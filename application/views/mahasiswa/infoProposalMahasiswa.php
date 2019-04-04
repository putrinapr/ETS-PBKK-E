<div class="ui middle aligned center aligned grid"> <!-- grid -->
  <div class="row" style="margin-top: 20px;">
    <div class="eight wide column" style="border-radius: 20px; box-shadow: 0px 0px 20px #c9c9c9; border-style: none;">

      <div>
        <div class="ui attached segment" >
          <div class="ui black image header">Data Proposal Tugas Akhir</div>
          <div class="ui grid" >
            <div class="three wide column"><h4>Judul Tugas Akhir</h4></div>
            <div class="five wide column">
              <?php echo $proposal[0]['title']; ?>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>RMK</h4></div>
            <div class="five wide column">
              <?php echo $proposal[0]['name']; ?>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Dosen Pembimbing 1</h4></div>
            <div class="five wide column">
              <?php echo $proposal[0]['dosbing1_name']; ?>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Dosen Pembimbing 2</h4></div>
            <div class="five wide column">
              <?php echo $proposal[0]['dosbing2_name']; ?>
            </div>
          </div>
        </div>

        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Proposal Tugas Akhir</h4></div>
            <div class="five wide column">
              <a href="<?php echo base_url('uploads/'.$proposal[0]['path']); ?>" target="_blank">File</a>
            </div>
          </div>
        </div>

        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Status</h4></div>
            <div class="five wide column">
              <?php echo $proposal[0]['text']; ?>
            </div>
          </div>
        </div>

        <!--<div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Nilai</h4></div>
            <div class="five wide column">
              <?php echo $proposal[0]['text']; ?>
              <p id="nilai"><p>
            </div>
          </div>
        </div>

        <div class="ui modal mini">
          <div style="float: left;" class="actions">
            123
          </div>
        </div>-->

        <!--<div class="ui attached segment">
          <a class="ui red label"><?php echo $proposal[0]['text']; ?></a>
        </div>-->
      </div>
    </div>
  </div>
</div>

</body>
<script>
$(document).ready(function() {
  $("#revisi").click(function() {
    $('.mini').modal('show');
  })
});
</script>

</html>
