<?php

define('FPDF_FONTPATH',APPPATH .'plugins/fpdf/font/');
//require(APPPATH .'plugins/fpdf/fpdf.php');
require(APPPATH .'plugins/fpdf/PDF_MC_Tables.php');

$pdf=new PDF_MC_Table('P','mm','LEGAL');

$pdf->AddPage();

$pdf->SetFont('Arial','B',12);

$arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

$split_tgl = explode('/', $tgl);

$pdf->Cell(205,4,'DATA MONITORING DAN EVALUASI',0,1,'C');
$pdf->Cell(205,4,'DI LINGKUNGAN PEMERINTAH KABUPATEN LUMAJANG TAHUN ANGGARAN ' . $this->session->userdata('tahun_anggaran'),0,1,'C');
$pdf->Cell(205,4,'SAMPAI DENGAN ' . $split_tgl[0] . ' ' . strtoupper($arr_bulan[(int) $split_tgl[1]]) .' ' . $this->session->userdata('tahun_anggaran'), 0, 1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',11);

if($jenis_pengadaan != '') {
    $pdf->Cell(10, 5, strtoupper($jenis_pengadaan), 0, 0, 'L');
    $pdf->Ln(5);
}

$pdf->SetFont('Arial','B', 10);

$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(55, 8, 'Program', 1, 0, 'C');
$pdf->Cell(25, 8, 'Kegiatan', 1, 0, 'C');
$pdf->Cell(35, 8, 'Belanja Langsung', 1, 0, 'C');
$pdf->Cell(35, 8, 'Pengadaan Melalui', 1, 0, 'C');
$pdf->Cell(35, 8, 'Paket Pekerjaan', 1, 0, 'C');

$pdf->SetAligns(array('C', 'L', 'L', 'L', 'L', 'L'));

$pdf->Ln(8);
$pdf->SetWidths(array(10, 55, 25, 35, 35, 35));

$no = 1;
foreach ($data as $d) {
    $pdf->SetFont('Arial','', 8);
    $pdf->SetWidths(array(10, 55, 25, 35, 35, 35));
    $pdf->SetAligns(array('C', 'L', 'L', 'L', 'L', 'L'));
    $pdf->Row(array($no++, $d->nama_program, $d->nama_kegiatan, $d->belanja_langsung, $d->pengadaan_melalui, $d->paket_pekerjaan));

}

$pdf->Output();
