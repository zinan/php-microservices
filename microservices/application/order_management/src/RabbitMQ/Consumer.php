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
 * Class Consumer
 * @package OrderManagement\RabbitMQ
 */
class Consumer
{
    /**
     * @var AbstractQueue
     */
    protected $queue;

    /**
     * @var array
     */
    protected $callbacks = [];

    /**
     * @param QueueInterface $queue
     */
    public function __construct(QueueInterface $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @param $callable
     */
    public function addCallback($callable)
    {
        $this->callbacks[] = $callable;
    }

    /**
     * @param callable $stream
     * @throws \ErrorException
     */
    public function work(callable $stream)
    {
        $connection = new Connection();
        $channel = $connection->channel();

        $channel->queue_declare(
            $this->queue->getName(),
            $this->queue->isPassive(),
            $this->queue->isDurable(),
            $this->queue->isExclusive(),
            $this->queue->isAutoDelete()
        );

        $stream('[*] Waiting for messages. To exit press CTRL+C');

        foreach ($this->callbacks as $callback) {
            $channel->basic_consume(
                $this->queue->getName(),
                '',
                false,
                true,
                false,
                false,
                $callback
            );
        }

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
