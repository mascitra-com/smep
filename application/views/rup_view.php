<?php

require_once("header.php");
require_once("sidebar.php");
require_once("topnav.php");

?>
<style>
    .form-horizontal .detail-label {
        padding-top: 8px;
    }
    .form-group {
        margin-bottom: 0;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Rencana Umum Pengadaan (RUP)</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kldi">KLDI</label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    Pemerintah Kabupaten Lumajang
                                </label>
                            </div>
                            <?php if ($this->session->userdata('level') == 1) { ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satker_id">Satuan
                                        Kerja <span class="required">*</span>
                                    </label>
                                    <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                        foreach ($satker as $s) {
                                            if($s->id == $data['satker_id']){
                                                echo $s->kdsatker . " - " . $s->namasatker;
                                            }
                                        }
                                        ?>
                                    </label>
                                </div>
                            <?php } else { ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_anggaran">Satuan
                                        Kerja <span class="required">*</span>
                                    </label>
                                    <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                        <?php echo $namasatker; ?>
                                    </label>
                                </div>
                            <?php } ?>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_anggaran">Tahun
                                    Anggaran <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['tahun_anggaran']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_rup">ID RUP <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['id_rup']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program_id">Program <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                        foreach ($program as $p) {
                                            if($p->id == $data['program_id']){
                                                echo $p->kdprogram . " - " . $p->namaprogram;
                                            }
                                        }
                                        ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kegiatan_id">Kegiatan
                                    <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    if ($data['id'] > 0) {
                                        foreach ($kegiatan as $k) {
                                            if($k->id == $data['kegiatan_id'] )
                                            echo $k->kdkegiatan . " - " . $k->namakegiatan;
                                        }
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_paket">Nama Paket
                                    <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['nama_paket']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label for="jenis_belanja_id" class="control-label col-md-3 col-sm-3 col-xs-12">Belanja Langsung</label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php if($data['jenis_belanja_id'] == 1) { ?>
                                        Belanja Pegawai
                                    <?php } else if($data['jenis_belanja_id'] == 2) {?>
                                        Belanja Barang dan Jasa
                                    <?php } else { ?>
                                        Belanja Modal
                                    <?php } ?>
                                </label>
                            </div>
                            <!--TODO Sesuaikan di Excel Part 1-->
                            <div class="item form-group">
                                <label for="jenis_pengadaan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis
                                    Pengadaan</label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                        <?php
                                        foreach ($jenispengadaan as $j) {
                                            if($j->id == $data['jenis_pengadaan_id'])
                                            echo $j->nama;
                                        }
                                        ?>
                                </label>
                            </div>
                            <!--TODO Sesuaikan di Excel Part 2-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metode_pemilihan_id">Metode
                                    Pemilihan Penyedia <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    foreach ($metodepemilihan as $m) {
                                        if($m->id == $data['metode_pemilihan_id'])
                                        echo $m->nama;
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="alert alert-info" role="alert"><b>Catatan : </b><span id="catatan"><?php echo isset($catatan) ? $catatan : "Diatas 5 Milyar" ?></span></div>
                            </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengadaan_melalui_id">Pengadaan Melalui <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php if(isset($data['pengadaan_melalui_id']) && $data['pengadaan_melalui_id'] == 0) { ?>
                                        Penyedia
                                    <?php } else { ?>
                                        Swakelola
                                    <?php } ?>
                                </label>
                            </div>
                            <!--TODO Catatan Sesuai Excel -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="volume">Volume <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['volume']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lokasi">Lokasi <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['lokasi']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail_lokasi">Detail
                                    Lokasi <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['detail_lokasi']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Deskripsi <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['deskripsi']; ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spesifikasi">Spesifikasi
                                    <span class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['spesifikasi']; ?>
                                </label>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sumber Dana</span>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label for="sumberdana" class="control-label col-md-3 col-sm-3 col-xs-12">Sumber
                                    Dana</label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['sumber_dana'] ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pagu">Pagu <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <span id="pagu"></span>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mak">MAK <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $data['mak']; ?>
                                </label>
                            </div>
                            <div class="ln_solid"></div>
                            <div id="pemilihan_penyedia">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pemilihan Penyedia</span>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metodeawal">Awal <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
                                        foreach ($arr_bulan as $key => $bulan) {
                                            if($data['metode_awal'] == $key + 1){
                                                echo $arr_bulan[$key];
                                            }
                                        }
                                    ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metode_akhir">Akhir <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
                                    foreach ($arr_bulan as $key => $bulan) {
                                        if($data['metode_akhir'] == $key + 1){
                                            echo $arr_bulan[$key];
                                        }
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="ln_solid"></div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_awal">Waktu
                                    Pekerjaan</span>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_awal">Awal <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
                                    foreach ($arr_bulan as $key => $bulan) {
                                        if($data['waktu_awal'] == $key + 1){
                                            echo $arr_bulan[$key];
                                        }
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_akhir">Akhir <span
                                            class="required">*</span>
                                </label>
                                <label class="detail-label col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
                                    foreach ($arr_bulan as $key => $bulan) {
                                        if($data['waktu_akhir'] == $key + 1){
                                            echo $arr_bulan[$key];
                                        }
                                    }
                                    ?>
                                </label>
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
<!-- jquery number-->
<script src="<?php echo base_url(); ?>libs/vendors/jquery.number/jquery.number.min.js"></script>

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

    $('.multi.required').on('keyup blur', 'input', function () {
        validator.checkField.apply($(this).siblings().last()[0]);
    });

    $('form').submit(function (e) {
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

<!-- Select2 -->
<script>
    $(document).ready(function () {

        <?php if(isset($data['pengadaan_melalui_id']) && $data['pengadaan_melalui_id']): ?>
        $('#pemilihan_penyedia').hide();
        <?php endif; ?>
        $('#pengadaan_melalui_id').change(function() {
            if($(this).val() === "0"){
                $('#pemilihan_penyedia').show()
            } else {
                $('#pemilihan_penyedia').hide()
            }
        });
        <?php if($this->session->userdata('level') == 1) { ?>
        $(".select2_satker").select2({
            placeholder: "Pilih Satker",
            allowClear: true
        });
        <?php } ?>
        $(".select2_program").select2({
            placeholder: "Pilih Program",
            allowClear: true
        });
        $(".select2_kegiatan").select2({
            placeholder: "Pilih Kegiatan",
            allowClear: true
        });
        /* $(".select2_group").select2({});
         $(".select2_multiple").select2({
         maximumSelectionLength: 4,
         placeholder: "With Max Selection limit 4",
         allowClear: true
         }); */
        <?php if($data['pagu']): ?>
        $('#pagu').html(<?php echo $data['pagu']?>);
        <?php endif; ?>
        $('#pagu').number( true, 0, ',', '.' );
    });
</script>
<!-- /Select2 -->

<script>
    $(document).ready(function () {
        $("#jenis_pengadaan_id").change(function () {
            var id = $('#jenis_pengadaan_id option:selected').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/rup/get_metode_pemilihan/" + id,
                success: function (data) {
                    $("#metode_pemilihan_id").html(data);
                    var id = $('#metode_pemilihan_id option:selected').val();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/rup/get_catatan_metode/" + id,

                        success: function (data) {
                            $("#catatan").html(data);
                        }
                    });
                }
            });
        });
        $("#metode_pemilihan_id").change(function () {
            var id = $('#metode_pemilihan_id option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/rup/get_catatan_metode/" + id,

                success: function (data) {
                    $("#catatan").html(data);
                }
            });
        });
        $("#program_id").change(function () {
            var id = $('#program_id option:selected').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/rup/get_kegiatan/" + id,

                success: function (data) {
                    $("#kegiatan_id").html(data);
                },
                error: function (data) {
                    alert("tidak dapat load data kegiatan!");
                }
            });
        });
    });
</script>
<?php if ($msg == 'saved') { ?>
    <script>
        $(document).ready(function () {
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

