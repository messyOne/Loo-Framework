<?php

namespace Loo\View;

/**
 * Renders a view which contains a video files.
 */
class VideoView extends AbstractView
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
     *  Sends the Header, read the file and dies.
     */
    public function render()
    {
        header('Content-Type: video/'.substr($this->path, -3));
        header('Content-Length: '.filesize($this->path));
        readfile($this->path);
        die();
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return 'video/'.substr($this->path, -3);
    }
}
