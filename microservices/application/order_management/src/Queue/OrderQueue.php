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

namespace OrderManagement\Queue;

use OrderManagement\RabbitMQ\AbstractQueue;

/**
 * Class OrderQueue
 * @package OrderManagement\Queue
 */
class OrderQueue extends AbstractQueue
{
    /**
     * Queue names may be up to 255 bytes of UTF-8 characters.
     *
     * @var string
     */
    protected $name = 'order_queue';
}
