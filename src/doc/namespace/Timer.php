<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Timer
{


    /**
     * @param $ms[required]
     * @param $callback[required]
     * @param $param[optional]
     * @return mixed
     */
    public static function tick($ms, $callback, $param=null){}

    /**
     * @param $ms[required]
     * @param $callback[required]
     * @return mixed
     */
    public static function after($ms, $callback){}

    /**
     * @param $timerId[required]
     * @return mixed
     */
    public static function exists($timerId){}

    /**
     * @param $timerId[required]
     * @return mixed
     */
    public static function clear($timerId){}


}
