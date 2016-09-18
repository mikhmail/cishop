<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller post
 * @created on : Friday, 02-Sep-2016 13:22:18
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */

class upload extends CI_Controller {


     public function __construct()
    {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../images/uploads');
        $this->gallery_path_url = base_url() . 'images/uploads/';   // to link to the images folder
    }

    public function index()
    {


        $data = $this->upload_files($_FILES);

        echo $data[0];exit;

    }


    	function upload_files($files)
	{
		$config = array(
			'allowed_types' => 'jpg|gif|png',
			'upload_path' => $this->gallery_path,
			'max_size' => 2000   // 2Mb

		);

		$images = array();
		$this->load->library('upload', $config);


        //var_dump($_FILES['Filedata']['name']);die;
       $ext = substr($_FILES['Filedata']['name'], -3);

			$config['file_name'] =  $this->get_img_name ($_FILES['Filedata']['name']) .'.'. $ext;


			$this->upload->initialize($config);

			if ($this->upload->do_upload('Filedata')) {

				$images[] = $config['file_name'];


			}



		echo json_encode (array(
						'title'     =>  $config['file_name'],
						'url'       =>  $this->gallery_path_url . $config['file_name']
					));
	}


    	function get_img_name ($title) {

		$str = 	$this->GenerateStr();

   
		$link =  str_replace (['jpg','png','gif'], ['','',''], $title);
		$link = strtr($link, array('.'=>''));
		$link = strtr($link, array('+'=>''));

		$link = preg_replace(array('/\'/', '/[^a-zA-Z0-9\-.+]+/', '/(^_|_$)/'), array('', '-', ''), $link);
		$link = preg_replace('{-(-)*}', '-', $link);
		$link = preg_replace('{^-}', '', $link);
		$link = preg_replace('/\s/', '-', $link);
		$link = mb_strtolower ($link);
		$link = trim($link);
		return $link.'-'.$str;
  }

  	private function GenerateStr($length = 10){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];
		return $code;
	}


}//end class