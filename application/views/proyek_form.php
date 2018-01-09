<?php

require_once("header.php");
require_once("sidebar.php");
require_once("topnav.php");

?>
<!-- page content -->
<style>
    .dropzone {
        height: 175px;
        min-height: 0px !important;
    }
    .thumb {
        position: relative;
        float: left;
        margin-left: 10px;
    }
    .thumb img {
        width: auto;
        height: 150px;
        border-radius: 50%;
    }
    .checkbox {
        position: absolute;
        top: 10px;
        left: 15px;
    }
    input[type=checkbox]{
        -ms-transform: scale(1.5); /* IE */
        -moz-transform: scale(1.5); /* FF */
        -webkit-transform: scale(1.5); /* Safari and Chrome */
        -o-transform: scale(1.5); /* Opera */
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Tambah Proyek</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" method="post"
                              action="<?php echo base_url(); ?>index.php/proyek/simpan" novalidate>
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rup_id">ID RUP <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <input type="number" id="rup_id" name="rup_id"
                                           value="<?php echo $rup->id; ?>"
                                           class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                            </div>
                            <?php if ($data['id'] > 0) { ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-6" for="satker">No Urut <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 input-group">
                                        <input id="no_urut" class="form-control col-md-6 col-xs-12"
                                               data-validate-length-range="6" name="no_urut"
                                               value="<?php echo $data['no_urut']; ?>" readonly="readonly" type="text">
                                        <span class="input-group-btn"><button
                                                    onclick="javascript:location.href='<?php echo base_url(); ?>index.php/proyek/pilih_proyek/<?php echo $data['rup_id'] . '/' . $data['id'] . '/' . $data['no_urut']; ?>'"
                                                    type="button" id="pilih_no_urut"
                                                    class="btn btn-primary">Pilih</button>
                          <span>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satker">Satuan Kerja <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 input-group">
                                    <input id="kldi" class="form-control col-md-7 col-xs-12"
                                           data-validate-length-range="6" name="satker"
                                           value="<?php echo $rup->nama_satker; ?>" readonly="readonly" type="text">
                                    <?php if ($data['id'] > 0) { ?>
                                    <span class="input-group-btn"><button
                                                onclick="javascript:location.href='<?php echo base_url(); ?>index.php/proyek/pilih_rup/<?php echo $data['id'] . '/' . $data['rup_id'] . '/' . $data['no_urut']; ?>'"
                                                type="button" id="pilih_rup" class="btn btn-primary">Pilih</button>
                                        <?php } ?>
                                        <span>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_anggaran">Tahun
                                    Anggaran <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="tahun_anggaran" name="tahun_anggaran"
                                           value="<?php echo $rup->tahun_anggaran; ?>" readonly="readonly"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kdprogram">Kode Program
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="kdprogram" name="kdprogram"
                                           value="<?php echo $rup->kdprogram; ?>" readonly="readonly"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaprogram">Nama Program
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="namaprogram" name="namaprogram"
                                           value="<?php echo $rup->namaprogram; ?>" readonly="readonly"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kdkegiatan">Kode Kegiatan
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="kdkegiatan" type="text" name="kdkegiatan"
                                           value="<?php echo $rup->kdkegiatan; ?>" readonly="readonly"
                                           required="required" class="optional form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namakegiatan">Kegiatan
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="namakegiatan" name="namakegiatan"
                                           value="<?php echo $rup->namakegiatan; ?>" readonly="readonly"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="waktupemilihan" class="control-label col-md-3">Waktu Pemilihan
                                    Penyedia</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                    $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                    $waktu = $bulan[$rup->metode_awal - 1] . ' s.d. ' . $bulan[$rup->metode_akhir - 1];
                                    ?>
                                    <input id="waktupemilihan" type="text" value="<?php echo $waktu; ?>"
                                           readonly="readonly" name="waktupemilihan"
                                           class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="nama_paket" class="control-label col-md-3">Nama Paket Pekerjaan</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nama_paket" type="text" name="nama_paket"
                                           value="<?php echo $rup->nama_paket; ?>" readonly="readonly"
                                           class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <!--                      <div class="item form-group">
                                                    <label for="password" class="control-label col-md-3">Kode Pekerjaan/RUP</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input id="idpaket" type="number" name="idpaket" class="form-control col-md-7 col-xs-12" required="required">
                                                    </div>
                                                  </div> -->
                            <div class="item form-group">
                                <label for="lokasi" class="control-label col-md-3">Lokasi</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lokasi" type="text" name="lokasi" value="<?php echo $rup->lokasi; ?>"
                                           readonly="readonly" class="form-control col-md-7 col-xs-12"
                                           required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="volume" class="control-label col-md-3">Volume</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="volume" type="text" name="volume" value="<?php echo $rup->volume; ?>"
                                           readonly="readonly" class="form-control col-md-7 col-xs-12"
                                           required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pagu">Pagu <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo number_format($rup->pagu, 0, ',', '.') ?>"
                                           id="pagu"
                                           readonly class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="namappk" class="control-label col-md-3">Nama PPTK/PPK</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['nama_ppk']; ?>" id="namappk" type="text"
                                           name="nama_ppk" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Sumber Dana</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_multiple form-control" name="sumber_dana_id[]"
                                            id="sumber_dana_id" multiple="multiple">
                                        <?php
                                        foreach ($sdana as $s)
                                        {
                                        ?>
                                        <option value="<?php echo $s->id; ?>"<?php echo in_array($s->id, $sumber_dana) ? " selected=\"selected\"" : ""; ?>><?php echo $s->nama; ?></value>
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="jenis_belanja_id" class="control-label col-md-3 col-sm-3 col-xs-12">Belanja
                                    Langsung</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="jenis_belanja_id" type="hidden" value="<?=$rup->jenis_belanja_id?>" />
                                    <select class="form-control" id="jenis_belanja_id" disabled>
                                        <?php
                                        foreach ($jenis_belanja as $j)
                                        {
                                        ?>
                                        <option value="<?php echo $j->id; ?>"<?php echo $j->id == $rup->jenis_belanja_id ? " selected" : ''; ?>><?php echo $j->nama; ?></value>
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="jenis_pengadaan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis
                                    Pengadaan</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="jenis_pengadaan_id" type="hidden" value="<?=$rup->jenis_pengadaan_id?>" />
                                    <select class="form-control" id="jenis_pengadaan_id" disabled>
                                        <?php
                                        foreach ($jenis_pengadaan as $j)
                                        {
                                        ?>
                                        <option value="<?php echo $j->id; ?>"<?php echo $j->id == $rup->jenis_pengadaan_id ? " selected=\"selected\"" : ''; ?>><?php echo $j->nama; ?></value>
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metode_pemilihan_id">Metode
                                    Pemilihan Pengadaan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <input name="metode_pemilihan_id" type="hidden" value="<?=$rup->metode_pemilihan_id?>" />
                                    <select class="form-control" id="metode_pemilihan_id" disabled>
                                        <option value="<?php echo $rup->metode_pemilihan_id ?>" selected><?php echo $rup->nama_metode_pemilihan; ?></value>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="alert alert-info" role="alert"><b>Catatan : </b><span id="catatan"><?php echo isset($catatan) ? $catatan : "Diatas 5 Milyar" ?></span></div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis_pengadaan_id">Pengadaan
                                    Melalui <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                    <input name="jenis_pengadaan_id" type="hidden" value="<?=$rup->jenis_pengadaan_id?>" />
                                    <select class="form-control" name="pengadaan_melalui_id" id="pengadaan_melalui_id" disabled="">
                                        <option value="0" <?php echo isset($rup->pengadaan_melalui_id) && $rup->pengadaan_melalui_id == 0 ? 'selected' : '' ?>>Penyedia</option>
                                        <option value="1" <?php echo isset($rup->pengadaan_melalui_id) && $rup->pengadaan_melalui_id == 1 ? 'selected' : '' ?>>Swakelola</option>
                                    </select>
                                </div>
                            </div>
                                    
                                    <input name="tgl_awal" type="hidden" value="<?=$data['waktu_awal']?>" />
                                    <input name="tgl_awal" type="hidden" value="<?=$data['waktu_akhir']?>" />
                                
                            <div class="ln_solid"></div>
                            <div id="pelaksaan_perkerjaan">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pelaksanaan Pekerjaan</span>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_adendum">Tanggal
                                    Pengumuman Lelang</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['tgl_pengumuman']; ?>" type="text"
                                           class="form-control has-feedback-left" id="tgl_pengumuman"
                                           name="tgl_pengumuman" placeholder="Tanggal pengumuman lelang"
                                           aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_perusahaan">Nama
                                    Perusahaan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['nama_perusahaan']; ?>" type="text"
                                           id="nama_perusahaan" name="nama_perusahaan"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Perusahaan
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['alamat']; ?>" type="text" id="alamat" name="alamat"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="npwp">NPWP <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input data-inputmask="'mask' : '99.999.999.9-999.999'"
                                           value="<?php echo $data['npwp']; ?>" type="text" id="npwp" name="npwp"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_kontak">Nama Kontak
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['nama_kontak']; ?>" type="text" id="nama_kontak"
                                           name="nama_kontak" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">No Telepon <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['telp']; ?>" type="text" id="telp" name="telp"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nilai_kontrak">Nilai
                                    Kontrak <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="" type="text"
                                           id="nilai_kontrak" name="nilai_kontrak" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_kontrak">No Kontrak
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['no_kontrak']; ?>" type="text" id="no_kontrak"
                                           name="no_kontrak" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spesifikasi">Tanggal
                                    Kontrak <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['tgl_kontrak']; ?>" type="text"
                                           class="form-control has-feedback-left" id="tgl_kontrak" name="tgl_kontrak"
                                           placeholder="Tanggal kontrak" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_adendum">No
                                    Adendum</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['no_adendum']; ?>" type="text" id="no_adendum"
                                           name="no_adendum" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_adendum">Tanggal
                                    Adendum</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['tgl_adendum']; ?>" type="text"
                                           class="form-control has-feedback-left" id="tgl_adendum" name="tgl_adendum"
                                           placeholder="Tanggal adendum" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spesifikasi">Tanggal
                                    Selesai Kontrak
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?php echo $data['tgl_selesai']; ?>" type="text"
                                           class="form-control has-feedback-left" id="tgl_selesai" name="tgl_selesai"
                                           placeholder="Tanggal Selesai kontrak"
                                           aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="progres_id">Progres <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="progres_id" id="progres_id">
                                        <?php
                                        foreach ($progres as $p)
                                        {
                                        ?>
                                        <option value="<?php echo $p->id; ?>"<?php echo $p->id == $data['progres_id'] ? " selected=\"selected\"" : ''; ?>><?php echo $p->nama; ?></value>
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?php echo base_url(); ?>index.php/proyek/pilih_rup" class="btn btn-dark">Tambah
                                        Baru</a>
                                    <a href="<?php echo base_url(); ?>index.php/proyek" class="btn btn-primary">Kembali
                                        ke daftar Proyek</a>
                                </div>
                            </div>
                        </form>
                        <div class="ln_solid"></div>
                        <?php if($photos): ?>
                        <form action="<?php echo site_url('proyek/remove_multiple/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>" method="POST">
                            <?php $i = 4; $j = 7; $k = count($photos) ?>
                            <?php foreach ($photos as $photo): ?>
                                <?php if ($i % 4 == 0) {
                                    echo '<div class="row section">';
                                } ?>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                    <?php if (in_array($photo->ext, array('.jpg', '.jpeg', '.png'))) : ?>

                                    <div class="thumb">
                                        <input id="link-<?= $photo->id ?>" value="<?= $photo->photo ?>" hidden/>
                                        <a href="#" onclick="detail('photo-<?= $photo->id ?>')">
                                            <img src="<?= base_url('file/'.$photo->photo) ?>" alt="<?= $photo->name ?>"
                                                 id="photo-<?=$photo->id?>"/>
                                        </a>
                                        <input type="checkbox" class="checkbox" name="check_list[]"
                                               value="<?= $photo->id ?>"/>
                                    </div>
                                    <?php else: ?>
                                        <input type="checkbox" class="checkbox" name="check_list[]"
                                               value="<?= $photo->id ?>"/><br><br>
                                        <a href="<?php echo base_url('file/'.$photo->photo)?>" download="<?php echo $photo->name ?>"><?php echo $photo->name ?></a>
                                    <?php endif; ?>
                                </div>
                                <?php if ($i == $j || $i == ($k + 3)) {
                                    echo '</div>';
                                    $j += 4;
                                } ?>
                                <?php $i++; endforeach; ?>
                            <div class="form-group" style="margin-top:2em;">
                                <?php if (is_array($photos)) : ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                    <small>( Gunakan Checkbox di pojok kiri atas pada tiap file )</small>
                                <?php endif; ?>
                            </div>
                        </form>
                        <?php endif; ?>
                        <?php if($proyek_id = $this->uri->segment(4)): ?>
                            <br><br>
                        <form action="<?php echo  base_url('index.php/proyek/simpanFile/'.$proyek_id)?>" class="dropzone">
                            <div class="dz-message" data-dz-message><span>Drag & Drop Foto atau File Anda disini! <br> Format yang di dukung JPG, PNG, Word, Excel, PowerPoint, dan PDF</span></div>
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                        <?php endif; ?>
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

<!-- jquery.inputmask -->
<script src="<?php echo base_url(); ?>libs/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- jquery number-->
<script src="<?php echo base_url(); ?>libs/vendors/jquery.number/jquery.number.min.js"></script>
<script src="<?php echo base_url(); ?>libs/vendors/dropzone/dist/dropzone.js"></script>
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
    <?php if(isset($data['pengadaan_melalui_id']) && $data['pengadaan_melalui_id']): ?>
        $('#pelaksaan_perkerjaan').hide();
    <?php endif; ?>
    $('#pengadaan_melalui_id').change(function() {
        if($(this).val() === "0"){
            $('#pelaksaan_perkerjaan').show()
        } else {
            $('#pelaksaan_perkerjaan').hide()
        }
    });
    $(document).ready(function () {
        $(".select2_single").select2({
            placeholder: "Select a state",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            placeholder: "Pilih Sumber Dana",
            allowClear: true
        });
    });
</script>
<!-- /Select2 -->
<!-- cal -->
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
        $('#tgl_awal').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'DD/MM/YYYY'
            },
        });
        $('#tgl_akhir').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'DD/MM/YYYY'
            },
        });
        $('#tgl_kontrak').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'DD/MM/YYYY'
            },
        });
        $('#tgl_selesai_kontrak').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'DD/MM/YYYY'
            },
        });
        $('#tgl_pengumuman').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            locale: {
                format: 'DD/MM/YYYY'
            },
        });
        $('#tgl_adendum').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY'
            },
        }, function (chosen_date) {
            $('#tgl_adendum').val(chosen_date.format('DD/MM/YYYY'));
        });

        $('#tgl_selesai').daterangepicker({
            singleDatePicker: true,
            singleClasses: "picker_2",
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY'
            },
        }, function (chosen_date) {
            $('#tgl_selesai').val(chosen_date.format('DD/MM/YYYY'));
        });
        <?php if($data['nilai_kontrak']) : ?>
        $('#nilai_kontrak').val(<?php echo $data['nilai_kontrak']?>);
        <?php endif; ?>
        $('#nilai_kontrak').number( true, 0, ',', '.' );
    });
</script>
<?php if ($data['id'] > 0) { ?>
    <script>
        $(document).ready(function () {
            var selectedValues = new Array();
            selectedValues[0] = 1;
            selectedValues[1] = 2;

            $('#sumber_dana_id').val(selectedValues);
        });
    </script>
<?php } ?>

<!-- jquery.inputmask -->
<script>

    $(document).ready(function () {
        $("#npwp").inputmask();
    });
</script>
<!-- /jquery.inputmask -->

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

