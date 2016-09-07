<?php

include_once 'user_model.php';

class Catalog_Model extends User_Model
{
    public $table = 'catalog';
    public $pk = 'catalog_id';

    public function pagination($id, $offset, $limit)
    {
        $cat_sql = "SELECT
                      *
                    FROM products AS p
                      LEFT OUTER JOIN categories AS cp
                        ON cp.category_id = p.category_id
                      LEFT OUTER JOIN catalog AS ck
                        ON ck.catalog_id = cp.catalog_id   
                    WHERE cp.catalog_id = $id
                    AND p.product_active = 1
                    GROUP BY p.id_product
                    ORDER BY p.id_product DESC
                    LIMIT $offset, $limit";

       return $this->db->query($cat_sql)->result();
        //var_dump($this->db->last_query());die;
    }

    public function count_all($id)
    {
        $sql = "SELECT
                  COUNT(*) as `count`
                FROM products AS p
                  LEFT OUTER JOIN categories AS cp
                        ON cp.category_id = p.category_id
                      LEFT OUTER JOIN catalog AS ck
                        ON ck.catalog_id = cp.catalog_id
                         AND p.product_active = 1   
                WHERE cp.category_id = ".(int)$id;

        return $this->db->query($sql)->row('count');
    }

    public function get_catalog($id)
    {	
        return $this->db
            ->get_where($this->table,array($this->pk => (int)$id))
            ->row();
        //var_dump($this->db->last_query());die;

    }


}