<?php if(!empty($product)): $product = $product[0]; //var_dump($product);?>


    <div id="path">
        <ul class="breadcrumb">
            <li ><a href="<?php echo base_url();?>">Главная страница</a></li> /
            <li ><a href="<?php echo base_url();?>catalogs/<?=$product->catalog_id;?>/<?=$product->catalog_url;?>/0/"><?=$product->catalog_title;?></a></li> /
            <li ><a href="<?php echo base_url();?>category/<?=$product->category_id;?>/<?=$product->category_url;?>/0/"><?=$product->category_title;?></a></li> /
            <li class="active"><?=$product->product_title;?></li>
        </ul>
    </div>
    <h2><?=$product->product_title;?></h2>

    <div class="product">
        <article class="product-item">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="padding">
                                <ul class="gallery">
                                    <li class="first">
                                        <a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url();?>images/products/<?=$product->product_image_front; ?>" title="<?=$product->product_title; ?>">
                                            <img alt="" src="<?php echo base_url();?>images/products/<?=$product->product_image_front;?>">
                                        </a>
                                    </li>
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <?php $img = 'product_image_'.$i; ?>
                                        <?php if(!empty($product->$img)): ?>
                                            <li class="thumb">
                                                <a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url();?>images/products/<?=$product->$img;?>" title="<?=$product->product_title . ' photo ' . $i;?>">
                                                    <img alt="" src="<?php echo base_url();?>images/products/thumbs/<?=$product->$img?>">
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </ul>
                                <?php if($product->product_status == 'action'): ?>
                                    <div class="p-action"></div>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="description">

                            <p><b>Категория:</b><br> <?=$product->category_title;?></p>
                            <br>
                            <p><b>Описание:</b><br> <?=$product->product_description;?></p>
                            <br>
                            <p><b>Свойства:</b><br>
                            <?
                            if ($product->product_properties) {
                                    $product_properties = unserialize ($product->product_properties);

                                        foreach ($properties as $id => $value) {

                                                if (@array_key_exists($id, $product_properties)) {?>
                                                   <p><?=$value?>: <?=$product_properties[$id]?>
                                                <?}
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="line"></div>
                            <div class="padding">
                                <p><?=$this->lang->line('cart_price');?>: <small><?=$product->product_price;?></small> <?=$this->lang->line('currency');?></p>
                                <p class="info-order"><?=$this->lang->line('cart_count');?>: <input
                                        type="text"
                                        data-id="<?=$product->id_product;?>"
                                        data-price="<?=$product->product_price;?>"
                                        data-name="<?=$product->product_title;?>"
                                        max="<?=$product->product_count;?>"
                                        data-img="/images/products/thumbs/<?=$product->product_image_front?>"
                                        size="3"
                                        pattern="^[0-9]{1,3}$"
                                        value="1"
                                        ></p>
                                <button class="btn btn-info add">
                                    <i class="add"></i>
                                    <?=$this->lang->line('button_add_to_cart');?>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>
    </div>
    <?php //$this->load->view('widgets/comments',array('key'=>$product->product_comment_status)); ?>

<?php else: ?>

    <h2><?=$this->lang->line('product_not_found');?></h2>
    <div class="line"></div>

<?php endif; ?>