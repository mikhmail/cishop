<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of orders
 * @created on : Friday, 02-Sep-2016 14:53:30
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class orderss extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data orders
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('status', 'status.status_id = orders.status_id');
		$this->db->join('delivery_method', 'delivery_method.delivery_id = orders.delivery_id');
		$this->db->join('payment_method', 'payment_method.payment_id = orders.payment_id');
		
		
		
		
		$this->db->limit($limit, $offset);	
		
		$result = $this->db->get();
		
		//echo $this->db->last_query();die;
		 
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
     *  Count All orders
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('orders');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All orders
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
                
        $this->db->like('order_name', $keyword);  
                
        $this->db->like('order_phone', $keyword);  
                
        $this->db->like('order_address', $keyword);  
                
        $this->db->like('order_content', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('orders');

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
    * Search All orders
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('orders');        
                
        $this->db->like('order_name', $keyword);  
                
        $this->db->like('order_phone', $keyword);  
                
        $this->db->like('order_address', $keyword);  
                
        $this->db->like('order_content', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One orders
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('order_id', $id);
        $result = $this->db->get('orders');

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
    *  Default form data orders
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'order_name' => '',
            
                'order_phone' => '',
            
                'order_address' => '',
            
                'order_content' => '',
            
                'order_date_create' => '',
            
                'order_date_update' => '',
            
                'user_id' => '',
            
                'status_id' => '',
            
                'delivery_id' => '',
            
                'payment_id' => '',
            
                'paid' => '',
            
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
        
            'order_name' => strip_tags($this->input->post('order_name', TRUE)),
        
            'order_phone' => strip_tags($this->input->post('order_phone', TRUE)),
        
            'order_address' => strip_tags($this->input->post('order_address', TRUE)),
        
            'order_content' => strip_tags($this->input->post('order_content', TRUE)),
        
            'order_date_create' => date('Y-m-d H:i:s'),
        
            'order_date_update' => date('Y-m-d H:i:s'),
        
            'user_id' => strip_tags($this->input->post('user_id', TRUE)),
        
            'status_id' => strip_tags($this->input->post('status_id', TRUE)),
        
            'delivery_id' => strip_tags($this->input->post('delivery_id', TRUE)),
        
            'payment_id' => strip_tags($this->input->post('payment_id', TRUE)),
        
            'paid' => strip_tags($this->input->post('paid', TRUE)),
        
        );
        
        
        $this->db->insert('orders', $data);
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
        
                'order_name' => strip_tags($this->input->post('order_name', TRUE)),
        
                'order_phone' => strip_tags($this->input->post('order_phone', TRUE)),
        
                'order_address' => strip_tags($this->input->post('order_address', TRUE)),
        
                'order_content' => strip_tags($this->input->post('order_content', TRUE)),
        
        
                'order_date_update' => date('Y-m-d H:i:s'),
        
                'user_id' => strip_tags($this->input->post('user_id', TRUE)),
        
                'status_id' => strip_tags($this->input->post('status_id', TRUE)),
        
                'delivery_id' => strip_tags($this->input->post('delivery_id', TRUE)),
        
                'payment_id' => strip_tags($this->input->post('payment_id', TRUE)),
        
                'paid' => strip_tags($this->input->post('paid', TRUE)),
        
        );
        
        
        $this->db->where('order_id', $id);
        $this->db->update('orders', $data);
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
        $this->db->where('order_id', $id);
        $this->db->delete('orders');
        
    }







    
    
    // get delivery_method
    public function get_delivery_method() 
    {
      
        $result = $this->db->get('delivery_method')
                           ->result();

        $ret ['']= 'Выбрать :';
        if($result)
        {
            foreach ($result as $key => $row)
            {
                $ret [$row->delivery_id] = $row->delivery_name;
            }
        }
        
        return $ret;
    }


    
    
    // get payment_method
    public function get_payment_method() 
    {
      
        $result = $this->db->get('payment_method')
                           ->result();

        $ret ['']= 'Выбрать :';
        if($result)
        {
            foreach ($result as $key => $row)
            {
                $ret [$row->payment_id] = $row->payment_name;
            }
        }
        
        return $ret;
    }
	
	 // get status
    public function get_status() 
    {
      
        $result = $this->db->get('status')
                           ->result();

        $ret ['']= 'Выбрать :';
        if($result)
        {
            foreach ($result as $key => $row)
            {
                $ret [$row->status_id] = $row->status_name;
            }
        }
        
        return $ret;
    }


    



}
