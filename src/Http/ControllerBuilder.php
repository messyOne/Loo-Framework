<?php

namespace Loo\Http;

use Loo\Core\Controller;
use Loo\Exception\NotAllowedException;
use Loo\Exception\NullException;
use Loo\View\ViewFactory;

/**
 * Create a controller object and handles the error if called url not exists or access is not allowed.
 */
class ControllerBuilder
{
    /** @var Request */
    private $request;
    /** @var ViewFactory */
    private $viewFactory;
    /** @var Router */
    private $router;
    /** @var Controller */
    private $controller;
    /** @var string */
    private $action;

    /**
     * @param Request     $request
     * @param Router      $router
     * @param ViewFactory $viewFactory
     */
    public function __construct(Request $request, Router $router, ViewFactory $viewFactory)
    {
        $this->request = $request;
        $this->viewFactory = $viewFactory;
        $this->router = $router;
    }

    /**
     */
    public function build()
    {
        $this->controller = $this->createControllerObject($this->router->getController());
        $this->action = $this->router->getAction();
    }

    /**
     * @return Controller
     * @throws NullException
     */
    public function getController()
    {
        if ($this->controller) {
            return $this->controller;
        }

        throw new NullException('There is no controller set. You have to run the build method at first');
    }

    /**
     * @return string
     * @throws NullException
     */
    public function getAction()
    {
        if ($this->action) {
            return $this->action;
        }

        throw new NullException('There is no action set. You have to run the build method at first');
    }

    /**
     * @param $controllerClass
     *
     * @throws NotAllowedException
     *
     * @return Controller
     */
    protected function createControllerObject($controllerClass)
    {
        /** @var Controller $controller */
        $controller = new $controllerClass(
            $this->request,
            $this->viewFactory
        );

        if ($controller instanceof Controller) {
            return $controller;
        }

        throw new NotAllowedException($controllerClass.' is not an instance of Controller');
    }
}
