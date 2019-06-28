<?php
/**
 * This file is part of category_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  CategoryManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

namespace CategoryManagement;

use PDO;
use PDOException;
use GuzzleHttp\Client;
use Dotenv\Dotenv;

/**
 * Class Application
 * @package CategoryManagement
 */
class Application
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
        defined('ENVROOT') ?: define('ENVROOT', dirname(__DIR__) . DS);
        if (file_exists(ENVROOT . '.env')) {
            $dotenv = new Dotenv(ENVROOT);
            try {
                $dotenv->load();
            } catch (InvalidFileException $e) {
            } catch (InvalidPathException $e) {
            }
        }

        define('DB_CONNECTION', getenv('DB_CONNECTION'));
        define('DATABASE_HOST', getenv('DB_HOST'));
        define('DATABASE_NAME', getenv('DB_DATABASE'));
        define('DATABASE_USERNAME', getenv('DB_USERNAME'));
        define('DATABASE_PASSWORD', getenv('DB_PASSWORD'));

        try {
            $this->db = new PDO(DB_CONNECTION.':host='.DATABASE_HOST.';dbname='.DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function run()
    {
        if (!$_SERVER['REQUEST_URI'])
        {
            header('Content-Type: application/json; charset=UTF-8');
        }

        if ($_SERVER['REQUEST_URI'] == '/category/list') {
            $categories = $this->db->prepare('SELECT * FROM categories');
            $categories->execute();
            echo json_encode($categories->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
            return;
        }

        if ($_SERVER['REQUEST_URI'] == '/category/add') {

            $token = $this->getToken();
            if(!$token) {
                die(json_encode(['error'=>'authentication error!']));
            }

            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ];
            $res = $client->request('GET', 'http://user_management_nginx_1/user/checkToken',
                [
                    'headers' => $headers,
                    'exceptions' => false
                ]
            );
            $httpCode = $res->getStatusCode();
            if($httpCode!=200)
            {
                die(json_encode(['error'=>'authentication error!']));
            }


            $response = json_decode($res->getBody(),1);
            $isAdmin = $response['user']['is_admin'];

            if(!$isAdmin) {
                die(json_encode(['error'=>'admin only!']));
            }

            $post = json_decode(file_get_contents('php://input'),true);

            $data = [
                'category_name' => $post['category_name']
            ];
            $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
            $stmt= $this->db->prepare($sql);
            $stmt->execute($data);

            die(json_encode(['id'=>$this->db->lastInsertId()]));
            return;
        }

        die('<h2 style="text-align: center;">Category Management</h2>');
    }

    /**
     * Get Http Header Bearer Token
     *
     * @return string |null
     */
    private function getToken()
    {
        $result = null;
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            list($type, $data) = explode(" ", $_SERVER["HTTP_AUTHORIZATION"], 2);
            if (strcasecmp($type, "Bearer") == 0) {
                $result = $data;
            }
        }

        return $result;
    }

}