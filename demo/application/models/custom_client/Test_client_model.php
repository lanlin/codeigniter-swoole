<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------
 * Test Client Model
 * ------------------------------------------------------------------------------------
 *
 * This is a normal CI style model,
 * through require specify custom swoole client class,
 * we can now have multi diffrent ways for our logic
 *
 *
 * @author  lanlin
 * @change  2015-10-11
 */
class Test_client_Model extends CI_Model
{

    // ------------------------------------------------------------------------------

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------------

    /**
     * using custom client 1
     *
     * @param $data
     * @return string|void
     */
    public function test1($data)
    {
        require "Custom1_Client.php";

        Custom1_Client::$post = $data;
        return Custom1_Client::client();
    }

    // ------------------------------------------------------------------------------

    /**
     * using custom client 2
     *
     * @param $data
     * @return string|void
     */
    public function test2($data)
    {
        require "Custom2_Client.php";

        Custom2_Client::$post = $data;
        return Custom2_Client::client();
    }

    // ------------------------------------------------------------------------------

}
