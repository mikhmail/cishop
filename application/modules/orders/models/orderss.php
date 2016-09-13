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
        $this->db->order_by('order_id', 'DESC');

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

        //var_dump($this->input->post());die;

            if ($this->input->post('id_product')) {

                $this->load->model('products/productss');
                $product = $this->productss->get_one($this->input->post('id_product'));


                $order_content[$product['id_product']] = [
                    'count' => (int)$this->input->post('count'),
                    'price' => (int)$this->input->post('price'),
                    'total' => (int)$this->input->post('price') * (int)$this->input->post('count'),
                    'name' => $product['product_title'],
                    'img' => '/images/products/thumbs/'. $product['product_image_front']
                ];
            }


        //var_dump($order_content);die;

        $data = array(
        
            'order_name' => strip_tags($this->input->post('order_name', TRUE)),
        
            'order_phone' => strip_tags($this->input->post('order_phone', TRUE)),
        
            'order_address' => strip_tags($this->input->post('order_address', TRUE)),

            'order_email' => strip_tags($this->input->post('order_email', TRUE)),

            'order_content' => addslashes(serialize($order_content)),
        
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

    /*
    так как у нас много может быть продуктов в корзине,
    мы их обозвали в форме id_product_2 count_2 price_2
    перебираем $_POST (stristr($key, 'id_product') на предмет этих продуктов
    и формируем масив типа:
    array (size=1)
      2 =>
        array (size=5)
              'count' => int 1
              'price' => int 150
              'total' => int 150
              'name' => string 'Белые розы' (length=19)
              'img' => string '/images/products/thumbs/bosch-b20-mod-dKXAygqOPy.jpg'

    где 2 =>  это id_product, а сам масив, это то что попали из корзины.


    который потом серилизируем addslashes(serialize($order_content))

    */

    public function update($id)
    {
        //var_dump($this->input->post());die;
        foreach ($this->input->post() as $key => $value){
            if (stristr($key, 'id_product')) {

                $id_product = explode("_", $key)[2];
                $new_id_product = $value;

                $this->load->model('products/productss');
                $product = $this->productss->get_one($new_id_product);


                    $order_content[$value] = [
                        'count' => (int)$this->input->post('count_'.$id_product),
                        'price' => (int)$this->input->post('price_'.$id_product),
                        'total' => (int)$this->input->post('price_'.$id_product) * (int)$this->input->post('count_'.$id_product),
                        'name' => $product['product_title'],
                        'img' => '/images/products/thumbs/'. $product['product_image_front']
                    ];


            }
        }

        //var_dump($order_content);die;

        $data = array(
        
                'order_name' => strip_tags($this->input->post('order_name', TRUE)),
        
                'order_phone' => strip_tags($this->input->post('order_phone', TRUE)),
        
                'order_address' => strip_tags($this->input->post('order_address', TRUE)),

                'order_email' => strip_tags($this->input->post('order_email', TRUE)),
        
                'order_content' => addslashes(serialize($order_content)),
        
        
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
    public function get_delivery_method($active=null)
    {
      if ($active=1){
          $result = $this->db
              ->where('is_active', 1)
              ->get('delivery_method')
              ->result();
      }else{
          $result = $this->db->get('delivery_method')
              ->result();

      }

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
    public function get_payment_method($active=null)
    {
        if ($active=1){
            $result = $this->db
                ->where('is_active', 1)
                ->get('payment_method')
                ->result();

        }else{
            $result = $this->db->get('payment_method')
                ->result();

        }

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
