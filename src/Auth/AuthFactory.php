<?php

namespace Loo\Auth;

use Loo\Core\FactoryInterface;

/**
 * Create instances used for authentication.
 */
class AuthFactory implements FactoryInterface
{
    /**
     * @return Session
     */
    public function getSession()
    {
        return new Session();
    }

    /**
     * @return Password
     */
    public function getPassword()
    {
        return new Password();
    }
}
