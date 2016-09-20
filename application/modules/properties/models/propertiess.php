<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of properties
 * @created on : Sunday, 04-Sep-2016 13:12:57
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class propertiess extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data properties
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('properties', $limit, $offset);

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
     *  Count All properties
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('properties');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All properties
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
                
        $this->db->or_like('title', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('properties');

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
    * Search All properties
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('properties');        
                
        $this->db->or_like('title', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One properties
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('property_id', $id);
        $result = $this->db->get('properties');

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
    *  Default form data properties
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'title' => '',
            
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
        
            'title' => strip_tags($this->input->post('title', TRUE)),
        
        );
        
        
        $this->db->insert('properties', $data);
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
        
                'title' => strip_tags($this->input->post('title', TRUE)),
        
        );
        
        
        $this->db->where('property_id', $id);
        $this->db->update('properties', $data);
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
        $this->db->where('property_id', $id);
        $this->db->delete('properties');
        
    }







    



}
