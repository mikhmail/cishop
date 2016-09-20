<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of status
 * @created on : Friday, 02-Sep-2016 14:21:09
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class statuss extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data status
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('status', $limit, $offset);

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
     *  Count All status
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('status');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All status
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
                
        $this->db->or_like('status_name', $keyword);  
                
        $this->db->or_like('status_color', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('status');

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
    * Search All status
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('status');        
                
        $this->db->or_like('status_name', $keyword);  
                
        $this->db->or_like('status_color', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One status
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('status_id', $id);
        $result = $this->db->get('status');

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
    *  Default form data status
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'status_name' => '',
            
                'status_color' => '',
            
                'status_type' => '',
            
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
        
            'status_name' => strip_tags($this->input->post('status_name', TRUE)),
        
            'status_color' => strip_tags($this->input->post('status_color', TRUE)),
        
            'status_type' => strip_tags($this->input->post('status_type', TRUE)),
        
        );
        
        
        $this->db->insert('status', $data);
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
        
                'status_name' => strip_tags($this->input->post('status_name', TRUE)),
        
                'status_color' => strip_tags($this->input->post('status_color', TRUE)),
        
                'status_type' => strip_tags($this->input->post('status_type', TRUE)),
        
        );
        
        
        $this->db->where('status_id', $id);
        $this->db->update('status', $data);
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
        $this->db->where('status_id', $id);
        $this->db->delete('status');
        
    }







    



}
