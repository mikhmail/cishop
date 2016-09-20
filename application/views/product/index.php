<?php if(!empty($product)): $product = $product[0]; //var_dump($product);?>
<div class="product row lg-grid-9 md-grid-9 sm-grid-12 xs-grid-12 padded-inner-sides">
        
<div class="row">
            


		<div class="breadcrumbs">

		  <a href="/" class="breadcrumbs-page breadcrumbs-page--home">
			<i class="fa fa-home"></i>
		  </a>

		  <span class="breadcrumbs-pipe">
			<i class="fa fa-angle-right"></i>
		  </span>
		 
						<a class="breadcrumbs-page" href="<?php echo base_url();?>catalogs/<?=$product->catalog_id;?>/<?=$product->catalog_url;?>/0/"><?=$product->catalog_title;?></a>
						<span class="breadcrumbs-pipe">
						  <i class="fa fa-angle-right"></i>
						</span>
			 
					  
						<a class="breadcrumbs-page" href="<?php echo base_url();?>category/<?=$product->category_id;?>/<?=$product->category_url;?>/0/"><?=$product->category_title;?></a>
						<span class="breadcrumbs-pipe">
						  <i class="fa fa-angle-right"></i>

			
		</div>

</div>
        

        <h1 class="product-title content-title"><?=$product->product_title;?></h1>

<div class="lg-grid-6 xs-grid-12
            padded-inner-bottom lg-padded-right sm-padded-zero-right">
  
<div class="product-gallery gallery">
					
									<div class="gallery-large_image sm-hidden xs-hidden">
                                        <a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url();?>images/products/<?=$product->product_image_front; ?>" title="<?=$product->product_title; ?>">
                                            <img alt="" src="<?php echo base_url();?>images/products/<?=$product->product_image_front;?>">
                                        </a>
										</div>
                                   
						<ul class="gallery gallery-preview_list gallery-preview_list--horizontal slider-container owl-carousel js-slider--gallery owl-loaded owl-drag">
                                    
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <?php $img = 'product_image_'.$i; ?>
                                        <?php if(!empty($product->$img)): ?>
                                            <li class="thumb">
                                                <a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url();?>images/products/<?=$product->$img;?>" title="<?=$product->product_title . ' photo ' . $i;?>">
                                                    <img src="<?php echo base_url();?>images/products/thumbs/<?=$product->$img?>">
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </ul>

  
</div>

</div>


<div class="product-info
            lg-grid-6 xs-grid-12
            lg-padded-left sm-padded-zero-left padded-inner-bottom">


  
  <div class="product-sku js-product-sku">
    Артикул:
    <span class="product-sku_field js-product-sku_field"><?=$product->product_article;?></span>
  </div>

  
  <div class="product-presence">
    <span class="product-presence_field js-product-presence">Есть в наличии</span>
  </div>

  


    <div class="row
                grid-inline">
      
      <div class="product-prices prices inline-middle">
	  
	 <?php if($product->product_status == 1): ?>
           <div class="prices-old js-prices-old"><?=$product->product_price;?>&nbsp;<?=$this->lang->line('currency');?></div>
        <div class="prices-current js-prices-current"><?=$product->product_action_price;?>&nbsp;<?=$this->lang->line('currency');?></div>
		<?else:?>
		<div class="prices-current js-prices-current"><?=$product->product_price;?>&nbsp;<?=$this->lang->line('currency');?></div>
                                <?php endif; ?>
       
		
      </div>

      
      
    </div>

    
    


</div>
    

    <div class="row
                grid-inline _grid-inline-top">
      
      <div class="product-quantity
                  inline-middle
                  mc-grid-3
                  padded-inner-right mc-padded-zero">
        


<div class="quantity quantity--side">


  <input id="product_count" class="quantity-input js-quantity-input"
                                        type="text"
                                        data-id="<?=$product->id_product;?>"
                                        data-price="<?=$product->product_price;?>"
                                        data-name="<?=$product->product_title;?>"
                                        data-article="<?=$product->product_article;?>"
                                                                                
                                        max="<?=$product->product_count;?>"
                                        data-img="/images/products/thumbs/<?=$product->product_image_front?>"
                                        size="3"
                                        pattern="^[0-9]{1,3}$"
                                        value="1"
                                        >


</div>

</div>
		
		<button class="product-buy button button--buy button--large mc-grid-9 js-buy js-product-buy inline-middle add"><?=$this->lang->line('button_add_to_cart');?></button>

		
		
      
    </div>

</div>

<div class="tabs
            lg-grid-12">
  <ul class="tabs-controls tabs-controls--horizontal">
    
      <li class="tabs-node                 mc-grid-12 tabs-node--active" data-params="target: '#description'">
        Описание
      </li>
    

    
      <li class="tabs-node                 mc-grid-12" data-params="target: '#characteristics'">
        Характеристики
      </li>

  </ul>

  
    <div id="description" class="tabs-content tabs-content--active">
      
      <div class="product-description editor">
      <?=$product->product_description;?>
      </div>
    </div>
  

  
    <div id="characteristics" class="tabs-content row">
      <!-- <p>Параметры:</p>-->
        <?
        if ($product->product_properties) {
        $product_properties = unserialize ($product->product_properties);

        foreach ($properties as $id => $value) {

        if (@array_key_exists($id, $product_properties)) {?>
        <p><?=$value?>: <?=$product_properties[$id]?></p>
            <?}
            }
            }
            ?>
    </div>
  

</div>


      </div>
	  <?php else: ?>

    <h2><?=$this->lang->line('product_not_found');?></h2>
    <div class="line"></div>

<?php endif; ?>