<?php

namespace Loo\Auth;

/**
 * Wrapper for the password functions from php.
 */
class Password
{
    /**
     * @param string $password
     *
     * @return bool|string
     */
    public function getHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
