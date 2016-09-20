<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->
<?//var_dump($products);die;?>
<?php echo form_open_multipart(site_url('products/' . $action),'role="form" class="form-horizontal" id="form_products" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">

      <div class="form-group">
                   <label for="product_article" class="col-sm-2 control-label">Артикул <span class="required-input">*</span></label>
                <div class="col-sm-6">
                  <?php
                   echo form_input(
                                array(
                                 'name'         => 'product_article',
                                 'id'           => 'product_article',
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Product article',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_article','')
                           );
                  ?>
                 <?php echo form_error('product_article');?>
                </div>
              </div> <!--/ Product article -->
         
                       
               <div class="form-group">
                   <label for="category_id" class="col-sm-2 control-label">Категория <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                
                   echo form_dropdown(
                           'category_id',
                           $categories,  
                           set_value('category_id',$products['category_id']),
                           'class="form-control input-sm  required"  id="category_id"'
                           );             
                  ?>
                 <?php echo form_error('category_id');?>
                </div>
              </div> <!--/ Category -->
                          
               <div class="form-group">
                   <label for="product_title" class="col-sm-2 control-label">Название <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_title',
                                 'id'           => 'product_title',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Product Title',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_title',$products['product_title'])
                           );             
                  ?>
                 <?php echo form_error('product_title');?>
                </div>
              </div> <!--/ Product Title -->
                          
               <div class="form-group">
                   <label for="product_description" class="col-sm-2 control-label">Описание <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_textarea(
                                array(
                                 'name'         => 'product_description',
                                 'id'           => 'product_description',                       
                                 'class'        => 'form-control input-sm',
                                 'placeholder'  => 'Product Description',
                                 
                                 ),
                                 set_value('product_description',$products['product_description'])
                           );             
                  ?>
                 <?php echo form_error('product_description');?>
                </div>
              </div> <!--/ Product Description -->
                          
               <div class="form-group">
                   <label for="product_price" class="col-sm-2 control-label">Цена <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_price',
                                 'id'           => 'product_price',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Product Price',
                                 
                                 ),
                                 set_value('product_price',$products['product_price'])
                           );             
                  ?>
                 <?php echo form_error('product_price');?>
                </div>
              </div> <!--/ Product Price -->
                          
               <div class="form-group">
                   <label for="product_action_price" class="col-sm-2 control-label">Акционная цена <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_action_price',
                                 'id'           => 'product_action_price',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Product Action Price',
                                 
                                 ),
                                 set_value('product_action_price',$products['product_action_price'])
                           );             
                  ?>
                 <?php echo form_error('product_action_price');?>
                </div>
              </div> <!--/ Product Action Price -->

             <div class="form-group">
                   <label for="product_trade_price" class="col-sm-2 control-label">Оптовая цена <span class="required-input">*</span></label>
                <div class="col-sm-6">
                  <?php
                   echo form_input(
                                array(
                                 'name'         => 'product_trade_price',
                                 'id'           => 'product_trade_price',
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Product Trade Price',

                                 ),
                                 set_value('product_trade_price','')
                           );
                  ?>
                 <?php echo form_error('product_trade_price');?>
                </div>
              </div> <!--/ Product Trade Price -->
                          
               <div class="form-group">
                   <label for="product_status" class="col-sm-2 control-label">Акция? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   

				  
				  <select name="product_status" class="form-control input-sm  required" id="product_status" data-parsley-id="4">
						<option value="1">ДА</option>
						<option value="0" selected >НЕТ</option>
					</select>
				  
                 <?php echo form_error('product_status');?>
                </div>
              </div> <!--/ Product Status -->
                          
               <div class="form-group">
                   <label for="product_active" class="col-sm-2 control-label">Активный? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                     

				  
				   <select name="product_active" class="form-control input-sm  required" id="product_active" data-parsley-id="4">
						<option value="1" selected>ДА</option>
						<option value="0">НЕТ</option>
					</select>
				  
                 <?php echo form_error('product_active');?>
                </div>
              </div> <!--/ Product Active -->
                          
               <div class="form-group">
                   <label for="product_properties" class="col-sm-2 control-label">Свойства <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
               
			   if ($products['product_properties']) { //var_dump($products['product_properties']);die;
						$product_properties = unserialize ($products['product_properties']);
						//var_dump($product_properties);die;
					foreach ($properties as $id => $value) {?>
				
					<input type="checkbox" name="product_properties[<?=$id?>]" <?if (@array_key_exists($id, $product_properties)) echo 'checked'?>/><?=$value?>
					<input <?if (@array_key_exists($id, $product_properties)) {echo 'value="'.$product_properties[$id].'"';} else {?>style="display:none;" disabled="disabled"<?}?> type="text" name="properties_value[<?=$id?>]" class="form-control input-sm" placeholder="Введите '<?=$value?>'" data-parsley-id="4"/><br>
					
				<?}	
						
			   }else{
			   
			
				foreach ($properties as $id => $value) {?>
				
					<input type="checkbox" name="product_properties[<?=$id?>]" /><?=$value?>
					<input style="display:none;" disabled="disabled" type="text" name="properties_value[<?=$id?>]" class="form-control input-sm" placeholder="Введите '<?=$value?>'" data-parsley-id="4"/><br>
					
				<?}}?>
				  
				  <script>
				$(document).ready(function(){  
				  $('input[name^=product_properties]').click(function(){
				  
						if ( $( this ).prop( "checked" ) ) {
						
							$(this).next().show();
							$(this).next().prop( "disabled", false );
						
						}else{
							$(this).next().hide();
							$(this).next().prop( "disabled", true );
						
						}
				  
				  });
				  
				 $('input[name^=delete_]').on('click', function(event) {
					event.preventDefault();

					var data = {
						'id' : this.id,
						'img' : this.name.substr(7)
					};
					
							$.ajax({
								type     : 'POST',
								url      : '/products/delete_img/',
								data     : data,
								cache    : false,
								async    : false,

								success: function(data){                       
									window.location.reload();
								},
								complete: function(){
									$("#loader").hide();
							   },
							   beforeSend : function(){
									$("#loader").show();
							   },
								error: function(xhr, textStatus, errorThrown){
									 console.log("status : " + errorThrown);
								}
							});
							
					});
				});	
				  </script>
				  
                 <?php echo form_error('product_properties');?>
				   <?php echo form_error('product_properties_value');?>
                </div>
              </div> <!--/ Product Properties -->
          <!-- test uploads

          <div class="form-group">

              <label>Image : </label>
              <input type="file" multiple="" name="images[]">

          </div>

          <!--/ end test uploads -->


               <div class="form-group">
                   <label for="product_image_front" class="col-sm-2 control-label">Главная картинка
				   
				   <?if ($products["product_image_front"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_front"]);?>">
				<?
				
				echo form_input(
                                array(
                                 'name'         => 'delete_product_image_front',
                                 'id'           => $products["id_product"],
								 'value' 		=> 'Удалить',		
                                 'class'        => 'btn btn-sm btn-danger',
                                 'type'  		=> 'button'
                                 
									)
                                );  
				}
				?>
				
				   
				   <span class="required-input">*</span></label>
                <div class="col-sm-6">
				
				
				
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_front',                     
                                 'style'        => $products["product_image_front"]? 'margin-top: 4em;':'margin-top: 0.5em;',
                                 'value'         => 'Выбрать File',
								 'class'		=> '',
								 'type'  		=> 'button'
                                 )
                                
                           );
				
                  ?>
				  
				  
				  
				  
                 <?php echo form_error('product_image_front');?>
                </div>
              </div> <!--/ Product Image Front -->
                          
               <div class="form-group">
                   <label for="product_image_1" class="col-sm-2 control-label">Image 1
				   
				   <?if ($products["product_image_1"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_1"]);?>">
				<?
				
				echo form_input(
                                array(
                                 'name'         => 'delete_product_image_1',
                                 'id'           => $products["id_product"],
								 'value' 		=> 'Удалить',		
                                 'class'        => 'btn btn-sm btn-danger',
                                 'type'  		=> 'button'
                                 
									)
                                );
				$style = 'margin-top: 4em;';					
				}
				?>
				   
				   </label>
                <div class="col-sm-6">                                   
                 
				 
				
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_1',
                                 'id'           => 'product_image_1',                       
                                 'style'        => $products["product_image_1"]? 'margin-top: 4em;':'margin-top: 0.5em;', 
                                 'title'         => 'Выбрать File.....'
                                 )
                                
                           );             
                  ?>
				 
                 <?php echo form_error('product_image_1');?>
                </div>
              </div> <!--/ Product Image 1 -->
                          
               <div class="form-group">
                   <label for="product_image_2" class="col-sm-2 control-label">Image 2
				   
				    <?if ($products["product_image_2"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_2"]);?>">
				<?
				
				echo form_input(
                                array(
                                 'name'         => 'delete_product_image_2',
                                 'id'           => $products["id_product"],
								 'value' 		=> 'Удалить',		
                                 'class'        => 'btn btn-sm btn-danger',
                                 'type'  		=> 'button'
                                 
									)
                                );
								
				}
				?>
				   
				   </label>
                <div class="col-sm-6">                                   
                 
				 
				 
				
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_2',
                                 'id'           => 'product_image_2',                       
                                 'style'        => $products["product_image_2"]? 'margin-top: 4em;':'margin-top: 0.5em;',
                                 'title'         => 'Выбрать File.....'
                                 )
                                
                           );             
                  ?>
				 
                 <?php echo form_error('product_image_2');?>
                </div>
              </div> <!--/ Product Image 2 -->
                          
               <div class="form-group">
                   <label for="product_image_3" class="col-sm-2 control-label">Image 3
				   
				   <?if ($products["product_image_3"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_3"]);?>">
				<?
				
				echo form_input(
                                array(
                                 'name'         => 'delete_product_image_3',
                                 'id'           => $products["id_product"],
								 'value' 		=> 'Удалить',		
                                 'class'        => 'btn btn-sm btn-danger',
                                 'type'  		=> 'button'
                                 
									)
                                ); 
								
				}
				?>
				   
				   </label>
                <div class="col-sm-6">                                   
                
				  
				
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_3',
                                 'id'           => 'product_image_3',                       
                                 'style'        => $products["product_image_3"]? 'margin-top: 4em;':'margin-top: 0.5em;', 
                                 'title'         => 'Выбрать File.....'
                                 )
                                
                           );             
                  ?>
				
                 <?php echo form_error('product_image_3');?>
                </div>
              </div> <!--/ Product Image 3 -->
                          
               <div class="form-group">
                   <label for="product_image_4" class="col-sm-2 control-label">Image 4
				   
				    <?if ($products["product_image_4"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_4"]);?>">
				<?
				
				echo form_input(
                                array(
                                 'name'         => 'delete_product_image_4',
                                 'id'           => $products["id_product"],
								 'value' 		=> 'Удалить',		
                                 'class'        => 'btn btn-sm btn-danger',
                                 'type'  		=> 'button'
                                 
									)
                                ); 
				$style = 'margin-top: 4em;';					
				}
				?>
				
				   
				   </label>
                <div class="col-sm-6">                                   
                  
				  
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_4',
                                 'id'           => 'product_image_4',                       
                                 'style'        => $products["product_image_4"]? 'margin-top: 4em;':'margin-top: 0.5em;', 
                                 'title'         => 'Выбрать File.....'
                                 )
                                
                           );             
                  ?>
				
				  
                 <?php echo form_error('product_image_4');?>
                </div>
              </div> <!--/ Product Image 4 -->
                          
               <div class="form-group">
                   <label for="product_image_5" class="col-sm-2 control-label">Image 5
				   
				    <?if ($products["product_image_5"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_5"]);?>">
				<?
				
				echo form_input(
                                array(
                                 'name'         => 'delete_product_image_5',
                                 'id'           => $products["id_product"],
								 'value' 		=> 'Удалить',		
                                 'class'        => 'btn btn-sm btn-danger',
                                 'type'  		=> 'button'
                                 
									)
                                ); 
				$style = 'margin-top: 4em;';					
				}
				?>
				
				   
				   </label>
                <div class="col-sm-6">                                   
                 
				 
				
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_5',
                                 'id'           => 'product_image_5',                       
                                 'style'        => $products["product_image_5"]? 'margin-top: 4em;':'margin-top: 0.5em;',  
                                 'title'         => 'Выбрать File.....'
                                 )
                                
                           );             
                  ?>
				 
                 <?php echo form_error('product_image_5');?>
                </div>
              </div> <!--/ Product Image 5 -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('products'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>
<script src="<?echo base_url()?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('product_description');
</script>