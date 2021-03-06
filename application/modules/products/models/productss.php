<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of products
 * @created on : Sunday, 04-Sep-2016 14:55:07
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class productss extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data products
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

        //$result = $this->db->get('products', $limit, $offset);
		
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('categories', 'products.category_id = categories.category_id');
		//$this->db->join('delivery_method', 'delivery_method.delivery_id = orders.delivery_id');
		//$this->db->join('payment_method', 'payment_method.payment_id = orders.payment_id');
        $this->db->order_by('id_product', 'DESC');
		
		$this->db->limit($limit, $offset);	
		
		$result = $this->db->get();
		

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
     *  Count All products
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('products');
        $this->db->join('categories', 'products.category_id = categories.category_id');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All products
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
                
        

$where = "product_title LIKE '%$keyword%' OR product_description LIKE '%$keyword%' OR product_properties LIKE '%$keyword%' OR product_article LIKE '%$keyword%'";

        $this->db->where($where);

        		$this->db->join('categories', 'products.category_id = categories.category_id');
        $this->db->limit($limit, $offset);
        $result = $this->db->get('products');

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
    * Search All products
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('products');        
		$this->db->join('categories', 'products.category_id = categories.category_id');
        $where = "product_title LIKE '%$keyword%' OR product_description LIKE '%$keyword%' OR product_properties LIKE '%$keyword%' OR product_article LIKE '%$keyword%'";

                $this->db->where($where);

                

        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One products
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id)
    {
        $this->db->where('id_product', $id);
        $result = $this->db->get('products');

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
    *  Default form data products
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'category_id' => '',
            
                'product_title' => '',
            
                'product_description' => '',
            
                'product_price' => '',
            
                'product_action_price' => '',
            
                'product_status' => '',
            
                'product_active' => '',
            
                'product_count' => '',
            
                'product_date_create' => '',
            
                'product_date_update' => '',
            
                'product_views' => '',
            
                'product_properties' => '',
            
                'product_image_front' => '',
            
                'product_image_1' => '',
            
                'product_image_2' => '',
            
                'product_image_3' => '',
            
                'product_image_4' => '',
            
                'product_image_5' => '',
            
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
		
		
		
		
		if ($this->input->post('properties_value')) {
			$product_properties = serialize ($this->input->post('properties_value', TRUE));
		}else{
			$product_properties = '';
		}
		
        $data = array(
        
            'category_id' => strip_tags($this->input->post('category_id', TRUE)),
        
            'product_title' => strip_tags($this->input->post('product_title', TRUE)),
        
            'product_description' => $this->input->post('product_description', TRUE),
        
            'product_price' => strip_tags($this->input->post('product_price', TRUE)),
        
            'product_action_price' => strip_tags($this->input->post('product_action_price', TRUE)),
        
            'product_status' => strip_tags($this->input->post('product_status', TRUE)),
        
            'product_active' => strip_tags($this->input->post('product_active', TRUE)),
        
            'product_count' => '',
        
            'product_date_create' => date('Y-m-d H:i:s'),
        
            'product_date_update' => '',
        
            'product_views' => '',
        
            'product_properties' => $product_properties,
            'product_article' => strip_tags($this->input->post('product_article', TRUE)),
            'product_trade_price' => strip_tags($this->input->post('product_trade_price', TRUE))

        
        );
        
        
        $this->db->insert('products', $data);
		
		$id = $this->db->insert_id();


        $data = $this->Gallery_model->upload_files($_FILES);

        if ($data){
            $this->db->where('id_product', $id);
            $this->db->update('products', $data);
        }
        /* Этот код добавляет новые рисунки

        $data = array();
        if ($_FILES !== null){
            foreach ($_FILES as $img => $value) {

                if ($value['name'] != false){

                    // upload new file and add it to $data array
                    $data[$img] = trim($this->Gallery_model->upload_files($img));

                }
            }

            if ($data){
                $this->db->where('id_product', $id);
                $this->db->update('products', $data);
            }
        }

         КОНЕЦ! Этот код добавляет новые рисунки */
		
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
		/* Этот код добавляет новые рисунки */
		$data = array();
		if ($_FILES !== null){
			foreach ($_FILES as $img => $value) {
				
				if ($value['name'] != false){
				
					// Delete old image
					  $old_file = $this->Gallery_model->gallery_path . '/' . $this->get_img($img, $id)[$img];
					  $thumbnail_name = $this->Gallery_model->gallery_path . '/thumbs/' . $this->get_img($img, $id)[$img];
					  
					  if ( is_file ($old_file))
					  {	
						unlink($old_file);
					  }
					  if ( is_file ($thumbnail_name))
					  {
						unlink($thumbnail_name);
					  }
				
				}
			}

            // upload new file and add it to $data array
            $data = $this->Gallery_model->upload_files($_FILES);

			if ($data){
				$this->db->where('id_product', $id);
				$this->db->update('products', $data);
			}	
		}
		/* КОНЕЦ! Этот код добавляет новые рисунки */
		
		
		if ($this->input->post('properties_value')) {
			$product_properties = serialize ($this->input->post('properties_value', TRUE));
		}else{
			$product_properties = '';
		}
		
		//var_dump($product_properties);die;
		
        $data = array(
        
                'category_id' => strip_tags($this->input->post('category_id', TRUE)),
        
                'product_title' => strip_tags($this->input->post('product_title', TRUE)),

                'product_description' => $this->input->post('product_description', TRUE),
        
                'product_price' => strip_tags($this->input->post('product_price', TRUE)),
        
                'product_action_price' => strip_tags($this->input->post('product_action_price', TRUE)),
        
                'product_status' => strip_tags($this->input->post('product_status', TRUE)),
        
                'product_active' => strip_tags($this->input->post('product_active', TRUE)),
        
                'product_count' => '',
        
                'product_date_create' => '',
        
                'product_date_update' => date('Y-m-d H:i:s'),
        
        
                'product_properties' => $product_properties,
                'product_article' => strip_tags($this->input->post('product_article', TRUE)),
                'product_trade_price' => strip_tags($this->input->post('product_trade_price', TRUE))
        
               
        );
        
        
        $this->db->where('id_product', $id);
        $this->db->update('products', $data);
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
	$imgs = ['product_image_front', 'product_image_1', 'product_image_2', 'product_image_3', 'product_image_4', 'product_image_5'];
		foreach ($imgs as $img) {
				// Delete old image
					  $old_file = $this->Gallery_model->gallery_path . '/' . $this->get_img($img, $id)[$img];
					  $thumbnail_name = $this->Gallery_model->gallery_path . '/thumbs/' . $this->get_img($img, $id)[$img];
					  
					  if ( is_file ($old_file))
					  {	
						unlink($old_file);
					  }
					  if ( is_file ($thumbnail_name))
					  {
						unlink($thumbnail_name);
					  }	
				}
		
        $this->db->where('id_product', $id);
        $this->db->delete('products');
        
    }







    
    
    // get categories
    public function get_categories() 
    {
      
        $result = $this->db->get('categories')
                           ->result();

        $ret ['']= 'Выбрать категорию :';
        if($result)
        {
            foreach ($result as $key => $row)
            {
                $ret [$row->category_id] = $row->category_title;
            }
        }
        
        return $ret;
    }


    
    
    // get properties
    public function get_properties() 
    {
      
        $result = $this->db->get('properties')
                           ->result();

        //$ret ['']= 'Выбрать свойства :';
        if($result)
        {
            foreach ($result as $key => $row)
            {
                $ret [$row->property_id] = $row->title;
            }
        }
        
        return $ret;
    }

 // get img	
 public function get_img($img, $id) 
    {
        
		$this->db->select($img);
		$this->db->where('id_product', $id);
        $result = $this->db->get('products');

        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }
    
	// delete img	
 public function delete_img($img, $id) 
    {	
	
		// Delete old image
					  $old_file = $this->Gallery_model->gallery_path . '/' . $this->get_img($img, $id)[$img];
					  $thumbnail_name = $this->Gallery_model->gallery_path . '/thumbs/' . $this->get_img($img, $id)[$img];
					  
					  if ( is_file ($old_file))
					  {	
						unlink($old_file);
					  }
					  if ( is_file ($thumbnail_name))
					  {
						unlink($thumbnail_name);
					  }	
		
		$data = [$img => ''];
        $this->db->where('id_product', $id);
        $this->db->update('products', $data);
		
    }


public function get_filter($limit, $offset)
    {
        $filter = $this->session->userdata('filter');

		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('categories', 'products.category_id = categories.category_id');
        $this->db->where('products.category_id', $filter);
        $this->db->order_by('id_product', 'DESC');

		$this->db->limit($limit, $offset);

		$result = $this->db->get();


        if ($result->num_rows() > 0)
        {
            return $result->result_array();
        }
        else
        {
            return array();
        }
        
    }


public function count_all_filter()
    {
         $filter = $this->session->userdata('filter');

		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('categories', 'products.category_id = categories.category_id');
        $this->db->where('products.category_id', $filter);
        $this->db->order_by('id_product', 'DESC');

	 return $this->db->count_all_results();
        
      
    }



}//end class
