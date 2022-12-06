<?php

namespace RLTSquare\Ccq\Cron;

use Psr\Log\LoggerInterface;

class RLTSquareCron
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     *
     * @return void
     */
    public function execute()
    {

        $this->logger->info('hello world from rltsquare_hello_world cron job');
    }
}
