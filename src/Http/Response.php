<?php

namespace Loo\Http;

use Loo\Data\Store;
use Loo\Helper\Type;

/**
 * Response object will be created by the Controllers and contains all the data which will be sent to the client.
 */
class Response
{
    /**
     * @var array HTTP response codes and messages
     */
    protected static $messages = [
        //Informational 1xx
        100 => '100 Continue',
        101 => '101 Switching Protocols',
        //Successful 2xx
        200 => '200 OK',
        201 => '201 Created',
        202 => '202 Accepted',
        203 => '203 Non-Authoritative Information',
        204 => '204 No Content',
        205 => '205 Reset Content',
        206 => '206 Partial Content',
        //Redirection 3xx
        300 => '300 Multiple Choices',
        301 => '301 Moved Permanently',
        302 => '302 Found',
        303 => '303 See Other',
        304 => '304 Not Modified',
        305 => '305 Use Proxy',
        306 => '306 (Unused)',
        307 => '307 Temporary Redirect',
        //Client Error 4xx
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        402 => '402 Payment Required',
        403 => '403 Forbidden',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        406 => '406 Not Acceptable',
        407 => '407 Proxy Authentication Required',
        408 => '408 Request Timeout',
        409 => '409 Conflict',
        410 => '410 Gone',
        411 => '411 Length Required',
        412 => '412 Precondition Failed',
        413 => '413 Request Entity Too Large',
        414 => '414 Request-URI Too Long',
        415 => '415 Unsupported Media Type',
        416 => '416 Requested Range Not Satisfiable',
        417 => '417 Expectation Failed',
        418 => '418 I\'m a teapot',
        422 => '422 Unprocessable Entity',
        423 => '423 Locked',
        //Server Error 5xx
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
        505 => '505 HTTP Version Not Supported',
    ];

    /** @var string */
    private $body;
    /** @var int */
    private $status;
    /** @var Store */
    private $headers;

    /**
     * @param string $body
     * @param int    $status
     * @param array  $headers
     */
    public function __construct($body = '', $status = 200, array $headers = [])
    {
        $this->status = $status;
        $this->body = $body;
        $this->headers = new Store(['Content-Type' => 'text/html']);
        $this->headers->setData($headers);
    }

    /**
     * Get message for HTTP status code.
     *
     * @param int $status
     *
     * @return string|null
     */
    public static function getMessageForCode($status)
    {
        if (isset(self::$messages[$status])) {
            return self::$messages[$status];
        } else {
            return;
        }
    }

    /**
     * @param string $url
     * @param int    $status
     */
    public function redirect($url, $status = 302)
    {
        $this->cleanBuffer();
        $this->body = '';
        $this->setStatus($status);
        $this->headers->set('Location', $url);
    }

    /**
     * @param string $body
     *
     * @return Response;
     */
    public function setBody($body = '')
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers->getAll();
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return Response
     */
    public function setHeader($key, $value)
    {
        $this->headers->set($key, $value);

        return $this;
    }

    /**
     * @param int $status
     *
     * @return Response
     */
    public function setStatus($status)
    {
        $this->status = Type::int($status);

        return $this;
    }

    /**
     * @return Response
     */
    private function cleanBuffer()
    {
        if (ob_get_level() !== 0) {
            ob_clean();
        }

        return $this;
    }
}
