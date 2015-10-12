<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------
 * Normal CI Controller
 * ------------------------------------------------------------------------------------
 *
 * @author  lanlin
 * @change  2015-10-11
 */
class Test extends CI_Controller
{

    // ------------------------------------------------------------------------------

    public function __construct()
    {
        parent::__construct();

        $this->load->model('custom_client/test_client_model', 'test1');
    }

    // ------------------------------------------------------------------------------

    public function demo1()
    {
        $data = [];
        $post = $this->input->post();

        // set params for swoole
        $data['return'] = TRUE;
        $data['method'] = 'normal1';
        $data['params'] = $post;
        $data['rename'] = 'test2';
        $data['model']  = 'normals/Test2_model';

        // call test_client_model test1 method
        $final = $this->test1->test1($data);
    }

    // ------------------------------------------------------------------------------

    public function demo2()
    {
        $data = [];
        $post = $this->input->post();

        // set params for swoole
        $data['return'] = TRUE;
        $data['method'] = 'normal2';
        $data['params'] = $post;
        $data['rename'] = 'test2';
        $data['model']  = 'normals/Test2_model';

        // call test_client_model->test2 method
        $final = $this->test1->test2($data);
    }

    // ------------------------------------------------------------------------------
}
