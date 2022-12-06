<?php
namespace RLTSquare\Tranning\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use RLTSquare\Tranning\Logger\Logger;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var StateInterface
     */
    protected $inlineTranslation;
    /**
     * @var Escaper
     */
    protected $escaper;
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param Context $context
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param Logger $logger
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        logger $logger
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger =$logger;
    }

    /**
     * @return void
     */
    public function sendEmail()
    {
        try {
            $this->inlineTranslation->suspend();
            /**
             * Email will be sent by this Email we can set these configurations in admin and fetch these creds through admin
             */
            $sender = [
                'name' => $this->escaper->escapeHtml('Test'),
                'email' => $this->escaper->escapeHtml('junaid.javaid@rltsquare.com'),
            ];
            /**
             * Transport builder will set email tamplate , store and reciver email.
             */
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_demo_template')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => 1,
                    ]
                )
                ->setTemplateVars([
                    'templateVar'  => 'My Topic',
                ])
                ->setFromByScope($sender)
                ->addTo('junaid.javaid@rltsquare.com')
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            /**
             * Editing log file with new entry.
             */
            $this->logger->Info("Emial has been sent");
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}
