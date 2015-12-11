<?php

namespace Loo\View;

/**
 * Creates the view for application/zip files.
 */
class ZipView extends AbstractView
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
        header('Cache-Control: public'); // needed for i.e.
        header('Content-Type: application/zip');
        header('Content-Transfer-Encoding: Binary');
        header('Content-Length:'.filesize($this->path));
        header('Content-Disposition: attachment; filename='.basename($this->path));

        readfile($this->path);
        die();
    }

    /**
     * @return string 'application/zip'
     */
    public function getContentType()
    {
        return 'application/zip';
    }
}
