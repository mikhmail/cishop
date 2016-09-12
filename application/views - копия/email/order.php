<?php if(!empty($cart)): ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
    <meta charset="utf-8" />
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
        <tbody>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td align="left">
                <table width="580" cellpadding="0" align="center" cellspacing="0" border="0">
                    <tbody>
                    <tr>
                        <td align="right" valign="bottom" colspan="2">

                        </td>
                    </tr>
                    <tr>
                        <td height="3" colspan="2"></td>
                    </tr>
                    <tr>
                        <td align="left" valign="bottom">
                            <a href="http://cishop"><img src="http://cishop/img/logo.jpg"></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>


        <tr>
            <td align="center">
                <table width="600" cellpadding="0" align="center" cellspacing="0" border="0">
                    <tbody>
                    <tr>
                        <td align="center">
                            <table border="0" align="center" width="580" cellpadding="0" cellspacing="0" bgcolor="#e0e0e0">
                                <tbody>
                                <tr>
                                    <td height="1"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" align="center" width="578" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                            <tbody>
                                            <tr>
                                                <td height="15"></td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <table border="0" width="540" align="center" cellpadding="0" cellspacing="0">

                                                        <tbody>
                                                        <tr>
                                                            <td align="left" style="color:#454545;font-size:20px;font-family:'Noto Sans',Arial,sans-serif">
                                                                <?=$user['name']?>, здравствуйте!
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px">
                                                                Номер вашего заказа: <strong><?=$user['order_id']?></strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px">
                                                                Ниже указаны детали вашего заказа.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>

                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="color:#424242;font-size:18px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px">
                                                                <strong>Ваш заказ содержит:</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="15"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">
                                                                <table width="540" align="center" cellpadding="5" cellspacing="0" border="0" style="border-width:1px;border-style:solid;border-color:#f2f2f2;border-bottom-width:0px">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;background-color:#f2f2f2;border-left-width:1px;border-left-style:solid;border-left-color:#fff"><strong><?=$this->lang->line('cart_item');?></strong></td>
                                                                        <td align="center" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;background-color:#f2f2f2;border-left-width:1px;border-left-style:solid;border-left-color:#fff"><strong><?=$this->lang->line('cart_count');?></strong></td>
                                                                        <td align="center" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;background-color:#f2f2f2;border-left-width:1px;border-left-style:solid;border-left-color:#fff"><strong><?=$this->lang->line('cart_price');?></strong></td>
                                                                        <td align="center" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;background-color:#f2f2f2;border-left-width:1px;border-left-style:solid;border-left-color:#fff"><strong><?=$this->lang->line('cart_subtotal');?></strong></td>
                                                                    </tr>

                                                                    <?php $total = 0; ?>
                                                                    <?php foreach($cart as $id => $i): ?>
                                                                        <?php $total += $i['total']; ?>

                                                                    <tr style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#f2f2f2">

                                                                        <td style="border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2">
                                                                            <table align="left" cellpadding="0" cellspacing="0" border="0">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td> <img src="https://ci/1.jpg" style="display:inline-block;vertical-align:top" border="0" alt="image"></td>
                                                                                    <td width="10"></td>
                                                                                    <td style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:18px">
                                                                                        <?=$i['name'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                        <td align="center" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2"><?=(int)$i['count'];?></td>
                                                                        <td align="center" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2"><?=round($i['price'],2);?></td>
                                                                        <td align="center" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2"><?=round($i['total'],2);?></td>
                                                                    </tr>

                                                                    <?php endforeach; ?>

                                                                    <tr style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#f2f2f2">
                                                                        <td align="right" colspan="5" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2"><strong><?=$this->lang->line('cart_total');?>: </strong><?=round($total,2);?></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="15"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left">
                                                                <table width="540" align="center" cellpadding="0" cellspacing="0" border="0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td width="265" valign="top">

                                                                            <table width="265" align="center" cellpadding="5" cellspacing="0" border="0" style="border-width:1px;border-style:solid;border-color:#f2f2f2;border-bottom-width:0px">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td colspan="2" style="color:#424242;font-size:15px;font-family:'Noto Sans',Arial,sans-serif;line-height:25px;background-color:#f2f2f2"><strong>Доставка:</strong></td>
                                                                                </tr>

                                                                                <tr style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#f2f2f2">
                                                                                    <td style="color:#424242;font-size:14px;font-family:'Noto Sans',Arial,sans-serif;line-height:20px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2">Получатель:</td>
                                                                                    <td align="left" style="color:#424242;font-size:14px;font-family:'Noto Sans',Arial,sans-serif;line-height:20px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2"><?=$user['name']?></td>
                                                                                </tr>
                                                                                <tr style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#f2f2f2">
                                                                                    <td style="color:#424242;font-size:14px;font-family:'Noto Sans',Arial,sans-serif;line-height:20px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2">Адрес:</td>
                                                                                    <td align="left" style="color:#424242;font-size:14px;font-family:'Noto Sans',Arial,sans-serif;line-height:20px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2">
                                                                                        <?=$user['address']?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#f2f2f2">
                                                                                    <td style="color:#424242;font-size:14px;font-family:'Noto Sans',Arial,sans-serif;line-height:20px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2">Телефон:</td>
                                                                                    <td align="left" style="color:#424242;font-size:14px;font-family:'Noto Sans',Arial,sans-serif;line-height:20px;border-left-width:1px;border-left-style:solid;border-left-color:#f2f2f2">
                                                                                        <?=$user['phone']?>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>

                                                                        </td>
                                                                        <td width="10"></td>

                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td height="20"></td>
                                                        </tr>

                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>

                                                        <tr>
                                                            <td align="center" style="color:#454545;font-size:18px;font-family:'Noto Sans',Arial,sans-serif">
                                                                В ближайшее время представитель магазина свяжется с вами для уточнения и подтверждения <span class="il">заказ</span>а!
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="50"></td>
        </tr>


        </tbody>
    </table>
    
<?php else: ?>
<h2><?=$this->lang->line('cart_empty');?></h2>
<?php endif; ?>