<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of product_properties
 * @created on : Sunday, 04-Sep-2016 18:56:27
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class product_propertiess extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data product_properties
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('product_properties', $limit, $offset);

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
     *  Count All product_properties
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('product_properties');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All product_properties
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
                
        $this->db->like('title', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('product_properties');

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
    * Search All product_properties
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('product_properties');        
                
        $this->db->like('title', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One product_properties
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->get('product_properties');

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
    *  Default form data product_properties
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'property_id' => '',
            
                'product_id' => '',
            
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
        
            'property_id' => strip_tags($this->input->post('property_id', TRUE)),
        
            'product_id' => strip_tags($this->input->post('product_id', TRUE)),
        
            'title' => strip_tags($this->input->post('title', TRUE)),
        
        );
        
        
        $this->db->insert('product_properties', $data);
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
        
                'property_id' => strip_tags($this->input->post('property_id', TRUE)),
        
                'product_id' => strip_tags($this->input->post('product_id', TRUE)),
        
                'title' => strip_tags($this->input->post('title', TRUE)),
        
        );
        
        
        $this->db->where('id', $id);
        $this->db->update('product_properties', $data);
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
        $this->db->where('id', $id);
        $this->db->delete('product_properties');
        
    }







    



}
