<?php

namespace Loo\Http;

use Loo\Data\Store;

/**
 * Request object represents the data which is sent by the client request like requested method and data
 */
class Request
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    const INPUT_STREAM = 'php://input';

    /** @var string*/
    private $url;
    /** @var Store */
    private $data;

    /**
     * @param string $url requested url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->data = new Store();
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns the data from a specific request method.
     *
     * @return array
     */
    public function getData()
    {
        $data = json_decode(file_get_contents(static::INPUT_STREAM), true);

        if ($data) {
            return array_merge($this->data->getAll(), $data);
        }

        if ($this->isMethod(self::GET)) {
            return array_merge($this->data->getAll(), $_GET);
        }

        if ($this->isMethod(self::POST)) {
            return array_merge($this->data->getAll(), $_POST);
        }

        return [];
    }

    /**
     * Data with the same key will be overridden
     *
     * @param array $data
     */
    public function addData(array $data)
    {
        $this->data->setData($data);
    }

    /**
     * @param string $method
     * @return bool
     */
    public function isMethod($method)
    {
        return strtolower($this->getMethod()) === strtolower($method);
    }

    /**
     * @return mixed
     * @SuppressWarnings(PHPMD.Superglobals)
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
