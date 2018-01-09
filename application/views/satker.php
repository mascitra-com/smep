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
                    <h2>Tambah/Ubah SKPD</h2>                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>index.php/satker/simpan" novalidate>                      
                      <input type="hidden" name="id" id="id" value="<?php echo $form['id']; ?>" />
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kdsatker">Kode Satker <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?php echo $form['kdsatker']; ?>" name="kdsatker" id="kdsatker" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>                                           
                      <div class="item form-group">
                        <label for="namasatker" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Satker <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?php echo $form['namasatker']; ?>" name="namasatker" id="namasatker" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url(); ?>index.php/satker/index" class="btn btn-dark">Reset</a>
                          
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>              
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar SKPD</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>     
                          <th>No</th>                     
                          <th>Kode Satker</th>
                          <th>Nama Satker</th>
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
                          <td><?php  echo $d->kdsatker; ?></td>                          
                          <td><?php echo $d->namasatker; ?></td>
                          <td style="text-align: center; width: 40px">
                              <a href="<?php echo base_url() . "index.php/satker/index/" . $d->id; ?>"><img src="<?php echo base_url() . 'images/application_form_edit.png'; ?>" /></a>
                              <a onclick="javascript:confirm('Hapus data program?')" href="<?php echo base_url() . "index.php/satker/hapus/" . $d->id; ?>"><img src="<?php echo base_url() . 'images/cross.png'; ?>" /></a>
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
    
    <!-- PNotify -->
    <script src="<?php echo base_url(); ?>libs/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/pnotify/dist/pnotify.nonblock.js"></script>

     <!-- validator -->
    <script src="<?php echo base_url(); ?>libs/vendors/validator/validator.js"></script>

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
        $('#datatable-buttons').dataTable();        
      });
    </script>
    <?php if($msg == 'saved') { ?>
    <script>
         $(document).ready(function() {
            new PNotify({
                title: 'Pesan',
                text: 'Data berhasil disimpan!',
                type: 'success',
                styling: 'bootstrap3'
            });
         });    
    </script>
    <?php } ?>
  </body>
</html>

