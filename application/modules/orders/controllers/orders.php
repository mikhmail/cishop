<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller orders
 * @created on : Friday, 02-Sep-2016 14:53:30
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class orders extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('orderss');
		$this->load->model('Gallery_model');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }
		
		//$this->Gallery_model->get_images();
		
    }
    

    /**
    * List all data orders
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('orders/index/'),
            'total_rows'        => $this->orderss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['orderss']       = $this->orderss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('orders/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New orders
    *
    */
    public function add() 
    {       
        $data['orders'] = $this->orderss->add();
        $data['action']  = 'orders/save';
     
       $data['delivery_method'] = $this->orderss->get_delivery_method();
       $data['payment_method']  = $this->orderss->get_payment_method();
	   $data['status'] 		    = $this->orderss->get_status();
	   $data['status_selected'] = 1; // новый
	   
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_orders").parsley();
                        });','embed');
      
        $this->template->render('orders/add',$data);

    }

    

    /**
    * Call Form to Modify orders
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['orders']      = $this->orderss->get_one($id);
            $data['action']       = 'orders/save/' . $id;           
      
           $data['delivery_method'] = $this->orderss->get_delivery_method();
           $data['payment_method']  = $this->orderss->get_payment_method();
		   $data['status'] 		    = $this->orderss->get_status();
		   
		   
       
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_orders").parsley();
                                    });','embed');
            
            $this->template->render('orders/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('orders'));
        }
    }


    
    /**
    * Save & Update data  orders
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'order_name',
                        'label' => 'Order Name',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'order_phone',
                        'label' => 'Order Phone',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    

                    array(
                        'field' => 'order_address',
                        'label' => 'Order Address',
                        'rules' => 'trim|xss_clean|required'
                    ),

                    
                    array(
                        'field' => 'order_date_create',
                        'label' => 'Order Date Create',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'order_date_update',
                        'label' => 'Order Date Update',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'user_id',
                        'label' => 'User',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'status_id',
                        'label' => 'Status',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'delivery_id',
                        'label' => 'Delivery',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'payment_id',
                        'label' => 'Payment',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'paid',
                        'label' => 'Paid',
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
                          
                          $this->orderss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('orders');
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
                        $this->orderss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('orders');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail orders
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['orders'] = $this->orderss->get_one($id);            
            $this->template->render('orders/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('orders'));
        }
    }
    
    
    /**
    * Search orders like ""
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
            'base_url'          => site_url('orders/search/'),
            'total_rows'        => $this->orderss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['orderss']       = $this->orderss->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('orders/view',$data);
    }
    
    
    /**
    * Delete orders by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->orderss->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('orders');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('orders');
        }       
    }

}

?>
