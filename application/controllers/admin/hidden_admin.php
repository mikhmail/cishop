<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hidden_Admin extends CI_Controller {


    function __construct()
    {
        parent::__construct();

        $this->load->library('Auth');
        $auth = new Auth();

        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;

        }else{
            redirect('/dashboard');
        }


    }


    function _output($output = null)
    {
        $this->load->view('admin/main',$output);
    }
}