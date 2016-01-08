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
     * @param bool $prettyPrint
     * @return JsonView
     */
    public function getJson($prettyPrint = false)
    {
        return new JsonView($prettyPrint);
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

    /**
     * @param string $path
     *
     * @return JSView
     */
    public function getJS($path)
    {
        return new JSView($path);
    }
}
