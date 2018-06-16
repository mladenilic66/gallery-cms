<?php
ob_start();
require_once ("admin/includes/init.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="<?=mb_internal_encoding()?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website for displayong Gallery type content">
    <meta name="author" content="Mladen">

    <title><?=tab_name()?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=ROOT?>img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=ROOT?>img/favicon.ico" type="image/x-icon">
    <!-- Semantic UI -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
    <!-- Custom CSS -->
    <link href="<?=ROOT?>css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<?php include("navigation.php"); ?>

    <main class="page">
        <div class="ui hidden divider"></div>
                
<?php ob_end_flush(); ?>