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
     * start swoole server through this method
     *
     * CLI command: php index.php swoole start
     */
    public function start()
    {
        $serv = new \Abstract_Swoole\Server();
        $serv->start();
    }

    // ------------------------------------------------------------------------------

}

