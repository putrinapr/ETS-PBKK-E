  <div class="ui middle aligned center aligned grid"> <!-- grid -->
    <div class="row"></div>
    <div class="row"></div>
    <div class="row"></div>
    <div class="row">
      <div class="fourteen wide column">
      <table id="listTA" class="ui celled table">
        <thead>
          <tr>
              <th>User_ID</th>
            <th>NRP</th>
            <th>Judul Proposal Tugas Akhir</th>
            <th>Dosen Pembimbing 1</th>
            <th>Dosen Pembimbing 2</th>
            <th>RMK</th>
            <th>Button</th>
          </tr>
        </thead>
      </table>
      </div>
    </div>
    <div class="row"></div>
    <div class="row"></div>
    <div class="row"></div>
    <div class="row"></div>
    <div class="row"></div>
  </div>
  <div class="ui modal mini">
    <!--<div class="ui icon header">
      <i class="archive icon"></i>
      Konfirmasi Perubahan Status.
    </div>-->
    <div class="content">
      <p id="pesan"></p>
    </div>
    <div class="actions">
      <!--<div class="ui blue basic cancel inverted button">
        <i class="remove icon"></i>
        Tidak.
      </div>-->
      <div style="float: left;" class="ui dropdown">
        <input type="hidden" name="gender">
        <i class="dropdown icon"></i>
        <div class="default text">Nilai</div>
        <div class="menu">
          <div class="item" data-value="male">A</div>
          <div class="item" data-value="female">AB</div>
          <div class="item" data-value="female">B</div>
          <div class="item" data-value="female">BC</div>
          <div class="item" data-value="female">C</div>
          <div class="item" data-value="female">D</div>
          <div class="item" data-value="female">E</div>
        </div>
      </div>
      <div id="ubahButton" data-value="" class="ui green ok button">
        <i class="checkmark icon"></i>
        Konfirmasi
      </div>
    </div>
  </div>
</body>
<script>
  $(document).ready(function() {
    var table = $('#listTA').DataTable({
      "pageLength" : 5,
      "ajax": {
            url : "<?php echo base_url("dosen/getListTA") ?>",
            type : 'POST'
        },
      "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button>Action</button>"
        },
        {
            "targets": 2,
            "data": null,
            "render": function(data,type,row){
              return "<a href='<?php echo base_url('uploads') ?>/"+data[7]+"' target='_blank'>"+data[2]+"</a>";
            }
        } ]
    });

    $('#listTA tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $('#pesan').html("Status saat ini adalah<h3 style='color:#000'>"+data[6]+"</h3>");
        $('#ubahButton').attr("data-value",data[0]);
        $('.mini').modal('show');
        $('.ui.dropdown').dropdown();
    });

    $('#ubahButton').click(function(){
      $.ajax({
        url: "<?php echo base_url("kaprodi/ubahStatusTA") ?>",
        method: "POST",
        data: {nrp: $(this).attr('data-value')}
      }).done(function(){
        setTimeout(function(){
           location.reload();
      }, 2000);
      });
    });
} );
</script>

</html>
