<?php

include_once 'user_model.php';

class Product_Model extends User_Model
{
    public  $table = 'products',
            $pk = 'id_product';


    public function set_product_score($id)
    {
        $prod_sql = "UPDATE products SET product_views = product_views + 1 WHERE id_product = $id";
        $this->db->query($prod_sql);
    }



     public function get_new_products()
    {
        $prod_sql = "SELECT *

                      FROM products AS p
                      LEFT OUTER JOIN categories AS cp ON cp.category_id = p.category_id
                      WHERE p.product_active = 1
                      ORDER BY p.id_product DESC LIMIT 0,8";

        //$this->db->query($prod_sql);
        //var_dump($this->db->last_query());die;
        return $this->db->query($prod_sql)->result();
    }


     public function get_popular_products()
    {
        $prod_sql = "SELECT *

                      FROM products AS p
                      LEFT OUTER JOIN categories AS cp ON cp.category_id = p.category_id
                      WHERE p.product_active = 1
                      ORDER BY p.product_views DESC LIMIT 0,8";

        //$this->db->query($prod_sql);
        //var_dump($this->db->last_query());die;
        return $this->db->query($prod_sql)->result();
    }

     public function get_action_products()
    {
        $prod_sql = "SELECT *

                      FROM products AS p
                      LEFT OUTER JOIN categories AS cp ON cp.category_id = p.category_id
                      WHERE p.product_active = 1
                      AND p.product_status = 1
                      ORDER BY p.id_product DESC LIMIT 0,8";

        //$this->db->query($prod_sql);
        //var_dump($this->db->last_query());die;
        return $this->db->query($prod_sql)->result();
    }

}