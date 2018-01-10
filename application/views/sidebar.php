            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">                
                <ul class="nav side-menu">
                  <?php if(in_array($this->session->userdata('level'), array(1, 4, 5, 6))) { ?>
                  <li><a><i class="fa fa-home"></i> Halaman Utama <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?php echo anchor('/main/', 'Dashboard'); ?></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <?php if(in_array($this->session->userdata('level'), array(1, 4, 6))) { ?>
                  <li><a><i class="fa fa-edit"></i> Input Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?php echo anchor('/rup/', 'RUP'); ?></li>
                      <li><?php echo anchor('/proyek/', 'Proyek'); ?></li>
                      <li><?php echo anchor('/target/', 'Target'); ?></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <?php if(in_array($this->session->userdata('level'), array(1, 3, 5))) { ?>
                  <li><a><i class="fa fa-table"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?php echo anchor('/report/form', 'Cetak Laporan'); ?></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <?php if(in_array($this->session->userdata('level'), array(1, 2, 3))) { ?>
                  <li><a><i class="fa fa-clone"></i> Referensi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(in_array($this->session->userdata('level'), array(1, 2, 3))) { ?>
                      <li><?php echo anchor('/user/', 'User'); ?></li>
                      <?php } ?>
                      <?php if(in_array($this->session->userdata('level'), array(1))) { ?>
                      <li><?php echo anchor('/satker/', 'Satuan Kerja'); ?></li>
                      <li><?php echo anchor('/program/', 'Program'); ?></li>
                      <li><?php echo anchor('/kegiatan/', 'Kegiatan'); ?></li> 
                      <li><?php echo anchor('/sumberdana/', 'Sumber Dana'); ?></li>
                      <?php } ?>                     
                    </ul>
                  </li>             
                  <?php } ?>
                  <li><a><i class="fa fa-clone"></i> User <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><?php echo anchor('/profil/', 'Profil'); ?></li>
                      <li><?php echo anchor('/login/logout', 'Logout'); ?></li>
                    </ul>
                  </li>                  
                </ul>
              </div>              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">              
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>