<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller products
 * @created on : Sunday, 04-Sep-2016 14:55:07
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class products extends MY_Controller
{

    public function __construct() 
    {
        parent::__construct();         
        $this->load->model('productss');
		$this->load->model('Gallery_model');
		$this->load->helper(array('form', 'url'));

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }

    }
    

    /**
    * List all data products
    *
    */
    public function index() 
    {

        $this->session->set_userdata(
                        array(  'keyword' => '',
                                'filter' => ''
                        )
            );

        $config = array(
            'base_url'          => site_url('products/index/'),
            'total_rows'        => $this->productss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
            
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['productss']       = $this->productss->get_all($config['per_page'], $this->uri->segment(3));
        $data['categories'] = $this->productss->get_categories();
        $this->template->render('products/view',$data);
	      
    }

    

    /**
    * Call Form to Add  New products
    *
    */
    public function add() 
    {       
        $data['products'] = $this->productss->add();
        $data['action']  = 'products/save';
     
       $data['categories'] = $this->productss->get_categories();
     
       $data['properties'] = $this->productss->get_properties();
     
        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_products").parsley();
                        });','embed');
      
        $this->template->render('products/add',$data);

    }

    

    /**
    * Call Form to Modify products
    *
    */
    public function edit($id='') 
    {
        if ($id != '') 
        {

            $data['products']      = $this->productss->get_one($id);
            $data['action']       = 'products/save/' . $id;           
      
           $data['categories'] = $this->productss->get_categories();
       
           $data['properties'] = $this->productss->get_properties();
       
            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_products").parsley();
                                    });','embed');
            
            $this->template->render('products/form',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('products'));
        }
    }


    
    /**
    * Save & Update data  products
    *
    */
    public function save($id =NULL) 
    {		
	
        // validation config
        $config = array(
                  
                    array(
                        'field' => 'category_id',
                        'label' => 'Category',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_title',
                        'label' => 'Product Title',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_description',
                        'label' => 'Product Description',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_price',
                        'label' => 'Product Price',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_action_price',
                        'label' => 'Product Action Price',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_status',
                        'label' => 'Product Status',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_active',
                        'label' => 'Product Active',
                        'rules' => 'trim|xss_clean|required'
                        ),
                    
                    array(
                        'field' => 'product_count',
                        'label' => 'Product Count',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_date_create',
                        'label' => 'Product Date Create',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_date_update',
                        'label' => 'Product Date Update',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_views',
                        'label' => 'Product Views',
                        'rules' => 'trim|xss_clean'
                        ),


                    
                    array(
                        'field' => 'product_image_1',
                        'label' => 'Product Image 1',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_2',
                        'label' => 'Product Image 2',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_3',
                        'label' => 'Product Image 3',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_4',
                        'label' => 'Product Image 4',
                        'rules' => 'trim|xss_clean'
                        ),
                    
                    array(
                        'field' => 'product_image_5',
                        'label' => 'Product Image 5',
                        'rules' => 'trim|xss_clean'
                        ),
                               
                  );
		
		
            
        // if id NULL then add new data
        if(!$id)
        {    
                  $this->form_validation->set_rules($config);

                  if ($this->form_validation->run() == TRUE) 
                  {
                      if ($this->input->post()) 
                      {
                          
                          $this->productss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('products');
                      }
                  } 
                  else // If validation incorrect 
                  {
                      $this->add();
                  }
         }
         else // Update data if Form Edit send Post and ID available
         {               
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == TRUE) 
                {
                    if ($this->input->post()) 
                    {	
						 
						
						
                        $this->productss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('products');
                    }
                } 
                else // If validation incorrect 
                {
                    $this->edit($id);
                }
         }
    }

    
    
    /**
    * Detail products
    *
    */
    public function show($id='') 
    {
        if ($id != '') 
        {

            $data['products'] = $this->productss->get_one($id);            
            $this->template->render('products/_show',$data);
            
        }
        else 
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('products'));
        }
    }
    
    
    /**
    * Search products like ""
    *
    */   
    public function search()
    {
        if($this->input->post('q'))
        {
            $keyword = $this->input->post('q');
            
            $this->session->set_userdata(
                        array('keyword' => $this->input->post('q',TRUE))
                    );
        }
        
         $config = array(
            'base_url'          => site_url('products/search/'),
            'total_rows'        => $this->productss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );
        
        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['productss']       = $this->productss->get_search($config['per_page'], $this->uri->segment(3));
        $data['categories'] = $this->productss->get_categories();
       
        $this->template->render('products/view',$data);
    }


     /**
    * Search products like ""
    *
    */
    public function filter()
    {
        if($this->input->post('filter')){
            //$keyword = $this->input->post('q');

            $this->session->set_userdata(
                        array('filter' => $this->input->post('filter',TRUE))
            );
        }

         $config = array(
            'base_url'          => site_url('products/filter/'),
            'total_rows'        => $this->productss->count_all_filter(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );

        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['productss']       = $this->productss->get_filter($config['per_page'], $this->uri->segment(3));
        $data['categories'] = $this->productss->get_categories();

        $this->template->render('products/view',$data);
    }
    
    
    /**
    * Delete products by ID
    *
    */
    public function destroy($id) 
    {        
        if ($id) 
        {
            $this->productss->destroy($id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('products');
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('products');
        }       
    }
	
	
	 public function delete_img() 
    {    
		$id = $this->input->post('id');
		$img = $this->input->post('img');
        
		if ($id AND $img) 
        {
            $this->productss->delete_img($img, $id);           
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('products/edit/'.$id);
        } 
        else 
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('products');
        }       
    }

    public function get_one()
    {
        $this->db->where('id_product', $this->input->post('id'));
        $result = $this->db->get('products');

        if ($result->num_rows() == 1)
        {
            echo json_encode($result->row_array());
        }
        else
        {
            echo 0;
        }
    }


    public function export($id=null){

        $this->save_store($id);

    }

    function save_store ($id_category = NULL){



        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'products.category_id = categories.category_id');
        if ($id_category){
            $this->db->where('products.category_id', $id_category);
                   
        }

        $this->db->order_by('id_product', 'DESC');
        $result = $this->db->get();

        $store = $result->result_array();


	//var_dump($store);die;

		/*
		// разкомментируйте строки ниже, если файл не будет загружаться
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		*/
		//стандартный заголовок, которого обычно хватает
		header('Content-Type: text/x-csv; charset=utf-8');
		header("Content-Disposition: attachment;filename=".date("d-m-Y")."-store_".$id_category.".xls");

		$csv_output ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="Andrey" />
		<title>export</title>
		</head>
		<body>';
		$csv_output .='<table border="1">
	<tr>
		<th>ID</th>
		<th>Артикул</th>
		<th>Название</th>
		<th>Описание</th>
		<th>Категория</th>
<th>Цена</th>
<th>Акционная цена</th>
<th>Оптовая цена</th>
<th>Свойства продукта</th>
<th>Картинка</th>




	</tr>';
		foreach($store as $product){
			$csv_output .='
	<tr>
		<td>'.$product['id_product'].'</td>
		<td>'.$product['product_article'].'</td>
		<td>'.$product['product_title'].'</td>
		<td>'.$product['product_description'].'</td>
		<td>'.$product['category_title'].'</td>

<td>'.$product['product_price'].'</td>
<td>'.$product['product_action_price'].'</td>
<td>'.$product['product_trade_price'].'</td>
<td>'.$product['product_properties'].'</td>
<td><a href="'.base_url().'product/'.$product['id_product'].'"><img src="'.base_url().'images/products/thumbs/'.$product['product_image_front'].'"></a></td>




	</tr>';
		}
		$csv_output .= '</table>';
		$csv_output .='</body></html>';
		echo $csv_output;
	}



}

?>
