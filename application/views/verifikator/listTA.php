<div class="ui middle aligned center aligned grid"> <!-- grid -->
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row">
    <div class="fourteen wide column">
    <table id="listTA" class="ui celled table">
      <thead>
        <tr>
            <th>ID</th>
          <th>NRP</th>
          <th>Judul Proposal Tugas Akhir</th>
          <th>RMK</th>
          <th>Dosen Pembimbing 1</th>
          <th>Dosen Pembimbing 2</th>
          <th>Action</th>
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

<div id="act" class="ui modal mini">
  <!--<div class="ui icon header">

    Konfirmasi Perubahan Status
  </div>-->
  <div class="content">
    <p id="pesan"></p>
  </div>
  <div class="actions">
    <div class="ui red ok button">
      <!--<i class="remove icon"></i>-->
      Tolak
    </div>
    <div id="revisi" class="ui yellow ok button">
      <!--<i class="remove icon"></i>-->
      Revisi
    </div>
    <div id="ubahButton" data-value="" class="ui green ok button">
      <!--<i class="checkmark icon"></i>-->
      Setuju
    </div>
  </div>
</div>

<div id="form1" class="ui modal mini" style="display:none;">
  <div class="actions">
    <div class="ui input">
      <input style="margin-right: 120px; height:100px; width: 330px;" type="text" placeholder="Revisi...">
    </div>
    <br><br>
    <div style="margin-right:120px;" data-value="" class="ui green ok button">
      <!--<i class="checkmark icon"></i>-->
      Submit
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
      $('#act').modal('show');
  });

  $('#ubahButton').click(function(){
    $.ajax({
      url: "<?php echo base_url("verifikator/ubahStatusTA") ?>",
      method: "POST",
      data: {nrp: $(this).attr('data-value')}
    }).done(function(){
      setTimeout(function(){
         location.reload();
    }, 2000);
    });
  });

  $('#revisi').click(function(){
    $('#form1').modal('show');
  });

} );
</script>

</html>
