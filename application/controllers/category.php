<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Category
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Category extends BaseController {

    public function __construct()
    {	
        parent::__construct();
        $this->load->model('categories_model');
        $this->load->model('catalog_model');

    }

    public function index($id = 0, $separate = '', $start = 0)
    {		
        $this->load->library('pagination');

        $data = $this->categories_model->_default();

        $config = array(
            'first_url' => '/category/'.$id.'/'.$separate.'/0/',
            'base_url' => '/category/'.$id.'/'.$separate.'/',
            'total_rows' => $this->categories_model->count_all($id),
            'uri_segment' => 4,
        );

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['products'] = $this->categories_model->pagination(
            $id,
            $start,
            9
        );

        $category = $this->categories_model->get_category($id);
        $data['category'] = $category;
        $data['title'] = $category->category_title;

        $data['description'] = $category->category_seo_description;
        $data['keywords'] = $category->category_seo_keywords;

        $catalog = $this->catalog_model->get_catalog($category->catalog_id);
        $data['catalog'] = $catalog;


        $this->layout('category/index',$data);
    }


}