<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('catalog/' . $action),'role="form" class="form-horizontal" id="form_catalog" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="catalog_title" class="col-sm-2 control-label">Название <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'catalog_title',
                                 'id'           => 'catalog_title',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Catalog Title',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('catalog_title',$catalog['catalog_title'])
                           );             
                  ?>
                 <?php echo form_error('catalog_title');?>
                </div>
              </div> <!--/ Catalog Title -->
                          
               <div class="form-group">
                   <label for="catalog_seo_description" class="col-sm-2 control-label">Catalog Seo Description <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'catalog_seo_description',
                                 'id'           => 'catalog_seo_description',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Catalog Seo Description',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('catalog_seo_description',$catalog['catalog_seo_description'])
                           );             
                  ?>
                 <?php echo form_error('catalog_seo_description');?>
                </div>
              </div> <!--/ Catalog Seo Description -->
                          
               <div class="form-group">
                   <label for="catalog_seo_keywords" class="col-sm-2 control-label">Catalog Seo Keywords <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'catalog_seo_keywords',
                                 'id'           => 'catalog_seo_keywords',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Catalog Seo Keywords',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('catalog_seo_keywords',$catalog['catalog_seo_keywords'])
                           );             
                  ?>
                 <?php echo form_error('catalog_seo_keywords');?>
                </div>
              </div> <!--/ Catalog Seo Keywords -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('catalog'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  