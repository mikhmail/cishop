<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                ?>
	</div>
</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
                <?php
                                  echo anchor(
                                           site_url('properties/add'),
                                            '<i class="glyphicon glyphicon-plus"></i>',
                                            'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('add').'"'
                                          );
                 ?>
                
            </div>
            <div class="col-md-4 col-xs-9">
                                           
                 <?php echo form_open(site_url('properties/search'), 'role="search" class="form"') ;?>       
                           <div class="input-group pull-right">                      
                                 <input type="text" class="form-control input-sm" placeholder="введите данные для поиска" name="q" autocomplete="off"> 
                                 <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Поиск</button>
                                 </span>
                           </div>
                           
               </form> 
                <?php echo form_close(); ?>
            </div>
        </div>
    </header>
    
    
    <div class="panel-body">
         <?php if ($propertiess) : ?>
          <table class="table table-hover table-condensed">
              
            <thead>
              <tr>
                <th class="header">#</th>
                
                    <th>Название</th>   
                
                <th class="red header" align="right" width="120">Опции</th>
              </tr>
            </thead>
            
            
            <tbody>
             
               <?php foreach ($propertiess as $properties) : ?>
              <tr>
              	<td><?php echo $number++;; ?> </td>
               
               <td><?php echo $properties['title']; ?></td>
               
                <td>    
                    
                    <?php
					/*
                                  echo anchor(
                                          site_url('properties/show/' . $properties['property_id']),
                                            '<i class="glyphicon glyphicon-eye-open"></i>',
                                            'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('view').'"'
                                          );
					*/					  
                   ?>
                    
                    <?php
                                  echo anchor(
                                          site_url('properties/edit/' . $properties['property_id']),
                                            '<i class="glyphicon glyphicon-edit"></i>',
                                            'class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('edit').'"'
                                          );
                   ?>
                   
                   <?php
                                  echo anchor(
                                          site_url('properties/destroy/' . $properties['property_id']),
                                            '<i class="glyphicon glyphicon-trash"></i>',
                                            'onclick="return confirm(\''.$this->lang->line('delete').'?\');" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('delete').'"'
                                          );
                   ?>   
                                 
                </td>
              </tr>     
               <?php endforeach; ?>
            </tbody>
          </table>
          <?php else: ?>
                <?php  echo notify('Нет данных для показа','info');?>
          <?php endif; ?>
    </div>
    
    
    <div class="panel-footer">
        <div class="row">
           <div class="col-md-3">
               Всего
               <span class="label label-info">
                    <?php echo $total; ?>
               </span>
           </div>  
           <div class="col-md-9">
                 <?php echo $pagination; ?>
           </div>
        </div>
    </div>
</section>