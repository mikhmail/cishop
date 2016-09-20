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
            <div class="col-md-1 col-xs-3">
                <?php
                                  echo anchor(
                                           site_url('products/add'),
                                            '<i class="glyphicon glyphicon-plus"></i>',
                                            'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('add').'"'
                                          );
                 ?>
                
            </div>


            <div class="col-md-4 col-xs-9">

                 <?php echo form_open(site_url('products/filter'), 'role="filter" class="form"') ;?>
                 <?php //$categories = array(''=>'Выбрать фильтр :', 1=>'Сегодня',2=>'Вчера',3=>'Неделя',4=>'Месяц');?>
                <div class="input-group pull-right">
                    <?
                     echo form_dropdown(
                               'filter',
                               $categories,
                               set_value('filter', $this->session->userdata('filter') ),
                               'class="form-control input-sm"'
                               );
                    ?>
                    <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> Показать</button>
                                 </span>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="col-md-4 col-xs-9">
                                           
                 <?php echo form_open(site_url('products/search'), 'role="search" class="form"') ;?>       
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
         <?php if ($productss) : ?>
          <table class="table table-hover table-condensed">
              
            <thead>
              <tr>
                <th class="header">#</th>

                  <th class="header">Артикул</th>


                    <th>Категория</th>   
                
                    <th>Название</th>   
                
                    <th>Описание</th>   
                
                    <th>Цена</th>   
                
                    <th>Акционная цена</th>
                    <th>Оптовая цена</th>

                    <th>Акция?</th>   
                
                    <th>Активный?</th>   
                
                
                    <th>Дата создания</th>    
                
                    <th>Чисто просмотров</th>   
                
                
                    <th>Главная картинка</th>   
                
                    
                
                <th class="red header" align="right" width="120">Опции</th>
              </tr>
            </thead>
            
            
            <tbody>
             
               <?php foreach ($productss as $products) : ?>
              <tr>
              	<td><?php echo $products['id_product']; ?> </td>

                <td><?php echo $products['product_article']; ?> </td>

               
               <td><?php echo $products['category_title']; ?></td>
               
               <td><?php echo $products['product_title']; ?></td>
               
               <td><?php echo $products['product_description']; ?></td>
               
               <td><?php echo $products['product_price']; ?></td>
               
               <td><?php echo $products['product_action_price']; ?></td>
               <td><?php echo $products['product_trade_price']; ?></td>
               
               <td><?php echo $products['product_status']? 'ДА':'НЕТ'; ?></td>
               
               <td><?php echo $products['product_active']? 'ДА':'НЕТ'; ?></td>
               
               
               <td><?php echo $products['product_date_create']; ?></td>
               
               
               <td><?php echo $products['product_views']; ?></td>
               

               
               <td>
			   <?if ($products["product_image_front"]) {?>
					<img src="<?=site_url('/images/products/thumbs/'.$products["product_image_front"]);?>"></td>
				<?}?>
               
                <td>    
                    
                    <?php
					/*
                                  echo anchor(
                                          site_url('products/show/' . $products['id_product']),
                                            '<i class="glyphicon glyphicon-eye-open"></i>',
                                            'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('view').'"'
                                          );
					*/					  
                   ?>
                    
                    <?php
                                  echo anchor(
                                          site_url('products/edit/' . $products['id_product']),
                                            '<i class="glyphicon glyphicon-edit"></i>',
                                            'class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('edit').'"'
                                          );
                   ?>
                   
                   <?php
                                  echo anchor(
                                          site_url('products/destroy/' . $products['id_product']),
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