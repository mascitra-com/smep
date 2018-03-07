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
                        <h2>Daftar Rencana Umum Pengadaan (RUP) Tahun Anggaran 2017</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-lg-6" style="padding-left: 0 !important;">
                            <form action="<?=site_url('rup')?>" class="input-group" method="GET">
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
                                <th>Paket</th>
                                <th>Pagu</th>
                                <th>Jenis Pengadaan</th>
                                <th>Satuan Kerja</th>
                                <th>Lokasi</th>
                                <th width="10%">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($data as $d) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $d->id_rup; ?></td>
                                    <td><?php echo $d->nama_paket; ?></td>
                                    <td><?php echo number_format($d->pagu, 0, ',', '.'); ?></td>
                                    <td><?php echo $d->jenis_pengadaan; ?></td>
                                    <td><?php echo $d->nama_satker; ?></td>
                                    <td><?php echo $d->lokasi; ?></td>
                                    <td style="text-align: center; width: 40px">
                                        <a data-toggle="tooltip" data-placement="top" title="View RUP"
                                           href="<?php echo base_url() . "index.php/rup/form/" . $d->id . "/view"; ?>"><i
                                                    class="fa fa-eye"></i> View</a><br>
                                        <a data-toggle="tooltip" data-placement="top" title="Ubah RUP"
                                           href="<?php echo base_url() . "index.php/rup/form/" . $d->id; ?>"><img
                                                    src="<?php echo base_url() . 'images/application_form_edit.png'; ?>"/>
                                            Edit</a><br>
                                        <a data-toggle="tooltip" data-placement="top" title="Hapus RUP"
                                           href="<?php echo base_url() . "index.php/rup/hapus/" . $d->id; ?>"
                                           onclick="return confirm('Hapus data rup?');"><img
                                                    src="<?php echo base_url() . 'images/cross.png'; ?>"/> Hapus</a>
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
        Template by <a href="https://mascitra.com">mascitra.com</a>
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
    $(document).ready(function () {
        var handleDataTableButtons = function () {
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
                            action: function (e, dt, node, config) {
                                window.location.href = '<?php echo base_url(); ?>index.php/rup/form';
                            },
                            className: "btn-sm"
                        },
                        {
                            text: 'Excel',
                            action: function (e, dt, node, config) {
                                window.location.href = '<?php echo base_url(); ?>index.php/rup/export';
                            },
                            className: "btn-sm"
                        }
                    ],
                    responsive: true,
                });
            }
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();


        TableManageButtons.init();
    });
</script>
</body>
</html>

