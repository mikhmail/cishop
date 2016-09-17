<?php if(!empty($cart)): ?>
<h2><?=$this->lang->line('cart_checkout');?></h2>
<div class="line"></div>
<form action="<?php echo base_url();?>cart/complete/" method="post">


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


                <span class="breadcrumbs-page">Оплата</span>


            </div>

        </div>


        <div class="cart-empty_notice
              notice notice--warning
              js-cart-notice">
            В вашей корзине нет товаров
        </div>



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



                            <div class="cart_item-prices">
                              <?=(int)$i['count'];?>
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
              padded-sides"><?=round($i['total'],2);?>&nbsp;<?=$this->lang->line('currency');?></div>


                        <div class="lg-grid-1
              padded-sides
              right mc-center">

               <!--<button name="remove" id="<?=$id;?>" class="product_preview-button button button--buy js-buy">&#10006;</button>-->
                        
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
              <?echo $total;?>&nbsp;<?=$this->lang->line('currency');?></span>
                    </div>
                </div>
            </div>
    </div>


 <div style="" class="lg-grid-6 md-grid-6 sm-grid-6 xs-grid-12 lg-padded-right xs-padded-zero-right">
    <div id="regular_client" style="min-height: 200px">
        <h3><?=$this->lang->line('contact_info');?></h3>
        <div class="field fc input input--required">
            <div class="field-label input-label">
                <label for="client_name">Контактное лицо (ФИО):</label>

            </div>
            <div class="field-content">
                <input class="textfield input-field" type="text" id="client_name" name="name" value="" required="required">
                <div class="small"></div>
            </div>
        </div>
        <div class="field fc input input--required">
            <div class="field-label input-label">
                <label for="client_phone">Контактный телефон:</label>

            </div>
            <div class="field-content">
                <input class="textfield input-field" type="text" id="client_phone" name="phone" value="" required="required" pattern="\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}">
                <!--<div class="small notice notice--info">Например: +7(926)111-11-11</div>-->
            </div>
        </div>
        <div class="field fc input--required">
            <div class="field-label input-label">
                <label for="client_email">E-mail:</label>
            </div>
            <div class="field-content">
                <input class="textfield input-field" type="text" id="client_email" name="email" required="required" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                <div class="small"></div>
            </div>
        </div>

    <div class="field fc input">
        <div class="field-label input-label">
                <label for="client_email">Вид доставки:</label>
            </div>
        <div class="field-content">
                 <?php
                echo form_dropdown(
                    'delivery_id',
                    $delivery_method,
                    set_value('delivery_id',1),
                    'class="" id="delivery_id"'
                );
                ?>
                <?php echo form_error('delivery_id');?>
            </div>
    </div>

         <div class="field fc input">
        <div class="field-label input-label">
                <label for="client_email">Вид оплаты:</label>
            </div>
        <div class="field-content">
                 <?php

                echo form_dropdown(
                    'payment_id',
                    $payment_method,
                    set_value('payment_id',1),
                    'class=""  id="payment_id"'
                );
                ?>
                <?php echo form_error('payment_id');?>
            </div>
    </div>

    <div id="shipping_address">
    <div class="address-autocomplete" id="delivery_address">
        <div class="field fc input--required">
            <div class="field-label input-label">
                <label for="shipping_address_address">Адрес:</label>
            </div>
            <div class="field-content">
                <textarea required="required" class="textfield input-field" id="shipping_address_address" name="address" rows="2"></textarea>
                <div class="small">

                </div>
            </div>
        </div>
    </div>

</div>

        <button type="submit" name="pay" class="button big mc-grid-12 button--buy_invert">
        <?=$this->lang->line('button_checkout');?>
    </button>
        
    </div>
 

</div>

</form>

<?php else: ?>
<h2><?=$this->lang->line('cart_empty');?></h2>
<div class="line"></div>
<?php endif; ?>