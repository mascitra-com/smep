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
<?php $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'); ?>

<h5 align="center">REKAP JUMLAH PAKET RUP PER BULAN <?=strtoupper($arr_bulan[$bulan-1])?> <?=$this->session->userdata('tahun_anggaran')?></h5>

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
        <?php $i = 1; $keys = array('total', 'lelang_umum','lelang_sederhana', 'umum', 'pemilihan_langsung', 'seleksi_umum',
            'seleksi_sederhana', 'barang_jasa', 'konstruksi', 'konsultan', 'e_purchasing', 'penunjukan', 'swakelola');
        $jumlah = array_fill_keys($keys, 0);
        foreach ($satker as $list) {
            foreach ($keys as $key){
                $jumlah["{$key}"] += isset($list["{$key}"]) ? (int) $list["{$key}"] : 0;
            }
            ?>
        <tr>
            <td class="text-center"><?=$i++?></td>
            <td><?=$list['namasatker']?></td>
            <td class="text-center"><?=(!isset($list['total']) ? '- ' : (int) $list['total'])?></td>
            <td class="text-center"><?=(!isset($list['lelang_umum']) ? '- ' : (int) $list['lelang_umum'])?></td>
            <td class="text-center"><?=(!isset($list['lelang_sederhana']) ? '- ' : (int) $list['lelang_sederhana'])?></td>
            <td class="text-center"><?=(!isset($list['umum']) ? '- ' : (int) $list['umum'])?></td>
            <td class="text-center"><?=(!isset($list['pemilihan_langsung']) ? '- ' : (int) $list['pemilihan_langsung'])?></td>
            <td class="text-center"><?=(!isset($list['seleksi_umum']) ? '- ' : (int) $list['seleksi_umum'])?></td>
            <td class="text-center"><?=(!isset($list['seleksi_sederhana']) ? '- ' : (int) $list['seleksi_sederhana'])?></td>
            <td class="text-center"><?=(!isset($list['barang_jasa']) ? '- ' : (int) $list['barang_jasa'])?></td>
            <td class="text-center"><?=(!isset($list['konstruksi']) ? '- ' : (int) $list['konstruksi'])?></td>
            <td class="text-center"><?=(!isset($list['konsultan']) ? '- ' : (int) $list['konsultan'])?></td>
            <td class="text-center"><?=(!isset($list['e_purchasing']) ? '- ' : (int) $list['e_purchasing'])?></td>
            <td class="text-center"><?=(!isset($list['penunjukan']) ? '- ' : (int) $list['penunjukan'])?></td>
            <td class="text-center"><?=(!isset($list['swakelola']) ? '- ' : (int) $list['swakelola'])?></td>
        </tr>
        <?php } ?>
        <tr>
            <td></td>
            <td>Total</td>
            <?php foreach ($jumlah as $j) { ?>
                <td class="text-center"><?=empty($j) ? '-' : $j?></td>
            <?php } ?>
        </tr>
    </tbody>
</table>

</body>
<script>
    window.print();
</script>
</html>