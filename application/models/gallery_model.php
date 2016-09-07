<?php

class Gallery_model extends CI_Model {

	var $gallery_path;
	var $gallery_path_url;

    function __construct($gallery_path=null, $gallery_path_url=null)
    {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../images/products');
        $this->gallery_path_url = base_url() . 'images/products/';   // to link to the images folder
    }


    public function do_upload($filename)
    {
	//var_dump($_FILES);die;
    

		$img_name = $this->get_img_name ($_FILES[$filename]["name"]);
		
        $config = array(
				
              'file_name' => $img_name,
              'allowed_types' => 'jpg|jpeg|gif|png',
              'upload_path' => $this->gallery_path,
              'max_size' => 2000   // 2Mb

        	);
			
	

        $this->load->library('upload', $config);
        $this->upload->do_upload($filename);  // call the loaded library upload and perform the upload, giving the config to the upload

        $image_data = $this->upload->data();  // return an array that contains data about the upload process
		
		/* resize_img */
		 $config = array(
                'source_image' => $image_data['full_path'],
                'new_image' => $this->gallery_path . '/thumbs',
                'maintain_ration' => true,
                'width' => 150,
                'height' => 100
        	);

        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();    
		/* end resize_img */
		
		return $image_data['file_name'];
		

    }

	public function resize_img ($img_name) {
		
		 $config = array(
                'source_image' => $this->gallery_path .'/'. $img_name,
                'new_image' => $this->gallery_path . '/thumbs',
                'maintain_ration' => true,
                'width' => 150,
                'height' => 100
        	);

        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();    
		
	}

    public function get_images()
    {
    	$files = scandir($this->gallery_path);  // scandir it returns everything including folders (and . and .. special folders)
        $files = array_diff($files, array('.', '..', 'thumbs'));

        $images = array();       // images will be an array of array. because it will contains two data, the url of the images and the thumb url

        foreach ($files as $file) {
        	
        	$images[] = array(
                   'url' => $this->gallery_path_url . $file,
                   'thumb_url' => $this->gallery_path_url . 'thumbs/' . $file,


        		);
        }

        return $images;
    }

	function get_img_name ($title) {
		
		$str = 	$this->GenerateStr();
		
		$link =  str_replace ('jpg', '', $title);
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

}