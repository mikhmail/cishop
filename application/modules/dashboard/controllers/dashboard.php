<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller dashboard
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

class dashboard extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }
       
    }
    

    /**
    *
    *
    */
    public function index() 
    {
    	
        $this->template->render('dashboard/view');
	      
    }
    
    
    

    
}

?>
