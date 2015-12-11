<?php

namespace Loo\Http;

use Loo\Exception\NotExistsException;
use Loo\Exception\WrongParamCountException;
use Loo\Helper\ClassHelper;
use Loo\Routing\Routes;

/**
 * This class will translate the given url to a Controller class, the action and data.
 */
class Router
{
    /** @var string */
    private $controller = '';
    /** @var string */
    private $action = '';
    /** @var array */
    private $queryData = [];
    /** @var Routes */
    private $routes;
    /** @var bool */
    private $extendByParentNamespace;

    /**
     * @param Routes $routes
     * @param bool   $extendByParentNamespace
     */
    public function __construct(Routes $routes, $extendByParentNamespace = false)
    {
        $this->routes = $routes;
        $this->extendByParentNamespace = $extendByParentNamespace;
    }

    /**
     * Parses the url in the elements controller, action and query.
     *
     * @param string $url
     *
     * @throws WrongParamCountException
     */
    public function parseUrl($url)
    {
        if ($url) {
            $controller = '';
            $controllerDirectories = $this->routes->getControllerDirectories();

            foreach ($controllerDirectories as $path => $target) {
                if (strpos($url, $path) === 0) {
                    $url = str_replace($path, '', $url);
                    $controller = $target;
                }
            }

            $urlArray = explode('/', ltrim($url, '/'));

            if (!$controller) {
                $controller = ClassHelper::toCamel(array_shift($urlArray), '/_|-/');
            }
            $this->controller = $controller;
            $this->action = ClassHelper::toCamel(array_shift($urlArray), '/_|-/', true);

            $c = count($urlArray);
            if ($c % 2 === 1) {
                throw new WrongParamCountException('Wrong count of query elements.');
            }
            while (count($urlArray) > 0) {
                $this->queryData[array_shift($urlArray)] = array_shift($urlArray);
            }
        }
    }

    /**
     * @return string
     */
    public function getControllerAsString()
    {
        return $this->controller;
    }

    /**
     * @return string
     * @throws NotExistsException
     */
    public function getController()
    {
        if (!trim($this->getControllerAsString())) {
            $this->controller = $this->routes->getController('default');
        }

        $controller = $this->buildController($this->getControllerAsString());
        if (!class_exists($controller)) {
            if (substr($controller, -1) !== '\\') {
                $controller = preg_replace('/.*/', '', $controller, 1);
            }

            if (!class_exists($controller)) {
                throw new NotExistsException('Controller '.$this->getControllerAsString().' does not exist');
            }
        }

        return $controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        if (trim($this->action) === '') {
            $action = $this->buildAction($this->routes->getAction('default'));
        } else {
            $action = $this->buildAction($this->action);
        }

        return $action;
    }

    /**
     * @param string $action
     *
     * @return string
     */
    public function buildAction($action)
    {
        $actionMethod = 'action'.ClassHelper::snakeToCamel($action);

        return $actionMethod;
    }

    /**
     * @return array
     */
    public function getQueryData()
    {
        return $this->queryData;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function addParam($key, $value)
    {
        $this->queryData[$key] = $value;
    }

    /**
     * @param string $controller
     *
     * @return string
     */
    private function buildController($controller)
    {
        $controller = ClassHelper::pathToNamespace(ClassHelper::snakeToCamel($controller));

        $controllerClassString = ($this->extendByParentNamespace ? $controller : '').CONTROLLER;
        $controllerClassString = APPLICATION.'\\'.$controller.'\\'.$controllerClassString;

        return $controllerClassString;
    }
}
