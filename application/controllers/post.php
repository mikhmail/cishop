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

class Post extends BaseController {

    public function index($id = 0)
    {
        $this->load->model('posts_model');
        $data = $this->posts_model->_default();
        $data['post'] = $this->posts_model->get_by_pk($id);
        if(empty($data['post'])){
            redirect('error/404','location',301);
            return;
        }

        $data['title'] = 'Новости';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $this->layout('post/index',$data);
    }
}