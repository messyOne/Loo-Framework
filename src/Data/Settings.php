<?php

namespace Loo\Data;

use ErrorException;
use Loo\Auth\Session;

/**
 * Application specific settings.
 */
class Settings
{
    /** @var Store */
    private static $store = null;

    /**
     * Set the store object which stores the settings for the application.
     *
     * @param Store $store
     */
    public static function setConfig(Store $store)
    {
        static::$store = $store;
    }

    /**
     * @return array
     */
    public static function getDbConnection()
    {
        return static::$store->get('db_connection');
    }

    /**
     * @return string
     */
    public static function getDefaultLayout()
    {
        return static::$store->get('default_layout');
    }

    /**
     * Returns the url to the public folder.
     *
     * @return string
     */
    public static function getPublicUrl()
    {
        return static::getBaseUrl();
    }

    /**
     * @return string
     */
    public static function getBaseUrl()
    {
        return static::$store->get('base_url');
    }

    /**
     * @return string
     */
    public static function getAppName()
    {
        return static::$store->get('application_name');
    }

    /**
     * @return string
     */
    public static function getAppPath()
    {
        return ROOT.DIRECTORY_SEPARATOR.static::$store->get('app_path');
    }

    /**
     * @return string
     */
    public static function getBasePath()
    {
        return ROOT.DIRECTORY_SEPARATOR;
    }

    /**
     * @return string[]
     */
    public static function getLayouts()
    {
        return static::$store->get('layout_templates');
    }

    /**
     * @return string
     */
    public static function getEntityPaths()
    {
        return static::$store->get('entity_paths');
    }

    /**
     * @return string
     */
    public static function getLogPath()
    {
        return ROOT.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR;
    }

    /**
     * @return bool
     */
    public static function isDevMode()
    {
        return static::$store->get('development_environment');
    }

    /**
     * @return string
     */
    public static function getLocale()
    {
        return static::$store->get('locale');
    }

    /**
     * Check if environment is development and display errors.
     *
     * @return void
     */
    public static function setErrorHandling()
    {
        error_reporting(E_ALL);

        if (static::isDevMode()) {
            ini_set('display_errors', 'On');
        } else {
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', ROOT.'/logs/error.log');
        }

        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }

    /**
     * Set php settings
     */
    public static function setPhpSettings()
    {
        session_set_cookie_params(Session::LIFETIME);
        setlocale(LC_ALL, static::getLocale());
    }
}
