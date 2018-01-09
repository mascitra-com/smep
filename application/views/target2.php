<?php

require_once("header.php");
require_once("sidebar.php");
require_once("topnav.php");

?>
<style>
    td {
        vertical-align: middle !important;
    }
</style>
<div class="right_col" role="main">
    <div class="">


        <div class="clearfix"></div>


        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Target Realisasi SKPD Tahun Anggaran <?php echo $this->session->userdata('tahun_anggaran') ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Bulan</th>
                                <th width="30%">Target</th>
                                <th width="30%">Realisasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;
                            $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
                            foreach ($data as $t): ?>
                                <tr>
                                    <td><?php echo $i + 1?></td>
                                    <td><?php echo $arr_bulan[$i++] ?></td>
                                    <td>Rp. <?php echo number_format($t->target, 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($t->realisasi, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
    $(document).ready(function () {
        $('.currency').number(true, 0, ',', '.');
    });
</script>