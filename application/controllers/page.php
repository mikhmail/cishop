<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller post
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Page extends BaseController {

    public function index($url = null)
    {
        $this->load->model('page_model');

        $data = $this->page_model->_default();

        $data['post'] = $this->page_model->get_by_url($url);

        //var_dump($this->db->last_query());die;
        if(empty($data['post'])){
            redirect('error/404','location',301);
            return;
            exit;
        }

        $data['title'] = 'Новости';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $this->layout('post/index',$data);
    }
}