<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('pages/' . $action),'role="form" class="form-horizontal" id="form_pages" parsley-validate'); ?>
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
                                 set_value('post_title',$pages['post_title'])
                           );             
                  ?>
                 <?php echo form_error('post_title');?>
                </div>
              </div> <!--/ Post Title -->
                          
               <div class="form-group">
                   <label for="post_description" class="col-sm-2 control-label">Описание <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'post_description',
                                 'id'           => 'post_description',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Post Description',
                                 
                                 ),
                                 set_value('post_description',$pages['post_description'])
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
                                 set_value('post_text',$pages['post_text'])
                           );             
                  ?>
                 <?php echo form_error('post_text');?>
                </div>
              </div> <!--/ Post Text -->

          <div class="form-group">
               <label for="post_status" class="col-sm-2 control-label">Ссылка</label>
            <div class="col-sm-6">

              <?php
                   echo form_input(
                                array(
                                 'name'         => 'post_url',
                                 'id'           => 'post_url',
                                 'class'        => 'form-control input-sm',
                                 'placeholder'  => 'Post URL',
                                 ($this->uri->segment(2)=='edit') ? 'disabled' : 'title'     => 'disabled',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('post_url',$pages['post_url'])
                           );
                  ?>
                 <?php echo form_error('post_title');?>
            </div>
          </div> <!--/  url -->
                         


			  <div class="form-group">
                   <label for="post_status" class="col-sm-2 control-label">Активен? <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                   <? if($this->uri->segment(2)=='edit') {?>
                   <select name="post_status" class="form-control input-sm  required" id="post_status" data-parsley-id="4">
						<option value="1" <?if (@$pages['post_status'] == 1) echo 'selected'?>>ДА</option>
						<option value="0" <?if (@$pages['post_status'] == 0) echo 'selected'?>>НЕТ</option>
					</select>
                   <?}else{?>
                     <select name="post_status" class="form-control input-sm  required" id="post_status" data-parsley-id="4">
						<option value="1" <? echo 'selected'?>>ДА</option>
						<option value="0">НЕТ</option>
					</select>
                    <?}?>
                
                 <?php echo form_error('post_status');?>
                </div>
              </div> <!--/  Activated -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('pages'); ?>" class="btn btn-default">
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
    CKEDITOR.replace('post_text');
</script>