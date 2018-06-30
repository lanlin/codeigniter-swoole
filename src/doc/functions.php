<?php
function swoole_version(){}

function swoole_cpu_num(){}

function swoole_last_error(){}

/**
 * @param $fd[required]
 * @param $readCallback[required]
 * @param $writeCallback[optional]
 * @param $events[optional]
 * @return mixed
 */
function swoole_event_add($fd, $readCallback, $writeCallback=null, $events=null){}

/**
 * @param $fd[required]
 * @param $readCallback[optional]
 * @param $writeCallback[optional]
 * @param $events[optional]
 * @return mixed
 */
function swoole_event_set($fd, $readCallback=null, $writeCallback=null, $events=null){}

/**
 * @param $fd[required]
 * @return mixed
 */
function swoole_event_del($fd){}

function swoole_event_exit(){}

function swoole_event_wait(){}

/**
 * @param $fd[required]
 * @param $data[required]
 * @return mixed
 */
function swoole_event_write($fd, $data){}

/**
 * @param $callback[required]
 * @return mixed
 */
function swoole_event_defer($callback){}

/**
 * @param $ms[required]
 * @param $callback[required]
 * @param $param[optional]
 * @return mixed
 */
function swoole_timer_after($ms, $callback, $param=null){}

/**
 * @param $ms[required]
 * @param $callback[required]
 * @return mixed
 */
function swoole_timer_tick($ms, $callback){}

/**
 * @param $timerId[required]
 * @return mixed
 */
function swoole_timer_exists($timerId){}

/**
 * @param $timerId[required]
 * @return mixed
 */
function swoole_timer_clear($timerId){}

/**
 * @param $settings[required]
 * @return mixed
 */
function swoole_async_set($settings){}

/**
 * @param $filename[required]
 * @param $callback[required]
 * @param $chunkSize[optional]
 * @param $offset[optional]
 * @return mixed
 */
function swoole_async_read($filename, $callback, $chunkSize=null, $offset=null){}

/**
 * @param $filename[required]
 * @param $content[required]
 * @param $offset[optional]
 * @param $callback[optional]
 * @return mixed
 */
function swoole_async_write($filename, $content, $offset=null, $callback=null){}

/**
 * @param $filename[required]
 * @param $callback[required]
 * @return mixed
 */
function swoole_async_readfile($filename, $callback){}

/**
 * @param $filename[required]
 * @param $content[required]
 * @param $callback[optional]
 * @param $flags[optional]
 * @return mixed
 */
function swoole_async_writefile($filename, $content, $callback=null, $flags=null){}

/**
 * @param $domainName[required]
 * @param $content[required]
 * @return mixed
 */
function swoole_async_dns_lookup($domainName, $content){}

/**
 * @param $readArray[required]
 * @param $writeArray[required]
 * @param $errorArray[required]
 * @param $timeout[optional]
 * @return mixed
 */
function swoole_client_select($readArray, $writeArray, $errorArray, $timeout=null){}

/**
 * @param $readArray[required]
 * @param $writeArray[required]
 * @param $errorArray[required]
 * @param $timeout[optional]
 * @return mixed
 */
function swoole_select($readArray, $writeArray, $errorArray, $timeout=null){}

/**
 * @param $processName[required]
 * @return mixed
 */
function swoole_set_process_name($processName){}

function swoole_get_local_ip(){}

function swoole_get_local_mac(){}

/**
 * @param $errno[required]
 * @return mixed
 */
function swoole_strerror($errno){}

function swoole_errno(){}

