<?php

namespace OrderManagement\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class Publisher
{
    /**
     * @var AbstractQueue
     */
    protected $queue;

    /**
     * @param QueueInterface $queue
     */
    public function __construct(QueueInterface $queue)
    {
        $this->queue = $queue;
    }

    public function publish($message)
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

        $message = new AMQPMessage(json_encode(['product_id'=>1,'product_name'=>'deneme'], JSON_UNESCAPED_SLASHES), array('delivery_mode' => 2));
        $channel->basic_publish($message, '', $this->queue->getName());

//        $channel->queue_declare(
//            $queue = RABBITMQ_QUEUE_NAME,
//            $passive = false,
//            $durable = true,
//            $exclusive = false,
//            $auto_delete = false,
//            $nowait = false,
//            $arguments = null,
//            $ticket = null
//        );
//
//        $job_id=0;
//        while (true)
//        {
//            $jobArray = array(
//                'id' => $job_id++,
//                'task' => 'sleep',
//                'sleep_period' => rand(0, 3)
//            );
//
//            $msg = new AMQPMessage(
//                json_encode($jobArray, JSON_UNESCAPED_SLASHES),
//                array('delivery_mode' => 2) # make message persistent
//            );
//
//            $channel->basic_publish($msg, '', $this->queue->getName());
//            print 'Job created' . PHP_EOL;
//            sleep(1);
//        }



        $channel->close();
        $connection->close();
    }
}
