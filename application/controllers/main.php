<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller MAin
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Main extends BaseController {

    public function index()
    {
        $data = $this->user_model->_default();
        $data['products'] = $this->user_model->get_products();

        $data['title'] = 'алмазная вышивка';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $this->layout('main/index',$data);
    }
}