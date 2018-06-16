<?php

// Autoload function
function autoloader($class){

	$class = ucfirst($class);
	$path = $_SERVER['DOCUMENT_ROOT'] . "/admin/includes/classes/{$class}.php";

	(is_file($path) && !class_exists($class)) ? require_once $path : die('Class named ' . $class . '.php does not exist');
}

spl_autoload_register('autoloader');


// Secouring inputs from injection
function safe_input($data) {

    $data = trim($data);
    $data = strip_tags($data);
    if (empty($data)) {
        return false;
    }
    return $data;
}

// Redirect User
function redirect($location){

	header("Location: {$location}");
}


// Random color hax
function rand_color() {

    return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}


// Formating file size units
function size_converter($bytes) {
		
    if ($bytes >= 1073741824) {

        $bytes = round(number_format($bytes / 1073741824, 2)) . ' GB';

    } elseif ($bytes >= 1048576) {

        $bytes = round(number_format($bytes / 1048576, 2)) . ' MB';

    } elseif ($bytes >= 1024) {

        $bytes = round(number_format($bytes / 1024, 2)) . ' KB';

    } elseif ($bytes > 1) {

        $bytes = $bytes . ' bytes';

    } elseif ($bytes == 1) {

        $bytes = $bytes . ' byte';

    } else {

        $bytes = '0 bytes';
    }

    return $bytes;
}


// Dynamic title tag
function tab_name() {

    $replace = array("-","_");

    $data = basename($_SERVER['PHP_SELF'],".php");
    $data = str_replace($replace, " ", $data);
    $data = ucwords($data);

    if ($data === "Index") {
        $data = "Home";
    }

    return $data . ' | ' . $_SERVER['HTTP_HOST'];
}


// Showing short format date
function date_short($data,$format = "M jS Y") {
    $data = strtotime($data);
    $data = date($format, $data);
    return $data;
}


// Giving new uniq name to file
function rename_img($file_name,$base,$more_entropy = false) {

    if (!empty($file_name)) {
        $path_info = pathinfo($file_name);
        $file_name = uniqid($base,$more_entropy);
        $file_name .= ".".$path_info['extension'];
    } else {
        $file_name = "";
    }

    return $file_name;
}


// Limiting number of characters
function excerpt($data,$limit,$endpoint = " [...]") {
    if (strlen($data) > $limit) {
        $data = substr($data, 0, $limit).$endpoint;
    }
    return $data;
}


// Resize and crop image by center
function img_crop_resize($max_width, $max_height, $source_file, $new_name, $quality = 100) {
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];
 
    switch($mime) {
 
        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            break;
 
        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            break;
 
        default:
            return false;
            break;
    }
     
    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);
     
    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if($width_new > $width) {
        //cut point by height
        $h_point = (($height - $height_new) / 2);
        //copy image
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    } else {
        //cut point by width
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }

    $image = imagejpeg($dst_img, $new_name, $quality);
}


// Convert timestamp to 'X time ago'
function time_ago($time) {

    $time = time() - $time; // get the time since that moment
    $time = ($time < 1 ) ? 1 : $time;
    $tokens = [
        31536000 => 'year',
        2592000  => 'month',
        604800   => 'week',
        86400    => 'day',
        3600     => 'hour',
        60       => 'minute',
        1        => 'second'
    ];

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $number_of_units = floor($time / $unit);

        return $number_of_units.' '.$text.(($number_of_units > 1) ? 's' : ''). ' ago';
    }
}