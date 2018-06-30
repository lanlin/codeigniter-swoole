<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Event
{


    /**
     * @param $fd[required]
     * @param $readCallback[required]
     * @param $writeCallback[optional]
     * @param $events[optional]
     * @return mixed
     */
    public static function add($fd, $readCallback, $writeCallback=null, $events=null){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public static function del($fd){}

    /**
     * @param $fd[required]
     * @param $readCallback[optional]
     * @param $writeCallback[optional]
     * @param $events[optional]
     * @return mixed
     */
    public static function set($fd, $readCallback=null, $writeCallback=null, $events=null){}

    /**
     * @return mixed
     */
    public static function exit(){}

    /**
     * @param $fd[required]
     * @param $data[required]
     * @return mixed
     */
    public static function write($fd, $data){}

    /**
     * @return mixed
     */
    public static function wait(){}

    /**
     * @param $callback[required]
     * @return mixed
     */
    public static function defer($callback){}


}
