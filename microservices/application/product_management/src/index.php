<?php
/**
 * This file is part of product_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  ProductManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */


error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('max_execution_time', 180);

header('Content-Type: text/html; charset=UTF-8');

function autoload($className)
{
    $classPath = __DIR__.'/'.str_replace('\\', '/', $className).'.php';
    if (is_readable($classPath)) {
        require($classPath);
    }
}

require_once('../vendor/autoload.php');

Sentry\init(['dsn' => 'https://8c9d7d4e841c421482d60533dc100833@sentry.io/1491710' ]);

spl_autoload_register('autoload');

defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
defined('ENVROOT') ?: define('ENVROOT', dirname(__DIR__) . DS);

// Application Config
define('ROOT_DIR', __DIR__); // Root directory
define('APP_DIR', ROOT_DIR.'/App'); // Application directory
define('CORE_DIR', APP_DIR.'/Core'); // Core directory
define('MDIR', APP_DIR.'/Model'); // Model directory
define('VDIR', APP_DIR.'/View'); // View directory
define('CDIR', APP_DIR.'/Controller'); // Controller directory
define('UDIR', APP_DIR.'/Utility'); // Utility directory
define("PUBLIC_ROOT", "/"); // Root diroctory

define('APP_URL', $_SERVER["HTTP_HOST"]); // Application URL
define('ROOT_URL', $_SERVER["HTTP_HOST"]); // Application Root URL
define('APP_NAME', 'Product Management Service'); // Application URL

// Default Controller Config
define('CONTROLLER_PATH', '\App\Controller\\'); //  Index Controller Action
define("INDEX_CONTROLLER", CONTROLLER_PATH . "index");
define('INDEX_ACTION', 'main'); //  Index Controller Action

//Permission Def
define('SUB_MENU_NAME', 'SubMenuName'); // Sub Menu Name  Variable
define('MENU_CONTROLLER', 'MenuController'); // Menu Controller  Variable

if (file_exists(ENVROOT . '.env')) {
    $dotenv = new Dotenv\Dotenv(ENVROOT);
    try {
        $dotenv->load();
    } catch (\Dotenv\Exception\InvalidFileException $e) {
    } catch (\Dotenv\Exception\InvalidPathException $e) {
    }
}

define('DATABASE_HOST', getenv('DB_HOST'));
define('DATABASE_NAME', getenv('DB_DATABASE'));
define('DATABASE_USERNAME', getenv('DB_USERNAME'));
define('DATABASE_PASSWORD', getenv('DB_PASSWORD'));
define('DATABASE_PREFIX', '');


$App = new App\Core\App;
$App->run();
