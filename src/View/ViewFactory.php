<?php

namespace Loo\View;

use Loo\Core\FactoryInterface;

/**
 * Creates instances for views.
 */
class ViewFactory implements FactoryInterface
{
    /**
     * @return NullView
     */
    public function getEmpty()
    {
        return new NullView();
    }

    /**
     * @param string $view Path to the view
     *
     * @return HtmlView
     */
    public function getHtml($view = null)
    {
        return new HtmlView($view);
    }

    /**
     * @return JsonView
     */
    public function getJson()
    {
        return new JsonView();
    }

    /**
     * @param string $path
     *
     * @return ImageView
     */
    public function getImage($path)
    {
        return new ImageView($path);
    }

    /**
     * @param string $path
     *
     * @return ZipView
     */
    public function getZip($path)
    {
        return new ZipView($path);
    }
}
