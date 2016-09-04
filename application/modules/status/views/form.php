<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('status/' . $action),'role="form" class="form-horizontal" id="form_status" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="status_name" class="col-sm-2 control-label">Status Name <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'status_name',
                                 'id'           => 'status_name',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Status Name',
                                 'maxlength'=>'150'
                                 ),
                                 set_value('status_name',$status['status_name'])
                           );             
                  ?>
                 <?php echo form_error('status_name');?>
                </div>
              </div> <!--/ Status Name -->
                          
               <div class="form-group">
                   <label for="status_color" class="col-sm-2 control-label">Status Color</label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'status_color',
                                 'id'           => 'status_color',                       
                                 'class'        => 'form-control input-sm ',
                                 'placeholder'  => 'Status Color',
                                 'maxlength'=>'100'
                                 ),
                                 set_value('status_color',$status['status_color'])
                           );             
                  ?>
                 <?php echo form_error('status_color');?>
                </div>
              </div> <!--/ Status Color -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('status'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  