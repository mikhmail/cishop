<div id="path">
    <ul class="breadcrumb">
        <li ><a href="<?php echo base_url();?>">Главная страница</a></li> /
        <li ><a href="<?php echo base_url();?>catalogs/<?=$catalog->catalog_id;?>/<?=$catalog->catalog_url;?>/0/"><?=$catalog->catalog_title;?></a></li> /
    </ul>
</div>

<?php if(!empty($products)): //var_dump($products);die;?>
    <div class="products-wrapper">
        <?php foreach($products as $p): ?>
            <article>
                <div class="block-image">
                    <a href="<?php echo base_url();?>product/<?=$p->id_product;?>/" title="<?=$p->product_title;?>">
                        <img src="<?php echo base_url();?>images/products/thumbs/<?=$p->product_image_front?>" >
                    </a>
                </div>
                <div class="line"></div>
                <p class="product-title"><a href="<?php echo base_url();?>product/<?=$p->id_product;?>/"><?=$p->product_title;?></a></p>

                <?php if($p->product_status == 'action'): ?>
                    <div class="action"></div>
                <?php endif; ?>

                <div class="info">
                    <p><small><?=$p->product_price;?></small> <?=$this->lang->line('currency');?></p>
					
                </div>

            </article>
        <?php endforeach; ?>
    </div>
    <div class="separate"></div>
    <div id="pagination">
        <?=(!empty($pagination)) ? $pagination : '<br>';?>
    </div>
<?php endif; ?>