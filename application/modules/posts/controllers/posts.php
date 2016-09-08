<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller posts
 * @created on : Sunday, 04-Sep-2016 13:46:47
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class posts extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('postss');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }
    }
    

    /**
    * List all data posts
    *
    */
    public function index() 
    {
        $config = array(
            'base_url'          => site_url('posts/index/'),
            'total_rows'        => $this->postss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['postss']       = $this->postss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('posts/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New posts
    *
    */
    public function add() 
    {       
        $data['posts'] = $this->postss->add();
        $data['action']  = 'posts/save';
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_posts").parsley();
                        });','embed');
      
        $this->template->render('posts/form',$data);

    }

    

    /**
    * Call Form to Modify posts
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['posts']      = $this->postss->get_one($id);
            $data['action']       = 'posts/save/' . $id;           
      
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_posts").parsley();
                                    });','embed');
            
            $this->template->render('posts/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('posts'));
        }
    }


    
    /**
    * Save & Update data  posts
    *
    */
    public function save($id =NULL) 
    {
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'post_title',
                        'label' => 'Post Title',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'post_description',
                        'label' => 'Post Description',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'post_text',
                        'label' => 'Post Text',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'post_date_create',
                        'label' => 'Post Date Create',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'post_date_update',
                        'label' => 'Post Date Update',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'post_url',
                        'label' => 'Post Url',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'post_type',
                        'label' => 'Post Type',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'post_seo_description',
                        'label' => 'Post Seo Description',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'user_id',
                        'label' => 'User',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'post_comment_status',
                        'label' => 'Post Comment Status',
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
                          
                          $this->postss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('posts');
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
                        $this->postss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('posts');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail posts
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['posts'] = $this->postss->get_one($id);            
            $this->template->render('posts/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('posts'));
        }
    }
    
    
    /**
    * Search posts like ""
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
            'base_url'          => site_url('posts/search/'),
            'total_rows'        => $this->postss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['postss']       = $this->postss->get_search($config['per_page'], $this->uri->segment(3));
       
        $this->template->render('posts/view',$data);
    }
    
    
    /**
    * Delete posts by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->postss->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('posts');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('posts');
        }       
    }

}

?>
