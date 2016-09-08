<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Hidden_Admin
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

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