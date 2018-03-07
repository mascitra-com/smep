<?php

define('FPDF_FONTPATH',APPPATH .'plugins/fpdf/font/');
//require(APPPATH .'plugins/fpdf/fpdf.php');
require(APPPATH .'plugins/fpdf/PDF_MC_Tables.php');

$pdf=new PDF_MC_Table('L','mm','LEGAL');

$pdf->AddPage();

$pdf->SetFont('Arial','B',7);

$arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

$split_tgl = explode("/", $tgl);

$pdf->Cell(335,4,'DATA REALISASI PROSES PENGADAAN BARANG/JASA',0,1,'C');
$pdf->Cell(335,4,'DI LINGKUNGAN PEMERINTAH KABUPATEN LUMAJANG TAHUN ANGGARAN ' . $this->session->userdata('tahun_anggaran'),0,1,'C');
$pdf->Cell(335,4,'SAMPAI DENGAN ' . $split_tgl[0] . ' ' . strtoupper($arr_bulan[(int) $split_tgl[1] - 1]) .' ' . $this->session->userdata('tahun_anggaran'), 0, 1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',7);

if($jenis_pengadaan != '') {
    $pdf->Cell(10, 5, strtoupper($jenis_pengadaan), 0, 0, 'L');
    $pdf->Ln(5);    
}

$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(40, 8, 'Nama Program/Kegiatan', 1, 0, 'C');
$pdf->Cell(20, 8, 'Pagu/HPS', 1, 0, 'C');
$pdf->Cell(20, 8, 'Lokasi', 1, 0, 'C');
$pdf->Cell(12, 8, 'Vol', 1, 0, 'C');
$pdf->Cell(20, 4, 'Sumber Dana', 1, 0, 'C');
$pdf->Cell(20, 8, 'Nilai Kontrak', 1, 0, 'C');
$pdf->Cell(20, 8, 'Sisa Kontrak', 1, 0, 'C');
$pdf->Cell(25, 8, 'Rekanan', 1, 0, 'C');
$pdf->Cell(25, 8, 'Alamat', 1, 0, 'C');
$pdf->Cell(27, 8, 'NPWP', 1, 0, 'C');
$pdf->Cell(40, 8, 'Nomor Kontrak', 1, 0, 'C');
$pdf->Cell(20, 8, 'Tgl Kontrak', 1, 0, 'C');
$pdf->Cell(30, 4, 'Waktu Pelaks', 1, 0, 'C');
$pdf->Cell(10, 8, 'Ket', 1, 0, 'C');

$pdf->Ln(4);

$pdf->Cell(102, 4, '', 0, 0, 'C');
$pdf->Cell(10, 4, 'DAU', 1, 0, 'C');
$pdf->Cell(10, 4, 'DAK', 1, 0, 'C');
$pdf->Cell(177, 4, '', 0, 0, 'C');
$pdf->Cell(15, 4, 'Mulai', 1, 0, 'C');
$pdf->Cell(15, 4, 'Selesai', 1, 0, 'C');

$pdf->Ln(4);

$pdf->Cell(10, 4, '1', 1, 0, 'C');
$pdf->Cell(40, 4, '2', 1, 0, 'C');
$pdf->Cell(20, 4, '3', 1, 0, 'C');
$pdf->Cell(20, 4, '4', 1, 0, 'C');
$pdf->Cell(12, 4, '5', 1, 0, 'C');
$pdf->Cell(10, 4, '6', 1, 0, 'C');
$pdf->Cell(10, 4, '7', 1, 0, 'C');
$pdf->Cell(20, 4, '8', 1, 0, 'C');
$pdf->Cell(20, 4, '9', 1, 0, 'C');
$pdf->Cell(25, 4, '10', 1, 0, 'C');
$pdf->Cell(25, 4, '11', 1, 0, 'C');
$pdf->Cell(27, 4, '12', 1, 0, 'C');
$pdf->Cell(40, 4, '13', 1, 0, 'C');
$pdf->Cell(20, 4, '14', 1, 0, 'C');
$pdf->Cell(15, 4, '15', 1, 0, 'C');
$pdf->Cell(15, 4, '16', 1, 0, 'C');
$pdf->Cell(10, 4, '17', 1, 0, 'C');

$pdf->SetAligns(array('C', 'L', 'R', 'C', 'C', 'C','C','R','R','L', 'L', 'C', 'C', 'C', 'C', 'C'));

$pdf->Ln(4);
$pdf->SetWidths(array(10, 40, 20, 20, 12, 10, 10, 20, 20, 25, 25, 27, 40, 20, 15, 15, 10 ));

$no = 1;

$satker = '';

foreach ($data as $d) {
    if($satker != $d->namasatker) {
        $satker = $d->namasatker;
        $pdf->SetAligns(array('L'));
        $pdf->SetWidths(array(10+40+20+20+12+10+10+20+20+25+25+27+40+20+15+15+10));
        $pdf->Row(array($d->namasatker));    
        $pdf->SetWidths(array(10, 40, 20, 20, 12, 10, 10, 20, 20, 25, 25, 27, 40, 20, 15, 15, 10 ));
        $pdf->SetAligns(array('C', 'L', 'R', 'C', 'C', 'C','C','R','R','L', 'L', 'C', 'C', 'C', 'C', 'C'));
    }

    $q=$this->db->get_where('proyek_sumber_dana', array('proyek_id' => $d->proyek_id));    
    $s = array();
    foreach($q->result_object() as $r) {
        $s[] = $r->sumber_dana_id;
    }

    $pdf->Row(array($no, $d->nama_paket, $d->pagu, $d->lokasi, $d->volume, 
        in_array(1, $s) ? 'V' : '', in_array(2, $s) ? 'V' : '', $d->nilai_kontrak, 
        $d->sisa_kontrak, $d->nama_perusahaan, $d->alamat, $d->npwp, $d->no_kontrak, 
        DateTime::createFromFormat('Y-m-d', $d->tgl_kontrak)->format('d/m/Y'), 
        DateTime::createFromFormat('Y-m-d', $d->waktu_awal)->format('d/m/Y'), 
        DateTime::createFromFormat('Y-m-d', $d->waktu_akhir)->format('d/m/Y'), ''));
    $no++;
}

$pdf->Output();



/*
//$arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

//$filename = "REKAP_SETORAN_PAJAK_" . $arr_bulan[$_POST['bulan']] . $_SESSION['tahun_anggaran'] .  ".xls"; 
$filename = "test.xls";
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");   
?><html>
    <head></head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">NAMA PROGRAM/KEGIATAN</th>
                    <th rowspan="2">PAGU/HPS</th>
                    <th rowspan="2">LOKASI</th>
                    <th rowspan="2">VOL</th>
                    <th colspan="2">SUMBER DANA</th>                    
                    <th rowspan="2">NILAI KONTRAK (RP)</th>
                    <th rowspan="2">SISA KONTRAK (RP)</th>
                    <th rowspan="2">PELAKS PEKERJAAN/REKANAN</th>
                    <th rowspan="2">ALAMAT</th>
                    <th rowspan="2">NPWP</th>
                    <th rowspan="2">NOMOR KONTRAK</th>
                    <th rowspan="2">TGL KONTRAK</th>
                    <th colspan="2">WAKTU PELAKS.</th>                    
                    <th rowspan="2">KET.</th>
                </tr>
                <tr>
                    <th>DAU</th>
                    <th>DAK</th>
                    <th>MULAI</th>
                    <th>SELESAI</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $no = 1;
                    foreach($data as $d) {                
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $d->nama_paket; ?></td>
                    <td><?php echo $d->pagu; ?></td>
                    <td><?php echo $d->lokasi; ?></td>
                    <td><?php echo $d->volume; ?></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $d->nilai_kontrak; ?></td>
                    <td><?php echo $d->sisa_kontrak; ?></td>
                    <td><?php echo $d->nama_perusahaan; ?></td>
                    <td><?php echo $d->alamat; ?></td>
                    <td><?php echo $d->npwp; ?></td>
                    <td><?php echo $d->no_kontrak; ?></td>
                    <td><?php echo $d->tgl_kontrak; ?></td>
                    <td><?php echo $d->waktu_awal; ?></td>
                    <td><?php echo $d->waktu_akhir; ?></td>
                    <td></td>
                </tr>
                <?php
                    $no++;
                    }
                ?>
            </tbody>
        </table>
    </body>

</html>
*/