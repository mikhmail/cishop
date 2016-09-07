<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'base_controller.php';

class Catalogs extends BaseController {

    public function __construct()
    {	
        parent::__construct();
        $this->load->model('catalog_model');
        $this->load->model('categories_model');
    }

    public function index($id = 0, $separate = '', $start = 0)
    {		
        $this->load->library('pagination');

        $data = $this->catalog_model->_default();

        $config = array(
            'first_url' => '/category/'.$id.'/'.$separate.'/0/',
            'base_url' => '/category/'.$id.'/'.$separate.'/',
            'total_rows' => $this->catalog_model->count_all($id),
            'uri_segment' => 4,
        );

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['products'] = $this->catalog_model->pagination(
            $id,
            $start,
            9
        );

        $catalog = $this->catalog_model->get_catalog($id);

        $data['catalog'] = $catalog;
        $data['title'] = $catalog->catalog_title;
        $data['description'] = $catalog->catalog_seo_description;
        $data['keywords'] = $catalog->catalog_seo_keywords;


        $this->layout('catalog/index',$data);
    }


}