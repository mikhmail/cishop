<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<?php echo form_open(site_url('categories/' . $action),'role="form" class="form-horizontal" id="form_categories" parsley-validate'); ?>               
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-signal"></i> </div>
     
      <div class="panel-body">
         
                       
               <div class="form-group">
                   <label for="catalog_id" class="col-sm-2 control-label">Каталог <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_dropdown(
                           'catalog_id',
                           $catalog,  
                           set_value('catalog_id',$categories['catalog_id']),
                           'class="form-control input-sm  required"  id="catalog_id"'
                           );             
                  ?>
                 <?php echo form_error('catalog_id');?>
                </div>
              </div> <!--/ Catalog -->
                          
               <div class="form-group">
                   <label for="category_title" class="col-sm-2 control-label">Название категории <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'category_title',
                                 'id'           => 'category_title',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Category Title',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('category_title',$categories['category_title'])
                           );             
                  ?>
                 <?php echo form_error('category_title');?>
                </div>
              </div> <!--/ Category Title -->
                          
               <div class="form-group">
                   <label for="category_seo_description" class="col-sm-2 control-label">Category Seo Description <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'category_seo_description',
                                 'id'           => 'category_seo_description',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Category Seo Description',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('category_seo_description',$categories['category_seo_description'])
                           );             
                  ?>
                 <?php echo form_error('category_seo_description');?>
                </div>
              </div> <!--/ Category Seo Description -->
                          
               <div class="form-group">
                   <label for="category_seo_keywords" class="col-sm-2 control-label">Category Seo Keywords <span class="required-input">*</span></label>
                <div class="col-sm-6">                                   
                  <?php                  
                   echo form_input(
                                array(
                                 'name'         => 'category_seo_keywords',
                                 'id'           => 'category_seo_keywords',                       
                                 'class'        => 'form-control input-sm  required',
                                 'placeholder'  => 'Category Seo Keywords',
                                 'maxlength'=>'255'
                                 ),
                                 set_value('category_seo_keywords',$categories['category_seo_keywords'])
                           );             
                  ?>
                 <?php echo form_error('category_seo_keywords');?>
                </div>
              </div> <!--/ Category Seo Keywords -->
               
           
      </div> <!--/ Panel Body -->
    <div class="panel-footer">   
          <div class="row"> 
              <div class="col-md-10 col-sm-12 col-md-offset-2 col-sm-offset-0">
                   <a href="<?php echo site_url('categories'); ?>" class="btn btn-default">
                       <i class="glyphicon glyphicon-chevron-left"></i> Назад                   </a> 
                    <button type="submit" class="btn btn-primary" name="post">
                        <i class="glyphicon glyphicon-floppy-save"></i> Подтвердить 
                    </button>                  
              </div>
          </div>
    </div><!--/ Panel Footer -->       
</div><!--/ Panel -->
<?php echo form_close(); ?>  