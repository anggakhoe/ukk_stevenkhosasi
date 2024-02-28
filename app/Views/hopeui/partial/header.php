<?php

$db = \Config\Database::connect();
$builder = $db->table('website');
$logo = $builder->select('*')
->where('deleted_at', null)
->get()
->getRow();

?>


<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  
  <!-- Library / Plugin Css Build -->
  <link rel="stylesheet" href="<?=base_url('assets/css/core/libs.min.css')?>" />
  
  <!-- Aos Animation Css -->
  <link rel="stylesheet" href="<?=base_url('assets/vendor/aos/dist/aos.css')?>" />
  
  <!-- Hope Ui Design System Css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/hope-ui.min.css?v=2.0.0')?>" />
  
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/custom.min.css?v=2.0.0')?>" />
  
  <!-- Dark Css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/dark.min.css')?>"/>
  
  <!-- Customizer Css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/customizer.min.css')?>" />
  
  <!-- RTL Css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/rtl.min.css')?>"/>

  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?=base_url('assets/extensions/@fortawesome/fontawesome-pro/css/all.min.css')?>">

  <!-- JQuery + AJAX-->
  <script src="<?=base_url('assets/jquery/jquery-3.6.0.min.js')?>"></script>
  <link rel="stylesheet" href="<?=base_url('assets/jquery/jquery-ui.css')?>">
  <script src="<?=base_url('assets/jquery/jquery-ui.js')?>"></script>

  <!-- Choice JS -->
  <link rel="stylesheet" href="<?=base_url('assets/extensions/choices.js/public/assets/styles/choices.css')?>"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?=base_url('assets/custom/custom_style.css')?>">

  <!-- File Uploader -->
  <link rel="stylesheet" href="<?=base_url('assets/extensions/filepond/filepond.css')?>" />
  <link rel="stylesheet" href="<?=base_url('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css')?>"
  />
  
</head>

<body class="  ">
  <!-- loader Start -->
  <!-- <div id="loading">
    <div class="loader simple-loader">
      <div class="loader-body"></div>
    </div>    </div> -->
    <!-- loader END -->