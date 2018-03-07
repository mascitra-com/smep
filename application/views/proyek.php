<?php

    require_once("header.php");
    require_once("sidebar.php");
    require_once("topnav.php");

?>
<style>
    button.edit {
        border: none;
        background: none;
    }
    table.table.table-striped.table-bordered {
        background: white;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url('libs/vendors/bootstrap-modal/css/bootstrap-modal.css')?>">
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">


            <div class="clearfix"></div>


            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Proyek Tahun Anggaran 2017</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="col-lg-6" style="padding-left: 0 !important;">
                          <form action="<?=site_url('proyek')?>" class="input-group" method="GET">
                              <select class="form-control" name="satker_id" id="satker">
                                  <option value="">Semua</option>
                                  <?php foreach ($satker as $item): ?>
                                      <option value="<?=$item->id?>"><?=$item->namasatker?></option>
                                  <?php endforeach; ?>
                              </select>
                              <div class="input-group-btn">
                                  <button type="submit" class="btn btn-default">Pilih</button>
                              </div>
                          </form>
                      </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>ID RUP</th>
                            <th width="15%">Paket</th>
                            <th>Nilai Kontrak</th>
                            <th>Jenis Pengadaan</th>
                            <th>Metode Pemilihan</th>
                            <th>Sumber Dana</th>
                            <th>Satuan Kerja</th>
                            <th>Progres</th>
                            <th>Perusahaan</th>
                            <th width="10%">&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $i = 1;
                        foreach($data as $d) {
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $d->id_rup; ?></td>
                          <td><?php echo $d->nama_paket; ?></td>
                          <td><?php echo number_format($d->nilai_kontrak, 0, ',' , '.'); ?></td>
                          <td><?php echo $d->jenis_pengadaan; ?></td>
                          <td><?php echo $d->metode_pemilihan; ?></td>
                          <td><?php echo $d->sumberdana; ?></td>
                          <td><?php echo $d->namasatker; ?></td>
                            <td><?php echo $d->progres; ?></td>
                            <td><?php echo $d->nama_perusahaan; ?></td>
                          <td style="text-align: center; width: 60px">
                              <button data-toggle="modal" onclick="realisasi('<?php echo $d->id; ?>')" class="edit"><img src="<?php echo base_url() . 'images/money_add.png'; ?>" /> Realisasi</button><br>
                              <a data-toggle="tooltip" data-placement="top" title="Ubah data proyek" href="<?php echo base_url() . "index.php/proyek/form/" . $d->rup_id . "/" . $d->id . "/" . $d->no_urut; ?>"><img src="<?php echo base_url() . 'images/application_form_edit.png'; ?>" /> Edit</a><br>
                              <a data-toggle="tooltip" data-placement="top" title="Hapus data proyek" href="<?php echo base_url() . "index.php/proyek/hapus/" . $d->id; ?>" onclick="return confirm('Hapus data rup?');"><img src="<?php echo base_url() . 'images/cross.png'; ?>"/> Hapus</a>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Realisasi Keuangan</h4>
            </div>
            <div class="modal-body" id="modal-body">
                <div class="row" id="tabel_realisasi" style="overflow-x: auto">
                    Belum ada realisasi
                </div>
                <div class="row">
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>index.php/proyek/simpan_realisasi" id="form_realisasi" novalidate>
                        <input type="hidden" name="proyek_id" id="proyek_id" />
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_adendum">Tanggal</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control has-feedback-left" id="tgl_realisasi" name="tgl" placeholder="Tanggal realisasi" aria-describedby="inputSuccess2Status2">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="jumlah" class="form-control col-md-7 col-xs-12" name="jumlah" required="required" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>

    </div>
</div>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>libs/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>libs/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/bootstrap-modal/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/bootstrap-modal/js/bootstrap-modalmanager.js"></script>

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

    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>libs/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>libs/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- jquery number-->
    <script src="<?php echo base_url(); ?>libs/vendors/jquery.number/jquery.number.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.0/jquery.form.min.js" integrity="sha384-E4RHdVZeKSwHURtFU54q6xQyOpwAhqHxy2xl9NLW9TQIqdNrNh60QVClBRBkjeB8" crossorigin="anonymous"></script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>libs/build/js/custom.min.js"></script>

    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              language: {
                  search: "_INPUT_",
                  searchPlaceholder: "Cari..."
              },
              pageLength: 50,
              dom: "Bfrtip",
              buttons: [
                {
                  text: 'Tambah',
                  action: function ( e, dt, node, config ) {
                      window.location.href = '<?php echo base_url(); ?>index.php/proyek/pilih_rup';
                  },
                  className: "btn-sm"
                },
                  {
                      text: 'Excel',
                      action: function ( e, dt, node, config ) {
                          window.location.href = '<?php echo base_url(); ?>index.php/proyek/export';
                      },
                      className: "btn-sm"
                  }
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();
        TableManageButtons.init();
      });
    </script>
    <script>
        function realisasi(id) {
            $('#proyek_id').val(id);
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/proyek/input_realisasi/' + id,
                method: 'GET'
            }).success(function(response) {
                $('#tabel_realisasi').html(response);
            });
            $('#myModal').modal();
        }
        $(document).ready(function() {
            $("#datatable-realisasi").DataTable({
                responsive: true
            });
            $('#tgl_realisasi').daterangepicker({
              singleDatePicker: true,
              singleClasses: "picker_2",
              locale: {
                format: 'DD/MM/YYYY'
              }
            });

            $("#form_realisasi").ajaxForm(function() {
                var id = $('#proyek_id').val();
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/proyek/input_realisasi/' + id,
                    method: 'GET'
                }).success(function(response) {
                    $('#tabel_realisasi').html(response);
                    $('#jumlah').val("");
                });
            });
            $('input#jumlah').number( true, 0, ',', '.' );

        });
    </script>
  </body>
</html>

