<?php

namespace RLTSquare\Tranning\Logger;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

class Handler extends Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * Log File name
     * @var string
     */
    protected $fileName = '/var/log/RLTSquareTestEmail.log';
}
