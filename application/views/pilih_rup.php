<?php 

    require_once("header.php");
    require_once("sidebar.php");
    require_once("topnav.php");
    
?>   
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <!-- <div class="page-title">
              <div class="title_left">
                <h3>Rencana Umum Pengadaan (RUP)</h3>
              </div>              
            </div>

            <div class="clearfix"></div>

            -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pilih Rencana Umum Pengadaan</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>     
                          <th>No</th>                     
                          <th>Paket</th>
                          <th>Pagu</th>
                          <th>Jenis Pengadaan</th>
                          <th>Satuan Kerja</th>
                          <th>Lokasi</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $i=1;
                        foreach($data as $d) {
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php  echo $d->nama_paket; ?></td>
                          <td><?php echo number_format($d->pagu, 2, ',', '.'); ?></td>
                          <td><?php echo $d->jenis_pengadaan; ?></td>
                          <td><?php echo $d->nama_satker; ?></td>
                          <td><?php echo $d->lokasi; ?></td>
                          <td style="text-align: center; width: 40px">
                              <a href="<?php echo base_url() . "index.php/proyek/form/" . $d->id . "/" . $id . "/" . $no_urut; ?>"><img src="<?php echo base_url() . 'images/accept.png'; ?>" /></a>                               
                          </td>
                        </tr>
                        <?php
                          $i++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>              
            </div>
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
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>libs/vendors/nprogress/nprogress.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>libs/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/pdfmake/build/vfs_fonts.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>libs/build/js/custom.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#datatable-buttons').dataTable();        
      });
    </script>
  </body>
</html>

