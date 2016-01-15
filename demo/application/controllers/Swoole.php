<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------
 * Swoole Server Controller
 * ------------------------------------------------------------------------------------
 *
 * @author  lanlin
 * @change  2016-01-15
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

    /**
     * start timer for all task
     */
    public function timer()
    {
        \CI_Swoole\Client::$post =
        [
            'return' => TRUE,
            'server' => TRUE,
            'params' => [],
            'method' => 'plan',
            'rename' => 'tsk',
            'model'  => 'task/Plan_model'
        ];

        \CI_Swoole\Client::client();
        echo "Set Timer Start.\n";
    }

    // ------------------------------------------------------------------------------

    /**
     * start email sync quene
     */
    public function email_quene()
    {
        \CI_Swoole\Client::$post =
        [
            'return' => FALSE,
            'server' => TRUE,
            'params' => [],
            'method' => 'sync_quene',
            'rename' => 'eqn',
            'model'  => 'contact/email_quene_model'
        ];

        \CI_Swoole\Client::client();
        echo "Email Quene Start.\n";
    }

    // ------------------------------------------------------------------------------

}

