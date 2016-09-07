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
                   <label for="order_address" class="col-sm-2 control-label">Адрес клиента <span class="required-input">*</span></label>
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
                   <label for="order_content" class="col-sm-2 control-label">Покупка <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php
                  $this->load->model('products/productss');
                  $products = $this->productss->get_all(1000,0);


                    foreach ($products as $pr){
                        $product[$pr['id_product']] = $pr['category_title'].'/'.$pr['product_title'];
                    }


                  $content = unserialize(stripslashes($orders['order_content']));
                    //var_dump($content);die;
                  foreach ($content as $id_product => $content){


                            echo form_dropdown(
                                'id_product_'.$id_product,
                                $product,
                                set_value('id_product',$id_product),
                                'class="form-control input-sm" id='.$id_product.''
                            );

                      echo form_input(
                          array(
                              'name'         => 'count_'.$id_product,
                              'class'        => 'form-control input-sm  required',
                              'placeholder'  => 'Order count',
                              'maxlength'=>'2'
                          ),
                          set_value('count',$content['count'])
                      );

                      echo form_input(
                          array(
                              'name'         => 'price_'.$id_product,
                              'id'         => 'price_'.$id_product,
                              'class'        => 'form-control input-sm  required',
                              'placeholder'  => 'Order price',
                              'maxlength'=>'100'
                          ),
                          set_value('price',$content['price'])
                      );

                      echo form_input(
                          array(
                              'name'         => 'name_product_'.$id_product,
                              'class'        => 'form-control input-sm',
                              'type'  => 'hidden',
                              'maxlength'=>'100'
                          ),
                          set_value('name_product',$content['name'])
                      );

                      echo form_input(
                          array(
                              'name'         => 'img_'.$id_product,
                              'class'        => 'form-control input-sm',
                              'type'  => 'hidden',
                              'maxlength'=>'100'
                          ),
                          set_value('img',$content['img'])
                      );

                  }

                  ?>
                 <?php echo form_error('order_content');?>
                </div>
              </div> <!--/ Order Content -->
          <script>
              $(document).ready(function(){

                  $('select[name^=id_product_]').on('change', function(event) {
                      event.preventDefault();

                      var id = $('#'+this.id+' option:selected').val();

                      var data = {
                          'id' :  id
                      };

                      $.ajax({
                          type     : 'POST',
                          url      : '/products/get_one/',
                          data     : data,
                          cache    : false,
                          async    : false,

                          success: function(data){
                              //window.location.reload();
                              //console.log(JSON.parse(data));
                              product_price = JSON.parse(data).product_price;
                              alert(product_price);
                              $('input[id=price_+id+]').
                          },
                          complete: function(){
                              $("#loader").hide();
                          },
                          beforeSend : function(){
                              alert('Вы поменяли продукт, сейчас установится новая цена!');
                          },
                          error: function(xhr, textStatus, errorThrown){
                              console.log("status : " + errorThrown);
                          }
                      });

                  });
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