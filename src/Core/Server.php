<?php namespace CiSwoole\Core;

/**
 * ------------------------------------------------------------------------------------
 * Swoole Server
 * ------------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2018/06/30
 */
class Server
{

    // ------------------------------------------------------------------------------

    /**
     * host config
     *
     * @var array
     */
    private static $cfgs =
    [
        'server_port' => null,
        'server_host' => '/var/run/swoole.sock',
        'debug_file'  => APPPATH . 'logs/swoole_debug.log',
    ];

    // ------------------------------------------------------------------------------

    /**
     * server config
     *
     * warning: do not change this
     *
     * @var array
     */
    private static $config =
    [
        'daemonize'      => true,        // using as daemonize?
        'package_eof'    => '☯',         // \u262F
        'reload_async'   => true,
        'open_eof_split' => true,
        'open_eof_check' => true,
    ];

    // ------------------------------------------------------------------------------

    /**
     * start a swoole server in cli
     *
     * @return mixed
     */
    public static function start()
    {
        self::initConfig();

        $serv = new \Swoole\Server
        (
            self::$cfgs['server_host'],
            self::$cfgs['server_port'],
            SWOOLE_PROCESS,
            SWOOLE_UNIX_STREAM
        );

        // init config
        $serv->set(self::$config);

        // listen on server init
        $serv->on('ManagerStart', [Server::class, 'onManagerStart']);
        $serv->on('WorkerStart',  [Server::class, 'onWorkerStart']);
        $serv->on('Start',        [Server::class, 'onMasterStart']);

        // listen on base event
        $serv->on('Connect', [Server::class, 'onConnect']);
        $serv->on('Receive', [Server::class, 'onReceive']);
        $serv->on('Finish',  [Server::class, 'onFinish']);
        $serv->on('Close',   [Server::class, 'onClose']);
        $serv->on('Task',    [Server::class, 'onTask']);

        // start server
        return $serv->start();
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on master start
     *
     * @param \Swoole\Server $serv
     */
    public static function onMasterStart(\Swoole\Server $serv)
    {
        if (self::$cfgs['server_port'] === null)
        {
            @chmod(self::$cfgs['server_host'], 0777);
        }

        @swoole_set_process_name($serv->setting['process_name'].'-MASTER');

        $msg = "SWOOLE MASTER: {$serv->manager_pid}\n";

        error_log($msg, 3, self::$cfgs['debug_file']);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on manager start
     *
     * @param \Swoole\Server $serv
     */
    public static function onManagerStart(\Swoole\Server $serv)
    {
        @swoole_set_process_name($serv->setting['process_name'].'-MANAGER');

        $msg = "SWOOLE MANAGER: {$serv->manager_pid}\n";

        error_log($msg, 3, self::$cfgs['debug_file']);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on workers start & set timers
     *
     * @param \Swoole\Server $serv
     * @param  int $workerId
     */
    public static function onWorkerStart(\Swoole\Server $serv, $workerId)
    {
        // set process name
        ($workerId >= $serv->setting['worker_num']) ?
        @swoole_set_process_name($serv->setting['process_name'].'-TASK') :
        @swoole_set_process_name($serv->setting['process_name'].'-WORKER');

        // when task start, return
        if ($serv->taskworker) { return; }

        // init all timers
        self::initTimers($serv);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on receive data
     *
     * @param \Swoole\Server $serv
     * @param int $fd
     * @param int $reactorId
     * @param string $data
     */
    public static function onReceive(\Swoole\Server $serv, $fd, $reactorId, $data = '')
    {
        // close client
        $serv->close($fd);

        // format passed
        $data = str_replace(self::$config['package_eof'], '', $data);
        $data = unserialize($data);

        if (!$data) { return; }

        // check is command
        if(!empty($data['shutdown']))
        {
            $serv->shutdown();
            return;
        }

        // reload command
        if (!empty($data['reload']))
        {
           $serv->reload();
           return;
        }

        // start a task
        $serv->task($data);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on task
     *
     * @param \Swoole\Server $serv
     * @param int $taskId
     * @param int $workerId
     * @param array $data
     */
    public static function onTask(\Swoole\Server $serv, $taskId, $workerId, $data)
    {
        try
        {
            $_SERVER['argv'] =
            [
                0 => SELF,
                1 => $data['route'],
            ];

            $_POST = $data['params'] ?? [];

            getCiSwooleConfig('starter');
        }

        catch (\Throwable $e) { self::logs($e); }
        finally { \Swoole\Process::kill(getmypid()); }
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on connect
     *
     * @param \Swoole\Server $serv
     * @param int $fd
     */
    public static function onConnect(\Swoole\Server $serv, $fd)
    {
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on close
     *
     * @param \Swoole\Server $serv
     * @param int $fd
     */
    public static function onClose(\Swoole\Server $serv, $fd)
    {
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on task finish
     *
     * @param \Swoole\Server $serv
     * @param int $taskId
     * @param mixed $data
     */
    public static function onFinish(\Swoole\Server $serv, $taskId, $data)
    {
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * init config
     *
     * @throws \Exception
     */
    private static function initConfig()
    {
        $config = getCiSwooleConfig('swoole');

        self::$cfgs['debug_file']  = $config['debug_file'];
        self::$cfgs['server_host'] = $config['server_host'];
        self::$cfgs['server_port'] = $config['server_port'];

        unset($config['debug_file'], $config['server_host'], $config['server_port']);

        self::$config = array_merge($config, self::$config);
    }

    // ------------------------------------------------------------------------------

    /**
     * log message to debug
     *
     * @param \Throwable $msg
     */
    private static function logs(\Throwable $msg)
    {
        $strings  = $msg->getMessage() . "\n";
        $strings .= $msg->getTraceAsString();

        $time_nw  = date('Y-m-d H:i:s');
        $content  = "\n== {$time_nw} ============================\n";
        $content .= "{$strings}";
        $content .= "\n===================================================\n\n";

        error_log($content, 3, self::$cfgs['debug_file']);
    }

    // ------------------------------------------------------------------------------

    /**
     * init timers for stamsel
     *
     * @param \Swoole\Server $serv
     */
    private static function initTimers(\Swoole\Server $serv)
    {
        try
        {
            $timers = getCiSwooleConfig('timers');

            foreach ($timers as $route => $microSeconds)
            {
                $data =
                [
                    'route'  => $route,
                    'params' => [],
                ];

                $serv->tick($microSeconds, function () use ($serv, $data)
                {
                    $stats = $serv->stats();

                    if ($stats['tasking_num'] < 4) { $serv->task($data); }
                });
            }
        }

        catch (\Throwable $e) { self::logs($e); }
        finally { unset($timers); }
    }

    // ------------------------------------------------------------------------------

}
