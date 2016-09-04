<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller delivery_method
 * @created on : Friday, 02-Sep-2016 14:05:04
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class delivery_method extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('delivery_methods');
    }
    

    /**
    * List all data delivery_method
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('delivery_method/index/'),
            'total_rows'        => $this->delivery_methods->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['delivery_methods']       = $this->delivery_methods->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('delivery_method/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New delivery_method
    *
    */
    public function add() 
    {       
        $data['delivery_method'] = $this->delivery_methods->add();
        $data['action']  = 'delivery_method/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_delivery_method").parsley();
                        });','embed');
      
        $this->template->render('delivery_method/form',$data);

    }

    

    /**
    * Call Form to Modify delivery_method
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['delivery_method']      = $this->delivery_methods->get_one($id);
            $data['action']       = 'delivery_method/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_delivery_method").parsley();
                                    });','embed');
            
            $this->template->render('delivery_method/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('delivery_method'));
        }
    }


    
    /**
    * Save & Update data  delivery_method
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'delivery_name',
                        'label' => 'Delivery Name',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'is_active',
                        'label' => 'Is Active',
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
                          
                          $this->delivery_methods->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('delivery_method');
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
                        $this->delivery_methods->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('delivery_method');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail delivery_method
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['delivery_method'] = $this->delivery_methods->get_one($id);            
            $this->template->render('delivery_method/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('delivery_method'));
        }
    }
    
    
    /**
    * Search delivery_method like ""
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
            'base_url'          => site_url('delivery_method/search/'),
            'total_rows'        => $this->delivery_methods->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['delivery_methods']       = $this->delivery_methods->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('delivery_method/view',$data);
    }
    
    
    /**
    * Delete delivery_method by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->delivery_methods->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('delivery_method');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('delivery_method');
        }       
    }

}

?>
