<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller status
 * @created on : Friday, 02-Sep-2016 14:21:09
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class status extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('statuss');
    }
    

    /**
    * List all data status
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('status/index/'),
            'total_rows'        => $this->statuss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['statuss']       = $this->statuss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('status/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New status
    *
    */
    public function add() 
    {       
        $data['status'] = $this->statuss->add();
        $data['action']  = 'status/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_status").parsley();
                        });','embed');
      
        $this->template->render('status/form',$data);

    }

    

    /**
    * Call Form to Modify status
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['status']      = $this->statuss->get_one($id);
            $data['action']       = 'status/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_status").parsley();
                                    });','embed');
            
            $this->template->render('status/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('status'));
        }
    }


    
    /**
    * Save & Update data  status
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'status_name',
                        'label' => 'Status Name',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'status_color',
                        'label' => 'Status Color',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'status_type',
                        'label' => 'Status Type',
                        'rules' => 'trim|xss_clean'
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
                          
                          $this->statuss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('status');
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
                        $this->statuss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('status');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail status
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['status'] = $this->statuss->get_one($id);            
            $this->template->render('status/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('status'));
        }
    }
    
    
    /**
    * Search status like ""
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
            'base_url'          => site_url('status/search/'),
            'total_rows'        => $this->statuss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['statuss']       = $this->statuss->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('status/view',$data);
    }
    
    
    /**
    * Delete status by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->statuss->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('status');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('status');
        }       
    }

}

?>
