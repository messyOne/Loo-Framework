<?php

namespace Loo\Debug;

use Loo\Core\AbstractEnum;

/**
 * Class LogChannelEnum.
 */
class LoggerChannel extends AbstractEnum
{
    const __DEFAULT = self::MAIN;

    const MAIN = 'global';
    const DEBUG = 'debug';
    const ERROR = 'error';
    const MAIL = 'mail';
    const DAEMON = 'daemon';
}
