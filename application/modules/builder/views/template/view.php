<div class="row">
	<div class="col-lg-12 col-md-12">		
		{php_open} 
                
                echo create_breadcrumb();		
                echo $this->session->flashdata('notify');
                
                {php_close}
	</div>
</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
                {php_open}
                                  echo anchor(
                                           site_url('{table}/add'),
                                            '<i class="glyphicon glyphicon-plus"></i>',
                                            'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('add').'"'
                                          );
                 {php_close}
                
            </div>
            <div class="col-md-4 col-xs-9">
                                           
                 {php_open} echo form_open(site_url('{table}/search'), 'role="search" class="form"') ;?>       
                           <div class="input-group pull-right">                      
                                 <input type="text" class="form-control input-sm" placeholder="<?=$this->lang->line('search_data');?>" name="q" autocomplete="off"> 
                                 <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i> <?=$this->lang->line('search');?></button>
                                 </span>
                           </div>
                           
               </form> 
                {php_open} echo form_close(); {php_close}
            </div>
        </div>
    </header>
    
    
    <div class="panel-body">
         {php_open} if (${table}s) : {php_close}
          <table class="table table-hover table-condensed">
              
            <thead>
              <tr>
                <th class="header">#</th>
                {labels}
                    <th>{label_name}</th>   
                {/labels}
                <th class="red header" align="right" width="120"><?=$this->lang->line('options');?></th>
              </tr>
            </thead>
            
            
            <tbody>
             
               {php_open} foreach (${table}s as ${table}) : {php_close}
              <tr>
              	<td>{php_open} echo $number++;; {php_close} </td>
               {fields}
               <td>{php_open} echo ${table}['{field_name}']; {php_close}</td>
               {/fields}
                <td>    
                    
                    {php_open}
                                  echo anchor(
                                          site_url('{table}/show/' . ${table}['{primary_key}']),
                                            '<i class="glyphicon glyphicon-eye-open"></i>',
                                            'class="btn btn-sm btn-info" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('view').'"'
                                          );
                   {php_close}
                    
                    {php_open}
                                  echo anchor(
                                          site_url('{table}/edit/' . ${table}['{primary_key}']),
                                            '<i class="glyphicon glyphicon-edit"></i>',
                                            'class="btn btn-sm btn-success" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('edit').'"'
                                          );
                   {php_close}
                   
                   {php_open}
                                  echo anchor(
                                          site_url('{table}/destroy/' . ${table}['{primary_key}']),
                                            '<i class="glyphicon glyphicon-trash"></i>',
                                            'onclick="return confirm(\''.$this->lang->line('delete').'?\');" class="btn btn-sm btn-danger" data-tooltip="tooltip" data-placement="top" title="'.$this->lang->line('delete').'"'
                                          );
                   {php_close}   
                                 
                </td>
              </tr>     
               {php_open} endforeach; {php_close}
            </tbody>
          </table>
          {php_open} else: {php_close}
                {php_open}  echo notify('Нет данных для показа','info');{php_close}
          {php_open} endif; {php_close}
    </div>
    
    
    <div class="panel-footer">
        <div class="row">
           <div class="col-md-3">
               Всего
               <span class="label label-info">
                    {php_open} echo $total; {php_close}
               </span>
           </div>  
           <div class="col-md-9">
                 {php_open} echo $pagination; {php_close}
           </div>
        </div>
    </div>
</section>