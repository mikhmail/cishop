<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller properties
 * @created on : Sunday, 04-Sep-2016 13:12:57
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class properties extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('propertiess');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }
    }
    

    /**
    * List all data properties
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('properties/index/'),
            'total_rows'        => $this->propertiess->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['propertiess']       = $this->propertiess->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('properties/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New properties
    *
    */
    public function add() 
    {       
        $data['properties'] = $this->propertiess->add();
        $data['action']  = 'properties/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_properties").parsley();
                        });','embed');
      
        $this->template->render('properties/form',$data);

    }

    

    /**
    * Call Form to Modify properties
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['properties']      = $this->propertiess->get_one($id);
            $data['action']       = 'properties/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_properties").parsley();
                                    });','embed');
            
            $this->template->render('properties/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('properties'));
        }
    }


    
    /**
    * Save & Update data  properties
    *
    */
    public function save($id =NULL) 
    {	// validation config
        $config = array(
                  
                    array(
                        'field' => 'title',
                        'label' => 'Title',
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
                          
                          $this->propertiess->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('properties');
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
                        $this->propertiess->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('properties');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail properties
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['properties'] = $this->propertiess->get_one($id);            
            $this->template->render('properties/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('properties'));
        }
    }
    
    
    /**
    * Search properties like ""
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
            'base_url'          => site_url('properties/search/'),
            'total_rows'        => $this->propertiess->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['propertiess']       = $this->propertiess->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('properties/view',$data);
    }
    
    
    /**
    * Delete properties by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->propertiess->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('properties');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('properties');
        }       
    }

}

?>
