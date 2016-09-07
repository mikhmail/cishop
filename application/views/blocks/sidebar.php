<div id="sidebar">

    <ul>
        <?php if(!empty($catalogs)):?>
            <?php foreach($catalogs as $cats): ?>
                <!--<li><a href="/catalogs/<?=$cats->catalog_id;?>/<?=$cats->catalog_url;?>/0/"><?=$cats->catalog_title;?></a></li>-->
                <li><?=$cats->catalog_title;?></li>
                <div class="line"></div>
                    <li>
                        <ul>
                            <?php $categories = $this->db->where('catalog_id', $cats->catalog_id)->order_by('category_priority','asc')->get('categories')->result();

                            if(!empty($categories)): //var_dump($categories);die;?>
                                <?php foreach($categories as $c): ?>
                                    <li><a href="/category/<?=$c->category_id;?>/<?=$c->category_url;?>/0/"><?=$c->category_title;?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>





</div>