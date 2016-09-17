<div class="breadcrumbs">

        <a href="/" class="breadcrumbs-page breadcrumbs-page--home">
            <i class="fa fa-home"></i>
        </a>

        <span class="breadcrumbs-pipe">
                <i class="fa fa-angle-right"></i>
              </span>

        <a class="breadcrumbs-page" href="<?php echo base_url();?>catalogs/<?=$catalog->catalog_id;?>/<?=$catalog->catalog_url;?>/0/"><?=$catalog->catalog_title;?></a>
        <span class="breadcrumbs-pipe">
                              <i class="fa fa-angle-right"></i>
                            </span>



</div>

 

<?php if(!empty($products)): //var_dump($products);die;?>
<div class="collection-products_list
                grid-inline
                grid-row-inner">
    
        <?php foreach($products as $p): ?>
			<div class="lg-grid-3 md-grid-4 xs-grid-6 mc-grid-12 padded-inner">
			<div class="product_preview">
							<div class="product_preview-preview ">
								<a href="<?php echo base_url();?>product/<?=$p->id_product;?>/" title="<?=$p->product_title;?>">
									<img src="<?php echo base_url();?>images/products/thumbs/<?=$p->product_image_front?>" >
								</a>
							</div>

							<form action="/cart_items" data-params="product_id: 54070106;" class="product_preview-form row">

								<div class="product_preview-prices prices lg-grid-12">
								  <div class="prices-current"> <?=$p->product_price;?>&nbsp;<?=$this->lang->line('currency');?> </div>
								</div>

							  <!--
							  <input id="product_count"
                                        type="hidden"
                                        data-id="<?=$p->id_product;?>"
                                        data-price="<?=$p->product_price;?>"
                                        data-name="<?=$p->product_title;?>"
                                        max="<?=$p->product_count;?>"
                                        data-img="/images/products/thumbs/<?=$p->product_image_front?>">
							  <button class="product_preview-button button button--buy js-buy add">Купить</button>
-->

							</form>

							<div class="product_preview-title">
							<a href="<?php echo base_url();?>product/<?=$p->id_product;?>/" class="product_preview-link" title="<?=$p->product_title;?>">
							  <?=$p->product_title;?>
							</a>
						  </div>


					  </div>
					  </div>
        <?php endforeach; ?>
</div>

<div class="row">
    <div class="xs-grid-12
                  lg-fr
                  xs-center">

        <div class="sm-center xs-center">
            <?=(!empty($pagination)) ? $pagination : '<br>';?>
        </div>
    </div>
</div>

<?php endif; ?>