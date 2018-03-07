<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Jumlah Paket RUP</title>
    <link href="<?php echo base_url(); ?>libs/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        thead {
            font-size: 7pt;
            font-weight: bold;
        }

        tbody {
            font-size: 7pt;
        }
    </style>
</head>
<body>
<?php $arr_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'); ?>

<h5 align="center">LAPORAN PELAKSANAAN PROGRAM / KEGIATAN PADA SATUAN KERJA PERANGKAT DAERAH</h5>
<h5 align="center">DI LINGKUNGAN PEMERINTAH KABUPATEN LUMAJANG TAHUN
    ANGGARAN <?= $this->session->userdata('tahun_anggaran') ?></h5>
<h5 ALIGN="center">
    SAMPAI DENGAN BULAN <?= strtoupper($arr_bulan[$bulan - 1]) ?> <?= $this->session->userdata('tahun_anggaran') ?></h5>

<table width="100%">
    <?php $count_sd = count((array)$sumber_dana); ?>
    <thead>
    <tr>
        <td class="text-center small bold" rowspan="2">No</td>
        <td class="text-center small bold" rowspan="2">Nama Program & Kegiatan</td>
        <td class="text-center small bold" rowspan="2">Kode</td>
        <td class="text-center small bold" rowspan="2">Lokasi</td>
        <td class="text-center small bold" rowspan="2">Vol</td>
        <td class="text-center small bold" rowspan="2">Nama PPK / PPTK</td>
        <td class="text-center small bold" colspan="<?= $count_sd ?>">SUMBER DANA</td>
        <td class="text-center small bold" rowspan="2">Jumlah Anggaran</td>
        <td class="text-center small bold" rowspan="2">Nilai Kontrak</td>
        <td class="text-center small bold" rowspan="2">Sisa Kontrak</td>
        <td class="text-center small bold" rowspan="2">Pelaksana Kegiatan</td>
        <td class="text-center small bold" colspan="2">Waktu Pelaks</td>
        <td class="text-center small bold" colspan="4">Realisasi Keuangan</td>
        <td class="text-center small bold" rowspan="2">Sisa Anggaran</td>
        <td class="text-center small bold" rowspan="2">Reals Keg</td>
        <td class="text-center small bold" rowspan="2">Ket</td>
    </tr>
    <tr>
        <?php foreach ($sumber_dana as $sumber) { ?>
            <td class="text-center small bold"><?= $sumber->nama ?> <br> Rp.</td>
        <?php } ?>
        <td class="text-center small bold">Mulai</td>
        <td class="text-center small bold">Selesai</td>
        <td class="text-center small bold">Bulan ini <br> Rp.</td>
        <td class="text-center small bold">Bulan lalu <br> Rp.</td>
        <td class="text-center small bold">Jumlah <br> Rp.</td>
        <td class="text-center small bold">%</td>
    </tr>
    <tr>
        <?php for ($i = 1; $i <= 19 + $count_sd; $i++) echo "<td class='text-center small bold'>$i</td>" ?>
    </tr>
    </thead>
    <tbody>
    <?php $no = 1; ?>
    <?php $noKeg = 1; ?>
    <?php
    $keys = array();
    foreach ($sumber_dana as $sd) {
        array_push($keys, $sd->nama);
    }
    $others = array('jumlah_anggaran', 'nilai_kontrak', 'sisa_kontrak', 'plksn', 'mulai', 'selesai', 'realisasi_bln_ini', 'realisasi_bln_lalu', 'jumlah', 'persen', 'sisa_anggaran', 'persen_kgtn');
    $keys = array_merge($keys, $others);
    $total = array_fill_keys($keys, 0);
    ?>
    <?php foreach ($program as $indexProg => $prog) { ?>
        <?php $noKeg = 1; ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="bold"><?= $prog['namaprogram'] ?></td>
            <?php for ($i = 0; $i <= 16 + $count_sd; $i++) echo "<td></td>" ?>
        </tr>
        <?php foreach ($prog['kegiatan'] as $indexKeg => $keg) { ?>
            <tr>
                <td></td>
                <td class="bold"><?= $keg['namakegiatan'] ?></td>
                <td class="bold"><?= $keg['kdkegiatan'] ?></td>
                <?php for ($i = 0; $i <= 15 + $count_sd; $i++) echo "<td></td>" ?>
            </tr>
            <?php foreach ($keg['rup'] as $indexRup => $rup) { ?>
                <tr>
                    <td></td>
                    <td><?= $rup['nama_paket'] ?></td>
                    <td></td>
                    <td><?= $rup['lokasi'] ?></td>
                    <td><?= $rup['volume'] ?></td>
                    <td><?= $rup['nama_ppk'] ?></td>
                    <?php foreach ($sumber_dana as $sd) { ?>
                        <td class="text-right">
                            <?= $rup['sumber_dana'] === $sd->nama ? number_format($rup['pagu'], 0, ',', '.') : '' ?>
                        </td>
                    <?php } ?>
                    <td class="text-right"><?= number_format($rup['pagu'], 0, ',', '.') ?></td>
                    <td class="text-right"><?= number_format($rup['nilai_kontrak'], 0, ',', '.') ?></td>
                    <td class="text-right"><?= number_format($rup['sisa_kontrak'], 0, ',', '.') ?></td>
                    <td><?= $rup['nama_perusahaan'] ?></td>
                    <td><?= date('d/m/Y', strtotime($rup['tgl_kontrak'])) ?></td>
                    <td><?= $rup['tgl_selesai_kontrak'] != '0000-00-00' ? date('d/m/Y', strtotime($rup['tgl_selesai_kontrak'])) : ''?></td>
                    <td class="text-right"><?= $rup['realisasi_bln_ini'] ? number_format($rup['realisasi_bln_ini'], 0, ',', '.') : '-'?></td>
                    <td class="text-right"><?= $rup['realisasi_bln_lalu'] ? number_format($rup['realisasi_bln_lalu'], 0, ',', '.') : '-'?></td>
                    <td class="text-right"><?= $rup['nilai_realisasi'] ? number_format($rup['nilai_realisasi'], 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $rup['persen_realisasi'] ? $rup['persen_realisasi'] : '0' ?></td>
                    <td class="text-right"><?= $rup['sisa_anggaran'] ? number_format($rup['sisa_anggaran'], 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $rup['sisa_anggaran'] ? $rup['persen_kegiatan'] : '0'?></td>
                    <td></td>
                </tr>
                <?php
                foreach ($sumber_dana as $key => $sd) {
                    if ($rup['sumber_dana'] === $sd->nama)
                        $total[$sd->nama] += $rup['pagu'];
                }
                $total['jumlah_anggaran'] += $rup['pagu'];
                $total['nilai_kontrak'] += $rup['nilai_kontrak'];
                $total['sisa_kontrak'] += $rup['sisa_kontrak'];
                $total['realisasi_bln_ini'] += $rup['realisasi_bln_ini'];
                $total['realisasi_bln_lalu'] += $rup['realisasi_bln_lalu'];
                $total['jumlah'] += $rup['nilai_realisasi'];
                $total['persen'] = $rup['persen_realisasi'] > 0 ? ((double)$rup['persen_realisasi'] + (double)$total['persen']) / 2 : $total['persen'];
                $total['sisa_anggaran'] += $rup['sisa_anggaran'];
                $total['persen_kgtn'] = $rup['persen_kegiatan'] > 0 ? ((double)$rup['persen_kegiatan'] + (double)$total['persen_kgtn']) / 2 : $total['persen_kgtn'];
            }
            ?>
        <?php } ?>
    <?php } ?>
    <tr>
        <?php for ($k = 0; $k < 6; $k++) echo "<td></td>" ?>
        <?php foreach ($total as $keyItem => $item) { ?>
            <td class="text-right"><?= !empty($item) ? number_format($item, 0, ',', '.') : '' ?> </td>
        <?php } ?>
        <td></td>
    </tr>
    </tbody>
</table>

</body>
<script>
    window.print();
</script>
</html>