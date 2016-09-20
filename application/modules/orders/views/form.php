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
                      ),
                      set_value('order_email',$orders['order_email'])
                  );
                  ?>
                  <?php echo form_error('order_email');?>
              </div>
          </div> <!--/ Order EMAIN -->
                          

                  <?php
                  $this->load->model('products/productss');
                  $products = $this->productss->get_all(1000,0);

                    $product = array('' => 'Выбрать продукт :');
                    foreach ($products as $pr){
                        $product[$pr['id_product']] = $pr['category_title'].' / '.$pr['product_title'];
                    }

            if($orders['order_content']){
                  $content = unserialize(stripslashes($orders['order_content']));
                    //var_dump($content);die;
               if(count($content)>0){
                  foreach ($content as $id_product => $content){?>

            <div id="<?=$id_product?>">
                <div class="form-group" >
                   <label for="order_content" class="col-sm-2 control-label">Товар
                       <a name="<?=$id_product?>" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="delete_product" data-original-title="Удалить"><i class="glyphicon glyphicon-trash"></i></a>
                                       
                   </label>
                <div class="col-sm-6 panel-footer" >
                   <?         echo form_dropdown(
                                'id_product_'.$id_product,
                                $product,
                                set_value('id_product',$id_product),
                                'class="form-control input-sm required "'
                            );
                   ?>
                    </div></div>
                <div class="form-group">
                   <label for="order_content" class="col-sm-2 control-label">Кол-во </label>
                <div class="col-sm-6 panel-footer">
                    <?  echo form_input(
                          array(
                              'name'         => 'count_'.$id_product,
                              'class'        => 'form-control input-sm  required',
                              'placeholder'  => 'Order count',
                              'maxlength'=>'2'
                          ),
                          set_value('count',$content['count'])
                      );
                    ?>
                 </div></div>
              <div class="form-group">
                   <label for="order_content" class="col-sm-2 control-label">Цена </label>
                <div class="col-sm-6 panel-footer">
                 <?     echo form_input(
                          array(
                              'name'         => 'price_'.$id_product,
                              'id'         => 'price_'.$id_product,
                              'class'        => 'form-control input-sm  required ',
                              'placeholder'  => 'Order price',
                              'maxlength'=>'100'
                          ),
                          set_value('price',$content['price'])
                      );
                ?>
                   </div></div>
                 <?     echo form_input(
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
                    ?></div><?
                  }
                }
              }
                  ?>
                 <?php echo form_error('order_content');?>

                <!--/ Order Content -->

               <div class="form-group" id="add_product">
                   <label for="delivery_id" class="col-sm-2 control-label">Добавить продукт</label>
                <div class="col-sm-6">
                    <a class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="add_product" data-original-title="Добавить"><i class="glyphicon glyphicon-plus"></i></a>

                   </div>
              </div>

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
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад </a>
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>

<!-- class product -->
             <div id="" class="product" style="display: none;">
               <div class="form-group" >
                  <label for="order_content" class="col-sm-2 control-label">Товар

                  </label>
               <div class="col-sm-6 panel-footer" >
                  <?         echo form_dropdown(
                               'id_product',
                               $product,
                               set_value('id_product',''),
                               'class="form-control input-sm"'
                           );
                  ?>
                   </div></div>
               <div class="form-group">
                  <label for="order_content" class="col-sm-2 control-label">Кол-во </label>
               <div class="col-sm-6 panel-footer">
                   <?  echo form_input(
                         array(
                             'name'         => 'count',
                             'class'        => 'form-control input-sm',
                             'placeholder'  => 'Order count',
                             'maxlength'=>'2'
                         ),
                         set_value('count',1)
                     );
                   ?>
                </div></div>
             <div class="form-group">
                  <label for="order_content" class="col-sm-2 control-label">Цена </label>
               <div class="col-sm-6 panel-footer">
                <?     echo form_input(
                         array(
                             'name'         => 'price',
                             'class'        => 'form-control input-sm',
                             'placeholder'  => 'Order price',
                             'maxlength'    =>'100'

                         ),
                         set_value('price','')
                     );
               ?>
                  </div></div>
                </div>
              <!-- //end class product -->


          <script>
              $(document).ready(function(){
                  /*
                глючить все...
                  */


                  //$('select[name^=id_product_]').change(function() {
                   $(document).on('change', 'select[name^=id_product_]', function() {

                      var arr = this.name.split('_');
                      var id = parseInt(arr[2]);
                      var new_id = $("option:selected",this).val();
                       
                       if($('div#'+new_id+'').length > 0){
                           alert('Уже есть такой товар!\nУстановите нужное количество.');
                                $('input[name=count_'+new_id+']').addClass("parsley-error").fadeOut("slow").fadeIn().focus();
                                     
                                       }else{



                      var dat = {
                          'id' :  $("option:selected",this).val()
                      };

                      $.ajax({
                          type     : 'POST',
                          url      : '/products/get_one/',
                          data     : dat,
                          cache    : false,

                          success: function(data){
                              //console.log(JSON.parse(data).product_price);

                              var product_price = JSON.parse(data).product_price;

                              alert('Вы поменяли продукт! \nПроверьте новую цену: '+product_price+'');
                              console.log(id);
                              $('input[name=price_'+id+']').val(product_price).addClass("parsley-success").fadeOut("slow").fadeIn().focus();



                          },
                          complete: function(){

                          },
                          beforeSend : function(){
                              //alert('Вы поменяли продукт, сейчас установится новая цена!');
                          },
                          error: function(xhr, textStatus, errorThrown){
                              console.log("status : " + errorThrown);
                          }
                      });
                   }
                  });

            // удалить продукт
                $('a[title=delete_product]').click(function() {
                    if(confirm('Удалить?')){
                        $('#'+this.name+'').remove();
                             $( "#form_orders" ).submit();
                        //window.location.replace("http://profhelp.com.ua");
                    }
                 });

             // добавить продукт, клонирует див с продуктов.
                  $('a[title=add_product]').click(function() {

                        $(".product").clone().insertBefore( "#add_product" ).css("display","block");

                        // еще надо добавить required class чтобы пустой продукт на добавился и убрать disabled
                              $("#form_orders .product").find("input,select,textarea").each(function () {
                                          $(this).addClass( "required" );
                              });
                        $("#form_orders .product").removeClass("product");
                   $(this).hide();

                 });


             // добавить новый продукт и просвоить им правеольные наймы
             
             $(document).on('change', 'select[name=id_product]', function() {

                 var id_product = $("option:selected",this).val();

                 if($('div#'+id_product+'').length > 0){
                     //console.log($('div#'+id_product+''));exit;
                     alert('Уже есть такой товар!\nУстановите нужное количество.');
                        $('input[name=count_'+id_product+']').addClass("parsley-error").fadeOut("slow").fadeIn().focus();
                            $(this).val('');
                 }else{

                 $(this).parent().parent().parent().attr('id', +id_product);

                 //console.log($(this).parent().parent().parent());
                 
                 //console.log($(this).val()); -- OK
                 //console.log($("option:selected",this).val()); --OK
                 //exit;

                 
                      var dat = {
                          'id' :  $("option:selected",this).val()
                      };

                      $.ajax({
                          type     : 'POST',
                          url      : '/products/get_one/',
                          data     : dat,
                          cache    : false,

                          success: function(data){
                              //console.log(JSON.parse(data).product_price);

                              var product_price = JSON.parse(data).product_price;



                              $('select[name=id_product]').attr('name', 'id_product_' + id_product);
                              $('input[name=count]').attr('name', 'count_' + id_product);
                              $('input[name=price]').attr('name', 'price_' + id_product);

                              $('input[name=price_'+id_product+']').val(product_price).addClass("parsley-success").fadeOut("slow").fadeIn().focus();

                               alert('Вы добавили продукт! \nУстановлена цена: '+product_price+'\nПроверьте цену..');


                                      
                          },
                          complete: function(){

                          },
                          beforeSend : function(){
                              //alert('Вы поменяли продукт, сейчас установится новая цена!');
                          },
                          error: function(xhr, textStatus, errorThrown){
                              console.log("status : " + errorThrown);
                          }
                      });
                    }
                  });//end 

              }); //JQuery

          </script>