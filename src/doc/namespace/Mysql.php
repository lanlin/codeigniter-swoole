<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Mysql
{
    const STATE_QUERY = 0;
    const STATE_READ_START = 1;
    const STATE_READ_FIELD  = 2;
    const STATE_READ_ROW = 3;
    const STATE_READ_END = 4;
    const STATE_CLOSED = 5;

    public $serverInfo;
    public $sock;
    public $connected;
    public $errno;
    public $connectErrno;
    public $error;
    public $connectError;
    public $insertId;
    public $affectedRows;

    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $serverConfig[required]
     * @param $callback[required]
     * @return mixed
     */
    public function connect($serverConfig, $callback){}

    /**
     * @param $callback[required]
     * @return mixed
     */
    public function begin($callback){}

    /**
     * @param $callback[required]
     * @return mixed
     */
    public function commit($callback){}

    /**
     * @param $callback[required]
     * @return mixed
     */
    public function rollback($callback){}

    /**
     * @param $string[required]
     * @param $flags[optional]
     * @return mixed
     */
    public function escape($string, $flags=null){}

    /**
     * @param $sql[required]
     * @param $callback[required]
     * @return mixed
     */
    public function query($sql, $callback){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @return mixed
     */
    public function getState(){}

    /**
     * @param $eventName[required]
     * @param $callback[required]
     * @return mixed
     */
    public function on($eventName, $callback){}


}
