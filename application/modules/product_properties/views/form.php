<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open_multipart(site_url('product_properties/' . $action),'role="form" class="form-horizontal" id="form_product_properties" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="property_id" class="col-sm-2 control-label">Property <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'property_id',
                                 'id'           => 'property_id',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Property',
                                 'maxlength'=>'11'
                                 ),
                                 set_value('property_id',$product_properties['property_id'])
                           );             
                  ?>
                 <?php echo form_error('property_id');?>
                </div>
              </div> <!--/ Property -->
                          
               <div class="form-group">
                   <label for="product_id" class="col-sm-2 control-label">Product <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'product_id',
                                 'id'           => 'product_id',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Product',
                                 'maxlength'=>'11'
                                 ),
                                 set_value('product_id',$product_properties['product_id'])
                           );             
                  ?>
                 <?php echo form_error('product_id');?>
                </div>
              </div> <!--/ Product -->
                          
               <div class="form-group">
                   <label for="title" class="col-sm-2 control-label">Title <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_upload(
                                array(
                                 'name'         => 'userfile',
                                 'id'           => 'title',                       
                                 'style'        => 'left: -182.667px; top: 20px;', 
                                 'title'         => '������� File.....'
                                 )
                                
                           );             
                  ?>
                 <?php echo form_error('title');?>
                </div>
              </div> <!--/ Title -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('product_properties'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  