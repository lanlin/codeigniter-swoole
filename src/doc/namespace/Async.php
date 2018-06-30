<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Async
{


    /**
     * @param $filename[required]
     * @param $callback[required]
     * @param $chunkSize[optional]
     * @param $offset[optional]
     * @return mixed
     */
    public static function read($filename, $callback, $chunkSize=null, $offset=null){}

    /**
     * @param $filename[required]
     * @param $content[required]
     * @param $offset[optional]
     * @param $callback[optional]
     * @return mixed
     */
    public static function write($filename, $content, $offset=null, $callback=null){}

    /**
     * @param $filename[required]
     * @param $callback[required]
     * @return mixed
     */
    public static function readFile($filename, $callback){}

    /**
     * @param $filename[required]
     * @param $content[required]
     * @param $callback[optional]
     * @param $flags[optional]
     * @return mixed
     */
    public static function writeFile($filename, $content, $callback=null, $flags=null){}

    /**
     * @param $domainName[required]
     * @param $content[required]
     * @return mixed
     */
    public static function dnsLookup($domainName, $content){}

    /**
     * @param $settings[required]
     * @return mixed
     */
    public static function set($settings){}


}
