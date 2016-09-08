<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('orders/' . $action),'role="form" class="form-horizontal" id="form_orders" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="order_name" class="col-sm-2 control-label">ФИО клиента <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'order_name',
                                 'id'           => 'order_name',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Order Name',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('order_name',$orders['order_name'])
                           );             
                  ?>
                 <?php echo form_error('order_name');?>
                </div>
              </div> <!--/ Order Name -->
                          
               <div class="form-group">
                   <label for="order_phone" class="col-sm-2 control-label">Телефон клиента <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'order_phone',
                                 'id'           => 'order_phone',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Order Phone',
                                 'maxlength'=>'150'
                                 ),
                                 set_value('order_phone',$orders['order_phone'])
                           );             
                  ?>
                 <?php echo form_error('order_phone');?>
                </div>
              </div> <!--/ Order Phone -->
                          
               <div class="form-group">
              <label for="order_address" class="col-sm-2 control-label">Адрес доставки <span class="required-input">*</span></label>
              <div class="col-sm-6">
                  <?php
                  echo form_input(
                      array(
                          'name'         => 'order_address',
                          'id'           => 'order_address',
                          'class'        => 'form-control input-sm  required',
                          'placeholder'  => 'Order Address',
                          'maxlength'=>'255'
                      ),
                      set_value('order_address',$orders['order_address'])
                  );
                  ?>
                  <?php echo form_error('order_address');?>
              </div>
          </div> <!--/ Order Address -->

          <div class="form-group">
              <label for="order_email" class="col-sm-2 control-label">Email клиента <span class="required-input">*</span></label>
              <div class="col-sm-6">
                  <?php
                  echo form_input(
                      array(
                          'name'         => 'order_email',
                          'id'           => 'order_email',
                          'class'        => 'form-control input-sm  required',
                          'placeholder'  => 'Order Email',
                          'maxlength'=>'255'
                      )
                  );
                  ?>
                  <?php echo form_error('order_email');?>
              </div>
          </div> <!--/ Order EMAIN -->
                          
               <div class="form-group">
                   <label for="order_content" class="col-sm-2 control-label">Покупка <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php
                  $this->load->model('products/productss');
                  $products = $this->productss->get_all(1000,0);

                  $product = array('' => 'Выбрать');
                    foreach ($products as $pr){
                        $product[$pr['id_product']] = $pr['category_title'].'/'.$pr['product_title'];
                    }



                      echo form_dropdown(
                                'id_product',
                                $product,

                                'class="form-control input-sm required"'
                            );
                      echo form_input(
                          array(
                              'name'         => 'count',
                              'class'        => 'form-control input-sm  required',
                              'placeholder'  => 'Order count',
                              'maxlength'=>'2'
                          )

                      );

                      echo form_input(
                          array(
                              'name'         => 'price',
                              'id'         => 'price',
                              'class'        => 'form-control input-sm  required',
                              'placeholder'  => 'Order price',
                              'maxlength'=>'100'
                          )

                      );

                      echo form_input(
                          array(
                              'name'         => 'name_product',
                              'class'        => 'form-control input-sm',
                              'type'  => 'hidden',
                              'maxlength'=>'100'
                          )

                      );

                      echo form_input(
                          array(
                              'name'         => 'img',
                              'class'        => 'form-control input-sm',
                              'type'  => 'hidden',
                              'maxlength'=>'100'
                          )

                      );



                  ?>
                 <?php echo form_error('order_content');?>
                </div>
              </div> <!--/ Order Content -->
          <script>
              $(document).ready(function(){


              });
          </script>
               <div class="form-group">
                   <label for="delivery_id" class="col-sm-2 control-label">Вид доставки</label>
                <div class="col-sm-6">                                   
                  <?php    //var_dump($delivery_method);die;
                   echo form_dropdown(
                           'delivery_id',
                           $delivery_method,  
                           set_value('delivery_id',$orders['delivery_id']),
                           'class="form-control input-sm "  id="delivery_id"'
                           );             
                  ?>
                 <?php echo form_error('delivery_id');?>
                </div>
              </div> <!--/ Delivery -->
                          
               <div class="form-group">
                   <label for="payment_id" class="col-sm-2 control-label">Вид оплаты</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_dropdown(
                           'payment_id',
                           $payment_method,  
                           set_value('payment_id',$orders['payment_id']),
                           'class="form-control input-sm "  id="payment_id"'
                           );             
                  ?>
                 <?php echo form_error('payment_id');?>
                </div>
              </div> <!--/ Payment -->
			  
			   <div class="form-group">
                   <label for="payment_id" class="col-sm-2 control-label">Статус заявки</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_dropdown(
                           'status_id',
                           $status,  
                           set_value('status_id',$orders['status_id']?:1),
                           'class="form-control input-sm "  id="status_id"'
                           );             
                  ?>
                 <?php echo form_error('status_id');?>
                </div>
              </div> <!--/ status -->
                          
			  
                          
               <div class="form-group">
                   <label for="paid" class="col-sm-2 control-label">Оплачено?</label>
                <div class="col-sm-6">                                   

				  
				  <select name="paid" class="form-control input-sm  required" id="paid" data-parsley-id="4">
						<option value="1" <?if ($orders['paid'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if ($orders['paid'] == 0) echo 'selected'?>>НЕТ</option>
					</select>
				  
                 <?php echo form_error('paid');?>
                </div>
              </div> <!--/ Paid -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('orders'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  