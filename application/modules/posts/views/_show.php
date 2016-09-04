

<div class="page-header">
    <h3>Posts</h3>
</div>
<?php 
    if($posts) :
?> 

<table id="detail" class="table table-striped table-condensed">
    <tbody>
   
    <tr>
        <td><b><?php echo $posts['post_title'] ?></b></td>
    </tr>
    
	<tr>
        <td><?php echo $posts['post_description'] ?></td>
    </tr>
	
	<tr>
        <td><?php echo $posts['post_text'] ?></td>
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

