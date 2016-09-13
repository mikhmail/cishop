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

}