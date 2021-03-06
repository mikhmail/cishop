<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Catalogs
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Catalogs extends BaseController {

    public function __construct()
    {	
        parent::__construct();
        $this->load->model('catalog_model');
        //$this->load->model('categories_model');
    }

    public function index($id = 0, $separate = '', $start = 0)
    {
        $this->load->library('pagination');

        $data = $this->catalog_model->_default();

        $config = array(
            'first_url' => base_url().'catalogs/'.$id.'/'.$separate.'/0',
            'base_url' => base_url().'catalogs/'.$id.'/'.$separate.'/',
            'total_rows' => $this->catalog_model->count_all($id),
            'uri_segment' => 4,
            'per_page' => 12
        );




        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['products'] = $this->catalog_model->pagination(
            $id,
            $start,
            $config['per_page']
        );

 //var_dump($data['products']);die;

        $catalog = $this->catalog_model->get_catalog($id);

        $data['catalog'] = $catalog;
        $data['title'] = $catalog->catalog_title;
        $data['description'] = $catalog->catalog_seo_description;
        $data['keywords'] = $catalog->catalog_seo_keywords;


        $this->layout('catalog/index',$data);
    }


}