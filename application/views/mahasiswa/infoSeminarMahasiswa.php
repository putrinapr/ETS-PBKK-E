<div class="ui middle aligned center aligned grid"> <!-- grid -->
  <div class="row" style="margin-top: 20px;">
    <div class="eight wide column" style="border-radius: 20px; box-shadow: 0px 0px 20px #c9c9c9; border-style: none;">
      <div class="ui top attached block header">Data Seminar Tugas Akhir</div>
      <div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Tema Seminar</h4></div>
            <div class="five wide column">
              <?php echo $seminar[0]['theme']; ?>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Tanggal Mulai</h4></div>
            <div class="five wide column">
              <?php echo $seminar[0]['start_date']; ?>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Tanggal Selesai</h4></div>
            <div class="five wide column">
              <?php echo $seminar[0]['end_date']; ?>
            </div>
          </div>
        </div>
        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Lokasi</h4></div>
            <div class="five wide column">
              <?php echo $seminar[0]['location']; ?>
            </div>
          </div>
        </div>

        <div class="ui attached segment">
          <div class="ui grid">
            <div class="three wide column"><h4>Status</h4></div>
            <div class="five wide column">
              <?php echo $seminar[0]['text']; ?>
            </div>
          </div>
        </div>

        <!--<div class="ui attached segment">
          <a class="ui green label"><?php echo $seminar[0]['text']; ?></a>
        </div>-->
      </div>
    </div>
  </div>
</div>

</body>
<script>
</script>

</html>
