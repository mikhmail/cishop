<h2><?=$error;?></h2>
<div class="line"></div>
<div class="page">
    <?php if($error == 404): ?>
        <img src="<?php echo base_url();?>img/error.jpg">
    <?php endif; ?>
</div>