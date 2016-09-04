<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller product_properties
 * @created on : Sunday, 04-Sep-2016 18:56:27
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class product_properties extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('product_propertiess');
		$this->load->model('Gallery_model');
		
    }
    

    /**
    * List all data product_properties
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('product_properties/index/'),
            'total_rows'        => $this->product_propertiess->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['product_propertiess']       = $this->product_propertiess->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('product_properties/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New product_properties
    *
    */
    public function add() 
    {       
        $data['product_properties'] = $this->product_propertiess->add();
        $data['action']  = 'product_properties/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_product_properties").parsley();
                        });','embed');
      
        $this->template->render('product_properties/form',$data);

    }

    

    /**
    * Call Form to Modify product_properties
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['product_properties']      = $this->product_propertiess->get_one($id);
            $data['action']       = 'product_properties/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_product_properties").parsley();
                                    });','embed');
            
            $this->template->render('product_properties/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('product_properties'));
        }
    }


    
    /**
    * Save & Update data  product_properties
    *
    */
    public function save($id =NULL) 
    {	//var_dump($this->input->post());die;
        print_r($_FILES);die;
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'property_id',
                        'label' => 'Property',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_id',
                        'label' => 'Product',
                        'rules' => 'trim|xss_clean|required'
                        )
                    

                               
                  );
            
        // if id NULL then add new data
        if(!$id)
        {    
                  $this->form_validation->set_rules($config);

                  if ($this->form_validation->run() == TRUE) 
                  {
                      if ($this->input->post()) 
                      {
                          $this->Gallery_model->do_upload('userfile');
                          $this->product_propertiess->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('product_properties');
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
                        $this->product_propertiess->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('product_properties');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail product_properties
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['product_properties'] = $this->product_propertiess->get_one($id);            
            $this->template->render('product_properties/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('product_properties'));
        }
    }
    
    
    /**
    * Search product_properties like ""
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
            'base_url'          => site_url('product_properties/search/'),
            'total_rows'        => $this->product_propertiess->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['product_propertiess']       = $this->product_propertiess->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('product_properties/view',$data);
    }
    
    
    /**
    * Delete product_properties by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->product_propertiess->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('product_properties');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('product_properties');
        }       
    }

}

?>
