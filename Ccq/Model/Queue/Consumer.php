<?php declare(strict_types=1);

namespace RLTSquare\Ccq\Model\Queue;

use Psr\Log\LoggerInterface;

class Consumer
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
     * @return void
     */
    public function processMessage(): void
    {
        $this->logger->debug('Processed queue message...');
    }
}
