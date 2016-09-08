<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Error
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

include_once 'base_controller.php';

class Error extends BaseController {

    public function index($key = 404)
    {
        $data = $this->user_model->_default();
        $data['error'] = 404;
        $this->layout('error/index',$data);
    }
}