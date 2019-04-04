<style>
#hovercard {
  box-shadow: 0 1px 7px rgba(0, 0, 0, 0.1);
  -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
  transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

#hovercard:hover {
  -webkit-transform: scale(1.25, 1.25);
  transform: scale(1.05, 1.05);
}

.dashboard {
  padding-left: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  margin: 0;
  color: #707070;
  -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
  transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.dashboard:hover {
  background-color: #f7f7f7;
}

</style>
<div style="background-color: #e2e2e2; width: 20%; height: 100%; float: left; position: fixed;">
   <h2 style="margin-top: 100px; margin-left: 20px;"><?php echo $this->session->userdata('login_data')["name"];?></h2>
   <h4 style="margin-top: 0; margin-left: 20px;"><?php echo $this->session->userdata('login_data')["nrp"];?></h4>
   <hr width="90%">
   <a href="<?php echo base_url('home'); ?>"><h3 class="dashboard">Dashboard</h3></a>
   <a href=<?php echo base_url('kaprodi/list'); ?>><h3 class="dashboard">List Proposal</h3></a>
</div>
<div class="ui middle aligned center aligned grid" style="margin-left: 300px;">
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <h1 style="font-size: 40pt;"><b>Welcome</b></h1>
  <div class="row">
    <div class="ui cards">
      <div id="hovercard" class="card"  style="border-radius: 20px;">
        <div class="content">
          <div class="header">List Proposal Tugas Akhir</div>
          <div class="description">
            List proposal tugas akhir mahasiswa.
          </div>
          <br>
          <img src="../assets/img/approval.png" width="50%" style="margin-left:60px;">
        </div>
        <a href=<?php echo base_url('kaprodi/list'); ?>>
          <div  align="center" style="color:#05a000; padding-bottom: 10px;">

            Lihat
          </div>
        </a>
      </div>
      <div id="hovercard" class="card"  style="border-radius: 20px;">
        <div class="content">
          <div class="header">List Seminar Tugas Akhir</div>
          <div class="description">
            List seminar tugas akhir mahasiswa.
          </div>
          <br>
          <img src="../assets/img/seminar.png" width="50%" style="margin-left:60px;">
        </div>
        <a href=<?php echo base_url('kaprodi/jadwal'); ?>>
          <div  align="center" style="color:#05a000; padding-bottom: 10px;">

            Lihat
          </div>
        </a>
      </div>
      <!--  <div class="card">
            <div class="content">
                <div class="header">List Seminar Tugas Akhir</div>
                <div class="description">
                    Melihat List Seminar Tugas Akhir mahasiswa dari berbagai RMK.
                </div>
            </div>
            <a href=<?php echo base_url('kaprodi/jadwal'); ?> class="ui bottom attached button" style="background-color:#2185D0;">
            <div style="color:white;">
                <i class="eye icon"></i>
                Lihat List
            </div>
            </a>
        </div>-->
    </div>
  </div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
  <div class="row"></div>
</div>

</body>

</html>
