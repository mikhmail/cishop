<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Contact
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Contact extends BaseController {

    public function index()
    {
        $data = $this->user_model->_default();

        $data['title'] = 'Контакты';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $this->layout('contact/index',$data);



    }

    public function send()
    {
        $data = $this->user_model->_default();

        if(!empty($_POST['email']) && !empty($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

            // Send email
            $this->load->helper('email');

            $data['name'] = !empty($_POST['name']) ? strip_tags($_POST['name']) : '';

            send_email(
                $_POST['email'],
                $data['name'],
                $this->lang->line('contact_new_message').$_POST['email'].': '.$data['name'],
                strip_tags(nl2br($_POST['message']),'<br>')
            );
        }

        $data['title'] = 'Контакты';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $this->layout('contact/complete',$data);
    }
}