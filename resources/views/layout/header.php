<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Standard-Titel' ?></title>
        <!-- Bootstrap CSS Lokal -->
        <link rel="stylesheet" href="<?php echo asset('assets/css/bootstrap.min.css'); ?>">
        <!-- Bootstrap CSS Link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Bootstrap JS Lokal -->
        <script src="<?php echo asset('assets/js/libs/bootstrap.bundle.min.js'); ?>"></script>
        <!-- Bootstrap JS Link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Jquery -->
        <script src="<?php echo asset('assets/jquery/jquery-3.7.1.min.js');?> "></script>
        <!-- Haupt-JS -->
        <script src="<?php echo asset('assets/js/main.js');?>"></script>
        <!-- Dashboard JS-->
        <script src="<?php echo asset('assets/js/pages/dashboard.js');?>"></script>
        <!-- User-Management JS-->
        <script src="<?php echo asset('assets/js/pages/user-management.js');?>"></script>
        <!-- Modul-Skripte -->
        <script src="<?php echo asset('assets/js/modules/api.js');?>"></script>
        <script src="<?php echo asset('assets/js/modules/formValidation.js');?> "></script>
    
    </head>
<body>
        <!-- Hier wird die Navigation geladen -->
        <?php require(BASE_PATH . '/resources/views/layout/nav.php'); ?>