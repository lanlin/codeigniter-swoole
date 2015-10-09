<?php

namespace Abstract_Swoole;

/**
 * ------------------------------------------------------------------------------------
 * Swoole Server
 * ------------------------------------------------------------------------------------
 *
 * Note: this class is for codeigniter 3
 *
 * This class is using for create swool server,
 * then waite for connection from client.
 *
 * @author  lanlin
 * @change  2015-10-09
 */
final class Server
{

    // ------------------------------------------------------------------------------

    const HOST = '127.0.0.1';
    const PORT = '9999';

    // ------------------------------------------------------------------------------

    public function __construct()
    {
        if(!is_cli()) { return; }
    }

    // ------------------------------------------------------------------------------

    public function start()
    {
        // new swoole server
        $serv = new swoole_server(
            self::HOST,     self::PORT,
            SWOOLE_PROCESS, SWOOLE_SOCK_TCP
        );

        // init config
        $serv->set([
            'worker_num' => 8,      // set workers
            'daemonize'  => TRUE,   // using as daemonize?
        ]);

        // listen on connect
        $serv->on('connect', [$this, 'on_connect']);

        // listen on connect
        $serv->on('receive', [$this, 'on_receive']);

        // listen on connect
        $serv->on('close', [$this, 'on_close']);

        // start server
        $serv->start();
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on connect
     *
     * @param $serv
     * @param $fd
     */
    public function on_connect($serv, $fd)
    {
        echo "Client:Connect.\n";
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on receive data
     *
     * @param $serv
     * @param $fd
     * @param $from_id
     * @param $data
     */
    public function on_receive($serv, $fd, $from_id, $data)
    {
        $serv->send($fd, 'Swoole: '.$data);
        $serv->close($fd);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on close
     *
     * @param $serv
     * @param $fd
     */
    public function on_close($serv, $fd)
    {
        echo "Client: Close.\n";
    }

    // ------------------------------------------------------------------------------

}
