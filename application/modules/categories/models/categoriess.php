<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of categories
 * @created on : Friday, 02-Sep-2016 13:39:02
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016    
 */
 
 
class categoriess extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }


    /**
     *  Get All data categories
     *
     *  @param limit  : Integer
     *  @param offset : Integer
     *
     *  @return array
     *
     */
    public function get_all($limit, $offset) 
    {

		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->join('catalog', 'categories.catalog_id = catalog.catalog_id');	
		$this->db->limit($limit, $offset);	
		
		$result = $this->db->get();
		
        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

    

    /**
     *  Count All categories
     *    
     *  @return Integer
     *
     */
    public function count_all()
    {
        $this->db->from('categories');
        return $this->db->count_all_results();
    }
    

    /**
    * Search All categories
    *
    *  @param limit   : Integer
    *  @param offset  : Integer
    *  @param keyword : mixed
    *
    *  @return array
    *
    */
    public function get_search($limit, $offset) 
    {
        $keyword = $this->session->userdata('keyword');
                
        $this->db->or_like('category_title', $keyword);  
                
        $this->db->or_like('category_url', $keyword);  
                
        $this->db->or_like('category_seo_description', $keyword);  
                
        $this->db->or_like('category_seo_keywords', $keyword);  
        
        $this->db->limit($limit, $offset);
        $result = $this->db->get('categories');

        if ($result->num_rows() > 0) 
        {
            return $result->result_array();
        } 
        else 
        {
            return array();
        }
    }

    
    
    
    
    
    /**
    * Search All categories
    * @param keyword : mixed
    *
    * @return Integer
    *
    */
    public function count_all_search()
    {
        $keyword = $this->session->userdata('keyword');
        $this->db->from('categories');        
                
        $this->db->or_like('category_title', $keyword);  
                
        $this->db->or_like('category_url', $keyword);  
                
        $this->db->or_like('category_seo_description', $keyword);  
                
        $this->db->or_like('category_seo_keywords', $keyword);  
        
        return $this->db->count_all_results();
    }


    
    
    
    /**
    *  Get One categories
    *
    *  @param id : Integer
    *
    *  @return array
    *
    */
    public function get_one($id) 
    {
        $this->db->where('category_id', $id);
        $result = $this->db->get('categories');

        if ($result->num_rows() == 1) 
        {
            return $result->row_array();
        } 
        else 
        {
            return array();
        }
    }

    
    
    
    /**
    *  Default form data categories
    *  @return array
    *
    */
    public function add()
    {
        $data = array(
            
                'catalog_id' => '',
            
                'category_title' => '',
            
                'category_url' => '',
            
                'category_seo_description' => '',
            
                'category_seo_keywords' => '',
            
                'category_priority' => '',
            
        );

        return $data;
    }

    
    
    
    
    /**
    *  Save data Post
    *
    *  @return void
    *
    */
    public function save() 
    {
        $data = array(
        
            'catalog_id' => strip_tags($this->input->post('catalog_id', TRUE)),
        
            'category_title' => strip_tags($this->input->post('category_title', TRUE)),
        
            'category_url' => $this->get_lnk($this->input->post('category_title', TRUE)),
        
            'category_seo_description' => strip_tags($this->input->post('category_seo_description', TRUE)),
        
            'category_seo_keywords' => strip_tags($this->input->post('category_seo_keywords', TRUE)),
        
            'category_priority' => strip_tags($this->input->post('category_priority', TRUE)),
        
        );
        
        
        $this->db->insert('categories', $data);
    }
    
    
    

    
    /**
    *  Update modify data
    *
    *  @param id : Integer
    *
    *  @return void
    *
    */
    public function update($id)
    {
        $data = array(
        
                'catalog_id' => strip_tags($this->input->post('catalog_id', TRUE)),
        
                'category_title' => strip_tags($this->input->post('category_title', TRUE)),

        
                'category_seo_description' => strip_tags($this->input->post('category_seo_description', TRUE)),
        
                'category_seo_keywords' => strip_tags($this->input->post('category_seo_keywords', TRUE)),
        
                'category_priority' => strip_tags($this->input->post('category_priority', TRUE)),
        
        );
        
        
        $this->db->where('category_id', $id);
        $this->db->update('categories', $data);
    }


    
    
    
    /**
    *  Delete data by id
    *
    *  @param id : Integer
    *
    *  @return void
    *
    */
    public function destroy($id)
    {       
        $this->db->where('category_id', $id);
        $this->db->delete('categories');
        
    }







    
    
    // get catalog
    public function get_catalog() 
    {
      
        $result = $this->db->get('catalog')
                           ->result();
						  			   

        $ret ['']= 'Выбрать каталог :';
        if($result)
        {
            foreach ($result as $key => $row)
            {
                $ret [$row->catalog_id] = $row->catalog_title;
            }
        }
        
        return $ret;
    }


    function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $lat, $str);
    }


    function get_lnk ($title) {


        $link = $this->translit($title);
        $link = strtr($link, array('.'=>''));
        $link = strtr($link, array('+'=>''));


        $link = preg_replace(array('/\'/', '/[^a-zA-Z0-9\-.+]+/', '/(^_|_$)/'), array('', '-', ''), $link);
        $link = preg_replace('{-(-)*}', '-', $link);
        $link = preg_replace('{^-}', '', $link);
        $link = preg_replace('/\s/', '-', $link);
        $link = mb_strtolower ($link);

        return $link;
    }


}
