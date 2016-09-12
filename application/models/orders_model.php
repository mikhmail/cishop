<?php

include_once 'user_model.php';

class Orders_Model extends User_Model
{
    public $table = 'orders';
    public $pk = 'order_id';



    public function order_create($data, $user)
    {
        $order = array(
            'order_date_create' => date('Y-m-d H:i:s'),
            'user_id'           => (int) $user['id'],
            'order_name'        => $this->escape($user['name']),
            'order_email'       => filter_var($user['email'], FILTER_VALIDATE_EMAIL) ? $user['email'] : '',
            'order_phone'       => preg_match("/[0-9- ()+]{8,19}/", $user['phone']) ? $user['phone'] : '',
            'order_message'     => $this->escape($user['message']),
            'order_content'     => $this->escape(serialize($data)),
            'order_address'     => $this->escape($user['address']),
            'status_id'         => 1,
            'delivery_id'       => $this->escape($user['delivery_id']),
            'payment_id'        => $this->escape($user['payment_id'])

        );

        $this->add($order);
        return $this->db->insert_id();
    }
}