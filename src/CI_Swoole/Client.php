<?php namespace CI_Swoole;

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
 * @change  2016-01-15
 */
class Client
{

    // ------------------------------------------------------------------------------

    const HOST = '127.0.0.1';
    const PORT = '9999';
    const EOFF = '☯';  // \u262F

    // ------------------------------------------------------------------------------

    /**
     * Datas that will be send to server
     *
     * @var  array
     * @tips server, reload, shutdown is options,
     *       others must be set.
     */
    public static $post =
    [
        'return'   => TRUE,                  // if need return data
        'server'   => TRUE,                  // if need pass serv object to your model
        'reload'   => TRUE,                  // if need reload all workers
        'shutdown' => TRUE,                  // if need shutdown server

        'params'   => [],                    // params will be passed to your method
        'method'   => 'test',                // the method will be call
        'rename'   => 'tt',                  // rename the model object
        'model'    => 'test/test_model'      // the model will be call
    ];

    // ------------------------------------------------------------------------------

    /**
     * connect to swoole server then send data
     *
     * @return string
     */
    public static function client()
    {
        $return = FALSE;
        $client = new \swoole_client(SWOOLE_SOCK_TCP);

        // set eof charactor
        $client->set(
        [
            'open_eof_split' => TRUE,
            'package_eof'    => self::EOFF,
        ]);

        // listen on
        $client->on('connect', '\CI_Swoole\Client::on_connect');
        $client->on('receive', '\CI_Swoole\Client::on_receive');
        $client->on('error',   '\CI_Swoole\Client::on_error');
        $client->on('close',   '\CI_Swoole\Client::on_close');

        // connect
        $client->connect(self::HOST, self::PORT, 10);

        // send data
        if($client->isConnected())
        {
            $post   = serialize(static::$post);
            $post  .= self::EOFF;
            $issend = $client->send($post);
        }

        // receiv data
        if(isset($issend) && $issend)
        {
            $return = @$client->recv();
            $return = str_replace(self::EOFF, '', $return);
            $return = unserialize($return);
        }

        $client->close();
        unset($client);

        return $return;
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when connect
     *
     * @param \swoole_client $cli
     */
    public static function on_connect(\swoole_client $cli)
    {
        // @TODO
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when receive
     *
     * @param \swoole_client $cli
     * @param $data
     */
    public static function on_receive(\swoole_client $cli, $data)
    {
        // @TODO
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger when close
     *
     * @param \swoole_client $cli
     */
    public static function on_close(\swoole_client $cli)
    {
        // @TODO
        return;
    }

    // ------------------------------------------------------------------------------

    /**
     * trigger on error
     *
     * @param \swoole_client $cli
     */
    public static function on_error(\swoole_client $cli)
    {
        // @TODO
        return;
    }

    // ------------------------------------------------------------------------------

}
