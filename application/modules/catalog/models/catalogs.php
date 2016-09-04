<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of catalog
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class catalogs extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data catalog
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('catalog', $limit, $offset);

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
     *  Count All catalog
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('catalog');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All catalog
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
                
        $this->db->like('catalog_title', $keyword);  
                
        $this->db->like('catalog_url', $keyword);  
                
        $this->db->like('catalog_seo_description', $keyword);  
                
        $this->db->like('catalog_seo_keywords', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('catalog');

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
    * Search All catalog
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('catalog');        
                
        $this->db->like('catalog_title', $keyword);  
                
        $this->db->like('catalog_url', $keyword);  
                
        $this->db->like('catalog_seo_description', $keyword);  
                
        $this->db->like('catalog_seo_keywords', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One catalog
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('catalog_id', $id);
        $result = $this->db->get('catalog');

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
    *  Default form data catalog
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'catalog_title' => '',
            
                'catalog_url' => '',
            
                'catalog_seo_description' => '',
            
                'catalog_seo_keywords' => '',
            
                'catalog_priority' => '',
            
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
        
            'catalog_title' => strip_tags($this->input->post('catalog_title', TRUE)),
        
            'catalog_url' => strip_tags($this->input->post('catalog_url', TRUE)),
        
            'catalog_seo_description' => strip_tags($this->input->post('catalog_seo_description', TRUE)),
        
            'catalog_seo_keywords' => strip_tags($this->input->post('catalog_seo_keywords', TRUE)),
        
            'catalog_priority' => strip_tags($this->input->post('catalog_priority', TRUE)),
        
        );
        
        
        $this->db->insert('catalog', $data);
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
        
                'catalog_title' => strip_tags($this->input->post('catalog_title', TRUE)),
        
                'catalog_url' => strip_tags($this->input->post('catalog_url', TRUE)),
        
                'catalog_seo_description' => strip_tags($this->input->post('catalog_seo_description', TRUE)),
        
                'catalog_seo_keywords' => strip_tags($this->input->post('catalog_seo_keywords', TRUE)),
        
                'catalog_priority' => strip_tags($this->input->post('catalog_priority', TRUE)),
        
        );
        
        
        $this->db->where('catalog_id', $id);
        $this->db->update('catalog', $data);
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
        $this->db->where('catalog_id', $id);
        $this->db->delete('catalog');
        
    }







    



}
