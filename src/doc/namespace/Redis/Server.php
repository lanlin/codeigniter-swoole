<?php
namespace Swoole\Redis;

/**
 * @since 1.9.19
 */
class Server extends \swoole_server
{
    const NIL = 1;
    const ERROR = 0;
    const STATUS = 2;
    const INT = 3;
    const STRING = 4;
    const SET = 5;
    const MAP = 6;

    public $onConnect;
    public $onReceive;
    public $onClose;
    public $onPacket;
    public $onBufferFull;
    public $onBufferEmpty;
    public $onStart;
    public $onShutdown;
    public $onWorkerStart;
    public $onWorkerStop;
    public $onWorkerExit;
    public $onWorkerError;
    public $onTask;
    public $onFinish;
    public $onManagerStart;
    public $onManagerStop;
    public $onPipeMessage;
    public $setting;
    public $connections;
    public $host;
    public $port;
    public $type;
    public $mode;
    public $ports;
    public $masterPid;
    public $managerPid;
    public $workerId;
    public $taskworker;
    public $workerPid;

    /**
     * @return mixed
     */
    public function start(){}

    /**
     * @param $command[required]
     * @param $callback[required]
     * @param $numberOfStringParam[optional]
     * @param $typeOfArrayParam[optional]
     * @return mixed
     */
    public function setHandler($command, $callback, $numberOfStringParam=null, $typeOfArrayParam=null){}

    /**
     * @param $type[required]
     * @param $value[optional]
     * @return mixed
     */
    public static function format($type, $value=null){}

    /**
     * @param $host[required]
     * @param $port[optional]
     * @param $mode[optional]
     * @param $sockType[optional]
     * @return mixed
     */
    public function __construct($host, $port=null, $mode=null, $sockType=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $host[required]
     * @param $port[required]
     * @param $sockType[required]
     * @return mixed
     */
    public function listen($host, $port, $sockType){}

    /**
     * @param $host[required]
     * @param $port[required]
     * @param $sockType[required]
     * @return mixed
     */
    public function addlistener($host, $port, $sockType){}

    /**
     * @param $eventName[required]
     * @param $callback[required]
     * @return mixed
     */
    public function on($eventName, $callback){}

    /**
     * @param $settings[required]
     * @return mixed
     */
    public function set($settings){}

    /**
     * @param $fd[required]
     * @param $sendData[required]
     * @param $reactorId[optional]
     * @return mixed
     */
    public function send($fd, $sendData, $reactorId=null){}

    /**
     * @param $ip[required]
     * @param $port[required]
     * @param $sendData[required]
     * @param $serverSocket[optional]
     * @return mixed
     */
    public function sendto($ip, $port, $sendData, $serverSocket=null){}

    /**
     * @param $connFd[required]
     * @param $sendData[required]
     * @return mixed
     */
    public function sendwait($connFd, $sendData){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function exist($fd){}

    /**
     * @param $fd[required]
     * @param $isProtected[optional]
     * @return mixed
     */
    public function protect($fd, $isProtected=null){}

    /**
     * @param $connFd[required]
     * @param $filename[required]
     * @param $offset[optional]
     * @param $length[optional]
     * @return mixed
     */
    public function sendfile($connFd, $filename, $offset=null, $length=null){}

    /**
     * @param $fd[required]
     * @param $reset[optional]
     * @return mixed
     */
    public function close($fd, $reset=null){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function confirm($fd){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function pause($fd){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public function resume($fd){}

    /**
     * @param $data[required]
     * @param $workerId[optional]
     * @param $finishCallback[optional]
     * @return mixed
     */
    public function task($data, $workerId=null, $finishCallback=null){}

    /**
     * @param $data[required]
     * @param $timeout[optional]
     * @param $workerId[optional]
     * @return mixed
     */
    public function taskwait($data, $timeout=null, $workerId=null){}

    /**
     * @param $tasks[required]
     * @param $timeout[optional]
     * @return mixed
     */
    public function taskWaitMulti($tasks, $timeout=null){}

    /**
     * @param $data[required]
     * @return mixed
     */
    public function finish($data){}

    /**
     * @return mixed
     */
    public function reload(){}

    /**
     * @return mixed
     */
    public function shutdown(){}

    /**
     * @param $workerId[optional]
     * @return mixed
     */
    public function stop($workerId=null){}

    /**
     * @return mixed
     */
    public function getLastError(){}

    /**
     * @param $reactorId[required]
     * @return mixed
     */
    public function heartbeat($reactorId){}

    /**
     * @param $fd[required]
     * @param $reactorId[optional]
     * @return mixed
     */
    public function connectionInfo($fd, $reactorId=null){}

    /**
     * @param $startFd[required]
     * @param $findCount[optional]
     * @return mixed
     */
    public function connectionList($startFd, $findCount=null){}

    /**
     * @param $fd[required]
     * @param $reactorId[optional]
     * @return mixed
     */
    public function getClientInfo($fd, $reactorId=null){}

    /**
     * @param $startFd[required]
     * @param $findCount[optional]
     * @return mixed
     */
    public function getClientList($startFd, $findCount=null){}

    /**
     * @param $ms[required]
     * @param $callback[required]
     * @param $param[optional]
     * @return mixed
     */
    public function after($ms, $callback, $param=null){}

    /**
     * @param $ms[required]
     * @param $callback[required]
     * @return mixed
     */
    public function tick($ms, $callback){}

    /**
     * @param $timerId[required]
     * @return mixed
     */
    public function clearTimer($timerId){}

    /**
     * @param $callback[required]
     * @return mixed
     */
    public function defer($callback){}

    /**
     * @param $dstWorkerId[required]
     * @param $data[required]
     * @return mixed
     */
    public function sendMessage($dstWorkerId, $data){}

    /**
     * @param $process[required]
     * @return mixed
     */
    public function addProcess($process){}

    /**
     * @return mixed
     */
    public function stats(){}

    /**
     * @param $port[optional]
     * @return mixed
     */
    public function getSocket($port=null){}

    /**
     * @param $fd[required]
     * @param $uid[required]
     * @return mixed
     */
    public function bind($fd, $uid){}


}
