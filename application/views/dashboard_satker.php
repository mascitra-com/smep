<?php 

    require_once("header.php");
    require_once("sidebar.php");
    require_once("topnav.php");
    
?>   



        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>
            
            <div class="row tile_count">
            <?php 
              $q1 = $this->db->query(sprintf("
                SELECT COUNT(*) jumlah FROM rup WHERE tahun_anggaran = %d AND satker_id = %d
              ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id')));
              $r1 = $q1->row();
            ?>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Total RUP</span>
              <div class="count"><?php echo number_format($r1->jumlah, 0, ',', '.'); ?></div>   
              <span class="count_bottom"> <a href="<?php echo base_url(); ?>index.php/rup">Lihat daftar RUP</a></span>           
            </div>
            <?php 
              $q2 = $this->db->query(sprintf("
                SELECT COUNT(*) jumlah FROM proyek WHERE tahun_anggaran = %d AND rup_id IN (SELECT id FROM rup WHERE tahun_anggaran = %d AND satker_id = %d)
              ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id')));
              $r2 = $q2->row();
            ?>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Total Proyek</span>
              <div class="count"><?php echo number_format($r2->jumlah, 0, ',', '.'); ?></div>   
              <span class="count_bottom"> <a href="<?php echo base_url(); ?>index.php/proyek">Lihat daftar Proyek</a></span>   
            </div>
            <?php 
              $q3 = $this->db->query(sprintf("
                SELECT COUNT(*) jumlah FROM proyek WHERE tahun_anggaran = %d AND progres_id = 5 AND rup_id IN (SELECT id FROM rup WHERE tahun_anggaran = %d AND satker_id = %d)
              ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id')));              
              $r3 = $q3->row();
            ?>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i> Proyek Selesai</span>
              <div class="count green"><?php echo number_format($r3->jumlah, 0, ',', '.'); ?></div>
              <span class="count_bottom"> <a href="<?php echo base_url(); ?>index.php/proyek">Lihat daftar Proyek</a></span>    
            </div>            
          </div>
          <!-- /top tiles -->

            <!-- -->
            <div class="row">
            <?php 
                $q_belum = $this->db->query(sprintf("                    
                    SELECT COUNT(a.id) jumlah
                    FROM rup a
                    WHERE a.tahun_anggaran = %d AND a.satker_id = %d
                    AND a.id NOT IN (SELECT rup_id FROM proyek WHERE tahun_anggaran = %d)                    
                ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id'), $this->session->userdata('tahun_anggaran')));

                $r_belum = $q_belum->row();

                 $q_sudah = $this->db->query(sprintf("                    
                    SELECT COUNT(a.id) jumlah
                    FROM rup a
                    WHERE a.tahun_anggaran = %d AND a.satker_id = %d AND a.id IN (SELECT rup_id FROM proyek WHERE tahun_anggaran = %d)                    
                ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id'), $this->session->userdata('tahun_anggaran')));

                $r_sudah = $q_sudah->row();

            ?>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>RUP</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>&nbsp;</p>
                      </th>                      
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info" style="width:100%">                            
                            <tr>
                                <td><p><i class="fa fa-square red"></i>Belum paket </p></td>
                                <td><?php echo number_format(($r_belum->jumlah/($r_belum->jumlah + $r_sudah->jumlah))*100, 0, ',', '.') ?>%</td>
                            </tr>
                            <tr>
                                <td><p><i class="fa fa-square green"></i>Sudah paket </p></td>
                                <td><?php echo number_format(($r_sudah->jumlah/($r_belum->jumlah + $r_sudah->jumlah))*100, 0, ',', '.') ?>%</td>
                            </tr>                            
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <?php 
                $q_proyek = $this->db->query(sprintf("
                    SELECT b.nama, IFNULL(a.jml, 0) jumlah FROM progres b
                    LEFT JOIN (
                        SELECT progres_id , COUNT(id) jml FROM proyek WHERE tahun_anggaran = %d 
                        AND rup_id IN (SELECT id FROM rup WHERE tahun_anggaran = %d AND satker_id = %d)
                        GROUP BY progres_id
                        ) a ON a.progres_id = b.id
                    GROUP BY b.nama
                    ORDER BY a.progres_id
                ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id')));

                $r_proyek = $q_proyek->result_object();

                $jumlah_proyek = 0;
                foreach($r_proyek as $r) {
                    $jumlah_proyek = $jumlah_proyek + $r->jumlah;
                }

                $warna = array('fa fa-square blue', 'fa fa-square green', 'fa fa-square purple', 'fa fa-square aero', 'fa fa-square red');
            ?>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Progres Paket</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>&nbsp;</p>
                      </th>                      
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas2" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                        <?php 
                        $i = 0;
                        foreach($r_proyek as $r) {
                        ?>
                          <tr>
                            <td>
                              <p><i class="<?php echo $warna[$i]; ?>"></i><?php echo $r->nama; ?> </p>
                            </td>
                            <td><?php echo $r->jumlah ? round(($r->jumlah/$jumlah_proyek) * 100) : 0?>%</td>
                          </tr>
                        <?php
                            $i++;
                        }
                        ?>                            
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <?php 
                $q_proyek2 = $this->db->query(sprintf("
                    SELECT b.nama, IFNULL(a.jml, 0) jumlah FROM jenis_pengadaan b
                    LEFT JOIN (
                        SELECT jenis_pengadaan_id , COUNT(id) jml FROM proyek WHERE tahun_anggaran = %d 
                        AND rup_id IN (SELECT id FROM rup WHERE tahun_anggaran = %d AND satker_id = %d)
                        GROUP BY jenis_pengadaan_id
                        ) a ON a.jenis_pengadaan_id = b.id
                    GROUP BY b.nama
                    ORDER BY a.jenis_pengadaan_id
                ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id')));

                $r_proyek2 = $q_proyek2->result_object();

                $jumlah_proyek2 = 0;
                foreach($r_proyek2 as $r) {
                    $jumlah_proyek2 = $jumlah_proyek2 + $r->jumlah;
                }

                $warna = array('fa fa-square blue', 'fa fa-square green', 'fa fa-square purple', 'fa fa-square aero', 'fa fa-square red');
            ?>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Jenis Pengadaan</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>&nbsp;</p>
                      </th>                      
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas3" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                        <?php 
                        $i = 0;
                        foreach($r_proyek2 as $r) {
                        ?>
                          <tr>
                            <td>
                              <p><i class="<?php echo $warna[$i]; ?>"></i><?php echo $r->nama; ?> </p>
                            </td>
                            <td><?php echo $r->jumlah ? round(($r->jumlah/$jumlah_proyek2) * 100) : 0?>%</td>
                          </tr>
                        <?php
                            $i++;
                        }
                        ?>                            
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <?php 
                $q_proyek3 = $this->db->query(sprintf("
                    SELECT b.nama, IFNULL(a.jml, 0) jumlah FROM jenis_belanja b
                    LEFT JOIN (
                        SELECT jenis_belanja_id , COUNT(id) jml FROM proyek WHERE tahun_anggaran = %d 
                        AND rup_id IN (SELECT id FROM rup WHERE tahun_anggaran = %d AND satker_id = %d)
                        GROUP BY jenis_belanja_id
                        ) a ON a.jenis_belanja_id = b.id
                    GROUP BY b.nama
                    ORDER BY a.jenis_belanja_id
                 ", $this->session->userdata('tahun_anggaran'), $this->session->userdata('tahun_anggaran'), $this->session->userdata('satker_id')));

                $r_proyek3 = $q_proyek3->result_object();

                $jumlah_proyek3 = 0;
                foreach($r_proyek3 as $r) {
                    $jumlah_proyek3 = $jumlah_proyek3 + $r->jumlah;
                }

                $warna = array('fa fa-square blue', 'fa fa-square green', 'fa fa-square purple', 'fa fa-square aero', 'fa fa-square red');
            ?>

              <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Jenis Belanja</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>&nbsp;</p>
                      </th>                      
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas4" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                        <?php 
                        $i = 0;
                        foreach($r_proyek3 as $r) {
                        ?>
                          <tr>
                            <td>
                              <p><i class="<?php echo $warna[$i]; ?>"></i><?php echo substr($r->nama, 8); ?> </p>
                            </td>
                            <td><?php echo $r->jumlah ? round(($r->jumlah/$jumlah_proyek3) * 100) : 0?>%</td>
                          </tr>
                        <?php
                            $i++;
                        }
                        ?>                            
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>

          <!-- end -->

            
          </div>
        </div>
        <!-- /page content -->

<!-- footer content -->
        <footer>
          <div class="pull-right">
              Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>libs/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>libs/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>libs/vendors/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>libs/build/js/custom.min.js"></script>   

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Belum paket",
              "Sudah paket"
            ],
            datasets: [{
              data: [<?php echo $r_belum->jumlah; ?>, <?php echo $r_sudah->jumlah; ?>],
              backgroundColor: [
                "#E74C3C",
                "#26B99A"
              ],
              hoverBackgroundColor: [
                "#E95E4F",  
                "#36CAAB"
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas2"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
            <?php foreach($r_proyek as $r) { ?>
                "<?php echo $r->nama; ?>", 
            <?php } ?>              
            ],
            datasets: [{
              data: [
                  <?php foreach($r_proyek as $r) { ?>
                        <?php echo $r->jumlah; ?>,
                    <?php } ?> 
              ],
              backgroundColor: [
                "#3498DB",
                "#26B99A",
                "#9B59B6",
                "#BDC3C7",                
                "#E74C3C"                                
              ],
              hoverBackgroundColor: [
                "#49A9EA",
                "#36CAAB",
                "#B370CF",
                "#CFD4D8",                
                "#E95E4F"                            
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas3"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
            <?php foreach($r_proyek2 as $r) { ?>
                "<?php echo $r->nama; ?>", 
            <?php } ?>              
            ],
            datasets: [{
              data: [
                  <?php foreach($r_proyek2 as $r) { ?>
                        <?php echo $r->jumlah; ?>,
                    <?php } ?> 
              ],
              backgroundColor: [
                "#3498DB",
                "#26B99A",
                "#9B59B6",
                "#BDC3C7",                
                "#E74C3C"                                
              ],
              hoverBackgroundColor: [
                "#49A9EA",
                "#36CAAB",
                "#B370CF",
                "#CFD4D8",                
                "#E95E4F"                            
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas4"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
            <?php foreach($r_proyek3 as $r) { ?>
                "<?php echo substr($r->nama, 8); ?>", 
            <?php } ?>              
            ],
            datasets: [{
              data: [
                  <?php foreach($r_proyek3 as $r) { ?>
                        <?php echo $r->jumlah; ?>,
                    <?php } ?> 
              ],
              backgroundColor: [
                "#3498DB",
                "#26B99A",
                "#9B59B6",
                "#BDC3C7",                
                "#E74C3C"                                
              ],
              hoverBackgroundColor: [
                "#49A9EA",
                "#36CAAB",
                "#B370CF",
                "#CFD4D8",                
                "#E95E4F"                            
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->
  </body>
</html>

