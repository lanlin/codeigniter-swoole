<?php

namespace Abstract_Swoole;

/**
 * ------------------------------------------------------------------------------------
 * Swoole Client
 * ------------------------------------------------------------------------------------
 *
 * Note: this class is for codeigniter 3
 *
 * This interface is using for connect swool server,
 * then excute code that may need a long time runing.
 *
 * @author  lanlin
 * @change  2015-10-08
 */
abstract class Client
{

    // ------------------------------------------------------------------------------

    const HOST = '127.0.0.1';
    const PORT = '9999';

    // ------------------------------------------------------------------------------

    /**
     * new a swoole client
     */
    public static function client()
    {
        $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

        $client->on('connect', 'static::on_connect');
        $client->on('receive', 'static::on_receive');
        $client->on('error',   'static::on_error');
        $client->on('close',   'static::on_close');

        $client->connect(self::HOST, self::PORT);
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when connect
     *
     * @param swoole_client $cli
     */
    public static function on_connect(swoole_client $cli)
    {
        $cli->send("GET / HTTP/1.1\r\n\r\n");
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when receive
     *
     * @param swoole_client $cli
     * @param $data
     */
    public static function on_receive(swoole_client $cli, $data)
    {
        echo "Receive: $data";
        $cli->send(str_repeat('A', 100)."\n");
        sleep(1);
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when close
     *
     * @param swoole_client $cli
     */
    public static function on_close(swoole_client $cli)
    {
        echo "Connection close\n";
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger on error
     *
     * @param swoole_client $cli
     */
    public static function on_error(swoole_client $cli)
    {
        echo "error\n";
    }

    // ------------------------------------------------------------------------------

}
