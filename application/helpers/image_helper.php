<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('validate_image')) {
	function validate_image($image_param='') {
        $config['upload_path']          = $image_param['temp_location'];
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']             = 20480;
        $config['max_width']            = $image_param['width']*50;
        $config['max_height']           = $image_param['height']*50;
        $config['min_width']            = $image_param['width'];
        $config['min_height']           = $image_param['height'];
        $config['remove_spaces']        = true;
        $config['file_ext_tolower']     = true;
        $config['encrypt_name']         = true;

        $CI =& get_instance();

        $CI->load->library('upload', $config);
        $req_aspect_ratio = round($config['min_width']/$config['min_height'], 2);

        if ($CI->upload->do_upload($image_param['image'])) {
        	if($image_param['image']=='fav_icon') {
            		//echo 1; exit;
            	}
            $upload_data    = $CI->upload->data();
            $post = "post_" . $image_param['image'];
            $_POST[$post] = $upload_data['file_name'];

            $img_path = $image_param['temp_location'].$_POST[$post];

            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $img_path;
            $config2['create_thumb'] = FALSE;
            $config2['maintain_ratio'] = TRUE;

            $_width = $upload_data['image_width'];
            $_height = $upload_data['image_height'];

            $thumb_size_width = $image_param['width']; //Required Image Width
            $thumb_size_height =  $image_param['height']; //Required Image Height

            if($upload_data['image_height'] > $thumb_size_height && $upload_data['image_width'] > $thumb_size_width) {
            	if($image_param['image']=='fav_icon') {
            		//echo 3; exit;
            	}
                if ($_width != $_height) {
                    //For Landscape or potrait image
                    $config2['width'] = intval($thumb_size_height * ($_width / $_height));
                    if($config2['width'] < $thumb_size_width) {
                        $config2['width'] = $thumb_size_width;
                        $config2['master_dim'] = 'width';
                    }
                    if ($config2['width'] % 2 != 0) {
                        $config2['width']++;
                    }
                } else {
                    //For Square Image
                    $config2['width'] = $thumb_size_width;
                }
                $config2['height'] = intval($config2['width'] * ($_height / $_width));
                if ($config2['height'] % 2 != 0)
                {
                        $config2['height']++;
                }

                $CI->load->library('image_lib');
                $CI->image_lib->initialize($config2);
                $CI->image_lib->resize();

                // reconfigure the image lib for cropping
                $conf_new = array(
                    'image_library' => 'gd2',
                    'source_image' => $img_path,
                    'create_thumb' => FALSE,
                    'maintain_ratio' => FALSE,
                    'width' => $thumb_size_width,
                    'height' => $thumb_size_height,
                    'x_axis' => 0,
                    'y_axis' => ($config2['height'] - $thumb_size_height)/2
                );

                $CI->image_lib->initialize($conf_new);
                $CI->image_lib->crop();

                if(file_exists($img_path)) {
                    copy($img_path, $image_param['location'].$_POST[$post]);
                    @unlink($img_path);
                    $response = array(
                				'status' => true
                			);
                    return $response;
                } else {
                	$response = array(
                				'status' => false,
                				'msg' => "An unknown error occured. Please upload image again."
                			);
                    return $response;
                }
            } else { 
            	if($image_param['image']=='fav_icon') {
            		//echo 4; exit;
            	}
                if(file_exists($img_path)) {
                    copy($img_path, $image_param['location'].$_POST[$post]);
                    @unlink($img_path);
                    $response = array(
                				'status' => true
                			);
                    return $response;
                } else {
                    $response = array(
                				'status' => false,
                				'msg' => "An unknown error occured. Please upload image again."
                			);
                    return $response;
                }
            }
        } else {
            //echo 3; exit;
        	if($image_param['image']=='fav_icon') {
            	//echo "Min W: ".$config['min_width']."<br>Min H: ".$config['min_height']; exit;
            }
        	$response = array(
                			'status' => false,
                			'msg' => strip_tags($CI->upload->display_errors())
                		);
            //echo $response['msg']; exit;
            return $response;
        }
	}
}

if(!function_exists('create_thumb')) {
    function create_thumb($image_param) {
        $config['width']            = $image_param['thumb_w'];
        $config['height']           = $image_param['thumb_h'];
        $config['master_dim']       = $image_param['master_dim'];
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_param['image_loc'].$image_param['image'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['new_image']        = $image_param['thumb_loc'].$image_param['image'];
        $config['quality']          = '100';
        $config['thumb_marker']     = '';

        $CI =& get_instance();
        $CI->load->library('image_lib');
        $CI->image_lib->initialize($config);
        if($CI->image_lib->resize()){
            $response = array(
                            'status' => true,
                        );
            return $response;
        } else {
            $response = array(
                            'status' => false,
                            'msg' => strip_tags($CI->image_lib->display_errors())
                        );
            return $response;
        }

    }
}


if(!function_exists('create_image_from_any')) {
    function create_image_from_any($filepath) {
        $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
        //echo $type; exit;
        $allowedTypes = array(
            1,  // [] gif
            2,  // [] jpg
            3  // [] png
            //6   // [] bmp
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 1 :
                $image = imageCreateFromGif($filepath);
            break;
            case 2 :
                $image = imageCreateFromJpeg($filepath);
            break;
            case 3 :
                $image = imageCreateFromPng($filepath);
            break;
            // case 6 :
                // $image = imageCreateFromBmp($filepath);
            // break;
        }   
        return $image; 
    }
}
