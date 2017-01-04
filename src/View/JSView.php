<?php

namespace Loo\View;

/**
 * Return a Javascript file
 */
class JSView extends AbstractView
{
    /**
     * @string
     */
    private $path;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Sends the Header, read the file and dies.
     */
    public function render()
    {
        header('Content-Type: ' . $this->getContentType());
        header('Content-Length: '.filesize($this->path));
        readfile($this->path);
        die();
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return 'Content-Type: application/javascript; charset=utf-8';
    }
}
