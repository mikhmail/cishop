<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of users
 * @created on : Sunday, 04-Sep-2016 13:21:38
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class userss extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data users
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        $result = $this->db->get('users', $limit, $offset);

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
     *  Count All users
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All users
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
                
        $this->db->or_like('user_name', $keyword);  
                
        $this->db->or_like('user_password_hash', $keyword);  
                
        $this->db->or_like('user_email', $keyword);  
                
        $this->db->or_like('user_ip', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('users');

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
    * Search All users
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('users');        
                
        $this->db->or_like('user_name', $keyword);  
                
        $this->db->or_like('user_password_hash', $keyword);  
                
        $this->db->or_like('user_email', $keyword);  
                
        $this->db->or_like('user_ip', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One users
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('user_id', $id);
        $result = $this->db->get('users');

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
    *  Default form data users
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'user_name' => '',
            
                'user_password_hash' => '',
            
                'user_email' => '',

                'user_password_hash' => '',

                'user_ip' => '',
            
                'user_date_create' => '',
            
                'user_last_date_visited' => '',
            
                'user_activated' => '',
            
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
        $this->load->library('Auth');
        $auth = new Auth();

        $data = array(
        
            'user_name' => strip_tags($this->input->post('user_name', TRUE)),
        
            'user_email' => strip_tags($this->input->post('user_email', TRUE)),

            'user_password_hash' => $auth->get_sha256($this->input->post('user_password', TRUE), 'password'),

            'user_ip' => '',
        
            'user_date_create' =>  date('Y-m-d H:i:s'),
        
            'user_last_date_visited' => '',
        
            'user_activated' => strip_tags($this->input->post('user_activated', TRUE)),
        
        );
        
        
        $this->db->insert('users', $data);
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

        $this->load->library('Auth');
        $auth = new Auth();

        if ($this->input->post('new_user_password')){

            $data = array(

                'user_name' => strip_tags($this->input->post('user_name', TRUE)),

                'user_email' => strip_tags($this->input->post('user_email', TRUE)),

                'user_password_hash' => $auth->get_sha256($this->input->post('new_user_password', TRUE), 'password'),

                'user_ip' => '',

                'user_date_create' => strip_tags($this->input->post('user_date_create', TRUE)),

                'user_last_date_visited' =>  '',

                'user_activated' => strip_tags($this->input->post('user_activated', TRUE)),

            );
        }else{
            $data = array(

                'user_name' => strip_tags($this->input->post('user_name', TRUE)),

                'user_email' => strip_tags($this->input->post('user_email', TRUE)),

                'user_ip' => '',

                'user_date_create' => strip_tags($this->input->post('user_date_create', TRUE)),

                'user_last_date_visited' =>  '',

                'user_activated' => strip_tags($this->input->post('user_activated', TRUE)),

            );
        }


        
        
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
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
        $this->db->where('user_id', $id);
        $this->db->delete('users');
        
    }







    



}
