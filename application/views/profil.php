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
                    <h2>Ubah Profil</h2>                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                    
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>index.php/profil/simpan" novalidate>                      
                      <input type="hidden" name="id" id="id" value="<?php echo $form['id']; ?>" />
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satker_id">SKPD <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  readonly="readonly" type="text" value="<?php echo $form['namasatker']; ?>" name="namasatker" id="namasatker" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>                                           
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?php echo $form['nama']; ?>" name="nama" id="nama" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>                                           
                      <div class="item form-group">
                        <label for="alamat" class="control-label col-md-3 col-sm-3 col-xs-12">Alamat </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?php echo $form['alamat']; ?>" name="alamat" id="alamat" class="form-control col-md-7 col-xs-12" />
                        </div>
                      </div>                      
                      <div class="item form-group">
                        <label for="nohp" class="control-label col-md-3 col-sm-3 col-xs-12">No HP </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?php echo $form['nohp']; ?>" name="nohp" id="nohp" class="form-control col-md-7 col-xs-12" />
                        </div>
                      </div>         
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  readonly="readonly" type="text" value="<?php echo $form['username']; ?>" name="username" id="username" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>
                      </div>                   
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password"  name="password" id="password" class="form-control col-md-7 col-xs-12" />
                        </div>
                      </div>     
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password2">Ulangi Password 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password"  name="password2" id="password2" class="form-control col-md-7 col-xs-12"  />
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Level <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                                $txtlevel = "";
                                if($form['level'] == 1) {
                                    $txtlevel = 'Administrator';
                                } else if($form['level'] == 2) {
                                    $txtlevel = 'Admin PPE';
                                } else if($form['level'] == 3) {
                                    $txtlevel = 'Admin Pembangunan';
                                } else if($form['level'] == 4) {
                                    $txtlevel = 'Admin SKPD';
                                } else if($form['level'] == 5) {
                                    $txtlevel = 'Pimpinan';
                                }
                             ?>
                            <input  readonly="readonly" type="text" value="<?php echo $txtlevel; ?>" name="username" id="username" class="form-control col-md-7 col-xs-12" required="required" />
                        </div>                        
                      </div>       
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button onsubmit="return isValidForm()" id="send" type="submit" class="btn btn-success">Simpan</button>                                               
                        </div>
                      </div>
                    </form>
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
        } else {
            var pass1 = $('#password').val();
            var pass2 = $('#password2').val();

            if(pass1 != pass2) {
                alert('Password tidak sesuai!');
                return false;
            }
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->

    
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

