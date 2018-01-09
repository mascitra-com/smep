<?php

require_once("header.php");
require_once("sidebar.php");
require_once("topnav.php");

?>
<style>
    th, td { white-space: nowrap; }
    .DTFC_LeftBodyLiner {
        top: -14px !important;
    }
    tr.even > td {
        background-color: white;
    }
    th  {
        background-color: white;
    }
    .DTFC_LeftHeadWrapper {
        background-color: white;
    }
    table tbody td {
        min-width: 100px;
    }
</style>
<div class="right_col" role="main" style="overflow-x: visible">
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
                        <form action="<?php echo base_url('/index.php/target/simpan') ?>" method="post">
                            <div class="pull-right">
                            <input type="submit" value="Simpan" class="btn btn-primary">
                            </div>
                            <table id="datatable" class="table table-striped table-bordered display" cellspacing="0" width="100%" style="background-color: white">
                            <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Kode <br>Satker</th>
                                <th rowspan="2">Nama Satker</th>
                                <th colspan="3">Januari</th>
                                <th colspan="3">Feb</th>
                                <th colspan="3">Maret</th>
                                <th colspan="3">April</th>
                                <th colspan="3">Mei</th>
                                <th colspan="3">Juni</th>
                                <th colspan="3">Juli</th>
                                <th colspan="3">Agustus</th>
                                <th colspan="3">September</th>
                                <th colspan="3">Oktober</th>
                                <th colspan="3">November</th>
                                <th colspan="3">Desember</th>
                            </tr>
                            <tr>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>%</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach($data as $d) {
                                ?>
                                <tr>
                                    <td style="font-size: 8pt"><?php echo $i; ?></td>
                                    <td style="font-size: 8pt"><?php  echo $d->kdsatker; ?></td>
                                    <td style="font-size: 8pt"><?php echo $d->namasatker; ?></td>
                                    <td><input name="januari[]" value="<?php echo number_format($d->target[0]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" /></td>
                                    <td><?php echo number_format($d->target[0]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[0]->target && $d->target[0]->realisasi) ? number_format($d->target[0]->target / $d->target[0]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="februari[]" value="<?php echo number_format($d->target[1]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[1]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[1]->target && $d->target[1]->realisasi) ? number_format($d->target[1]->target / $d->target[0]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="maret[]" value="<?php echo number_format($d->target[2]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[2]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[2]->target && $d->target[2]->realisasi) ? number_format($d->target[2]->target / $d->target[2]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="april[]" value="<?php echo number_format($d->target[3]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" /></td>
                                    <td><?php echo number_format($d->target[3]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[3]->target && $d->target[3]->realisasi) ? number_format($d->target[3]->target / $d->target[3]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="mei[]" value="<?php echo number_format($d->target[4]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[4]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[4]->target && $d->target[4]->realisasi) ? number_format($d->target[4]->target / $d->target[4]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="juni[]" value="<?php echo number_format($d->target[5]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[5]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[5]->target && $d->target[5]->realisasi) ? number_format($d->target[5]->target / $d->target[5]->realisasi * 100, 0) : 0?></td>
                                    <td><input  name="juli[]" value="<?php echo number_format($d->target[6]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" /></td>
                                    <td><?php echo number_format($d->target[6]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[6]->target && $d->target[6]->realisasi) ? number_format($d->target[6]->target / $d->target[6]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="agustus[]" value="<?php echo number_format($d->target[7]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[7]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[7]->target && $d->target[7]->realisasi) ? number_format($d->target[7]->target / $d->target[7]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="september[]" value="<?php echo number_format($d->target[8]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[8]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[8]->target && $d->target[8]->realisasi) ? number_format($d->target[8]->target / $d->target[8]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="oktober[]" value="<?php echo number_format($d->target[9]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" /></td>
                                    <td><?php echo number_format($d->target[9]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[9]->target && $d->target[9]->realisasi) ? number_format($d->target[9]->target / $d->target[9]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="november[]" value="<?php echo number_format($d->target[10]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[10]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[10]->target && $d->target[10]->realisasi) ? number_format($d->target[10]->target / $d->target[10]->realisasi * 100, 0) : 0?></td>
                                    <td><input name="desember[]" value="<?php echo number_format($d->target[11]->target, 0, ',', '.') ?>" type="text" size="10" class="currency" ></td>
                                    <td><?php echo number_format($d->target[11]->realisasi, 0, ',', '.') ?></td>
                                    <td><?php echo ($d->target[11]->target && $d->target[0]->realisasi) ? number_format($d->target[1]->target / $d->target[11]->realisasi * 100, 0) : 0?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                            <br>
                        <input type="submit" value="Simpan" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
<script src="<?php echo base_url(); ?>libs/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?php echo base_url(); ?>libs/vendors/dataTables.net-fixedColumns/js/dataTables.fixedColumns.min.js"></script>

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
            if ($("#datatable").length) {
                $("#datatable").DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Cari..."
                    },
                    pageLength: 50,
                    dom: "Bfrtip",
                    buttons: [
                        {
                            text: 'Excel',
                            action: function ( e, dt, node, config ) {
                                window.location.href = '<?php echo base_url(); ?>index.php/target/export';
                            },
                            className: "btn-sm"
                        }
                    ],
                    scrollY:        "500px",
                    scrollX:        true,
                    scrollCollapse: true,
                    bScrollCollapse: true,
                    paging:         false,
                    searching: false,
                    fixedColumns:   {
                        leftColumns: 3
                    }
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

        $('.currency').number(true, 0, ',', '.');
        $('.currency').focus(function(){
            if (this.value == '0') {this.value = '';}
        });
        $('.currency').blur(function(){
            if (this.value == '') {this.value = '0';}
        });
    } );
</script>