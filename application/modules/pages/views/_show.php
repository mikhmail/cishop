

<div class="page-header">
    <h3>Posts</h3>
</div>
<?php 
    if($posts) :
?> 

<table id="detail" class="table table-striped table-condensed">
    <tbody>
   
    <tr>
        <td><span class="form-control input-sm  required"><b><?php echo $posts['post_title'] ?></b></span></td>
    </tr>
    
	<tr>
        <td><span class="form-control input-sm  required"><?php echo $posts['post_description'] ?></span></td>
    </tr>
	
	<tr>
        <td><textarea class="form-control input-sm  required"><?php echo $posts['post_text'] ?></textarea></td>
    </tr>
	
     </tbody>
</table>



	<?php 
	
		echo anchor(site_url('posts'), '<span class="fa fa-chevron-left"></span> '.$this->lang->line('return').'', 'class="btn btn-sm btn-default"');
	
	?>


<br /><br />

<?php 
    endif;
?>

