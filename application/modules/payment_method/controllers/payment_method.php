<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller payment_method
 * @created on : Friday, 02-Sep-2016 14:14:58
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class payment_method extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('payment_methods');
    }
    

    /**
    * List all data payment_method
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('payment_method/index/'),
            'total_rows'        => $this->payment_methods->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['payment_methods']       = $this->payment_methods->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('payment_method/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New payment_method
    *
    */
    public function add() 
    {       
        $data['payment_method'] = $this->payment_methods->add();
        $data['action']  = 'payment_method/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_payment_method").parsley();
                        });','embed');
      
        $this->template->render('payment_method/form',$data);

    }

    

    /**
    * Call Form to Modify payment_method
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['payment_method']      = $this->payment_methods->get_one($id);
            $data['action']       = 'payment_method/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_payment_method").parsley();
                                    });','embed');
            
            $this->template->render('payment_method/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('payment_method'));
        }
    }


    
    /**
    * Save & Update data  payment_method
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'payment_name',
                        'label' => 'Payment Name',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'is_active',
                        'label' => 'Is Active',
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
                          
                          $this->payment_methods->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('payment_method');
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
                        $this->payment_methods->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('payment_method');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail payment_method
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['payment_method'] = $this->payment_methods->get_one($id);            
            $this->template->render('payment_method/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('payment_method'));
        }
    }
    
    
    /**
    * Search payment_method like ""
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
            'base_url'          => site_url('payment_method/search/'),
            'total_rows'        => $this->payment_methods->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['payment_methods']       = $this->payment_methods->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('payment_method/view',$data);
    }
    
    
    /**
    * Delete payment_method by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->payment_methods->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('payment_method');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('payment_method');
        }       
    }

}

?>
