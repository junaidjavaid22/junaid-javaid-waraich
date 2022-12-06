<?php

namespace RLTSquare\Ccq\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;
use RLTSquare\Ccq\Api\Data\QueueDataInterface;
use Magento\Framework\MessageQueue\PublisherInterface;

class UnitTwo extends Command
{
    /**
     *  number1
     */
    const FirstNumber = 'var1';
    /**
     * number2
     */
    const SecondNumber = 'var2';
    /**
     * @var PublisherInterface
     */
    protected $publisher;
    /**
     * @var QueueDataInterface
     */
    protected $queueData;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     * @param QueueDataInterface $queueData
     * @param PublisherInterface $publisher
     * @param string|null $name
     */
    public function __construct(

        LoggerInterface    $logger,
        QueueDataInterface $queueData,
        PublisherInterface $publisher,
        string             $name = null
    )
    {
        $this->publisher = $publisher;
        $this->queueData = $queueData;
        $this->logger = $logger;
        parent::__construct($name);

    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('RLTSquare:sum:number');
        $this->setDescription('My awesome Console command');

        // Next line will add a new required parameter to our script
        $this->addArgument(
            self::FirstNumber,
            null,
            InputArgument::IS_ARRAY,
            'var1'
        );
        $this->addArgument(
            self::SecondNumber,
            null,
            InputArgument::IS_ARRAY,
            'var2'
        );

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;
        $firstNumber = $input->getArgument(self::FirstNumber);
        $secondNumber = $input->getArgument(self::SecondNumber);
        $this->queueData->setData(".$firstNumber.$secondNumber");
        $this->publisher->publish('rltsquare', $this->queueData);
        $this->logger->info($firstNumber . $secondNumber . 'has been scheduled');
        return $exitCode;
    }
}
