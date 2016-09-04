<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('payment_method/' . $action),'role="form" class="form-horizontal" id="form_payment_method" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="payment_name" class="col-sm-2 control-label">Название <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'payment_name',
                                 'id'           => 'payment_name',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Payment Name',
                                 'maxlength'=>'150'
                                 ),
                                 set_value('payment_name',$payment_method['payment_name'])
                           );             
                  ?>
                 <?php echo form_error('payment_name');?>
                </div>
              </div> <!--/ Payment Name -->
                          
               <div class="form-group">
                   <label for="is_active" class="col-sm-2 control-label">Активно <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  
				  <select name="is_active" class="form-control input-sm  required" id="is_active" data-parsley-id="4">
						<option value="1" <?if ($payment_method['is_active'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if ($payment_method['is_active'] == 0) echo 'selected'?>>НЕТ</option>
					</select>
				  
                 <?php echo form_error('is_active');?>
                </div>
              </div> <!--/ Is Active -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('payment_method'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  