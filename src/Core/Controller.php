<?php

namespace Loo\Core;

use Loo\Exception\NotExistsException;
use Loo\Http\Request;
use Loo\Http\Response;
use Loo\View\AbstractView;
use Loo\View\ViewFactory;

/**
 * Core Controller class with provides the needed objects for the children controllers.
 */
class Controller
{
    const HANDLE = 'handle';

    /** @var ViewFactory */
    private $viewFactory;
    /** @var AbstractView */
    private $view = null;
    /** @var Request */
    private $request;
    /** @var Response */
    private $response;
    /** @var string */
    private $requiredHttpMethod = null;

    /**
     * @param Request     $request
     * @param ViewFactory $viewFactory
     */
    public function __construct(Request $request, ViewFactory $viewFactory)
    {
        $this->request = $request;
        $this->viewFactory = $viewFactory;
        $this->view = $this->getViewFactory()->getEmpty();
        $this->response = new Response();

        $this->initialize();
    }

    /**
     * Returns the request object with all information about the request from the client.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return ViewFactory
     */
    public function getViewFactory()
    {
        return $this->viewFactory;
    }

    /**
     * Hook will be called in the constructor.
     */
    public function initialize()
    {
    }

    /**
     * Hook.
     */
    public function preAction()
    {
    }

    /**
     * Hook.
     */
    public function postAction()
    {
    }

    /**
     * This method is called before the page will be rendered.
     * This is the best place to manipulate the status code (other than 2xx or 3xx will lead to an error page).
     *
     * Return true if access is allowed otherwise false
     *
     * @return bool
     */
    public function hasAccess()
    {
        return true;
    }

    /**
     * @param string $action
     *
     * @throws NotExistsException
     *
     * @return Response
     */
    public function handle($action)
    {
        if (!method_exists($this, $action)) {
            throw new NotExistsException('Method '.$action.' does not exist');
        }

        if (((int) substr($this->getStatus(), 0, 1) === 2 ||
            (int) substr($this->getStatus(), 0, 1) === 3)
        ) {
            // Call hooks
            if ($this->hasAccess()) {
                $this->preAction();
                call_user_func([$this, $action]);
                $this->postAction();
            }

            if (!$this->isHttpMethodAllowed()) {
                $this->setStatus(405);
                $body = Response::getMessageForCode($this->getStatus());
            } else {
                $this->response->setHeader('Content-Type', $this->getView()->getContentType());
                $body = $this->getView()->render();
            }
        } else {
            $body = Response::getMessageForCode($this->getStatus());
        }

        $this->response->setBody($body)
            ->setStatus($this->getStatus());

        return $this->response;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->response->getStatus();
    }

    /**
     * @param string $status
     *
     * @return Response
     */
    protected function setStatus($status)
    {
        return $this->response->setStatus($status);
    }

    /**
     * @param string $view
     */
    protected function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return AbstractView|\Loo\View\NullView
     */
    protected function getView()
    {
        return $this->view;
    }

    /**
     * @param string $url
     * @param int    $status
     */
    protected function redirect($url, $status = 302)
    {
        $this->response->redirect($url, $status);
    }

    /**
     * @param string $method
     */
    protected function setRequiredHttpMethod($method)
    {
        $this->requiredHttpMethod = $method;
    }

    protected function getRequiredHttpMethod()
    {
        return $this->requiredHttpMethod;
    }

    /**
     * @return bool
     */
    protected function isHttpMethodAllowed()
    {
        return empty($this->getRequiredHttpMethod()) || $this->getRequest()->isMethod($this->getRequiredHttpMethod());
    }
}
