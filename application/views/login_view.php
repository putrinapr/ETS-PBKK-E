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
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/reset.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/site.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/container.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/grid.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/header.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/image.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/menu.css'); ?>"">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/divider.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/segment.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/form.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/input.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/button.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/list.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/message.css'); ?>"">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/components/icon.css'); ?>"">

  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="crossorigin="anonymous"></script>
  <script src="<?php echo base_url('assets/semantic/components/form.js'); ?>"></script>
  <script src="<?php echo base_url('assets/semantic/components/transition.js'); ?>"></script>

  <style type="text/css">
    body {
      background-color: #FFFFFF;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            nrp: {
              identifier  : 'nrp',
              rules: [
                {
                  type   : 'empty',
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters!'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">

    <form class="ui large form" method="POST" action="<?php echo base_url('user/login') ?>">
      <div class="ui stacked segment" style="border-radius: 20px; box-shadow: 0px 0px 20px #c9c9c9;">
        <h2 class="ui black image header">
          <div class="content">
            Selamat Datang
          </div>
        </h2>
        <div class="field">


            <input type="text" name="nrp" placeholder="NRP/ID" style="border-radius: 20px;">

        </div>
        <div class="field">


            <input type="password" name="pass" placeholder="Password" style="border-radius: 20px;">

        </div>
        <div class="ui fluid large green submit button" style="border-radius: 20px;">Login</div>
      </div>

      <div class="ui error message"></div>

    </form>

      Belum punya akun? <a href="<?php echo base_url('user/register'); ?>">Daftar</a>

  </div>
</div>

</body>

</html>
