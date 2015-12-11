<?php

namespace Loo\Auth;

/**
 * Handles all about the session and encapsulates the session functions.
 */
class Session
{
    const LIFETIME = 3600 * 2;

    /**
     * @return bool
     */
    public function start()
    {
        return session_start();
    }

    /**
     * @return bool
     */
    public function close()
    {
        return session_destroy();
    }

    /**
     * Returns either a value from the session container or the entire session array if $key is not set.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }

        if (!isset($_SESSION[$key])) {
            return false;
        }

        return $_SESSION[$key];
    }

    /**
     * Set a value to the session container.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
