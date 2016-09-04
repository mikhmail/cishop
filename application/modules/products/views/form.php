<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open_multipart(site_url('products/' . $action),'role="form" class="form-horizontal" id="form_products" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
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
                   echo form_input(
                                array(
                                 'name'         => 'product_description',
                                 'id'           => 'product_description',                       
                                 'class'        => 'form-control input-sm  required',
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
                   <label for="product_status" class="col-sm-2 control-label">Акция? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   

				  
				  <select name="product_status" class="form-control input-sm  required" id="product_status" data-parsley-id="4">
						<option value="1" <?if ($products['product_status'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if ($products['product_status'] == 0) echo 'selected'?>>НЕТ</option>
					</select>
				  
                 <?php echo form_error('product_status');?>
                </div>
              </div> <!--/ Product Status -->
                          
               <div class="form-group">
                   <label for="product_active" class="col-sm-2 control-label">Активный? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                     

				  
				   <select name="product_active" class="form-control input-sm  required" id="product_active" data-parsley-id="4">
						<option value="1" <?if ($products['product_active'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if ($products['product_active'] == 0) echo 'selected'?>>НЕТ</option>
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
				  $('input[name^=product_properties]').click(function(){
				  
						if ( $( this ).prop( "checked" ) ) {
						
							$(this).next().show();
							$(this).next().prop( "disabled", false );
						
						}else{
							$(this).next().hide();
							$(this).next().prop( "disabled", true );
						
						}
				  
				  });
				  </script>
				  
                 <?php echo form_error('product_properties');?>
				   <?php echo form_error('product_properties_value');?>
                </div>
              </div> <!--/ Product Properties -->
                          
               <div class="form-group">
                   <label for="product_image_front" class="col-sm-2 control-label">Главная картинка <span class="required-input">*</span></label>
                <div class="col-sm-6">
				
				<?if ($products["product_image_front"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_front"]);?>">
				<?}?>
				
                  <?php 

					echo form_upload(
                                array(
                                 'name'         => 'product_image_front',
                                 'id'           => 'product_image_front',                       
                                 'style'        => 'left: -182.667px; top: 20px;', 
                                 'title'         => 'Выбрать File.....'
                                 )
                                
                           );             
                  ?>
				  
				  
				  
                 <?php echo form_error('product_image_front');?>
                </div>
              </div> <!--/ Product Image Front -->
                          
               <div class="form-group">
                   <label for="product_image_1" class="col-sm-2 control-label">Image 1</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_image_1',
                                 'id'           => 'product_image_1',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Product Image 1',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_image_1',$products['product_image_1'])
                           );             
                  ?>
                 <?php echo form_error('product_image_1');?>
                </div>
              </div> <!--/ Product Image 1 -->
                          
               <div class="form-group">
                   <label for="product_image_2" class="col-sm-2 control-label">Image 2</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_image_2',
                                 'id'           => 'product_image_2',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Product Image 2',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_image_2',$products['product_image_2'])
                           );             
                  ?>
                 <?php echo form_error('product_image_2');?>
                </div>
              </div> <!--/ Product Image 2 -->
                          
               <div class="form-group">
                   <label for="product_image_3" class="col-sm-2 control-label">Image 3</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_image_3',
                                 'id'           => 'product_image_3',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Product Image 3',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_image_3',$products['product_image_3'])
                           );             
                  ?>
                 <?php echo form_error('product_image_3');?>
                </div>
              </div> <!--/ Product Image 3 -->
                          
               <div class="form-group">
                   <label for="product_image_4" class="col-sm-2 control-label">Image 4</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_image_4',
                                 'id'           => 'product_image_4',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Product Image 4',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_image_4',$products['product_image_4'])
                           );             
                  ?>
                 <?php echo form_error('product_image_4');?>
                </div>
              </div> <!--/ Product Image 4 -->
                          
               <div class="form-group">
                   <label for="product_image_5" class="col-sm-2 control-label">Image 5</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_image_5',
                                 'id'           => 'product_image_5',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Product Image 5',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('product_image_5',$products['product_image_5'])
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