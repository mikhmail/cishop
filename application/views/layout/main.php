<?//var_dump($_SESSION['cart']);die;?>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='default-locale' content='ru'/>

    <title><?= $data['title']; ?></title>
    <meta name="description" content="<?= $data['description']; ?>">
    <meta name="keywords" content="<?= $data['keywords']; ?>">

    <link href="<?=base_url()?>images/favicon.png" rel="icon">
    <link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>css/template.css">

    <link media="screen" href="<?php echo base_url(); ?>assets/fancyBox/source/jquery.fancybox.css?v=2.1.4"
          type="text/css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" media="screen" href="<?php echo base_url(); ?>css/template.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Istok+Web:400,700&amp;subset=latin,cyrillic" rel="stylesheet"
          type="text/css">


    <?php if ($this->uri->segment(1) == 'product'): ?>
        <link type="text/css" rel="stylesheet" media="screen"
              href="<?php echo base_url(); ?>assets/fancyBox/source/helpers/jquery.fancybox-buttons.css">
        <link type="text/css" rel="stylesheet" media="screen"
              href="<?php echo base_url(); ?>assets/fancyBox/source/helpers/jquery.fancybox-thumbs.css">
    <?php endif; ?>

</head>

<body class="adaptive">

<section class="section--content">
    <header>

        <div class="section--top_panel">
            <div class="wrap row
                grid-inline grid-inline-middle
                padded-inner-sides">
                <div class="lg-grid-9 sm-grid-8 xs-grid-2">


                    <div class="top_menu">
                        <ul class="menu menu--top menu--horizontal __menu--one_line sm-hidden xs-hidden js-menu--top">

                            <li class="menu-node menu-node--top">
                                <a href="<?php echo base_url(); ?>news/0/" class="menu-link">
                                    Статьи
                                </a>
                            </li>

                            <li class="menu-node menu-node--top
     ">
                                <a href="<?php echo base_url(); ?>page/delivery" class="menu-link">
                                    Доставка
                                </a>
                            </li>

                            <li class="menu-node menu-node--top
     ">
                                <a href="<?php echo base_url(); ?>page/contacts" class="menu-link">
                                    Обратная связь
                                </a>
                            </li>

                        </ul>

                        <ul class="menu menu--top menu--horizontal
                    lg-hidden md-hidden">
                            <li class="menu-node menu-node--top">
                                <button type="button" class="menu-link
                            menu-toggler
                            js-panel-link" data-params="target: '.js-panel--menu'">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="lg-grid-3
                  right
                  sm-hidden xs-hidden">
                    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter,lj"></div>
                </div>

            </div>
        </div>

        <div class="section--header header">
            <div class="wrap row
                padded-inner">

                <div class="grid-inline grid-inline-middle">

                    <div class="lg-grid-9 sm-grid-12
                    sm-center
                    grid-inline grid-inline-middle
                    sm-padded-inner-bottom">
                        <div class="mc-grid-12
                      xs-padded-inner-bottom">
                            <a href="<?=base_url()?>" class="logo"><img src="<?=base_url()?>images/logo.png" alt="diamondmosaic.com.ua"></a>

                        </div>

                        <div class="lg-grid-6 mc-grid-12
                      left mc-center
                      lg-padded-inner-left mc-padded-zero
                      xs-hidden">

                            <div class="editor
                          lg-left mc-center">
                                <h4>Добро пожаловать в Diamondmosaic!</h4>
                                <h5>Интернет магазин алмазной вышивки</h5>
                            </div>


                        </div>
                    </div>

                    <div class="lg-grid-3 sm-grid-12
                    lg-right sm-center">

                        <div class="contacts editor">
                            <p><span>(067) 649 83 14</span></p>
                            <p>
                                <span><a
                                        href="mailto:support@diamondmosaic.com.ua">support@diamondmosaic.com.ua</a></span>
                            </p>
                            <p><span>c 10:00 до 19:00</span></p>
                        </div>


                        <div class="mc-grid-12
                        sm-padded-vertical xs-padded-vertical
                        sm-hidden xs-hidden">


                            <div class="cart_widget
            cart_widget--header">
                                <a href="<?=base_url()?>cart/" class="various cart_widget-link">
    
    <span class="cart_widget-icon">
      <i class="fa fa-shopping-cart"></i>

      <span class="cart_widget-items_count
                  js-cart_widget-items_count"><?= $cart['item']; ?></span>
    </span>

    <span class="cart_widget-title
                sm-hidden xs-hidden">
      Корзина:
    </span>

    <span class="cart_widget-total prices">
      <span class="cart_widget-items_price
                  prices-current
                  js-cart_widget-total_price"><?= round($cart['total'], 2); ?></span>
    </span>
                                </a>


<!--
                                                    <div class="cart_widget-dropdown
                basket_list
                sm-hidden xs-hidden
                padded
                js-basket_list">
                                    <div class="basket_list-header">
                                        <span class="basket_list-title">Корзина</span>

                                    </div>

                                    <ol class="basket_list-items">
                                        <?php foreach ($_SESSION['cart'] as $id_product => $c){?>
                                        <li class="basket_item">

                                            <a href="<?echo base_url('product').'/'. $id_product?>" class="basket_item-image">
                                                <img width="75" src="<? echo base_url(). $c['img'];?>">
                                            </a>

                                            <a href="<?echo base_url('product').'/'. $id_product?>" class="basket_item-title">Футболка Lino Blue Stripe </a>

                                            <div class="basket_item-details right">

                                                <span class="basket_item-count"><?=$c['count']?></span> x
                                                <span class="basket_item-price prices">
                                                  <span class="prices-current"><?=$c['price']?>&nbsp;<?=$this->lang->line('currency');?></span>
                                                </span>


                                                <button name="remove" id="<?=$id_product?>" class="fa fa-times">

                                            </div>
                                        </li>
                                        <?}?>
                                    </ol>

                                    <div class="basket_list-footer">
                                        Товаров в корзине:
                                         <span class="basket_list-count fr"><?echo $cart['item'];?></span>
                                        <div class="basket_list-total prices right">
                                            <div class="prices-current"> Всего:
                                                <span class="basket_list-total"><?echo $cart['total']?></span>&nbsp;<?=$this->lang->line('currency');?>
                                            </div>
                                        </div>
                                        <a href="<?=base_url()?>cart" class="various basket_list-submit button lg-grid-12">Оформить</a>
                                        <button class="product-buy button button--buy button--large" name="clear">Очистить</button>
                                    </div>
                                </div>
                                -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="wrap row
                padded-inner-top padded-sides
                sm-padded-zero-top">
                <div class="section--main_menu
                  row
                  grid-inline
                  padded">
                    <div class="lg-grid-9 sm-grid-12">


                        <div class="grid-row xs-hidden">
                            <ul class="menu menu--main menu--main_lvl_1             menu--horizontal             js-menu--main">


                                <li class="menu-node menu-node--main_lvl_1
                menu-node--current">

                                    <a href="<?=base_url()?>" class="menu-link
                  menu-link--current">
                                        Каталог

                                    </a>

                                </li>

                                <li class="menu-node menu-node--main_lvl_1
                ">

                                    <a href="<?=base_url()?>news/0/" class="menu-link
                  ">
                                        Статьи

                                    </a>

                                </li>

                                <li class="menu-node menu-node--main_lvl_1
                  ">

                                    <a href="<?=base_url()?>page/about" class="menu-link
                  ">
                                        О магазине

                                    </a>

                                </li>

                                <li class="menu-node menu-node--main_lvl_1
                  ">

                                    <a href="<?=base_url()?>page/delivery" class="menu-link
                  ">
                                        Доставка и оплата

                                    </a>

                                </li>

                                <li class="menu-node menu-node--main_lvl_1
                  ">

                                    <a href="<?=base_url()?>page/contacts/" class="menu-link
                  ">
                                        Контакты

                                    </a>

                                </li>

                            </ul>
                        </div>

                    </div>
                    <!--
                            <div class="lg-grid-3
                                        sm-hidden xs-hidden
                                        right">




                      <form action="/search" method="get" class="search_widget
                                search_widget--header ">
                      <input type="text" name="q" class="search_widget-field
                                    js-ajax_search-input" value="" placeholder="Поиск">

                      <button type="submit" class="search_widget-submit
                                    button--invert">
                        <i class="fa fa-search"></i>
                      </button>


                        <div class="ajax_search-wrapper
                                    js-ajax_search-wrapper"></div>


                      </form>

                            </div>
                    -->
                </div>

            </div>
        </div>
    </header>


    <div class="content-container
                wrap row">


        <div class="lg-grid-3 md-grid-3 sm-hidden xs-hidden padded-inner-sides">
            <?php $this->load->view('blocks/sidebar', $data); ?>
        </div>
        <div class="index row lg-grid-9 md-grid-9 sm-grid-12 xs-grid-12 padded-inner-sides">
            <?php $this->load->view($data['view'], $data); ?>
        </div>


    </div>
</section>

<footer>
    <div class="section--footer_menus
              padded-inner-vertical">
        <div class="wrap row">


            <div class="footer_block
                    lg-grid-4 sm-grid-6 mc-grid-12
                    padded-inner">
                <ul class="footer_block-content menu menu--footer menu--vertical">

                    <li class="menu-node menu-node--footer">
                        <a href="<?=base_url()?>page/delivery" class="menu-link">
                            Доставка
                        </a>
                    </li>

                    <li class="menu-node menu-node--footer">
                        <a href="<?=base_url()?>page/contacts" class="menu-link">
                            Обратная связь
                        </a>
                    </li>

                </ul>
            </div>


            <div class="footer_block
                  lg-grid-4 sm-grid-6 mc-grid-12
                  center sm-right mc-center">
                <div class="footer_block-content">


                    <div class="social_groups padded-inner">


                    </div>


                </div>
            </div>

            <div class="footer_block
                  lg-grid-4 sm-grid-6 mc-grid-12
                  lg-fr md-fr
                  padded-inner
                  right mc-center">
                <div class="footer_block-content contacts editor">
                    <p><span>(067) 649 83 14</span></p>
                    <p><span><a href="mailto:support@diamondmosaic.com.ua">support@diamondmosaic.com.ua</a></span></p>
                    <p><span>c 10:00 до 19:00</span></p>
                </div>

                <div class="footer_block-content
                    lg-hidden md-hidden">


                </div>
            </div>

        </div>
    </div>

    <div class="section--footer_copyright
              padded-inner-bottom">
        <div class="wrap row">
            <div class="editor
                  lg-grid-4 sm-grid-6 xs-grid-12
                  xs-center
                  padded-inner">
                <p>Интернет-магазин Diamondmosaic"</p>
            </div>

            <div class="insales-copyright
                  lg-grid-4 sm-grid-6 xs-grid-12
                  lg-fr
                  right xs-center
                  padded-inner">
                Работает на codeigniter</a>
            </div>

        </div>
    </div>

    <button type="button" class="button button--scroll_top
                js-scrollTop
                fa fa-angle-up
                sm-hidden xs-hidden"></button>

</footer>

<div class="panel panel--menu js-panel--menu" style="display: none;">
    <div class="panel_block">
        <h3 class="panel_block-title">
            Главное меню
        </h3>

        <div class="panel_block-content">


            <ul class="menu menu--main menu--mobile_panel menu--vertical">


                <li class="menu-node
              ">
                    <a href="<?=base_url()?>" class="menu-link
                ">
                        Каталог
                    </a>
                </li>

                <li class="menu-node
              ">
                    <a href="<?=base_url()?>blogs/blog" class="menu-link
                ">
                        Статьи
                    </a>
                </li>

                <li class="menu-node
              ">
                    <a href="<?=base_url()?>page/o-magazine" class="menu-link
                ">
                        О магазине
                    </a>
                </li>

                <li class="menu-node
              ">
                    <a href="<?=base_url()?>page/dostavka-i-oplata" class="menu-link
                ">
                        Доставка и оплата
                    </a>
                </li>

                <li class="menu-node
              ">
                    <a href="<?=base_url()?>page/contacts/" class="menu-link
                ">
                        Контакты
                    </a>
                </li>

            </ul>

        </div>
    </div>

    <div class="panel_block">
        <h3 class="panel_block-title">
            Каталог
        </h3>

        <div class="panel_block-content">


            <ul class="menu menu--collection menu--vertical
          menu--mobile_panel">


                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/dlya-devochek" class="menu-link
                ">
                        Для девочек
                    </a>

      
        <span class="menu-marker menu-marker--parent menu-toggler
                    button--toggler
                    js-menu-toggler">
          <i class="fa
                    fa-caret-down"></i>
        </span>

                    <ul class="menu menu--vertical
                  menu--collapse">

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/golfy" class="menu-link menu-link
     ">
                                Гольфы
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/platishki" class="menu-link menu-link
     ">
                                Платишки
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/futbolochki" class="menu-link menu-link
     ">
                                Футболочки
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/shtanishki" class="menu-link menu-link
     ">
                                Штанишки
                            </a>

              
                <span class="menu-marker menu-marker--parent menu-toggler
                            button--toggler
                            js-menu-toggler">
                  <i class="fa fa-caret-down"></i>
                </span>
                            <ul class="menu menu--vertical menu--collapse">

                                <li class="menu-node menu-node--collection_lvl_3
           ">
                                    <a href="<?=base_url()?>collection/shortiki-i-yubochki" class="menu-link menu-link
             ">
                                        Шортики и юбочки
                                    </a>
                                </li>

                                <li class="menu-node menu-node--collection_lvl_3
           ">
                                    <a href="<?=base_url()?>collection/bryuchki" class="menu-link menu-link
             ">
                                        Брючки
                                    </a>
                                </li>

                                <li class="menu-node menu-node--collection_lvl_3
           ">
                                    <a href="<?=base_url()?>collection/legginsy" class="menu-link menu-link
             ">
                                        Леггинсы
                                    </a>
                                </li>

                            </ul>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/sumochki" class="menu-link menu-link
     ">
                                Сумочки
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/zakolochki" class="menu-link menu-link
     ">
                                Заколочки
                            </a>

              
                <span class="menu-marker menu-marker--parent menu-toggler
                            button--toggler
                            js-menu-toggler">
                  <i class="fa fa-caret-down"></i>
                </span>
                            <ul class="menu menu--vertical menu--collapse">

                                <li class="menu-node menu-node--collection_lvl_3
           ">
                                    <a href="<?=base_url()?>collection/korony" class="menu-link menu-link
             ">
                                        Короны
                                    </a>
                                </li>

                            </ul>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/kombinezonchiki" class="menu-link menu-link
     ">
                                Комбинезончики
                            </a>


                        </li>

                    </ul>

                </li>

                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/dlya-malchikov" class="menu-link
                ">
                        Для мальчиков
                    </a>

      
        <span class="menu-marker menu-marker--parent menu-toggler
                    button--toggler
                    js-menu-toggler">
          <i class="fa
                    fa-caret-down"></i>
        </span>

                    <ul class="menu menu--vertical
                  menu--collapse">

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/shtany" class="menu-link menu-link
     ">
                                Штаны
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/futbolki" class="menu-link menu-link
     ">
                                Футболки
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/noski" class="menu-link menu-link
     ">
                                Носки
                            </a>


                        </li>

                        <li class="menu-node menu-node--collection_lvl_2
                      
                      js-menu-wrapper">


                            <a href="<?=base_url()?>collection/kombinezony" class="menu-link menu-link
     ">
                                Комбинезоны
                            </a>


                        </li>

                    </ul>

                </li>

                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/panamki" class="menu-link
                ">
                        Панамки
                    </a>


                </li>

                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/svitshoty" class="menu-link
                ">
                        Свитшоты
                    </a>


                </li>

                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/sumochki-2" class="menu-link
                ">
                        Сумочки
                    </a>


                </li>

                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/futbolki-2" class="menu-link
                ">
                        Футболки
                    </a>


                </li>

                <li class="menu-node menu-node--collection_lvl_1
              
              js-menu-wrapper">


                    <a href="<?=base_url()?>collection/yubki" class="menu-link
                ">
                        Юбки
                    </a>


                </li>


            </ul>

        </div>
    </div>

    <div class="panel_block">
        <h3 class="panel_block-title">
            Полезные ссылки
        </h3>

        <div class="panel_block-content">
            <ul class="menu menu--vertical menu--mobile_panel">


                <li class="menu-node
 ">
                    <a href="<?=base_url()?>news/0/" class="menu-link">
                        Статьи
                    </a>
                </li>

                <li class="menu-node
                    menu-node--current">
                    <a href="<?=base_url()?>page/delivery" class="menu-link">
                        Доставка
                    </a>
                </li>

                <li class="menu-node
 ">
                    <a href="<?=base_url()?>page/contacts" class="menu-link">
                        Обратная связь
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

<script src="<?php echo base_url(); ?>assets/fancyBox/source/jquery.fancybox.js?v=2.1.4" type="text/javascript"></script>

<?php if ($this->uri->segment(1) == 'product'): ?>
    <script src="<?php echo base_url(); ?>assets/fancyBox/source/helpers/jquery.fancybox-buttons.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/fancyBox/source/helpers/jquery.fancybox-thumbs.js" type="text/javascript"></script>
<?php endif; ?>

<?php if ($this->uri->segment(1) == 'cart'): ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.js"></script>
    <script type="text/javascript">
        $("#client_phone").mask("(099) 999-99-99");
    </script>
<?php endif; ?>




    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript">

        // ========================================================================
        //                              TABS
        // ========================================================================

        $( '.tabs-node' ).on( 'click touchstart', function(){
            var
                $unit    = $(this),
                $content = $unit.parents( '.tabs:first' ).find( '.tabs-content' ),
                params   = getParams( $unit );

            $unit
                .siblings( '.tabs-node--active' )
                .removeClass( 'tabs-node--active' );

            $unit
                .addClass( 'tabs-node--active' );

            $content
                .removeClass( 'tabs-content--active' );
            $( params.target )
                .addClass( 'tabs-content--active' );
        });


        $( function(){
            $( '.tabs-node:first' )
                .trigger( 'click' );
        });

        
        // =======================================================================================
        //                                      SCROLL PAGE
        // =======================================================================================

        $(document).on( 'click', '.js-scrollTop', function(event){
            //event.preventDefault();
            console.log( 'click' );

            $('html, body').animate({
                scrollTop: 0
            }, 400 );
        });


        // =======================================================================================
        //                                     getParams
        // =======================================================================================

       getParams = function( $obj ){
            var
                readyParams = $obj.data( 'readyParams' ),
                params;

            // РµСЃС‚СЊ Р»Рё Сѓ РЅР°СЃ СЂР°Р·РѕР±СЂР°РЅРЅС‹Р№ РѕР±СЉРµРєС‚?
            if( !$.isEmptyObject( readyParams ) ){
                return readyParams;
            }

            // РµСЃР»Рё РЅРµС‚, С‚Рѕ
            // СЂР°Р·Р±РёСЂР°РµРј СЃС‚СЂРѕРєСѓ Рё СЃРѕС…СЂР°РЅСЏРµРј РіРѕС‚РѕРІС‹Р№ РѕР±СЉРµРєС‚
            params = prepareJSON( $obj.attr( 'data-params' ) );
            $obj
                .data( 'readyParams', params );

            return params;
        };


        // =======================================================================================
        //                                     prepareJSON
        // =======================================================================================
        prepareJSON = function( string ){
            if( !string ){
                return {};
            }

            var
                temp   = [],
                result = [];

            string = string.replace(/\s+/g, '').split(';');

            for( var i = 0; i < string.length; i++ ){
                if( string[i] !== '' ){
                    temp = string[i].split( ':' );

                    result.push( '"'+ temp[0] +'":'+ temp[1].replace( /\'/g, '"' ) );
                }
            }

            return $.parseJSON( '{'+ result.join(',') +'}' );
        };


        // =======================================================================================
        //                                     IU для панели
        // =======================================================================================
$( function(){

  $( '.js-panel-link' ).on( '_click tap', function( e ){alert(1);exit;
    e.preventDefault();

    if( $(this).hasClass( 'js-panel-close' ) ){
      return;
    }

    var
      params = getParams( $(this) ),
      $unit  = $(this),
      $panels_trig = $( '.js-panel-link.js-panel-close' );

    if( $panels_trig.length > 0 ){
      $panels_trig
        .trigger( 'click' );
    }

    // flag;
    params.panel = true;

    $( 'body' )
      //.css( 'overflow', 'hidden' )
      .addClass( 'lock_scroll' )
      .append( '<div class="overlay" />');

    $( params.target ).show();

    setParams( $( '.overlay' ), params );


    window.setTimeout( function(){
      $unit
        .toggleClass( 'js-panel-close' );
    }, 200 );
  });

  $( document ).on( '_click tap', '.js-panel-close, .overlay', function( e ){
    e.preventDefault();
    var
      params = getParams( $( '.overlay' ) );

    if( params.panel ){
      $( params.target ).hide();
      $( '.overlay' ).remove();
      $( 'body' )
        .removeClass( 'lock_scroll' );

      window.setTimeout( function(){
        $( '.js-panel-link' )
          .removeClass( 'js-panel-close' );
      }, 200 );
    }
  });

  $( window ).on( 'resize', function(){
    if( $(window).width() > 800 ){
      $( '.overlay' )
        .trigger( 'click' );
    }
  });
});

    </script>


</body>
</html>