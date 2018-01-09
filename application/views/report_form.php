<?php 

    require_once("header.php");
    require_once("sidebar.php");
    require_once("topnav.php");
    
?>   
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cetak Laporan Realisasi Proses Pengadaan Barang/Jasa</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
                    <form target="_blank" class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>index.php/report/cetak" novalidate>                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satker_id">Satuan Kerja <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_satker form-control" tabindex="-1" name="satker_id" id="satker_id">
                            <option value="0">Semua</option>
                            <?php
                                foreach($satker as $s) {
                                  echo "<option value=\"". $s->id ."\"" . ($s->id == $data['satker_id'] ? ' selected="selected"' : '') . ">".$s->kdsatker . " - " . $s->namasatker ."</option>";
                                }
                            ?>
                          </select>
                        </div>
                      </div>                                           
                      <div class="item form-group">
                        <label for="jenis_pengadaan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Pengadaan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="jenis_pengadaan_id" id="jenis_pengadaan_id">
                            <option value="0">Semua</option>
                              <?php
                                  foreach($jenispengadaan as $j) {
                                      echo "<option value=\"". $j->id ."\"" . ($j->id == $data['jenis_pengadaan_id'] ? ' selected="selected"' : '') . ">" . $j->nama . "</option>";
                                  }
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_adendum">Sampai dengan</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control has-feedback-left" id="tgl" name="tgl" placeholder="Tanggal realisasi" aria-describedby="inputSuccess2Status2">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>        
                      <div class="item form-group">
                        <label for="jenis_pengadaan_id" class="control-label col-md-3 col-sm-3 col-xs-12"> Laporan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="jenis_report" id="jenis_report">
                            <option value="report1">Laporan Rekapitulasi Lelang</option>                             
                            <option value="report2">Laporan TEPRA</option>    
                            <option value="report3">Laporan MONEV</option>                             
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="report1" name="xxxx" type="submit" class="btn btn-success">Cetak</button>
                        </div>
                      </div>
                    </form>
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
    <!-- validator -->
    <script src="<?php echo base_url(); ?>libs/vendors/validator/validator.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>libs/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- PNotify -->
    <script src="<?php echo base_url(); ?>libs/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>libs/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>libs/build/js/custom.min.js"></script>

    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
    <script>
      $(document).ready(function() {                     
        $('#tgl').daterangepicker({
          singleDatePicker: true,
          singleClasses: "picker_2",          
          locale: {
            format: 'DD/MM/YYYY'
          }
        });        
      });
    </script>
    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_satker").select2({
          placeholder: "Pilih Satker",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->
  </body>
</html>

