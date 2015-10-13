<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ----------------------------------------------------------------------------------
 * Test2 Model
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2015-10-11
 */
class Test2_model extends CI_Model
{

    // ------------------------------------------------------------------------------

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------------

    /**
     * normal1 method for swoole server call
     *
     * @param $params
     * @return mixed
     */
    public function normal1($params)
    {
        // @TODO
        return $params;
    }

    // ------------------------------------------------------------------------------

    /**
     * normal2 method for swoole server call
     *
     * @param $params
     * @return mixed
     */
    public function normal2($params)
    {
        // @TODO
        return $params;
    }

    // ------------------------------------------------------------------------------

}
