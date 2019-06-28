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

namespace OrderManagement\Http\Controller;

use OrderManagement\Queue\OrderQueue;
use OrderManagement\RabbitMQ\Publisher;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class OrderController
 * @package OrderManagement\Http\Controller
 */
class OrderController
{
    /**
     *
     */
    public function create()
    {
        $publisher = new Publisher(new OrderQueue());
        $publisher->publish('ürün adı');

        echo json_encode([
            'status' => 'created',
            'hostname' => getenv('HOSTNAME'),
        ], JSON_PRETTY_PRINT);
    }

    /**
     *
     */
    public function show()
    {
        echo json_encode([
            'hostname' => getenv('HOSTNAME'),
        ], JSON_PRETTY_PRINT);
    }
}
