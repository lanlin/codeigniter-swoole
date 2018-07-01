<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ----------------------------------------------------------------------------------
 * Test Client & Task
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2018/07/01
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

        log_message('info', var_export($data, true));
	}

    // ------------------------------------------------------------------------------

    /**
     * here's the timer method
     */
    public function task_timer()
    {
        log_message('info', 'timer works!');
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
