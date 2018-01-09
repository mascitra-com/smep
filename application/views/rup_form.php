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
                        <h2>Form Tambah Rencana Umum Pengadaan (RUP)</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" method="post"
                              action="<?php echo base_url(); ?>index.php/rup/simpan" novalidate>
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>"/>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kldi">KLDI <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="Pemerintah Kabupaten Lumajang" id="kldi"
                                           class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                           name="kldi" required="required" type="text" readonly="readonly">
                                </div>
                            </div>
                            <?php if ($this->session->userdata('level') == 1) { ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satker_id">Satuan
                                        Kerja <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="select2_satker form-control" tabindex="-1" name="satker_id"
                                                id="satker_id">
                                            <option></option>
                                            <?php
                                            foreach ($satker as $s) {
                                                echo "<option value=\"" . $s->id . "\"" . ($s->id == $data['satker_id'] ? ' selected="selected"' : '') . ">" . $s->kdsatker . " - " . $s->namasatker . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_anggaran">Satuan
                                        Kerja <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="namasatker" name="namasatker"
                                               value="<?php echo $namasatker; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12" readonly="readonly">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_anggaran">Tahun
                                    Anggaran <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="tahun_anggaran" name="tahun_anggaran"
                                           value="<?php echo $data['tahun_anggaran']; ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_rup">ID RUP <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="id_rup" name="id_rup"
                                           value="<?php echo $data['id_rup']; ?>" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program_id">Program <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_program form-control" tabindex="-1" name="program_id"
                                            id="program_id">
                                        <option></option>
                                        <?php
                                        foreach ($program as $p) {
                                            echo "<option value=\"" . $p->id . "\"" . ($p->id == $data['program_id'] ? ' selected="selected"' : '') . ">" . $p->kdprogram . " - " . $p->namaprogram . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kegiatan_id">Kegiatan
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="select2_kegiatan form-control" tabindex="-1" name="kegiatan_id"
                                            id="kegiatan_id">
                                        <?php
                                        if ($data['id'] > 0) {
                                            foreach ($kegiatan as $k) {
                                                echo "<option value=\"" . $k->id . "\"" . ($k->id == $data['kegiatan_id'] ? ' selected="selected"' : '') . ">" . $k->kdkegiatan . " - " . $k->namakegiatan . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_paket">Nama Paket
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nama_paket" value="<?php echo $data['nama_paket']; ?>" type="text"
                                           name="nama_paket" required="required"
                                           class="optional form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="jenis_belanja_id" class="control-label col-md-3 col-sm-3 col-xs-12">Belanja Langsung</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="jenis_belanja_id" id="jenis_belanja_id">
                                        <option value="1" <?php echo $data['jenis_belanja_id'] == 1 ? 'selected' : '' ?>>Belanja Pegawai</option>
                                        <option value="2" <?php echo $data['jenis_belanja_id'] == 2 ? 'selected' : '' ?>>Belanja Barang dan Jasa</option>
                                        <option value="3" <?php echo $data['jenis_belanja_id'] == 3 ? 'selected' : '' ?>>Belanja Modal</option>
                                    </select>
                                </div>
                            </div>
                            <!--TODO Sesuaikan di Excel Part 1-->
                            <div class="item form-group">
                                <label for="jenis_pengadaan_id" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis
                                    Pengadaan</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="jenis_pengadaan_id" id="jenis_pengadaan_id">
                                        <?php
                                        foreach ($jenispengadaan as $j) {
                                            echo "<option value=\"" . $j->id . "\"" . ($j->id == $data['jenis_pengadaan_id'] ? ' selected="selected"' : '') . ">" . $j->nama . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--TODO Sesuaikan di Excel Part 2-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metode_pemilihan_id">Metode
                                    Pemilihan Penyedia <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="metode_pemilihan_id" id="metode_pemilihan_id">
                                        <?php
                                        foreach ($metodepemilihan as $m) {
                                            echo "<option value=\"" . $m->id . "\"" . ($m->id == $data['metode_pemilihan_id'] ? ' selected="selected"' : '') . ">" . $m->nama . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="alert alert-info" role="alert"><b>Catatan : </b><span id="catatan"><?php echo isset($catatan) ? $catatan : "Diatas 5 Milyar" ?></span></div>
                            </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengadaan_melalui_id">Pengadaan Melalui <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="pengadaan_melalui_id" id="pengadaan_melalui_id">
                                        <option value="0" <?php echo isset($data['pengadaan_melalui_id']) && $data['pengadaan_melalui_id'] == 0 ? 'selected' : '' ?>>Penyedia</option>
                                        <option value="1" <?php echo isset($data['pengadaan_melalui_id']) && $data['pengadaan_melalui_id'] == 1 ? 'selected' : '' ?>>Swakelola</option>
                                    </select>
                                </div>
                            </div>
                            <!--TODO Catatan Sesuai Excel -->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="volume">Volume <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo $data['volume']; ?>" id="volume" name="volume"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lokasi">Lokasi <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo $data['lokasi']; ?>" id="lokasi" name="lokasi"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail_lokasi">Detail
                                    Lokasi <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo $data['detail_lokasi']; ?>" id="detail_lokasi"
                                           name="detail_lokasi" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="deskripsi">Deskripsi <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo $data['deskripsi']; ?>" id="deskripsi"
                                           name="deskripsi" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spesifikasi">Spesifikasi
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo $data['spesifikasi']; ?>" id="spesifikasi"
                                           name="spesifikasi" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sumber Dana</span>
                                </label>
                            </div>
                            <div class="item form-group">
                                <label for="sumberdana" class="control-label col-md-3 col-sm-3 col-xs-12">Sumber
                                    Dana</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="sumber_dana" id="sumber_dana">
                                        <option value="APBD"<?php echo "APBD" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            APBD
                                        </option>
                                        <option value="APBDP"<?php echo "APBDP" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            APBDP
                                        </option>
                                        <option value="APBN"<?php echo "APBN" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            APBN
                                        </option>
                                        <option value="APBNP"<?php echo "APBNP" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            APBNP
                                        </option>
                                        <option value="BLU"<?php echo "BLU" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            BLU
                                        </option>
                                        <option value="BLUD"<?php echo "BLUD" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            BLUD
                                        </option>
                                        <option value="BUMD"<?php echo "BUMD" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            BUMD
                                        </option>
                                        <option value="BUMN"<?php echo "BUMN" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            BUMN
                                        </option>
                                        <option value="Lainnya"<?php echo "Lainnya" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            Lainnya
                                        </option>
                                        <option value="PHLN"<?php echo "PHLN" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            PHLN
                                        </option>
                                        <option value="PNBP"<?php echo "PNBP" == $data['sumber_dana'] ? ' selected="selected"' : ''; ?>>
                                            PNBP
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pagu">Pagu <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="pagu" name="pagu"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mak">MAK <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?php echo $data['mak']; ?>" id="mak" name="mak"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
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
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="metode_awal" id="metode_awal">
                                        <option value="1"<?php echo "1" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Januari
                                        </option>
                                        <option value="2"<?php echo "2" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Februari
                                        </option>
                                        <option value="3"<?php echo "3" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Maret
                                        </option>
                                        <option value="4"<?php echo "4" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            April
                                        </option>
                                        <option value="5"<?php echo "5" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Mei
                                        </option>
                                        <option value="6"<?php echo "6" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Juni
                                        </option>
                                        <option value="7"<?php echo "7" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Juli
                                        </option>
                                        <option value="8"<?php echo "8" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Agustus
                                        </option>
                                        <option value="9"<?php echo "9" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            September
                                        </option>
                                        <option value="10"<?php echo "10" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Oktober
                                        </option>
                                        <option value="11"<?php echo "11" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Nopember
                                        </option>
                                        <option value="12"<?php echo "12" == $data['metode_awal'] ? ' selected="selected"' : ''; ?>>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metode_akhir">Akhir <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="metode_akhir" id="metode_akhir">
                                        <option value="1"<?php echo "1" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Januari
                                        </option>
                                        <option value="2"<?php echo "2" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Februari
                                        </option>
                                        <option value="3"<?php echo "3" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Maret
                                        </option>
                                        <option value="4"<?php echo "4" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            April
                                        </option>
                                        <option value="5"<?php echo "5" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Mei
                                        </option>
                                        <option value="6"<?php echo "6" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Juni
                                        </option>
                                        <option value="7"<?php echo "7" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Juli
                                        </option>
                                        <option value="8"<?php echo "8" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Agustus
                                        </option>
                                        <option value="9"<?php echo "9" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            September
                                        </option>
                                        <option value="10"<?php echo "10" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Oktober
                                        </option>
                                        <option value="11"<?php echo "11" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Nopember
                                        </option>
                                        <option value="12"<?php echo "12" == $data['metode_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Desember
                                        </option>
                                    </select>
                                </div>
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
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="waktu_awal" id="waktu_awal">
                                        <option value="1"<?php echo "1" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Januari
                                        </option>
                                        <option value="2"<?php echo "2" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Februari
                                        </option>
                                        <option value="3"<?php echo "3" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Maret
                                        </option>
                                        <option value="4"<?php echo "4" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            April
                                        </option>
                                        <option value="5"<?php echo "5" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Mei
                                        </option>
                                        <option value="6"<?php echo "6" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Juni
                                        </option>
                                        <option value="7"<?php echo "7" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Juli
                                        </option>
                                        <option value="8"<?php echo "8" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Agustus
                                        </option>
                                        <option value="9"<?php echo "9" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            September
                                        </option>
                                        <option value="10"<?php echo "10" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Oktober
                                        </option>
                                        <option value="11"<?php echo "11" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Nopember
                                        </option>
                                        <option value="12"<?php echo "12" == $data['waktu_awal'] ? ' selected="selected"' : ''; ?>>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waktu_akhir">Akhir <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="waktu_akhir" id="waktu_akhir">
                                        <option value="1"<?php echo "1" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Januari
                                        </option>
                                        <option value="2"<?php echo "2" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Februari
                                        </option>
                                        <option value="3"<?php echo "3" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Maret
                                        </option>
                                        <option value="4"<?php echo "4" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            April
                                        </option>
                                        <option value="5"<?php echo "5" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Mei
                                        </option>
                                        <option value="6"<?php echo "6" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Juni
                                        </option>
                                        <option value="7"<?php echo "7" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Juli
                                        </option>
                                        <option value="8"<?php echo "8" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Agustus
                                        </option>
                                        <option value="9"<?php echo "9" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            September
                                        </option>
                                        <option value="10"<?php echo "10" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Oktober
                                        </option>
                                        <option value="11"<?php echo "11" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Nopember
                                        </option>
                                        <option value="12"<?php echo "12" == $data['waktu_akhir'] ? ' selected="selected"' : ''; ?>>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?php echo base_url(); ?>index.php/rup/form" class="btn btn-dark">Tambah
                                        Baru</a>
                                    <a href="<?php echo base_url(); ?>index.php/rup" class="btn btn-primary">Kembali ke
                                        daftar RUP</a>
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
        $('#pagu').val(<?php echo $data['pagu']?>);
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

