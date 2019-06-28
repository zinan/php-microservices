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
 * Class AbstractQueue
 * @package OrderManagement\RabbitMQ
 */
abstract class AbstractQueue implements QueueInterface
{
    /**
     *
     * @var string
     */
    protected $name = '';

    /**
     *
     * @var bool
     */
    protected $passive = false;

    /**
     *
     * @var bool
     */
    protected $durable = true;

    /**
     *
     * @var bool
     */
    protected $exclusive = false;

    /**
     *
     * @var bool
     */
    protected $autoDelete = false;

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isPassive() : bool
    {
        return $this->passive;
    }

    /**
     * @return bool
     */
    public function isDurable() : bool
    {
        return $this->durable;
    }

    /**
     * @return bool
     */
    public function isExclusive() : bool
    {
        return $this->exclusive;
    }

    /**
     * @return bool
     */
    public function isAutoDelete() : bool
    {
        return $this->autoDelete;
    }
}
