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

    public function basket()
    {   $id_product = $this->uri->segment(3);

        $c= $_SESSION['cart'][$this->uri->segment(3)];?>
            <li class="basket_item">

                <a href="<?echo base_url('product').'/'. $id_product?>" class="basket_item-image">
                    <img width="75" src="<? echo base_url(). $c['img'];?>">
                </a>

                <a href="<?echo base_url('product').'/'. $id_product?>" class="basket_item-title">Футболка Lino Blue Stripe </a>

                <div class="basket_item-details right">

                    <span class="basket_item-count"><?=$c['count']?></span> x
                                                        <span class="basket_item-price prices">
                                                          <span class="prices-current"><?=$c['price']?>&nbsp;<?=$this->lang->line('currency');?></span>
                                                        </span>


                    <button name="remove" id="<?=$id_product?>" class="fa fa-times">

                </div>
            </li>
        <?
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

        $data['delivery_method'] = $this->orderss->get_delivery_method($active=1);
        $data['payment_method']  = $this->orderss->get_payment_method($active=1);

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
            $id = $this->orders_model->order_create($this->cart,$this->user);
            if($id){    
                $this->user['order_id'] = $id;

                // Send email about order
                //$this->load->helper('email');

                $this->send_order(
                    $this->user['email'],
                    $this->lang->line('order_new_order'),
                    $this->cart,
                    $this->user

                );
                $_SESSION['cart'] = $this->cart = array();
            }
        }
        
        $data['order_id'] = $id;
        $data['title'] = 'Корзина';
        $data['description'] = '';
        $data['keywords'] = 'купить алмазною вышивку';

        $data['cart'] = array();
        $this->layout('cart/complete',$data);
    }

    function send_order($email,$subject,$order,$user)
    {
        $config['charset'] = 'utf-8';
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from(base_url(), 'Admin');
        $this->email->to($email.',frentsel@mail.ru');
        $this->email->subject($subject);

        $text = $this->load->view('email/order',array('cart'=>$order, 'user'=>$user,),true);

        mb_convert_encoding($text, "UTF-8");

        $this->email->message($text);

        $this->email->send();
    }
}