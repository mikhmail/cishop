

<div class="page-header">
    <h3>Delivery Method</h3>
</div>
<?php 
    if($delivery_method) :
?> 

<table id="detail" class="table table-striped table-condensed">
    <tbody>
    <?php     
        foreach($delivery_method as $table => $value) :    
    ?>
    <tr>
        <td width="20%" align="right"><strong><?php echo $table ?></strong></td>
        <td><?php echo $value ?></td>
    </tr>
     <?php 
        endforeach;
     ?>
     </tbody>
</table>


	<?php 
	
		echo anchor(site_url('delivery_method'), '<span class="fa fa-chevron-left"></span> '.$this->lang->line('return').'', 'class="btn btn-sm btn-default"');
	
	?>


<br /><br />

<?php 
    endif;
?>

