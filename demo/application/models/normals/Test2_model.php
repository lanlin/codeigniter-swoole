<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ----------------------------------------------------------------------------------
 * Test2 Model
 * ----------------------------------------------------------------------------------
 *
 * \Abstract_Swoole\Client is a abstract class,
 * extends it, so you can overwrite some static methods if needed.
 * and using it with late static bindings.
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
