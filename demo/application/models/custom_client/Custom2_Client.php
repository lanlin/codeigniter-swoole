<?php

/**
 * ----------------------------------------------------------------------------------
 * Custom2_Client
 * ----------------------------------------------------------------------------------
 *
 * \Abstract_Swoole\Client is a abstract class,
 * extends it, so you can overwrite some static methods if needed.
 * and using it with late static bindings.
 *
 * @author lanlin
 * @change 2015-10-11
 */
class Custom2_Client extends \Abstract_Swoole\Client
{

    // ------------------------------------------------------------------------------

    public static function client()
    {
        // @TODO
    }

    // ------------------------------------------------------------------------------


    public static function on_connect()
    {
        // @TODO
    }

    // ------------------------------------------------------------------------------


    public static function on_receive()
    {
        // @TODO
    }

    // ------------------------------------------------------------------------------

}
