<?php
/**
 * This file is part of order_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  OrderManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

namespace OrderManagement;

use OrderManagement\Http\Controller\DefaultController;
use OrderManagement\Http\Controller\OrderController;
use OrderManagement\Worker\OrderQueue\OrderQueueController;
use Dotenv\Dotenv;

/**
 * Class Application
 * @package OrderManagement
 */
class Application
{
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

    }

    /**
     * @throws \ErrorException
     */
    public function run()
    {
        if ($_SERVER['REQUEST_URI'] == '/order/create') {
            (new OrderController())->create();

            return;
        }

        if (isset($GLOBALS['argv'])
            && in_array('--queue', $GLOBALS['argv'])
        ) {
            (new OrderQueueController())->work();
        }

        (new DefaultController())->index();
    }
}
