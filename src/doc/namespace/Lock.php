<?php
namespace Swoole;

/**
 * @since 1.9.19
 */
class Lock
{
    const FILELOCK = 2;
    const MUTEX = 3;
    const SEM = 4;
    const RWLOCK = 1;
    const SPINLOCK = 5;

    /**
     * @param $type[optional]
     * @param $filename[optional]
     * @return mixed
     */
    public function __construct($type=null, $filename=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @return mixed
     */
    public function lock(){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function lockwait($timeout=null){}

    /**
     * @return mixed
     */
    public function trylock(){}

    /**
     * @return mixed
     */
    public function lockRead(){}

    /**
     * @return mixed
     */
    public function trylockRead(){}

    /**
     * @return mixed
     */
    public function unlock(){}


}
