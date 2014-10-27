<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Skola programiranja</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/themes/blue/style.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/ajaxupload.3.5.js"></script>


        <?php include_once('functions/general_function.php') ?>
        <?php
        if($_SERVER['REQUEST_URI']!='/projekt_skola/index.php'){
            is_login();
        }
        if(isset($_COOKIE['remember'])){
          echo 'kuki';
        } else echo 'nema kukija';
        ?>

    </head>
    <body style="background-color:#CED8F6">