<?php if(!empty($posts)): ?>
    <div class="posts">
        <?php foreach($posts as $p): ?>
            <article>
                <h2><a href="<?php echo base_url();?>post/<?=$p->post_id;?>/"><?=$p->post_title;?></a></h2>
                <p><?=$p->post_description;?></p>
                
            </article>
        <?php endforeach; ?>
    </div>
<div id="pagination">
    <?=@$pagination;?>
</div>
<?php endif; ?>