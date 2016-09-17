<?php

include_once 'user_model.php';

class Categories_Model extends User_Model
{
    public $table = 'categories';
    public $pk = 'category_id';

    public function pagination($id, $offset, $limit)
    {
        $cat_sql = "SELECT
                      *
                    FROM products AS p
                      LEFT OUTER JOIN categories AS cp
                        ON cp.category_id = p.category_id
                    WHERE cp.category_id = $id
                    AND p.product_active = 1
                    GROUP BY p.id_product
                    ORDER BY p.id_product DESC
                    LIMIT $offset, $limit";

        return $this->db->query($cat_sql)->result();
    }

    public function count_all($id)
    {
        $sql = "SELECT
                  COUNT(*) as `count`
                FROM products AS p
                  LEFT OUTER JOIN categories AS cp
                    ON cp.category_id = p.category_id
                WHERE cp.category_id = ".(int)$id;

         return $this->db->query($sql)->row('count');
        //var_dump($this->db->last_query());die;
    }

    public function get_category($id)
    {	
        return $this->db
            ->get_where($this->table,array($this->pk => (int)$id))
            ->row();


    }


}