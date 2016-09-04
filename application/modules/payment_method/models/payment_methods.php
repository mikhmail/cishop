<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of payment_method
 * @created on : Friday, 02-Sep-2016 14:14:58
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class payment_methods extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data payment_method
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('payment_method', $limit, $offset);

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
     *  Count All payment_method
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('payment_method');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All payment_method
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
                
        $this->db->like('payment_name', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('payment_method');

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
    * Search All payment_method
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('payment_method');        
                
        $this->db->like('payment_name', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One payment_method
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('payment_id', $id);
        $result = $this->db->get('payment_method');

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
    *  Default form data payment_method
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'payment_name' => '',
            
                'is_active' => '',
            
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
        
            'payment_name' => strip_tags($this->input->post('payment_name', TRUE)),
        
            'is_active' => strip_tags($this->input->post('is_active', TRUE)),
        
        );
        
        
        $this->db->insert('payment_method', $data);
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
        
                'payment_name' => strip_tags($this->input->post('payment_name', TRUE)),
        
                'is_active' => strip_tags($this->input->post('is_active', TRUE)),
        
        );
        
        
        $this->db->where('payment_id', $id);
        $this->db->update('payment_method', $data);
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
        $this->db->where('payment_id', $id);
        $this->db->delete('payment_method');
        
    }







    



}
