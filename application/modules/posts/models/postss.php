<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of posts
 * @created on : Sunday, 04-Sep-2016 13:46:47
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class postss extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data posts
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('posts', $limit, $offset);

        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

    

    /**
     *  Count All posts
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('posts');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All posts
    *
    *  @param limit   : Integer
    *  @param offset  : Integer
    *  @param keyword : mixed
    *
    *  @return array
    *
    */
    public function get_search($limit, $offset) 
    {
        $keyword = $this->session->userdata('keyword');
                
        $this->db->like('post_title', $keyword);  
                
        $this->db->like('post_description', $keyword);  
                
        $this->db->like('post_text', $keyword);  
                
        $this->db->like('post_url', $keyword);  
                
        $this->db->like('post_seo_description', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('posts');

        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

    
    
    
    
    
    /**
    * Search All posts
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('posts');        
                
        $this->db->like('post_title', $keyword);  
                
        $this->db->like('post_description', $keyword);  
                
        $this->db->like('post_text', $keyword);  
                
        $this->db->like('post_url', $keyword);  
                
        $this->db->like('post_seo_description', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One posts
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('post_id', $id);
        $result = $this->db->get('posts');

        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }

    
    
    
    /**
    *  Default form data posts
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'post_title' => '',
            
                'post_description' => '',
            
                'post_text' => '',
            
                'post_date_create' => '',
            
                'post_date_update' => '',
            
                'post_url' => '',
            
                'post_type' => '',
            
                'post_seo_description' => '',
            
                'user_id' => '',
            
                'post_comment_status' => '',
            
        );

        return $data;
    }

    
    
    
    
    /**
    *  Save data Post
    *
    *  @return void
    *
    */
    public function save() 
    {
        $data = array(
        
            'post_title' => strip_tags($this->input->post('post_title', TRUE)),
        
            'post_description' => strip_tags($this->input->post('post_description', TRUE)),
        
            'post_text' => strip_tags($this->input->post('post_text', TRUE)),
        
            'post_date_create' => strip_tags($this->input->post('post_date_create', TRUE)),
        
            'post_date_update' => strip_tags($this->input->post('post_date_update', TRUE)),
        
            'post_url' => strip_tags($this->input->post('post_url', TRUE)),
        
            'post_type' => strip_tags($this->input->post('post_type', TRUE)),
        
            'post_seo_description' => strip_tags($this->input->post('post_seo_description', TRUE)),
        
            'user_id' => 1,
        
            'post_status' => strip_tags($this->input->post('post_comment_status', TRUE)),
        
        );
        
        
        $this->db->insert('posts', $data);
    }
    
    
    

    
    /**
    *  Update modify data
    *
    *  @param id : Integer
    *
    *  @return void
    *
    */
    public function update($id)
    {
        $data = array(
        
                'post_title' => strip_tags($this->input->post('post_title', TRUE)),
        
                'post_description' => strip_tags($this->input->post('post_description', TRUE)),
        
                'post_text' => strip_tags($this->input->post('post_text', TRUE)),
        
                'post_date_create' => strip_tags($this->input->post('post_date_create', TRUE)),
        
                'post_date_update' => strip_tags($this->input->post('post_date_update', TRUE)),
        
                'post_url' => strip_tags($this->input->post('post_url', TRUE)),
        
                'post_type' => strip_tags($this->input->post('post_type', TRUE)),
        
                'post_seo_description' => strip_tags($this->input->post('post_seo_description', TRUE)),
        
                'user_id' => 1,
        
                'post_status' => strip_tags($this->input->post('post_comment_status', TRUE)),
        
        );
        
        
        $this->db->where('post_id', $id);
        $this->db->update('posts', $data);
    }


    
    
    
    /**
    *  Delete data by id
    *
    *  @param id : Integer
    *
    *  @return void
    *
    */
    public function destroy($id)
    {       
        $this->db->where('post_id', $id);
        $this->db->delete('posts');
        
    }







    



}
