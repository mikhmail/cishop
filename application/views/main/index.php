<div class="slider slider--index xs-hidden">

    <div class="slider-container owl-carousel js-slider--index owl-loaded owl-drag">
     <div class="jcarousel">
          <ul>
                <?
                 $folder = realpath(APPPATH . '../images/slider');
                 $files = scandir($folder);
                 foreach($files as $file) {
                            if(($file == '.') || ($file == '..')) continue;
                            $f0 = $folder.$file;
                            if(!is_dir($f0)) {
                              echo '<li><img src="'.base_url().'images/slider/'.$file.'"></li>';
                            }
                    }
                ?>
          </ul>
     </div>

        <div class="owl-nav slider-control"><div class="owl-prev slider-left"><i class="fa fa-angle-left"></i></div><div class="owl-next slider-right"><i class="fa fa-angle-right"></i></div></div>
    </div>
</div>





<div class="tabs tabs--index">
	
	<ul class="tabs-controls tabs-controls--horizontal">
        <li class="tabs-node mc-grid-12 tabs-node--active" data-params="target: '#frontpage'">Новинки</li>
        <li class="tabs-node mc-grid-12" data-params="target: '#popular'">Популярные товары</li>
        <li class="tabs-node mc-grid-12" data-params="target: '#action'">Акция! </li>
	</ul>
	
	<div id="frontpage" class="tabs-content tabs-content--active">
        <div class="collection-product_list grid-row-inner grid-inline">
            <?$data['products'] = $this->product_model->get_new_products();?>
			<?php $this->load->view('widgets/products_main',$data); ?>
		</div>
	</div>
  
  <div id="popular" class="tabs-content">
        <div class="collection-product_list grid-row-inner grid-inline">
             <?$data['products'] = $this->product_model->get_popular_products();?>
		<?php $this->load->view('widgets/products_main',$data); ?>
	</div>
	</div>
	
  <div id="action" class="tabs-content">
        <div class="collection-product_list grid-row-inner grid-inline">
             <?$data['products'] = $this->product_model->get_action_products();?>
		<?php $this->load->view('widgets/products_main',$data); ?>
	</div>
	</div>
 
 
</div>

<div class="index-content">

  <h1 class="index-title content-title">Добро пожаловать в Diamondmosaic - интернет магазин алмазной мозаики!</h1>

	<div class="page-content editor">

		<p>Мы с радостью принимаем и обслуживаем заказы 7 дней в неделю с 10 до 18.
		Доставка возможна по всем городам и регионам Украины.</p>
		<p>Сделайте заказ через сайт и мы Вам перезвоним для согласования времени доставки заказа.</p>

	</div> 
 </div>