<?php

namespace Loo\Http;

use Loo\Data\Settings;

/**
 * Helper functions related to HTTP
 */
class Helper
{
    /**
     * Is the current requested uri the current active uri. An ending / or /index will be identified as same uri
     *
     * @param string $uri
     * @return bool
     */
    public static function isActiveUri($uri)
    {
        $currentUri = rtrim(explode('?', ltrim($_SERVER['REQUEST_URI'], '/'))[0], '/');
        $uriWithIndex = $uri.'/index';


        return $currentUri === $uri || $currentUri === $uriWithIndex;
    }

    /**
     * Creates an url with the base url and the given parameters
     *
     * @param string $controller
     * @param string $action
     * @param array  $data
     * @return string
     */
    public static function url($controller = '', $action = '', array $data = [])
    {
        $url = Settings::getBaseUrl();

        if ($controller) {
            $url .= $controller;
        }

        if ($action) {
            $url .= '/'.$action;
        }

        if (!empty($data)) {
            $url .= '?'.http_build_query($data);
        }

        return $url;
    }
}
