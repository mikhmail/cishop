<?php if(!empty($products)): //var_dump($products);die;?>

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
				   
							  <input type="hidden" name="variant_id" value="85296322">
							  <button title="Футболка Lino Blue Stripe" class="product_preview-button button button--buy js-buy">Купить</button>
				
							</form>
							
							<div class="product_preview-title">
							<a href="<?php echo base_url();?>product/<?=$p->id_product;?>/" class="product_preview-link" title="<?=$p->product_title;?>">
							  <?=$p->product_title;?>
							</a>
						  </div>
							
						   
					  </div>
					  </div>
        <?php endforeach; ?>

	
	
    <div class="separate"></div>
    <div id="pagination">
        <?=(!empty($pagination)) ? $pagination : '<br>';?>
    </div>
<?php endif; ?>