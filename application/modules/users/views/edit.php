<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('users/' . $action),'role="form" class="form-horizontal" id="form_users" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="user_name" class="col-sm-2 control-label">Логин <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'user_name',
                                 'id'           => 'user_name',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'User Name',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('user_name',$users['user_name'])
                           );             
                  ?>
                 <?php echo form_error('user_name');?>
                </div>
              </div> <!--/ User Name -->
                          
               <div class="form-group">
                   <label for="user_email" class="col-sm-2 control-label">Email <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'user_email',
                                 'id'           => 'user_email',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'User Email',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('user_email',$users['user_email'])
                           );             
                  ?>
                 <?php echo form_error('user_email');?>
                </div>
              </div> <!--/ User Email -->

          <div class="form-group">
              <label for="user_password" class="col-sm-2 control-label">Новый пароль <span class="required-input"></span></label>
              <div class="col-sm-6">
                  <?php
                  echo form_input(
                      array(
                          'name'         => 'new_user_password',
                          'id'           => 'new_user_password',
                          'class'        => 'form-control input-sm',
                          'placeholder'  => 'NEW User password',
                          'maxlength'=>'255'
                      ),
                      set_value('new_user_password','')
                  );
                  ?>
                  <?php echo form_error('new_user_password');?>
              </div>
          </div> <!--/ User password -->
                          
               <div class="form-group">
                   <label for="user_activated" class="col-sm-2 control-label">Активен? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                         
                   <select name="user_activated" class="form-control input-sm  required" id="user_activated" data-parsley-id="4">
						<option value="1" <?if ($users['user_activated'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if ($users['user_activated'] == 0) echo 'selected'?>>НЕТ</option>
					</select>
                   
                
                 <?php echo form_error('user_activated');?>
                </div>
              </div> <!--/ User Activated -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('users'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  