<?php

require_once 'init.php';

$user = new User;

if (isset($_POST['image_name'])) {
	
	$user->updateUserAjax($_POST['image_name'],$_POST['user_id']);
}


if (isset($_POST['photo_id'])) {

	User::displaySidebar($_POST['photo_id']);
}