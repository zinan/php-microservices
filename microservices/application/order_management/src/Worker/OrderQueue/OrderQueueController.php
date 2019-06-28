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

namespace OrderManagement\Worker\OrderQueue;

use OrderManagement\Queue\OrderQueue;
use OrderManagement\RabbitMQ\Consumer;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class OrderQueueController
 * @package OrderManagement\Worker\OrderQueue
 */
class OrderQueueController
{
    /**
     * @throws \ErrorException
     */
    public function work()
    {
        $consumer = new Consumer(new OrderQueue());

        $consumer->addCallback(function (AMQPMessage $message) {
            //echo (':::'.$message);
        });

        $consumer->work(function (string $output) {
            //echo $output."\n";
        });
    }
}