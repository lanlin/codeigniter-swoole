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
    const EOFF = '【@=_=@】';

    // ------------------------------------------------------------------------------

    /**
     * check is cli
     */
    public function __construct()
    {
        if(!is_cli()) { return; }
    }

    // ------------------------------------------------------------------------------

    /**
     * start a swoole server in cli
     */
    public function start()
    {
        // new swoole server
        $serv = new \swoole_server(
            self::HOST,     self::PORT,
            SWOOLE_PROCESS, SWOOLE_SOCK_TCP
        );

        // init config
        $serv->set(
        [
            'worker_num'     => 8,           // set workers
            'daemonize'      => TRUE,        // using as daemonize?
            'open_eof_split' => TRUE,
            'package_eof'    => self::EOFF,
        ]);

        // listen on
        $serv->on('connect', [$this, 'on_connect']);
        $serv->on('receive', [$this, 'on_receive']);
        $serv->on('close',   [$this, 'on_close']);

        // start server
        $serv->start();
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on connect
     *
     * @param \swoole_server $serv
     * @param $fd
     */
    public function on_connect(\swoole_server $serv, $fd)
    {
        echo "Client:Connect.\n";
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on receive data
     *
     * @param \swoole_server $serv
     * @param $fd
     * @param $from_id
     * @param $data
     */
    public function on_receive(\swoole_server $serv, $fd, $from_id, $data)
    {
        $serv->send($fd, 'Swoole: '.$data);
        $serv->close($fd);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on close
     *
     * @param \swoole_server $serv
     * @param $fd
     */
    public function on_close(\swoole_server $serv, $fd)
    {
        echo "Client: Close.\n";
    }

    // ------------------------------------------------------------------------------

}
