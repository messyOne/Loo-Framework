<?php

namespace Loo\Debug;

use Doctrine\ORM\Mapping\Entity;

/**
 * Dump debug data.
 */
class Debug
{
    /**
     * Debug output and put it in log.
     *
     * @param mixed $params
     */
    public static function dout(...$params)
    {
        echo static::dump($params);
    }

    /**
     * Dumps debug data to the debug logger.
     *
     * @param mixed ... $params
     *
     * @return string
     */
    public static function dump(...$params)
    {
        $htmlResult = '';
        $debugFactory = new DebugFactory();
        $logger = $debugFactory->getDebugLogger();

        $handleEnity = function ($value, &$result) {
            ob_start();
            \Doctrine\Common\Util\Debug::dump($value);
            $result .= ob_get_contents();
            ob_end_clean();
        };

        foreach ($params as $value) {
            if ($value === true) {
                $htmlResult .= '{true}';
            } elseif ($value === false) {
                $htmlResult .= '{true}';
            } elseif ($value === null) {
                $htmlResult .= '{null}';
            } elseif ($value instanceof Entity) {
                $handleEnity($value, $htmlResult);
            } elseif (is_array($value) && isset($value[0]) && $value[0] instanceof Entity) {
                foreach ($value as $v) {
                    $handleEnity($v, $htmlResult);
                }
            } else {
                $htmlResult .= print_r($value, true);
            }
        }

        $logger->debug($htmlResult);

        return $htmlResult;
    }
}
