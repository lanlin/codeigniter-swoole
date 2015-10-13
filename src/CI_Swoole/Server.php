<?php namespace CI_Swoole;

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
    const EOFF = '☯';  // \u262F

    // ------------------------------------------------------------------------------

    /**
     * check is cli
     *
     * @params
     */
    public function __construct()
    {
        if(!is_cli()) { return; }
    }

    // ------------------------------------------------------------------------------

    /**
     * start a swoole server in cli
     *
     * @return mixed
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
            'max_conn'        => 256,         // max connection number
            'worker_num'      => 1,           // set workers
            'dispatch_mode'   => 3,           // post to a free worker
            'task_worker_num' => 1,           // worker numbers for task

            'daemonize'      => TRUE,         // using as daemonize?
            'open_eof_check' => TRUE,
            'open_eof_split' => TRUE,
            'package_eof'    => self::EOFF,
            'log_file'       => APPPATH.'logs/swoole.log',

            'heartbeat_check_interval' => 30
        ]);

        // listen on
        $serv->on('connect', [$this, 'on_connect']);
        $serv->on('receive', [$this, 'on_receive']);
        $serv->on('finish',  [$this, 'on_finish']);
        $serv->on('close',   [$this, 'on_close']);
        $serv->on('task',    [$this, 'on_task']);

        // start server
        return $serv->start();
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
        var_dump($fd);
        var_dump($serv->worker_id);

        // call model
        $back  = $this->_dispatch($serv, $data);

        // dont send back
        if(empty($data['return']) || $data['return'] === TRUE)
        {
            $back  = serialize($back);
            $back .= self::EOFF;
            $serv->send($fd, $back);
        }

        // close connect
        $serv->close($fd);
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on task
     *
     * @param  $serv
     * @param  $task_id
     * @param  $from_id
     * @param  $data
     * @return string
     */
    public function on_task(\swoole_server $serv, $task_id, $from_id, $data)
    {
        $back['taskid'] = $task_id;
        $back['fromid'] = $from_id;
        $back['return'] = $this->_dispatch($serv, $data);

        $back  = serialize($back);
        $back .= self::EOFF;

        return $back;
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
        // @TODO
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
        // @TODO
    }

    // ------------------------------------------------------------------------------

    /**
     * listen on task finish
     *
     * @param \swoole_server $serv
     * @param $task_id
     * @param $data
     */
    public function on_finish(\swoole_server $serv, $task_id, $data)
    {
        // @TODO
    }

    // ------------------------------------------------------------------------------

    /**
     * dispatch signal
     *
     * @param  \swoole_server $serv
     * @param  $data
     * @return string
     */
    protected function _dispatch(\swoole_server $serv, $data)
    {
          // format passed
        $back = 'FALSE';
        $data = str_replace(self::EOFF, '', $data);
        $data = unserialize($data);

        // check is signal for server shutdown
        if(!empty($data['shutdown']) && $data['shutdown'] === TRUE)
        {
            return $this->_shutdown($serv);
        }

        // check is signal for workers reload
        if(!empty($data['reload']) && $data['reload'] === TRUE)
        {
            return $this->_reload($serv);
        }

        // load specify models
        if(!empty($data['model']) && !empty($data['method']))
        {
            $model = $alias = $data['model'];

            // Is the model in a sub-folder? If so, parse out the filename and path.
            if (($last_slash = strrpos($alias, '/')) !== FALSE)
            {
                $alias = substr($alias, ++$last_slash);
            }

            // Is the model need set a alias name
            $alias = !empty($data['rename']) ? $data['rename'] : $alias;

            // load the model
            $CI = &get_instance();
            $CI->load->model($model, $alias);

            // call specify model
            $back =
            !empty($data['server']) && $data['server'] === TRUE ?
            $CI->$alias->$data['method']($data['params'], $serv) :
            $CI->$alias->$data['method']($data['params']);

            // destroy obj
            $CI->db->close();
            unset($CI);
        }

        return $back;
    }

    // ------------------------------------------------------------------------------

    /**
     * stop swoole server
     *
     * @param  \swoole_server $serv
     * @return mixed
     */
    protected function _shutdown(\swoole_server $serv)
    {
        return $serv->shutdown();
    }

    // ------------------------------------------------------------------------------

    /**
     * reload swoole server
     *
     * @param  \swoole_server $serv
     * @return mixed
     */
    protected function _reload(\swoole_server $serv)
    {
        return $serv->reload();
    }

    // ------------------------------------------------------------------------------

}
