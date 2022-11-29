<?php

namespace RLTSquare\Tranning\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use RLTSquare\Tranning\Logger\Logger;


class Test implements HttpGetActionInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param PageFactory $pageFactory
     * @param RequestInterface $request
     * @param Logger $logger
     */
    public function __construct(
        PageFactory      $pageFactory,
        RequestInterface $request,
        logger           $logger
    )
    {
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        $this->logger = $logger;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $this->logger->Info("Page Visited");
        return $this->pageFactory->create();
    }
}
