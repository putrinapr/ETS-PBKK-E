<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title><?php echo $title ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semanticui/dist/semantic.css'); ?>">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css"/>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
  <script src="<?php echo base_url('assets/semanticui/dist/semantic.js'); ?>"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    });
  </script>
  <style type="text/css">
    body {
      background-color: #ffffff;
    }
    body > .grid {
      height: 100%;
  </style>
</head>
<body>
  <div class="ui large top fixed menu transition visible" style="background-color: #c9c9c9; font-size: 15pt; display: flex !important;" ">
    <div class="ui container">
      <a href="<?php echo base_url('home'); ?>" class="item" style="color:white;"><img src="../assets/img/home.png" style="width: 95%;"></a>
      <!--<div class="ui simple dropdown item">
        <div style="color:white;">Proposal TA</div>
        <i class="dropdown icon"></i>
        <div class="menu">
          <a href="<?php echo base_url('dosen/list'); ?>" class="item">List Proposal TA</a>
        </div>
      </div>
      <div class="ui simple dropdown item">
        <div style="color:white;">Seminar</div>
        <i class="dropdown icon"></i>
        <div class="menu">
          <a href="<?php echo base_url('dosen/jadwal'); ?>" class="item">List Jadwal Seminar</a>
        </div>
      </div>-->
      <div class="right menu">
        <div class="ui simple dropdown item">
          <div style="color:white;">Hello, <?php echo $this->session->userdata('login_data')['name']?>! </div>
          <i class="dropdown icon"></i>
          <div class="menu">
            <a href="<?php echo base_url('user/logout'); ?>"class="item"><div style="color:black">Logout</div></a>
          </div>
        </div>
      </div>
    </div>
</div>
