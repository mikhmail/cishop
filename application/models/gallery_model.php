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
        
        $config = array(
				
              'file_name' => '',
              'allowed_types' => 'jpg|jpeg|gif|png',
              'upload_path' => $this->gallery_path,
              'max_size' => 2000   // 2Mb

        	);
			
		
		//$config['file_name'] .= '_aaa'; 	

        $this->load->library('upload', $config);
        $this->upload->do_upload($filename);  // call the loaded library upload and perform the upload, giving the config to the upload

        $image_data = $this->upload->data();  // return an array that contains data about the upload process
        

        $config = array(
                'source_image' => $image_data['full_path'],
                'new_image' => $this->gallery_path . '/thumbs',
                'maintain_ration' => true,
                'width' => 150,
                'height' => 100
        	);

        $this->load->library('image_lib', $config);    // load image manipulation class
        $this->image_lib->resize();    // take the original image, save as a new image under the path we have given in new_image,
                                       // with width, height of 150x100 and same ratio

	return $image_data['file_name'];
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

	public function test () {
		echo __CLASS__ . exit;
	}

}