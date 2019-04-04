<div class="ui middle aligned center aligned grid">
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row">
    <form class="ui large form" enctype="multipart/form-data" method="POST" action="<?php echo base_url('mahasiswa/ajukan') ?>">
      <div class="ui stacked segment" style="border-radius: 20px; box-shadow: 0px 0px 20px #c9c9c9;">
        <div class="field">

            <input type="text" name="judul" placeholder="Judul Tugas Akhir">

        </div>
        <div class="field">
          <div id="rmkx" class="ui fluid search selection dropdown">
            <input id="rmk" type="hidden" name="rmk">
            <i class="dropdown icon"></i>
            <div class="default text">RMK</div>
            <div class="menu">
              <div class="item" data-value="1">RPL</div>
              <div class="item" data-value="2">NCC</div>
              <div class="item" data-value="3">KCV</div>
              <div class="item" data-value="4">AJK</div>
              <div class="item" data-value="5">IGS</div>
              <div class="item" data-value="6">ALPRO</div>
              <div class="item" data-value="7">MI</div>
              <div class="item" data-value="8">DTK</div>
            </div>
          </div>
        </div>
        <div class="field">

            <input type="text" name="dosbing1" placeholder="Dosen Pembimbing 1">

        </div>
        <div class="field">

            <input type="text" name="dosbing2" placeholder="Dosen Pembimbing 2">

        </div>
        <div class="field">

            <input name="draftTA" type="file" id="file">

        </div>
        <input type="submit" class="ui fluid large green submit button" style="border-radius: 20px;" value="Submit">
      </div>
    </form>
  </div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
</div>

</body>
<script>
  $(document).ready(function() {
    $('#rmkx').dropdown();
  });
  </script>

</html>
