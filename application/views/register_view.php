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
  <title>Daftar</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/semantic/semantic.css'); ?>">
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
  <script src="<?php echo base_url('assets/semantic/semantic.js'); ?>"></script>
  <script src="<?php echo base_url('assets/semantic/components/form.js'); ?>"></script>
  <script src="<?php echo base_url('assets/semantic/components/transition.js'); ?>"></script>

  <style type="text/css">
    body {
      background-color: #ffffff;
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
  $(document).ready(function() {
    $('#rmk').hide();
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
            nama: {
              identifier  : 'nama',
              rules: [
                {
                  type   : 'empty',
                }
              ]
            },
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
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
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
        });

      $('#rolex').dropdown();
      $('#rmkx').dropdown();
      $('#rolex').dropdown({
        onChange: function(value, text, $selectedItem) {
          console.log(value);
          if(value == 3 || value == 4){
            $('#rmk').show();
          }
          else{
            $('#rmk').hide();
            $('#rmkx').dropdown('clear');
          }
        }
    });
    });
  </script>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">

    <form class="ui large form" method="POST" action="<?php echo base_url('user/register') ?>">
      <div class="ui stacked segment" style="border-radius: 20px; box-shadow: 0px 0px 20px #c9c9c9;">
        <h2 class="ui black image header">
          <div class="content">
            Daftar
          </div>
        </h2>
        <div class="field">

            <input type="text" name="nrp" placeholder="NRP/ID" style="border-radius: 20px;">

        </div>
        <div class="field">

            <input type="text" name="nama" placeholder="Nama" style="border-radius: 20px;">

        </div>
        <div class="field">

            <input type="text" name="email" placeholder="E-mail" style="border-radius: 20px;">

        </div>
        <div class="field">

            <input type="password" name="pass" placeholder="Password" style="border-radius: 20px;">

        </div>
        <div class="field">
          <div id="rolex" class="ui fluid search selection dropdown" style="border-radius: 20px;">
            <input id="role" type="hidden" name="privilege">
            <i class="dropdown icon"></i>
            <div class="default text">Jabatan</div>
            <div class="menu">
              <!--<div class="item" data-value="1">Administrator</div>-->
              <!--<div class="item" data-value="2">Kepala Prodi</div>-->
              <!--<div class="item" data-value="3">Verifikator</div>-->
              <div class="item" data-value="4">Dosen</div>
              <div class="item" data-value="5">Mahasiswa</div>
            </div>
          </div>
        </div>
        <div id="rmk" class="field">
          <select id="rmkx" class="ui fluid search dropdown" multiple="" name="rmk[]">
            <option value="">RMK</option>
            <option value="1">RPL</option>
            <option value="2">NCC</option>
            <option value="3">KCV</option>
            <option value="4">AJK</option>
            <option value="5">IGS</option>
            <option value="6">ALPRO</option>
            <option value="7">MI</option>
            <option value="8">DTK</option>
          </select>
        </div>
        <div class="ui fluid large green submit button" style="border-radius: 20px;">Register</div>
      </div>

      <div class="ui error message"></div>

    </form>


      Sudah punya akun? <a href="<?php echo base_url('user/login'); ?>">Login</a>

  </div>
</div>

</body>

</html>
