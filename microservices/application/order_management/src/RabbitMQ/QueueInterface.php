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

/**
 * Interface QueueInterface
 * @package OrderManagement\RabbitMQ
 */
interface QueueInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return bool
     */
    public function isPassive() : bool;

    /**
     * @return bool
     */
    public function isDurable() : bool;

    /**
     * @return bool
     */
    public function isExclusive() : bool;

    /**
     * @return bool
     */
    public function isAutoDelete() : bool;
}
