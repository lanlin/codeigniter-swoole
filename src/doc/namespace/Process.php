<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Process
{
    const IPC_NOWAIT = 256;

    public $pipe;
    public $callback;
    public $msgQueueId;
    public $msgQueueKey;
    public $pid;
    public $id;

    /**
     * @param $callback[required]
     * @param $redirectStdinAndStdout[optional]
     * @param $pipeType[optional]
     * @return mixed
     */
    public function __construct($callback, $redirectStdinAndStdout=null, $pipeType=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $blocking[optional]
     * @return mixed
     */
    public static function wait($blocking=null){}

    /**
     * @param $signalNo[required]
     * @param $callback[required]
     * @return mixed
     */
    public static function signal($signalNo, $callback){}

    /**
     * @param $usec[required]
     * @return mixed
     */
    public static function alarm($usec){}

    /**
     * @param $pid[required]
     * @param $signalNo[optional]
     * @return mixed
     */
    public static function kill($pid, $signalNo=null){}

    /**
     * @param $nochdir[optional]
     * @param $noclose[optional]
     * @return mixed
     */
    public static function daemon($nochdir=null, $noclose=null){}

    /**
     * @param $cpuSettings[required]
     * @return mixed
     */
    public static function setaffinity($cpuSettings){}

    /**
     * @param $key[optional]
     * @param $mode[optional]
     * @return mixed
     */
    public function useQueue($key=null, $mode=null){}

    /**
     * @return mixed
     */
    public function statQueue(){}

    /**
     * @return mixed
     */
    public function freeQueue(){}

    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @param $data[required]
     * @return mixed
     */
    public function write($data){}

    /**
     * @return mixed
     */
    public function close(){}

    /**
     * @param $size[optional]
     * @return mixed
     */
    public function read($size=null){}

    /**
     * @param $data[required]
     * @return mixed
     */
    public function push($data){}

    /**
     * @param $size[optional]
     * @return mixed
     */
    public function pop($size=null){}

    /**
     * @param $exitCode[optional]
     * @return mixed
     */
    public function exit($exitCode=null){}

    /**
     * @param $execFile[required]
     * @param $args[required]
     * @return mixed
     */
    public function exec($execFile, $args){}

    /**
     * @param $processName[required]
     * @return mixed
     */
    public function name($processName){}


}
