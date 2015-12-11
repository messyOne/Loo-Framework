<?php

namespace Loo\Data;

/**
 * Reads in a json file and returns data as an array.
 */
class JsonHandler
{
    /** @var string[] */
    private static $cache;
    /** @var string */
    private $file;

    /**
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param bool|true $assoc
     * @return array
     */
    public function load($assoc = true)
    {
        if (!isset(static::$cache[$this->file])) {
            static::$cache[$this->file] = json_decode($this->loadFile(), $assoc);
        }

        return static::$cache[$this->file];
    }

    /**
     * @param array $data
     * @param bool  $pretty json pretty print
     */
    public function save(array $data, $pretty = false)
    {
        $options = 0;
        $options |= $pretty ? JSON_PRETTY_PRINT : 0;

        $this->saveFile(json_encode($data, $options));
    }

    /**
     * Reset the cache
     */
    public function reset()
    {
        static::$cache[$this->file] = null;
    }

    /**
     * @return string
     */
    private function loadFile()
    {
        return file_get_contents(ROOT.DIRECTORY_SEPARATOR.$this->file);
    }

    /**
     * @param string $json
     */
    private function saveFile($json)
    {
        file_put_contents($this->file, $json);
    }
}
