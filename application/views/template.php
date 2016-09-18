<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--/ No cache -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
   
    <title>Home</title>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/parsley/parsley.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/datepicker/datepicker3.min.css" rel="stylesheet" type="text/css">
	
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-2.1.1.min.js"></script>
</head>

<body>
  
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-windows"></i> Dahsboard</a></li>
            <?php
				$menus = menu(APPPATH . 'modules/');
			?>
			
            <?php   if($menus) : ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-signal"></i> Admin <b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                 <?php 
				 
				 
				 
                foreach ($menus as $key => $val)
                {   
					 if($val['name'] !='dashboard' && $val['name'] !='builder') : 
                ?>
                    <li><a href="<?php  echo site_url($val['name']);  ?>"><?php echo $val['label'];  ?></a></li>
                
               <?php
               		endif;
                }
               
                ?>
                             
              </ul>
            </li>

            
            <?php  endif; ?>
             
          </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('/'); ?>"><i class=""></i> Site</a></li>

                <li><a href="<?php echo site_url('/admin/login/logout'); ?>"><i class="fa fa-code"></i> Logout</a></li>

            </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>
   
 
   
    <div class="container-fluid">
        <div class="row">
            
                <?php echo $content; ?>
            
        </div>
       
       
    </div><!--/ Content -->
   
     

  


<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/holder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.file-input.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/parsley/parsley.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/parsley/i18n/ru.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/parsley/i18n/ru.extra.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepicker/locales/bootstrap-datepicker.id.js"></script>

<?php if ($this->uri->segment(1) == 'posts' OR $this->uri->segment(1) == 'pages'): ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/swfupload.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/swfupload.queue.js"></script>

    <script type="text/javascript">

    var swfu = new SWFUpload(
    {
        upload_url : ""+base_url+"upload",
        flash_url :  ""+base_url+"js/swfupload.swf",


        file_size_limit : "2 MB",
        file_types : "*.jpg; *.png; *.jpeg; *.gif",
        file_types_description : "Images",
        file_upload_limit : "0",
        debug: false,

        button_placeholder_id : "swfu-placeholder",
        //button_image_url: "button.png",
        button_width : 100,
        button_height : 20,
        button_text_left_padding: 15,
        button_text_top_padding: 2,
        button_text : "<span class=\"uploadBtn\">Обзор...</span>",
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_text_style : ".uploadBtn { color: #ffffff; font-size: 14px; }",

        file_dialog_complete_handler : fileDialogComplete,
        upload_success_handler : uploadSuccess,
        upload_complete_handler : uploadComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress
    }
    );

    function uploadSuccess(file, serverData) {
        //$('#images').append($(serverData));

         var _result = jQuery.parseJSON(serverData);
         insertImageToEditor(_result.title, _result.url, _result.permalink);
    }

    function uploadComplete(file) {
        //$('#status').append($('<p>Загрузка ' + file.name + ' завершена</p>'));
    }

    function uploadStart(file) {
        //$('#status').append($('<p>Начата загрузка файла ' + file.name + '</p>'));
        return true;
    }

    function uploadProgress(file, bytesLoaded, bytesTotal) {
        //$('#status').append($('<p>Загружено ' + Math.round(bytesLoaded/bytesTotal*100) + '% файла ' + file.name + '</p>'));
    }

    function fileDialogComplete(numFilesSelected, numFilesQueued) {
        //$('#status').html($('<p>Выбрано ' + numFilesSelected + ' файл(ов), начинаем загрузку</p>'));
        this.startUpload();
    }

    var insertImageToEditor = function (title, url, link) {

        CKEDITOR.instances.post_text.insertHtml('<img src=\"' + url + '\" alt=\"' + title + '\" />') ;


    };
    </script>
<?php endif; ?>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>



<?php echo $js; ?>


</body>
</html>
