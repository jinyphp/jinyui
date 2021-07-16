<?php

// 원본 이미지 -> 썸네일로 만드는 함수
function thumbnail($file, $save_filename, $max_width, $max_height)
{
		$ext = substr($file, strrpos($file, '.') + 1); //확장자 추출


        if($ext == "jpg" || $ext == "JPG") $src_img = ImageCreateFromJPEG($file); //JPG파일로부터 이미지를 읽어옵니다
        else if($ext == "gif" || $ext == "GIF") $src_img = ImageCreateFromgif($file); //JPG파일로부터 이미지를 읽어옵니다
        else if($ext == "png" || $ext == "PNG") $src_img = ImageCreateFrompng($file); //JPG파일로부터 이미지를 읽어옵니다

 
        $img_info = getImageSize($file);//원본이미지의 정보를 얻어옵니다
        $img_width = $img_info[0];
        $img_height = $img_info[1];
 
        if(($img_width/$max_width) == ($img_height/$max_height))
        {//원본과 썸네일의 가로세로비율이 같은경우
            $dst_width=$max_width;
            $dst_height=$max_height;
        }
 
        elseif(($img_width/$max_width) < ($img_height/$max_height))
        {//세로에 기준을 둔경우
            $dst_width=$max_height*($img_width/$img_height);
            $dst_height=$max_height;
        }
 
        else
        {//가로에 기준을 둔경우
            $dst_width=$max_width;
            $dst_height=$max_width*($img_height/$img_width);
        }
 
 
        $dst_img = imagecreatetruecolor($dst_width, $dst_height); //타겟이미지를 생성합니다
   
        ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다
   
        ImageInterlace($dst_img);
        if($ext == "jpg" || $ext == "JPG") ImageJPEG($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
        else if($ext == "gif" || $ext == "GIF") Imagegif($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
		else if($ext == "png" || $ext == "PNG") Imagepng($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
        
        ImageDestroy($dst_img);
        ImageDestroy($src_img);
}


function thumbnail_squre($file, $save_filename, $max_width, $max_height)
{
		$ext = substr($file, strrpos($file, '.') + 1); //확장자 추출


        if($ext == "jpg" || $ext == "JPG") $src_img = ImageCreateFromJPEG($file); //JPG파일로부터 이미지를 읽어옵니다
        else if($ext == "gif" || $ext == "GIF") $src_img = ImageCreateFromgif($file); //JPG파일로부터 이미지를 읽어옵니다
        else if($ext == "png" || $ext == "PNG") $src_img = ImageCreateFrompng($file); //JPG파일로부터 이미지를 읽어옵니다

 
        $img_info = getImageSize($file);//원본이미지의 정보를 얻어옵니다
        $img_width = $img_info[0];
        $img_height = $img_info[1];
 
        //원본과 썸네일의 가로세로비율이 같은경우
        $dst_width=$max_width;
        $dst_height=$max_height;

 
 
        $dst_img = imagecreatetruecolor($dst_width, $dst_height); //타겟이미지를 생성합니다
   
        ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다
   
        ImageInterlace($dst_img);
        if($ext == "jpg" || $ext == "JPG") ImageJPEG($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
        else if($ext == "gif" || $ext == "GIF") Imagegif($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
		else if($ext == "png" || $ext == "PNG") Imagepng($dst_img,  $save_filename); //실제로 이미지파일을 생성합니다
        
        ImageDestroy($dst_img);
        ImageDestroy($src_img);
}

// 원본 이미지 파일
// $srcFile = "./upfiles_adbrain/20055/10/img/5.jpg";
 
// 타겟 이미지 파일
// $sumFile = "./upfiles_adbrain/20055/10/sub/9.jpg";
 
// thumbnail($srcFile,$sumFile,"97","72");

	
?>
