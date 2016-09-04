

<div class="page-header">
    <h3>Status</h3>
</div>
<?php 
    if($status) :
?> 

<table id="detail" class="table table-striped table-condensed">
    <tbody>
    <?php     
        foreach($status as $table => $value) :    
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
	
		echo anchor(site_url('status'), '<span class="fa fa-chevron-left"></span> '.$this->lang->line('return').'', 'class="btn btn-sm btn-default"');
	
	?>


<br /><br />

<?php 
    endif;
?>

