<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('posts/' . $action),'role="form" class="form-horizontal" id="form_posts" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="post_title" class="col-sm-2 control-label">Заголовок <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'post_title',
                                 'id'           => 'post_title',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Post Title',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('post_title',$posts['post_title'])
                           );             
                  ?>
                 <?php echo form_error('post_title');?>
                </div>
              </div> <!--/ Post Title -->
                          
               <div class="form-group">
                   <label for="post_description" class="col-sm-2 control-label">Описание <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_textarea(
                                array(
                                 'name'         => 'post_description',
                                 'id'           => 'post_description',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Post Description',
                                 
                                 ),
                                 set_value('post_description',$posts['post_description'])
                           );             
                  ?>
                 <?php echo form_error('post_description');?>
                </div>
              </div> <!--/ Post Description -->
                          
               <div class="form-group">
                   <label for="post_text" class="col-sm-2 control-label">Текст <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_textarea(
                                array(
                                 'name'         => 'post_text',
                                 'id'           => 'post_text',                       
                                 'class'        => 'form-control input-sm',
                                 'placeholder'  => 'Post Text',
                                 
                                 ),
                                 set_value('post_text',$posts['post_text'])
                           );             
                  ?>
                 <?php echo form_error('post_text');?>
                </div>
              </div> <!--/ Post Text -->
			  
			  <div class="form-group">
                   <label for="post_status" class="col-sm-2 control-label">Активен? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                         
                   <select name="post_status" class="form-control input-sm  required" id="post_status" data-parsley-id="4">
						<option value="1" <?if (@$posts['post_status'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if (@$posts['post_status'] == 0) echo 'selected'?>>НЕТ</option>
					</select>
                   
                
                 <?php echo form_error('post_status');?>
                </div>
              </div> <!--/  Activated -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('posts'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>
<script src="<?echo base_url()?>additions/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('post_text');
</script>