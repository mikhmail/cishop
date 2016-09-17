   <div class="sidebar_block">


    <ul class="menu menu--collection menu--vertical">
        <?php if(!empty($catalogs)):?>
            <?php foreach($catalogs as $cats): ?>
                <li class="menu-node menu-node--collection_lvl_1 js-menu-wrapper">
					<a class="sidebar_block-title" href="<?php echo base_url();?>catalogs/<?=$cats->catalog_id;?>/<?=$cats->catalog_url;?>/0/"><?=$cats->catalog_title;?></a>
					<span class="menu-marker menu-marker--parent menu-toggler
                    button--toggler
                    js-menu-toggler">
				  <i class="fa fa-caret-down"></i>
				</span>
				</li>
                    <ul class="menu menu--vertical menu--collapse" style="display: block;">
							
                            <?php $categories = $this->db->where('catalog_id', $cats->catalog_id)->order_by('category_priority','asc')->get('categories')->result();

                            if(!empty($categories)): //var_dump($categories);die;?>
                                <?php foreach($categories as $c): ?>
								<li class="menu-node menu-node--collection_lvl_2 js-menu-wrapper">
                                    <a href="<?php echo base_url();?>category/<?=$c->category_id;?>/<?=$c->category_url;?>/0/"><?=$c->category_title;?></a>
								</li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                
                    </ul>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

  
    
      <div class="sidebar_block">
        <div class="sidebar_block-title">Группа ВКонтакте</div>
        <div class="sidebar_block-content editor"> 			Группа ВКонтакте
        </div>
      </div>
    
      <div class="sidebar_block">
        <div class="sidebar_block-title">Бесплатная доставка</div>
        <div class="sidebar_block-content editor">
          <p>Бесплатная доставка</p> 			<p>при заказе от 3000р!</p>
        </div>
      </div>
