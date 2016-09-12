<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Product
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Product extends BaseController {

    public function index($id = 0)
    {
        $this->load->model('product_model');
        $this->load->model('products/productss');
        $data = $this->product_model->_default();
        $data['product'] = $this->product_model->get_by_pk($id);

        //var_dump($data['product']);die;

        $data['title'] = $data['product'][0]->product_title;
        $data['description'] = $data['product'][0]->product_description;
        $data['keywords'] = 'купить алмазною вышивку';

        $data['properties'] = $this->productss->get_properties();

        $this->layout('product/index',$data);
    }
}