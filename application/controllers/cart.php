<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'base_controller.php';

class Cart extends BaseController {

    public function index()
    {
        if(!empty($_POST['data']) && $_POST['data'] != 'empty')
            $_SESSION['cart'] = $this->cart = $_POST['data'];
        elseif(!empty($_POST['data']) && $_POST['data'] == 'empty')
            $_SESSION['cart'] = $this->cart = array();

        die($this->load->view(
            'cart/cart_form',
            array('cart' => $this->cart),
            true
        ));
    }

    public function init()
    {
        die(json_encode($this->cart));
    }

    public function checkout()
    {
        $this->load->model('orders_model');
        $this->load->model('orders/orderss');
        $data =  $this->orders_model->_default();

        $data['cart'] = $this->cart;

        $data['title'] = 'Корзина';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $data['delivery_method'] = $this->orderss->get_delivery_method();
        $data['payment_method']  = $this->orderss->get_payment_method();

        $this->layout('cart/checkout',$data);
    }

    public function complete()
    {   
        $this->load->model('orders_model');
        $data = $this->orders_model->_default();

        if(!empty($this->cart) && !empty($_POST)){

            // Set User Information
            $this->user['email'] = $_POST['email'];
            $this->user['name'] = $_POST['name'];
            $this->user['phone'] = $_POST['phone'];
            $this->user['message'] = '';
            $this->user['address'] = $_POST['address'];
            $this->user['delivery_id'] = $_POST['delivery_id'];
            $this->user['payment_id'] = $_POST['payment_id'];



            // Save data
            if($this->orders_model->order_create($this->cart,$this->user)){

                // Send email about order
                $this->load->helper('email');

                send_order(
                    $this->user['email'],
                    $this->lang->line('order_new_order'),
                    $this->cart
                );
                $_SESSION['cart'] = $this->cart = array();
            }
        }

        $data['title'] = 'Корзина';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $data['cart'] = array();
        $this->layout('cart/complete',$data);
    }
}