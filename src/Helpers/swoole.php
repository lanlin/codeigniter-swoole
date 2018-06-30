<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Swoole Server Host
|--------------------------------------------------------------------------
|
| For custom configuration, you can copy this swoole.php to
| the application/config folder.
|
| Warning:
|    Do not change any configuration, unless you know what it is!
|
| For more detail document, view this link below
| @link https://www.swoole.co.uk/docs/modules/swoole-server-doc
*/
$swoole['server_host'] = '127.0.0.1';
$swoole['server_port'] = 9501;


/*
|--------------------------------------------------------------------------
| Connection
|--------------------------------------------------------------------------
|
| Max connection number
*/
$swoole['max_conn'] = 1000;


/*
|--------------------------------------------------------------------------
| Request
|--------------------------------------------------------------------------
|
| Exit worker when finished ? times
*/
$swoole['max_request'] = 10;


/*
|--------------------------------------------------------------------------
| Waite Time
|--------------------------------------------------------------------------
|
| After ? seconds force exit
*/
$swoole['max_wait_time'] = 60;


/*
|--------------------------------------------------------------------------
| Worker
|--------------------------------------------------------------------------
|
| How many workers did you want?
*/
$swoole['worker_num'] = 4;


/*
|--------------------------------------------------------------------------
| Swoole Server Port
|--------------------------------------------------------------------------
|
| 3: post to a free worker
*/
$swoole['dispatch_mode'] = 3;


/*
|--------------------------------------------------------------------------
| Task Worker
|--------------------------------------------------------------------------
|
| Worker numbers for task
*/
$swoole['task_worker_num'] = 12;


/*
|--------------------------------------------------------------------------
| Logs
|--------------------------------------------------------------------------
|
| Server log file & debug file
*/
$swoole['log_file']   = APPPATH . 'logs/swoole.log';
$swoole['debug_file'] = APPPATH . 'logs/swoole_debug.log';


/*
|--------------------------------------------------------------------------
| Swoole Process
|--------------------------------------------------------------------------
|
| Process name for swoole
*/
$swoole['process_name'] = 'CiSwoole';


/*
|--------------------------------------------------------------------------
| Heartbeat
|--------------------------------------------------------------------------
|
| Seconds for heartbeat
*/
$swoole['heartbeat_idle_time']      = 10;
$swoole['heartbeat_check_interval'] = 5;


// the end
return $swoole;
