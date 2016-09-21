<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Controller orders
 * @created on : Friday, 02-Sep-2016 14:53:30
 * @author Mikhail Khorunzhenko <activex.mail@gmail.com>
 * Copyright 2016
 *
 *
 */


class orders extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('orderss');
		$this->load->model('Gallery_model');

        $this->load->library('Auth');
        $auth = new Auth();
        if(!$auth->is_logged_in()){
            redirect('admin/login');
            die;
        }

		//$this->Gallery_model->get_images();

    }


    /**
    * List all data orders
    *
    */
    public function index()
    {

        $this->session->set_userdata(
                        array(  'keyword' => '',
                                'filter' => ''
                        )
            );

        $config = array(
            'base_url'          => site_url('orders/index/'),
            'total_rows'        => $this->orderss->count_all(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE

        );

        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['pagination']     = $this->pagination->create_links();
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['orderss']       = $this->orderss->get_all($config['per_page'], $this->uri->segment(3));
        $this->template->render('orders/view',$data);

    }


    /**
    * Call Form to Add  New orders
    *
    */
    public function add()
    {
        $data['orders'] = $this->orderss->add();
        $data['action']  = 'orders/save';

       $data['delivery_method'] = $this->orderss->get_delivery_method();
       $data['payment_method']  = $this->orderss->get_payment_method();
	   $data['status'] 		    = $this->orderss->get_status();
	   $data['status_selected'] = 1; // новый


        $this->template->js_add('
                $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#form_orders").parsley();
                        });','embed');

        $this->template->render('orders/add',$data);

    }



    /**
    * Call Form to Modify orders
    *
    */
    public function edit($id='')
    {
        if ($id != '')
        {

            $data['orders']      = $this->orderss->get_one($id);
            $data['action']       = 'orders/save/' . $id;

           $data['delivery_method'] = $this->orderss->get_delivery_method();
           $data['payment_method']  = $this->orderss->get_payment_method();
		   $data['status'] 		    = $this->orderss->get_status();



            $this->template->js_add('
                     $(document).ready(function(){
                    // binds form submission and fields to the validation engine
                    $("#form_orders").parsley();
                                    });','embed');

            $this->template->render('orders/form',$data);

        }
        else
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('orders'));
        }
    }



    /**
    * Save & Update data  orders
    *
    */
    public function save($id =NULL)
    {
        // validation config
        $config = array(

                    array(
                        'field' => 'order_name',
                        'label' => 'Order Name',
                        'rules' => 'trim|xss_clean|required'
                        ),

                    array(
                        'field' => 'order_phone',
                        'label' => 'Order Phone',
                        'rules' => 'trim|xss_clean|required'
                        ),


                    array(
                        'field' => 'order_address',
                        'label' => 'Order Address',
                        'rules' => 'trim|xss_clean|required'
                    ),


                    array(
                        'field' => 'order_date_create',
                        'label' => 'Order Date Create',
                        'rules' => 'trim|xss_clean'
                        ),

                    array(
                        'field' => 'order_date_update',
                        'label' => 'Order Date Update',
                        'rules' => 'trim|xss_clean'
                        ),

                    array(
                        'field' => 'user_id',
                        'label' => 'User',
                        'rules' => 'trim|xss_clean'
                        ),

                    array(
                        'field' => 'status_id',
                        'label' => 'Status',
                        'rules' => 'trim|xss_clean'
                        ),

                    array(
                        'field' => 'delivery_id',
                        'label' => 'Delivery',
                        'rules' => 'trim|xss_clean'
                        ),

                    array(
                        'field' => 'payment_id',
                        'label' => 'Payment',
                        'rules' => 'trim|xss_clean'
                        ),

                    array(
                        'field' => 'paid',
                        'label' => 'Paid',
                        'rules' => 'trim|xss_clean'
                        ),

                  );

        // if id NULL then add new data
        if(!$id)
        {
                  $this->form_validation->set_rules($config);

                  if ($this->form_validation->run() == TRUE)
                  {
                      if ($this->input->post())
                      {

                          $this->orderss->save();
                          $this->session->set_flashdata('notif', notify('success','success'));
                          redirect('orders');
                      }
                  }
                  else // If validation incorrect
                  {
                      $this->add();
                  }
         }
         else // Update data if Form Edit send Post and ID available
         {
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == TRUE)
                {
                    if ($this->input->post())
                    {
                        $this->orderss->update($id);
                        $this->session->set_flashdata('notif', notify('success','success'));
                        redirect('orders');
                    }
                }
                else // If validation incorrect
                {
                    $this->edit($id);
                }
         }
    }



    /**
    * Detail orders
    *
    */
    public function show($id='')
    {
        if ($id != '')
        {

            $data['orders'] = $this->orderss->get_one($id);
            $this->template->render('orders/_show',$data);

        }
        else
        {
            $this->session->set_flashdata('notif', notify('no id','info'));
            redirect(site_url('orders'));
        }
    }


    /**
    * Search orders like ""
    *
    */
    public function search()
    {
        if($this->input->post('q'))
        {
            //$keyword = $this->input->post('q');

            $this->session->set_userdata(
                        array('keyword' => trim(stripslashes ($_POST['q'])))
                    );
        }

         $config = array(
            'base_url'          => site_url('orders/search/'),
            'total_rows'        => $this->orderss->count_all_search(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );

        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['orderss']       = $this->orderss->get_search($config['per_page'], $this->uri->segment(3));

        $this->template->render('orders/view',$data);
    }



    /**
    * fILTER orders ""
    *
    */
    public function filter()
    {
       if($this->input->post('filter')){
            //$keyword = $this->input->post('q');

            $this->session->set_userdata(
                        array('filter' => $this->input->post('filter',TRUE))
            );
        }

         $config = array(
            'base_url'          => site_url('orders/filter/'),
            'total_rows'        => $this->orderss->count_all_filter(),
            'per_page'          => $this->config->item('per_page'),
            'uri_segment'       => 3,
            'num_links'         => 9,
            'use_page_numbers'  => FALSE
        );

        $this->pagination->initialize($config);
        $data['total']          = $config['total_rows'];
        $data['number']         = (int)$this->uri->segment(3) +1;
        $data['pagination']     = $this->pagination->create_links();
        $data['orderss']       = $this->orderss->get_filter($config['per_page'], $this->uri->segment(3));

        $this->template->render('orders/view',$data);
    }


    /**
    * Delete orders by ID
    *
    */
    public function destroy($id)
    {
        if ($id)
        {
            $this->orderss->destroy($id);
             $this->session->set_flashdata('notif', notify('success','success'));
             redirect('orders');
        }
        else
        {
            $this->session->set_flashdata('notif', notify('not deleted','warning'));
            redirect('orders');
        }
    }


public function export($id=null){

        $this->save_store($id);

    }

function save_store ($id = NULL){

 switch ($id) {
            case 1:
                $date = date("Y-m-d");
                $where = " orders.order_date_create LIKE '".$date."%' ";
                break;
            case 2:
                $date = date("Y-m-d", strtotime('-1 day'));
                $where = " orders.order_date_create LIKE '".$date."%' ";
                break;
            case 3: // неделя
                 $date = date("Y-m-d", strtotime('-1 week'));
                 $where = " orders.order_date_create >= '".$date."%' ";
                 break;
            case 4: // месяц
                 $date = date("Y-m-d", strtotime('-1 month'));
                 $where = " orders.order_date_create >= '".$date."%' ";
                 break;
            default:
                //$date = date("Y-m-d", strtotime('-1 month'));
                 $where = " orders.order_date_create >= '2000-01-01%' ";
                 break;
        }

        $this->db->join('status', 'status.status_id = orders.status_id');
		//$this->db->join('delivery_method', 'delivery_method.delivery_id = orders.delivery_id');
		//$this->db->join('payment_method', 'payment_method.payment_id = orders.payment_id');
        $this->db->order_by('order_id', 'DESC');

        $this->db->where($where, NULL, FALSE);
        //$this->db->limit($limit, $offset);
        $result = $this->db->get('orders');


        $store = $result->result_array();

        $this->load->model('products/productss');

	//var_dump($store);die;

		/*
		// разкомментируйте строки ниже, если файл не будет загружаться
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		*/
		//стандартный заголовок, которого обычно хватает
		header('Content-Type: text/x-csv; charset=utf-8');
		header("Content-Disposition: attachment;filename=".date("d-m-Y")."-orders.xls");

		$csv_output ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="Andrey" />
		<title>export</title>
		</head>
		<body>';
		$csv_output .='<table border="1">
	<tr>
		<th>#заказа</th>
		<th>Клиент</th>
		<th>Телефон</th>
		<th>E-MAIL</th>
		<th>Адрес доставки</th>
        <th>Товары</th>
        <th>Сумма</th>
        <th>Дата покупки</th>
        <th>Статус</th>
        <th>Статус оплаты</th>



	</tr>';
		foreach($store as $order){

            $paid = ($order['paid'])? 'Оплачено':'Не оплачено';
            $summ = 0;
            $order_content = '';

            $order_arr = unserialize (stripslashes($order['order_content']));

            if (is_array($order_arr) AND count($order_arr)>=1){

                foreach ($order_arr as $id_product => $content){

               $pr = $this->productss->get_one($id_product);
               $order_content .= $pr['product_title'] .'('.$pr['product_article'].')('. $content['count'] . 'шт.)('.$content['price'].currency.')<br>';
               $summ += $content['price'];
             }
           }


$csv_output .='
	<tr>
		<td style="text-align: center; font-weight:bold; font-size:large;">'.$order['order_id'].'</td>
		<td>'.$order['order_name'].'</td>
		<td>'.$order['order_phone'].'</td>
		<td>'.$order['order_email'].'</td>
		<td>'.$order['order_address'].'</td>

        <td>'.$order_content.'</td>

        <td style="text-align: center; color:green; font-weight:bold; font-size:large;">'.$summ.'</td>

        <td>'.$order['order_date_create'].'</td>
        <td>'.$order['status_name'].'</td>
        <td>'.$paid.'</td>


	</tr>';
		}
		$csv_output .= '</table>';
		$csv_output .='</body></html>';
		echo $csv_output;
	}



}//end class

?>
