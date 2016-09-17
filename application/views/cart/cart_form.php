<?php if(!empty($cart)): ?>

    <div class="cart row

                    grid-12

                  padded-inner-sides">

        <div class="row">



            <div class="breadcrumbs">

                <a href="/" class="breadcrumbs-page breadcrumbs-page--home">
                    <i class="fa fa-home"></i>
                </a>

  <span class="breadcrumbs-pipe">
    <i class="fa fa-angle-right"></i>
  </span>


                <span class="breadcrumbs-page">Корзина</span>


            </div>

        </div>


        <h1 class="cart-title content-title">Корзина</h1>


        <div class="cart-empty_notice
              notice notice--warning
              js-cart-notice">
            В вашей корзине нет товаров
        </div>


            <form id="cartform" class="cart-table_container" action="<?php echo base_url();?>cart/checkout/" method="post">
            <div class="cart-items_list">
    <?php foreach($cart as $id => $i): ?>
                <div id="cart_order_line_85226174" class="cart_item grid-row grid-inline grid-inline-middle" data-item-id="85226174" data-params="item_id: 85226174">

                    <div class="lg-grid-6 md-grid-5 sm-grid-7 sm-grid-12
              sm-padded-inner-bottom">
                        <div class="grid-inline grid-inline-middle">

                            <div class="cart_item-image
                  lg-grid-2 sm-grid-3 _mc-grid-12
                  padded-sides">
                                <a href="<?php echo base_url();?>product/<?=$id;?>" class="image-square">
                                    <img class="cart-img" src="<?=$i['img'];?>">
                                </a>
                            </div>


                            <div class="cart_item-title
                  lg-grid-10 sm-grid-9 _mc-grid-12
                  padded-sides mc-padded-bottom">

                                <a href="<?php echo base_url();?>product/<?=$id;?>" class="cart_item-link">
                                    <?=$i['name'];?>
                                </a>

                            </div>
                        </div>
                    </div>


                    <div class="cart_item-quantity
              lg-grid-1 md-grid-2 mc-grid-3
              padded-sides
              center sm-left">



                        <div class="quantity quantity--side">


                            <input type="text" class="quantity-input js-quantity-input" autocomplete="off"
                                   id="<?=$id;?>"
                                   name="item[<?=$id;?>][count]"
                                   size="1"
                                   pattern="^[0-9]{1,3}$"
                                   value="<?=(int)$i['count'];?>">
                           

                            <input type="hidden" name="item[<?=$id;?>][total]" value="<?=round($i['total'],2);?>">
                            <input type="hidden" name="item[<?=$id;?>][price]" value="<?=round($i['price'],2);?>">

                        </div>

                    </div>


                    <div class="cart_item-prices cart_item-prices--stock
              prices-current
              lg-grid-2 sm-grid-4 xs-grid-3 mc-grid-3
              mc-hidden
              padded-sides
              center">
    <span class="js-price_type-85226174">
      <?=round($i['price'],2);?>&nbsp;<?=$this->lang->line('currency');?>
    </span>
                    </div>


                    <div class="cart_item-prices cart_item-prices--total
              prices-current
              lg-grid-2 sm-grid-5 xs-grid-6 mc-grid-8
              js-cart_item-total
              js-price_type-85226174
              center mc-left
              padded-sides">
                        <span id="total_<?=$id?>">
                            <?=round($i['total'],2);?>

                        </span>
                &nbsp;<?=$this->lang->line('currency');?>
                    </div>


                    <div class="lg-grid-1
              padded-sides
              right mc-center">

                        <button name="remove" id="<?=$id;?>" class="product_preview-button button button--buy
                    js-buy">&#10006;</button>

                    </div>
                </div>
<?endforeach;?>

            </div>






            <div class="cart_total">
                <div class="lg-grid-1
                  lg-fr md-fr
                  sm-hidden xs-hidden
                  padded">
                </div>
                <div class="lg-grid-4 sm-grid-6 xs-grid-12
                  lg-fr md-fr sm-fr
                  lg-padded-left sm-padded-zero">
                    <div class="cart_total-title
                    lg-grid-6">
                        Итого:
                    </div>

                    <div class="lg-grid-6
                    center sm-right">
          <span class="cart_total-price
                      prices-current
                      js-cart-total">
            <?php  if(!empty($_SESSION['cart'])){
               $total=0;
                $cart = $_SESSION['cart'];
                foreach($cart as $c){

                    $total += $c['total'];
                }
            }?>
              <span id="total"><?echo $total;?></span>  &nbsp;<?=$this->lang->line('currency');?></span>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="lg-grid-7 mc-hidden">

                </div>

                <div class="lg-grid-5 mc-grid-12 lg-fr
                  right">
                    <input type="submit" class="cart-button                       button button--buy                       mc-grid-12" value="Оформить">
                </div>
            </div>

        </form>



    </div>

<?php else: ?>
    <h2><?=$this->lang->line('cart_empty');?></h2>
<?php endif; ?>