<div class="ui middle aligned center aligned grid">
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row">
    <div class="five wide column">
      <form class="ui large form" enctype="multipart/form-data" method="POST" action="<?php echo base_url('mahasiswa/seminar') ?>">

        <div class="ui stacked segment" style="border-radius: 20px; box-shadow: 0px 0px 20px #c9c9c9;">
          <h4 class="header">Submit Tanggal Seminar Tugas Akhir</h4>
          <div class="field">

              <input type="text" name="tema" placeholder="Tema Seminar">

          </div>
          <div class="field">
            <div class="ui calendar" id="kalender_mulai">

                <input type="text" name="d_mulai" placeholder="Waktu Mulai Seminar">

            </div>
          </div>
          <div class="field">
            <div class="ui calendar" id="kalender_selesai">

                <input type="text" name="d_selesai" placeholder="Waktu Selesai Seminar">

            </div>
          </div>
          <div class="field">

              <input type="text" name="tempat" placeholder="Tempat Seminar">

          </div>
          <input type="submit" class="ui fluid large green submit button" style="border-radius: 20px;" value="Ajukan">
        </div>
      </form>
    </div>
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
    // $('#kalender_mulai').calendar();
    $('#kalender_mulai').calendar({
      ampm: false,
      monthFirst: false,
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          return year + '/' + month + '/' + day;
        }
      }
    });
    $('#kalender_selesai').calendar({
      ampm: false,
      monthFirst: false,
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          return year + '/' + month + '/' + day;
        }
      }
    });
    // $('#kalender_selesai').calendar();
  });
</script>

</html>
