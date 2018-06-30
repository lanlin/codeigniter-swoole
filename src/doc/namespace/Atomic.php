<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Atomic
{


    /**
     * @param $value[optional]
     * @return mixed
     */
    public function __construct($value=null){}

    /**
     * @param $addValue[optional]
     * @return mixed
     */
    public function add($addValue=null){}

    /**
     * @param $subValue[optional]
     * @return mixed
     */
    public function sub($subValue=null){}

    /**
     * @return mixed
     */
    public function get(){}

    /**
     * @param $value[required]
     * @return mixed
     */
    public function set($value){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function wait($timeout=null){}

    /**
     * @param $count[optional]
     * @return mixed
     */
    public function wakeup($count=null){}

    /**
     * @param $cmpValue[required]
     * @param $newValue[required]
     * @return mixed
     */
    public function cmpset($cmpValue, $newValue){}


}
