<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------
 * Swoole Server Controller
 * ------------------------------------------------------------------------------------
 *
 * @author  lanlin
 * @change  2015-10-08
 */
class Swoole extends CI_Controller
{

    // ------------------------------------------------------------------------------

    public $serv;

    // ------------------------------------------------------------------------------

    /**
     * check is cli
     */
    public function __construct()
    {
        parent::__construct();

        if(!is_cli()) { return; }
    }

    // ------------------------------------------------------------------------------

    /**
     * start swoole server
     */
    public function start()
    {
        $serv  = new \CI_Swoole\Server();
        $start = $serv->start();

        echo "Start Server: {$start}\n";
    }

    // ------------------------------------------------------------------------------

    /**
     * stop swoole server
     */
    public function stop()
    {
        \CI_Swoole\Client::$post =
        [
            'return'   => TRUE,
            'shutdown' => TRUE
        ];

        $stop = \CI_Swoole\Client::client();
        echo "Stop Server: {$stop}\n";
    }

    // ------------------------------------------------------------------------------

    /**
     * reload swoole workers
     */
    public function reload()
    {
        \CI_Swoole\Client::$post =
        [
            'return' => TRUE,
            'reload' => TRUE
        ];

        $reload = \CI_Swoole\Client::client();
        echo "Reload Workers: {$reload}\n";
    }

    // ------------------------------------------------------------------------------

}

