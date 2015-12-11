<?php

namespace Loo\View;

use Loo\Data\FileEndings;
use Loo\Data\Settings;
use Loo\Exception\FieldNotSetException;

/**
 * The HtmlView object renders the given values in a html template.
 */
class HtmlView extends AbstractView
{
    private $layout;
    private $view;
    private $content;
    private $viewPath;
    private $cssFiles = [];

    /**
     * @param string $view
     */
    public function __construct($view = null)
    {
        $this->view = $view;
        $this->setDefaultLayout();
        $this->setDefaultViewPath();
    }

    /**
     * Sets a specified layout.
     *
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Returns the rendered view output.
     *
     * @return string
     */
    public function renderContent()
    {
        return $this->content;
    }

    /**
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @param string $path
     */
    public function setViewPath($path)
    {
        $this->viewPath = $path;
    }

    /**
     * @param string $file
     * @param string $media
     */
    public function addCss($file, $media = 'screen')
    {
        $this->cssFiles[] = [
            'file' => $file,
            'media' => $media,
        ];
    }

    /**
     * @return string
     */
    public function renderCssFiles()
    {
        $html = '';

        foreach ($this->cssFiles as $file) {
            $html .= '<link href="'.Settings::getPublicUrl().$file['file'].'" rel="stylesheet" media="'.$file['media'].'">';
        }

        return $html;
    }

    /**
     * Renders the view in the template.
     *
     * @return string
     */
    public function render()
    {
        $this->content = '';
        if ($this->view) {
            $this->content = $this->bufferView();
        }

        return $this->bufferLayout();
    }

    /**
     * @param string $view
     */
    public function includeView($view)
    {
        include Settings::getAppPath().$view.FileEndings::VIEW;
    }

    /**
     * @param string $layout
     */
    public function includeLayout($layout)
    {
        include $this->getLayoutFile($layout).FileEndings::LAYOUT;
    }

    /**
     * @return string 'text/html'
     */
    public function getContentType()
    {
        return 'text/html';
    }

    /**
     * Sets the default layout which is defined in the configuration of the application.
     */
    protected function setDefaultLayout()
    {
        $this->setLayout(Settings::getDefaultLayout());
    }

    /**
     * Sets the default view path.
     */
    protected function setDefaultViewPath()
    {
        $this->setViewPath(Settings::getAppPath());
    }

    /**
     * @param string $layout
     * @return string
     * @throws FieldNotSetException
     */
    protected function getLayoutFile($layout)
    {
        if (!isset(Settings::getLayouts()[$layout])) {
            throw new FieldNotSetException($layout.' is not set');
        }

        return Settings::getBasePath().Settings::getLayouts()[$layout];
    }

    /**
     * Uses the output buffer to render the given file.
     *
     * @param string $file
     *
     * @return string
     */
    private function buffer($file)
    {
        ob_start();
        include_once $file;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * @return string
     */
    private function bufferLayout()
    {
        return $this->buffer($this->getLayoutFile($this->layout).FileEndings::LAYOUT);
    }

    /**
     * @return string
     */
    private function bufferView()
    {
        return $this->buffer($this->viewPath.$this->view.FileEndings::VIEW);
    }
}
