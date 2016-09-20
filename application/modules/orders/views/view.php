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
            <div class="col-md-1 col-xs-3">
                <?php
                                  echo anchor(
                                           site_url('orders/add'),
                                            '<i class="glyphicon glyphicon-plus"></i>',
                                            'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('add').'"'
                                          );
                 ?>
                
            </div>

            <div class="col-md-4 col-xs-9">

                 <?php echo form_open(site_url('orders/filter'), 'role="filter" class="form"') ;?>
                 <?php $filter = array(''=>'Выбрать фильтр :', 1=>'Сегодня',2=>'Вчера',3=>'Неделя',4=>'Месяц');?>
                <div class="input-group pull-right">
                    <?
                     echo form_dropdown(
                               'filter',
                               $filter,
                               set_value('filter', $this->session->userdata('filter') ),
                               'class="form-control input-sm"'
                               );
                    ?>
                    <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Показать</button>
                                 </span>
                </div><!--
                           <div class="input-group pull-right">
                               <select name="filter" class="form-control input-sm " id="filter">
                                    <option value="">Выбрать фильтр :</option>
                                    <option value="1">Сегодня</option>
                                    <option value="2">Вчера</option>
                                    <option value="3">Неделя</option>
                                    <option value="4">Месяц</option>
                                </select>
                               <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Показать</button>
                                 </span>
                           </div>
                -->
               </form>
                <?php echo form_close(); ?>
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
                    <th>Сумма</th>
                
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
              	<td><?php echo $orders['order_id'] ?> </td>
               
               <td><?php echo $orders['order_name']; ?></td>
               
               <td><?php echo $orders['order_phone']; ?></td>
			   <td><?php echo $orders['order_email']; ?></td>
			   
               <td><?php echo $orders['order_address']; ?></td>
			   
               <td><?php

                $summ = 0;
                if ($orders['order_content']){
                   $content = unserialize(stripslashes($orders['order_content']));

                      if(count($content)>0){
                      foreach ($content as $id_product => $product_) {

                          $this->load->model('products/productss');
                          $product = $this->productss->get_one($id_product);
                        //var_dump($product);
                        echo '<a href="'.base_url().'product/'.$id_product.'" target="_blank">Артикул: <b>'. $id_product.'</b><br>';
                        echo $product['product_title'].'<br>';
                        echo '<img src="'.base_url().'/images/products/thumbs/'.$product['product_image_front'].'"><br>';
                        echo  $product_['count'].' шт. &#8727; '. $product_['price'] .' = <b>'.$product_['total']. currency . '</b></a>'.'<hr>';

                        $summ += $product_['total'];
                      }
                   }
                }
			   ?></td>
               
               
                <td><?php  echo '<h2><span class="label label-success">'. $summ . '</span></h2>'. currency;?></td>
               <td><?php echo $orders['order_date_create']; ?></td>
               
               
               <td><div class="btn" style="background-color: <?=$orders['status_color']?>; color: #fff;"><b><?php echo $orders['status_name']; ?></b></div></td>
               
               <td><?php echo $orders['delivery_name']; ?></td>
               
               <td><?php echo $orders['payment_name']; ?></td>
               
               <td><?if ($orders['paid'] == 1) {echo 'ДА';}else{echo 'НЕТ';}?></td>
               
                <td>    
                    
                    <?php
                    /*
                                  echo anchor(
                                          site_url('orders/show/' . $orders['order_id']),
                                            '<i class="glyphicon glyphicon-eye-open"></i>',
                                            'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('view').'"'
                                          );
                    */
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