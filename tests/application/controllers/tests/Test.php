<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ----------------------------------------------------------------------------------
 * Test Client & Task
 * ----------------------------------------------------------------------------------
 *
 * Tips: you must enable logs at config.php first before use log_message()
 *
 * @author lanlin
 * @change 2018/09/25
 */
class Test extends CI_Controller
{

    // ------------------------------------------------------------------------------

    /**
     * here's the task
     */
	public function task()
	{
	    $data = $this->input->post();

        log_message('error', var_export($data, true));
	}

    // ------------------------------------------------------------------------------

    /**
     * here's the timer method
     */
    public function task_timer()
    {
        log_message('error', 'timer works!');
    }

    // ------------------------------------------------------------------------------

    /**
     * send data to task
     */
	public function send()
    {
        try
        {
            \CiSwoole\Core\Client::send(
            [
                'route'  => 'tests/test/task',
                'params' => ['hope' => 'it works!'],
            ]);
        }
        catch (\Exception $e)
        {
            log_message('error', $e->getMessage());
            log_message('error', $e->getTraceAsString());
        }
    }

    // ------------------------------------------------------------------------------

}
