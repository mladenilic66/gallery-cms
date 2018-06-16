<?php
ob_start();
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?=mb_internal_encoding()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=tab_name()?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=ROOT?>img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=ROOT?>img/favicon.ico" type="image/x-icon">
    <!-- Semantic UI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>

    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->
    <!-- Custom CSS -->
    <link href="<?=ADMIN?>css/style.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=ADMIN?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Pie Chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

    <div class="ui sidebar vertical left inverted fixed menu">
        <a href="<?=ADMIN?>" class="ui big header item"><i class="dashboard icon"></i>Dashboard</a>
        <a href="<?=ADMIN?>uploads.php" class="ui big header item"><i class="cloud upload icon"></i>Uploads</a>
        <a href="<?=ADMIN?>photos.php" class="ui big header item"><i class="camera icon"></i>Photos</a>
        <a href="<?=ADMIN?>users.php" class="ui big header item"><i class="users icon"></i>Users</a>
        <a href="<?=ADMIN?>comments.php" class="ui big header item"><i class="comments icon"></i>Comments</a>
    </div>

    <div class="ui inverted fixed menu">

        <?php if ($session->isLoggedIn()): ?>
            <a id="toggle" class="ui small header item"><i class="sidebar icon"></i>Menu</a>
        <?php endif; ?>

        <a href="<?=ROOT?>" class="ui small header item">Home</a>
        <a href="<?=ROOT?>contact" class="ui small header item">Contact</a>
        
        <?php if ($session->isLoggedIn()): ?>
        <div class="ui simple right floated dropdown item"><i class="icon user"></i><?=$session->userInfo()?><i class="dropdown icon"></i>
            <div class="menu">
                <a href="<?=ADMIN?>logout" class="ui big header item"><i class="icon shutdown"></i>Logout</a>
            </div>
        </div>
        <?php endif; ?>
    </div>