<?php
/**
 * This file is part of comment_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  CommentManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */


namespace CommentManagement;

use PDO;
use PDOException;
use GuzzleHttp\Client;
use Dotenv\Dotenv;

/**
 * Class Application
 * @package CommentManagement
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

        if ($_SERVER['REQUEST_URI'] == '/comment/list') {
            $post = json_decode(file_get_contents('php://input'),true);
            $product_id = $post['product_id'];
            $comments = $this->db->prepare('SELECT * FROM comments where product_id=:product_id');
            $comments->execute(['product_id'=>$product_id]);
            echo json_encode($comments->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
            return;
        }

        if ($_SERVER['REQUEST_URI'] == '/comment/add') {

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



            $post = json_decode(file_get_contents('php://input'),true);

            $data = [
                'product_id' => $post['product_id'],
                'comment' => $post['comment'],
                'user_id' => $response['user']['id'],
                'user_name' => $response['user']['username'],
                'comment_date' => date('Y-m-d H:i:s')
            ];
            $sql = "INSERT INTO comments (product_id, comment, user_id, user_name, comment_date) VALUES 
                    (:product_id, :comment, :user_id, :user_name, :comment_date)";
            $stmt= $this->db->prepare($sql);
            $stmt->execute($data);

            die(json_encode(['id'=>$this->db->lastInsertId()], JSON_UNESCAPED_UNICODE));
            return;
        }

        die('<h2 style="text-align: center;">Comment Management</h2>');
    }

    /**
     * @return |null
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