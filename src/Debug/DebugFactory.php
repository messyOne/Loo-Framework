<?php

namespace Loo\Debug;

use Loo\Data\Settings;
use Monolog\Handler\StreamHandler;

/**
 * Creates all debug instances.
 */
class DebugFactory
{
    /**
     * @return Logger
     */
    public function getDebugLogger()
    {
        return $this->getLogger(LoggerLevel::DEBUG, LoggerChannel::DEBUG);
    }

    /**
     * @return Logger
     */
    public function getErrorLogger()
    {
        return $this->getLogger(LoggerLevel::ERROR, LoggerChannel::ERROR);
    }

    /**
     * @return Logger
     */
    public function getMailLogger()
    {
        return $this->getLogger(LoggerLevel::INFO, LoggerChannel::MAIL);
    }

    /**
     * @return Logger
     */
    public function getDaemonLogger()
    {
        return $this->getLogger(LoggerLevel::DEBUG, LoggerChannel::DAEMON);
    }

    /**
     * @param string $channel \Debug\LoggerChannel
     * @param int    $level   \Debug\LoggerLevel
     *
     * @return Logger
     */
    protected function getLogger($level = LoggerLevel::DEBUG, $channel = LoggerChannel::MAIN)
    {
        $logger = new Logger($channel);
        $logger->pushHandler($this->getStreamHandler(Settings::getLogPath().$channel.'.log', $level));

        return $logger;
    }

    /**
     * @param string $stream
     * @param bool|int $level
     * @return StreamHandler
     */
    protected function getStreamHandler($stream, $level)
    {
        return new StreamHandler($stream, $level);
    }
}
