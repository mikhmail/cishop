<?php if(!empty($cart)): ?>
<h2><?=$this->lang->line('cart_checkout');?></h2>
<div class="line"></div>
<form action="<?php echo base_url();?>cart/complete/" method="post">
    <table id="checkout" class="checkout-form">
        <tbody>
        <tr>
            <th><?=$this->lang->line('cart_image');?></th>
            <th><?=$this->lang->line('cart_count');?></th>
            <th><?=$this->lang->line('cart_item');?></th>
            <th><?=$this->lang->line('cart_price');?></th>
            <th><?=$this->lang->line('cart_subtotal');?></th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach($cart as $id => $i): ?>
            <?php $total += $i['total']; ?>
        <tr>
            <td>
                <a href="<?php echo base_url();?>product/<?=$id;?>">
                    <img class="cart-img" src="<?=$i['img'];?>">
                </a>
            </td>
            <td><?=(int)$i['count'];?></td>
            <td><?=$i['name'];?></td>
            <td><?=round($i['price'],2);?></td>
            <td><?=round($i['total'],2);?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4"></td>
            <td><?=$this->lang->line('cart_total');?>: <?=round($total,2);?></td>
        </tr>
        </tbody>
    </table>

    <br>
    <h2><?=$this->lang->line('contact_info');?></h2>
    <table class="user-data-checkout">
        <tbody>
        <tr>
            <td>
                <input type="text" name="name" id="name"  required="required" placeholder="<?=$this->lang->line('contact_name');?> *">
            </td>
            <td rowspan="3">
                <textarea class="contact-block" placeholder="<?=$this->lang->line('delivery_address');?>" name="address"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <input type="tel" name="phone" id="phone" pattern="[0-9- ()+]{8,19}" placeholder="<?=$this->lang->line('contact_tel');?> *" required="required">
            </td>
        </tr>
        <tr>
            <td>
                <input type="email" name="email" id="email" placeholder="<?=$this->lang->line('contact_email');?> *" required="required">
            </td>
        </tr>

        <tr>
            <td>
                <?php

                echo form_dropdown(
                    'delivery_id',
                    $delivery_method,
                    set_value('delivery_id',1),
                    'class="" id="delivery_id"'
                );
                ?>
                <?php echo form_error('delivery_id');?>
            </td>
        </tr>

        <tr>
            <td>
                <?php

                echo form_dropdown(
                    'payment_id',
                    $payment_method,
                    set_value('payment_id',1),
                    'class=""  id="payment_id"'
                );
                ?>
                <?php echo form_error('payment_id');?>
            </td>
        </tr>

        </tbody>
    </table>
    <br>
    <button type="submit" name="pay" class="btn btn-info">
        <i class="ok"></i>
        <?=$this->lang->line('button_checkout');?>
    </button> <small><a href="<?php echo base_url();?>#" class="go_back"><?=$this->lang->line('go_back');?></a></small>
    <br>
    <br>
    <br>
</form>
<?php else: ?>
<h2><?=$this->lang->line('cart_empty');?></h2>
<div class="line"></div>
<?php endif; ?>