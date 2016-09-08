<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller catalog
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class catalog extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('catalogs');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }
    }
    

    /**
    * List all data catalog
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('catalog/index/'),
            'total_rows'        => $this->catalogs->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['catalogs']       = $this->catalogs->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('catalog/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New catalog
    *
    */
    public function add() 
    {       
        $data['catalog'] = $this->catalogs->add();
        $data['action']  = 'catalog/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_catalog").parsley();
                        });','embed');
      
        $this->template->render('catalog/form',$data);

    }

    

    /**
    * Call Form to Modify catalog
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['catalog']      = $this->catalogs->get_one($id);
            $data['action']       = 'catalog/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_catalog").parsley();
                                    });','embed');
            
            $this->template->render('catalog/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('catalog'));
        }
    }


    
    /**
    * Save & Update data  catalog
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'catalog_title',
                        'label' => 'Catalog Title',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'catalog_url',
                        'label' => 'Catalog Url',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'catalog_seo_description',
                        'label' => 'Catalog Seo Description',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'catalog_seo_keywords',
                        'label' => 'Catalog Seo Keywords',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'catalog_priority',
                        'label' => 'Catalog Priority',
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
                          
                          $this->catalogs->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('catalog');
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
                        $this->catalogs->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('catalog');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail catalog
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['catalog'] = $this->catalogs->get_one($id);            
            $this->template->render('catalog/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('catalog'));
        }
    }
    
    
    /**
    * Search catalog like ""
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
            'base_url'          => site_url('catalog/search/'),
            'total_rows'        => $this->catalogs->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['catalogs']       = $this->catalogs->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('catalog/view',$data);
    }
    
    
    /**
    * Delete catalog by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->catalogs->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('catalog');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('catalog');
        }       
    }

}

?>
