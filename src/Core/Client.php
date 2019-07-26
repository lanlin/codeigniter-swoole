<?php namespace CiSwoole\Core;

/**
 * ------------------------------------------------------------------------------------
 * Swoole Client
 * ------------------------------------------------------------------------------------
 *
 * @author  lanlin
 * @change  2019/07/26
 */
class Client
{

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
        'package_eof' => '☯',         // \u262F
        'server_port' => null,
        'server_host' => '/var/run/swoole.sock',
        'server_type' => SWOOLE_SOCK_UNIX_STREAM,
        'debug_file'  => APPPATH . 'logs/swoole_debug.log',
    ];

    // ------------------------------------------------------------------------------

    /**
     * connect to swoole server then send data
     *
     * @param array $data
     * [
     *     'route'   => 'your/route/uri', // the route uri will be call
     *     'params'  => [],               // params will be passed to your method
     * ];
     */
    public static function send(array $data)
    {
        self::initConfig();

        // select mode
        $sapi = php_sapi_name();
        $mode = ($sapi === 'cli') ? SWOOLE_SOCK_ASYNC : SWOOLE_SOCK_SYNC;

        /**
         * @property array $stamsel
         */
        $client = new \Swoole\Client(self::$config['server_type'], $mode);

        // dynamic custom data
        $client->CiSwooleData = $data;

        // set eof charactor
        $client->set(
        [
            'open_eof_split' => true,
            'package_eof'    => self::$config['package_eof'],
        ]);

        // client init
        ($mode === SWOOLE_SOCK_ASYNC) ? self::asyncInit($client) : self::syncInit($client);
    }

    // ------------------------------------------------------------------------------

    /**
     * reload swoole server
     */
    public static function reload()
    {
        self::send(['reload' => true]);
    }

    // ------------------------------------------------------------------------------

    /**
     * shutdown swoole server
     */
    public static function shutdown()
    {
        self::send(['shutdown' => true]);
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when connect
     *
     * @param \Swoole\Client $client
     */
    public static function onConnect(\Swoole\Client $client)
    {
        $post  = serialize($client->CiSwooleData);
        $post .= self::$config['package_eof'];

        $client->send($post);
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger on error
     *
     * @param \Swoole\Client $client
     */
    public static function onError(\Swoole\Client $client)
    {
        $msg = "swoole client error code: {$client->errCode}";

        error_log($msg, 3, self::$config['debug_file']);
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger on buffer empty
     *
     * @param \Swoole\Client $client
     */
    public static function onBufferEmpty(\Swoole\Client $client)
    {
        $client->close();
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when receive
     *
     * @param \Swoole\Client $client
     * @param string $data
     */
    public static function onReceive(\Swoole\Client $client, $data)
    {
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when close
     *
     * @param \Swoole\Client $client
     */
    public static function onClose(\Swoole\Client $client)
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

        self::$config = array_merge(self::$config, $config);
    }

    // ------------------------------------------------------------------------------

    /**
     * async mode init
     *
     * @param \Swoole\Client $client
     */
    private static function asyncInit(\Swoole\Client $client)
    {
        // event listener
        $client->on('Close',       [Client::class, 'onClose']);
        $client->on('Error',       [Client::class, 'onError']);
        $client->on('Connect',     [Client::class, 'onConnect']);
        $client->on('Receive',     [Client::class, 'onReceive']);
        $client->on('BufferEmpty', [Client::class, 'onBufferEmpty']);

        // connect server
        $client->connect(self::$config['server_host'], self::$config['server_port']);
    }

    // ------------------------------------------------------------------------------

    /**
     * sync mode init
     *
     * @param \Swoole\Client $client
     */
    private static function syncInit(\Swoole\Client $client)
    {
        $cnnt = $client->connect(self::$config['server_host'], self::$config['server_port']);

        if (!$cnnt)
        {
            $msg = "swoole client error code: {$client->errCode}";

            error_log($msg, 3, self::$config['debug_file']);
            return;
        }

        $post  = serialize($client->CiSwooleData);
        $post .= self::$config['package_eof'];
        $check = $client->send($post);

        if ($check === false)
        {
            $msg = "swoole client error code: {$client->errCode}";

            error_log($msg, 3, self::$config['debug_file']);
        }

        $client->close();
    }

    // ------------------------------------------------------------------------------

}
