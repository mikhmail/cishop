<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thumb {
    public  function createThumbs($pathToImages,$fname, $pathToThumbs, $thumbWidth ,$thumbHeight)
    {
        $srcFile = $pathToImages.$fname;
        $thumbFile = $pathToThumbs.$fname;
        if(!empty($fname))
        {
            $type = strtolower(substr( $fname , strrpos( $fname , '.' )+1 ));

            $thumbnail_width=$thumbWidth;
            $thumbnail_height=$thumbHeight;

            switch( $type ){
                case 'jpg' : case 'jpeg' :
                try{
                    $src = imagecreatefromjpeg( $srcFile ); break;
                }
                catch(Exception $e) {

                    log_message('System Error', $e->getMessage());
                }
                ///$src = imagecreatefromjpeg( $srcFile ); break;
                case 'jpeg' : case 'jpeg' :
                try{
                    $src = imagecreatefromjpeg( $srcFile ); break;
                }
                catch(Exception $e) {

                    log_message('System Error', $e->getMessage());
                }
                case 'png' :
                    if ( ! function_exists('imagecreatefrompng'))
                    {
                        $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_png_not_supported'));
                        return FALSE;
                    }
                    $src = imagecreatefrompng( $srcFile ); break;
                case 'gif' :
                    if ( ! function_exists('imagecreatefromgif'))
                    {
                        $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_gif_not_supported'));
                        return FALSE;
                    }
                    $src = imagecreatefromgif( $srcFile ); break;
            }
            list($width_orig, $height_orig) = getimagesize($srcFile);
            $ratio_orig = $width_orig/$height_orig;

            if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
                $new_height = $thumbnail_width/$ratio_orig;
                $new_width = $thumbnail_width;
            } else {
                $new_width = $thumbnail_height*$ratio_orig;
                $new_height = $thumbnail_height;
            }

            $x_mid = $new_width/2;  //horizontal middle
            $y_mid = $new_height/2; //vertical middle

            $process = imagecreatetruecolor(round($new_width), round($new_height));

            imagecopyresampled($process, $src, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
            $dest_img = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagecopyresampled($dest_img, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);

    switch( $type ){
        case 'jpg' : case 'jpeg' :
        $src = imagejpeg( $dest_img , $thumbFile ); break;
        case 'png' :
            $src = imagepng( $dest_img , $thumbFile ); break;
        case 'gif' :
            $src = imagegif( $dest_img , $thumbFile ); break;
    }

  }

    }



}
?>