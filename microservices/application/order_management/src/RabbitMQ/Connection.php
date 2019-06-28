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

namespace OrderManagement\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class Connection
 * @package OrderManagement\RabbitMQ
 */
class Connection extends AMQPStreamConnection
{
    /**
     * Connection constructor.
     */
    public function __construct()
    {
        parent::__construct(
            getenv('RABBITMQ_URL'),
            getenv('RABBITMQ_PORT'),
            getenv('RABBITMQ_DEFAULT_USER'),
            getenv('RABBITMQ_DEFAULT_PASS')
        );
    }
}
