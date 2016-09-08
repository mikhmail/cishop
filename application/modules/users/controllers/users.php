<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller users
 * @created on : Sunday, 04-Sep-2016 13:21:38
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class users extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('userss');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }
    }
    

    /**
    * List all data users
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('users/index/'),
            'total_rows'        => $this->userss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['userss']       = $this->userss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('users/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New users
    *
    */
    public function add() 
    {       
        $data['users'] = $this->userss->add();
        $data['action']  = 'users/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_users").parsley();
                        });','embed');
      
        $this->template->render('users/form',$data);

    }

    

    /**
    * Call Form to Modify users
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['users']      = $this->userss->get_one($id);
            $data['action']       = 'users/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_users").parsley();
                                    });','embed');
            
            $this->template->render('users/edit',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('users'));
        }
    }


    
    /**
    * Save & Update data  users
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'user_name',
                        'label' => 'User Name',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'user_password_hash',
                        'label' => 'User Password Hash',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'user_email',
                        'label' => 'User Email',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'user_ip',
                        'label' => 'User Ip',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'user_date_create',
                        'label' => 'User Date Create',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'user_last_date_visited',
                        'label' => 'User Last Date Visited',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'user_activated',
                        'label' => 'User Activated',
                        'rules' => 'trim|xss_clean|required'
                        ),
                               
                  );
            
        // if id NULL then add new data
        if(!$id)
        {    
                  $this->form_validation->set_rules($config);

                  if ($this->form_validation->run() == TRUE) 
                  {
                      if ($this->input->post()) 
                      {
                          
                          $this->userss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('users');
                      }
                  } 
                  else // If validation incorrect 
                  {
                      $this->add();
                  }
         }
         else // Update data if Form Edit send Post and ID available
         {               
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == TRUE) 
                {
                    if ($this->input->post()) 
                    {
                        $this->userss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('users');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail users
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['users'] = $this->userss->get_one($id);            
            $this->template->render('users/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('users'));
        }
    }
    
    
    /**
    * Search users like ""
    *
    */   
    public function search()
    {
        if($this->input->post('q'))
        {
            $keyword = $this->input->post('q');
            
            $this->session->set_userdata(
                        array('keyword' => $this->input->post('q',TRUE))
                    );
        }
        
         $config = array(
            'base_url'          => site_url('users/search/'),
            'total_rows'        => $this->userss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['userss']       = $this->userss->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('users/view',$data);
    }
    
    
    /**
    * Delete users by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->userss->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('users');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('users');
        }       
    }

}

?>
