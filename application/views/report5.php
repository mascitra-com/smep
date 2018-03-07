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
            font-size: 9pt;
        }

        tbody {
            font-size: 7pt;
        }
    </style>
</head>
<body>
<?php $arr_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'); ?>

<h5 align="center">REKAP JUMLAH PAKET RUP PER
    BULAN <?= strtoupper($arr_bulan[$bulan - 1]) ?> <?= $this->session->userdata('tahun_anggaran') ?></h5>

<table width="100%">
    <thead>
    <tr>
        <td class="text-center small bold" rowspan="3">NO</td>
        <td class="text-center small bold" rowspan="3">SKPD</td>
        <td class="text-center small bold" rowspan="3">TOTAL</td>
        <td class="text-center small bold" colspan="6">DIATAS 200 JUTA / EPROC</td>
        <td class="text-center small bold" colspan="3">DIBAWAH 200 JUTA / NON</td>
        <td class="text-center text-warp small bold" rowspan="3">E-PURCHASING</td>
        <td class="text-center text-warp small bold" rowspan="3">PENUNJUKAN LANGSUNG</td>
        <td class="text-center text-warp small bold" rowspan="3">SWAKELOLA</td>
    </tr>
    <tr>
        <td class="text-center text-warp small bold" colspan="2">BARANG / JASA</td>
        <td class="text-center text-warp small bold" colspan="2">KONSTRUKSI</td>
        <td class="text-center text-warp small bold" colspan="2">KONSULTAN</td>
        <td class="text-center text-warp small bold" rowspan="2">BARANG / JASA</td>
        <td class="text-center text-warp small bold" rowspan="2">KONSTRUKSI</td>
        <td class="text-center text-warp small bold" rowspan="2">KONSULTAN</td>
    </tr>
    <tr>
        <td class="text-center text-warp small bold">LELANG UMUM</td>
        <td class="text-center text-warp small bold">LELANG SEDERHANA</td>
        <td class="text-center text-warp small bold">UMUM</td>
        <td class="text-center text-warp small bold">PEMILIHAN LANGSUNG</td>
        <td class="text-center text-warp small bold">SELEKSI UMUM</td>
        <td class="text-center text-warp small bold">SELEKSI SEDERHANA</td>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;
    $keys = array('total', 'lelang_umum', 'lelang_sederhana', 'umum', 'pemilihan_langsung', 'seleksi_umum',
        'seleksi_sederhana', 'barang_jasa', 'konstruksi', 'konsultan', 'e_purchasing', 'penunjukan', 'swakelola');
    $jumlah = array_fill_keys($keys, 0);
    foreach ($satker as $list) {
        foreach ($keys as $key) {
            $jumlah["{$key}"] += isset($list["{$key}"]) ? (int)$list["{$key}"] : 0;
        }
        ?>
        <tr>
            <td class="text-center"><?= $i++ ?></td>
            <td><?= $list['namasatker'] ?></td>
            <td class="text-right pagu"><?= empty($list['total']) ? '- ' : monefy($list['total']) ?></td>
            <td class="text-right pagu"><?= empty($list['lelang_umum']) ? '- ' : monefy($list['lelang_umum']) ?></td>
            <td class="text-right pagu"><?= empty($list['lelang_sederhana']) ? '- ' : monefy($list['lelang_sederhana']) ?></td>
            <td class="text-right pagu"><?= empty($list['umum']) ? '- ' : monefy($list['umum']) ?></td>
            <td class="text-right pagu"><?= empty($list['pemilihan_langsung']) ? '- ' : monefy($list['pemilihan_langsung']) ?></td>
            <td class="text-right pagu"><?= empty($list['seleksi_umum']) ? '- ' : monefy($list['seleksi_umum']) ?></td>
            <td class="text-right pagu"><?= empty($list['seleksi_sederhana']) ? '- ' : monefy($list['seleksi_sederhana']) ?></td>
            <td class="text-right pagu"><?= empty($list['barang_jasa']) ? '- ' : monefy($list['barang_jasa']) ?></td>
            <td class="text-right pagu"><?= empty($list['konstruksi']) ? '- ' : monefy($list['konstruksi']) ?></td>
            <td class="text-right pagu"><?= empty($list['konsultan']) ? '- ' : monefy($list['konsultan']) ?></td>
            <td class="text-right pagu"><?= empty($list['e_purchasing']) ? '- ' : monefy($list['e_purchasing']) ?></td>
            <td class="text-right pagu"><?= empty($list['penunjukan']) ? '- ' : monefy($list['penunjukan']) ?></td>
            <td class="text-right pagu"><?= empty($list['swakelola']) ? '- ' : monefy($list['swakelola']) ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td></td>
        <td>Total</td>
        <?php foreach ($jumlah as $j) { ?>
            <td class="text-center"><?=empty($j) ? '-' : monefy($j)?></td>
        <?php } ?>
    </tr>
    </tbody>
</table>

</body>
<script>
    window.print();
</script>
</html>