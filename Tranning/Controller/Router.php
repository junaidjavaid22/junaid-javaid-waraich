<?php
declare(strict_types=1);

namespace RLTSquare\Tranning\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

/**
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Router constructor.
     *
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request): ?ActionInterface
    {
        $identifier = trim($request->getPathInfo(), '/');

        if (str_contains($identifier, 'rltsquares')) {
            $request->setModuleName('rltsquare');
            $request->setControllerName('index');
            $request->setActionName('test');
            $request->setParams([
                'first_param' => 'first_value',
                'second_param' => 'second_value'
            ]);

            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }

        return null;
    }
}
