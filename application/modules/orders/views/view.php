<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
                <?php
                                  echo anchor(
                                           site_url('orders/add'),
                                            '<i class="glyphicon glyphicon-plus"></i>',
                                            'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('add').'"'
                                          );
                 ?>
                
            </div>
            <div class="col-md-4 col-xs-9">
                                           
                 <?php echo form_open(site_url('orders/search'), 'role="search" class="form"') ;?>       
                           <div class="input-group pull-right">                      
                                 <input type="text" class="form-control input-sm" placeholder="введите данные для поиска" name="q" autocomplete="off"> 
                                 <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Поиск</button>
                                 </span>
                           </div>
                           
               </form> 
                <?php echo form_close(); ?>
            </div>
        </div>
    </header>
    
    
    <div class="panel-body">
         <?php if ($orderss) : ?>
          <table class="table table-hover table-condensed">
              
            <thead>
              <tr>
                <th class="header">#</th>
                
                    <th>ФИО клиента</th>   
                
                    <th>Телефон клиента</th>
                    <th>E-mail клиента</th>
					
                
                    <th>Адрес доставки</th>   
                
                    <th>Товары</th>   
                
                    <th>Дата покупки</th>   
                

                
                    <th>Статус заявки</th>   
                
                    <th>Вид доставки</th>   
                
                    <th>Вид оплаты</th>   
                
                    <th>Оплачено?</th>   
                
                <th class="red header" align="right" width="120">Опции</th>
              </tr>
            </thead>
            
            
            <tbody>
             
               <?php foreach ($orderss as $orders) : ?>
              <tr>
              	<td><?php echo $number++;; ?> </td>
               
               <td><?php echo $orders['order_name']; ?></td>
               
               <td><?php echo $orders['order_phone']; ?></td>
			   <td><?php echo $orders['order_email']; ?></td>
			   
               <td><?php echo $orders['order_address']; ?></td>
			   
               <td><?php

                   $content = unserialize(stripslashes($orders['order_content']));
                      foreach ($content as $id_product => $product_) {

                          $this->load->model('products/productss');
                          $product = $this->productss->get_one($id_product);
                        //var_dump($product);
                        echo '<img src="/images/products/thumbs/'.$product['product_image_front'].'"><br>';
                        echo $product['product_title'] .' ('.$product_['count'].' шт. &#8727; '. $product_['price'] .' = <b>'.$product_['total']. currency . '</b>)'.'<hr>';

                      }

			   ?></td>
               
               
               
               <td><?php echo $orders['order_date_create']; ?></td>
               
               
               <td><div class="btn" style="background-color: <?=$orders['status_color']?>; color: #fff;"><b><?php echo $orders['status_name']; ?></b></div></td>
               
               <td><?php echo $orders['delivery_name']; ?></td>
               
               <td><?php echo $orders['payment_name']; ?></td>
               
               <td><?if ($orders['paid'] == 1) {echo 'ДА';}else{echo 'НЕТ';}?></td>
               
                <td>    
                    
                    <?php
                                  echo anchor(
                                          site_url('orders/show/' . $orders['order_id']),
                                            '<i class="glyphicon glyphicon-eye-open"></i>',
                                            'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('view').'"'
                                          );
                   ?>
                    
                    <?php
                                  echo anchor(
                                          site_url('orders/edit/' . $orders['order_id']),
                                            '<i class="glyphicon glyphicon-edit"></i>',
                                            'class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('edit').'"'
                                          );
                   ?>
                   
                   <?php
                                  echo anchor(
                                          site_url('orders/destroy/' . $orders['order_id']),
                                            '<i class="glyphicon glyphicon-trash"></i>',
                                            'onclick="return confirm(\''.$this->lang->line('delete').'?\');" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('delete').'"'
                                          );
                   ?>   
                                 
                </td>
              </tr>     
               <?php endforeach; ?>
            </tbody>
          </table>
          <?php else: ?>
                <?php  echo notify('Нет данных для показа','info');?>
          <?php endif; ?>
    </div>
    
    
    <div class="panel-footer">
        <div class="row">
           <div class="col-md-3">
               Всего
               <span class="label label-info">
                    <?php echo $total; ?>
               </span>
           </div>  
           <div class="col-md-9">
                 <?php echo $pagination; ?>
           </div>
        </div>
    </div>
</section>