<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller products
 * @created on : Sunday, 04-Sep-2016 14:55:07
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class products extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('productss');
		$this->load->model('Gallery_model');
		$this->load->helper(array('form', 'url'));

    }
    

    /**
    * List all data products
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('products/index/'),
            'total_rows'        => $this->productss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['productss']       = $this->productss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('products/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New products
    *
    */
    public function add() 
    {       
        $data['products'] = $this->productss->add();
        $data['action']  = 'products/save';
     
       $data['categories'] = $this->productss->get_categories();
     
       $data['properties'] = $this->productss->get_properties();
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_products").parsley();
                        });','embed');
      
        $this->template->render('products/form',$data);

    }

    

    /**
    * Call Form to Modify products
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['products']      = $this->productss->get_one($id);
            $data['action']       = 'products/save/' . $id;           
      
           $data['categories'] = $this->productss->get_categories();
       
           $data['properties'] = $this->productss->get_properties();
       
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_products").parsley();
                                    });','embed');
            
            $this->template->render('products/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('products'));
        }
    }


    
    /**
    * Save & Update data  products
    *
    */
    public function save($id =NULL) 
    {		
	//print_r($_FILES);die;
	//var_dump($this->input->post());die;
	
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'category_id',
                        'label' => 'Category',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_title',
                        'label' => 'Product Title',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_description',
                        'label' => 'Product Description',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_price',
                        'label' => 'Product Price',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_action_price',
                        'label' => 'Product Action Price',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_status',
                        'label' => 'Product Status',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_active',
                        'label' => 'Product Active',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_count',
                        'label' => 'Product Count',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_date_create',
                        'label' => 'Product Date Create',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_date_update',
                        'label' => 'Product Date Update',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_views',
                        'label' => 'Product Views',
                        'rules' => 'trim|xss_clean'
                        ),


                    
                    array(
                        'field' => 'product_image_1',
                        'label' => 'Product Image 1',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_2',
                        'label' => 'Product Image 2',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_3',
                        'label' => 'Product Image 3',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_4',
                        'label' => 'Product Image 4',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_5',
                        'label' => 'Product Image 5',
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
                          
                          $this->productss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('products');
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
						 
						
						
                        $this->productss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('products');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail products
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['products'] = $this->productss->get_one($id);            
            $this->template->render('products/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('products'));
        }
    }
    
    
    /**
    * Search products like ""
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
            'base_url'          => site_url('products/search/'),
            'total_rows'        => $this->productss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['productss']       = $this->productss->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('products/view',$data);
    }
    
    
    /**
    * Delete products by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->productss->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('products');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('products');
        }       
    }

}

?>
