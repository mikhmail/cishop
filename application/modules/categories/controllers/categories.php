<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller categories
 * @created on : Friday, 02-Sep-2016 13:39:02
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class categories extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('categoriess');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }

    }
    

    /**
    * List all data categories
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('categories/index/'),
            'total_rows'        => $this->categoriess->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['categoriess']       = $this->categoriess->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('categories/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New categories
    *
    */
    public function add() 
    {       
        $data['categories'] = $this->categoriess->add();
        $data['action']  = 'categories/save';
     
       $data['catalog'] = $this->categoriess->get_catalog();
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_categories").parsley();
                        });','embed');
      
        $this->template->render('categories/form',$data);

    }

    

    /**
    * Call Form to Modify categories
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['categories']      = $this->categoriess->get_one($id);
            $data['action']       = 'categories/save/' . $id;           
      
           $data['catalog'] = $this->categoriess->get_catalog();
       
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_categories").parsley();
                                    });','embed');
            
            $this->template->render('categories/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('categories'));
        }
    }


    
    /**
    * Save & Update data  categories
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'catalog_id',
                        'label' => 'Catalog',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'category_title',
                        'label' => 'Category Title',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'category_url',
                        'label' => 'Category Url',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'category_seo_description',
                        'label' => 'Category Seo Description',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'category_seo_keywords',
                        'label' => 'Category Seo Keywords',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'category_priority',
                        'label' => 'Category Priority',
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
                          
                          $this->categoriess->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('categories');
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
                        $this->categoriess->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('categories');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail categories
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['categories'] = $this->categoriess->get_one($id);            
            $this->template->render('categories/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('categories'));
        }
    }
    
    
    /**
    * Search categories like ""
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
            'base_url'          => site_url('categories/search/'),
            'total_rows'        => $this->categoriess->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['categoriess']       = $this->categoriess->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('categories/view',$data);
    }
    
    
    /**
    * Delete categories by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->categoriess->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('categories');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('categories');
        }       
    }

}

?>
