<?php

namespace Loo\Html;

use Loo\Core\AbstractRenderable;
use Loo\Http\Helper;

/**
 * Creating a frame work URL.
 */
class Url extends AbstractRenderable
{
    /** @var string */
    private $title;
    /** @var string */
    private $controller;
    /** @var string */
    private $action;
    /** @var array */
    private $data = [];
    /** @var string */
    private $cssClass;

    /**
     * @param string $title
     * @param string $controller
     * @param string $action
     */
    public function __construct($title, $controller = '', $action = '')
    {
        $this->title = $title;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @param array $data
     * @return Url
     */
    public function addData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $class
     * @return Url
     */
    public function addCss($class)
    {
        $this->cssClass = $class;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $href = Helper::url($this->controller, $this->action, $this->data);
        $element = new UrlElement($this->title, $href, $this->cssClass);

        return $element->render();
    }
}
