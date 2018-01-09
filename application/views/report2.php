<?php

define('FPDF_FONTPATH',APPPATH .'plugins/fpdf/font/');
//require(APPPATH .'plugins/fpdf/fpdf.php');
require(APPPATH .'plugins/fpdf/PDF_MC_Tables.php');

$pdf=new PDF_MC_Table('L','mm','LEGAL');

$pdf->AddPage();

$pdf->SetFont('Arial','B',7);

$arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

$split_tgl = explode('/', $tgl);

$pdf->Cell(335,4,'DATA REALISASI PROSES PENGADAAN BARANG/JASA',0,1,'C');
$pdf->Cell(335,4,'DI LINGKUNGAN PEMERINTAH KABUPATEN LUMAJANG TAHUN ANGGARAN ' . $this->session->userdata('tahun_anggaran'),0,1,'C');
$pdf->Cell(335,4,'SAMPAI DENGAN ' . $split_tgl[0] . ' ' . strtoupper($arr_bulan[(int) $split_tgl[1]]) .' ' . $this->session->userdata('tahun_anggaran'), 0, 1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',7);

if($jenis_pengadaan != '') {
    $pdf->Cell(10, 5, strtoupper($jenis_pengadaan), 0, 0, 'L');
    $pdf->Ln(5);    
}

$pdf->SetFont('Arial','', 5);

$pdf->Cell(8, 8, 'No', 1, 0, 'C');
$pdf->Cell(40, 8, 'Nama Program/Kegiatan', 1, 0, 'C');
$pdf->Cell(15, 8, 'Pagu/HPS', 1, 0, 'C');
$pdf->Cell(15, 8, 'Lokasi', 1, 0, 'C');
$pdf->Cell(10, 8, 'Vol', 1, 0, 'C');
$pdf->Cell(16, 4, 'Sumber Dana', 1, 0, 'C');
$pdf->Cell(56, 4, 'Progres', 1, 0, 'C');
$pdf->Cell(15, 8, 'Nilai Kontrak', 1, 0, 'C');
$pdf->Cell(15, 8, 'Sisa Kontrak', 1, 0, 'C');
$pdf->Cell(22, 8, 'Rekanan', 1, 0, 'C');
$pdf->Cell(22, 8, 'Alamat', 1, 0, 'C');
$pdf->Cell(25, 8, 'NPWP', 1, 0, 'C');
$pdf->Cell(35, 8, 'Nomor Kontrak', 1, 0, 'C');
$pdf->Cell(12, 8, 'Tgl Kontrak', 1, 0, 'C');
$pdf->Cell(24, 4, 'Waktu Pelaks', 1, 0, 'C');
$pdf->Cell(9, 8, 'Ket', 1, 0, 'C');

$pdf->Ln(4);

$pdf->Cell(88, 4, '', 0, 0, 'C');
$pdf->Cell(8, 4, 'DAU', 1, 0, 'C');
$pdf->Cell(8, 4, 'DAK', 1, 0, 'C');

$pdf->Cell(10, 4, 'Usulan', 1, 0, 'C');
$pdf->Cell(10, 4, 'Proses', 1, 0, 'C');
$pdf->Cell(14, 4, 'Tanda tangan', 1, 0, 'C');
$pdf->Cell(14, 4, 'Pelaksanaan', 1, 0, 'C');
$pdf->Cell(8, 4, 'PHO', 1, 0, 'C');

$pdf->Cell(146, 4, '', 0, 0, 'C');
$pdf->Cell(12, 4, 'Mulai', 1, 0, 'C');
$pdf->Cell(12, 4, 'Selesai', 1, 0, 'C');

$pdf->Ln(4);

$pdf->Cell(8, 4, '1', 1, 0, 'C');
$pdf->Cell(40, 4, '2', 1, 0, 'C');
$pdf->Cell(15, 4, '3', 1, 0, 'C');
$pdf->Cell(15, 4, '4', 1, 0, 'C');
$pdf->Cell(10, 4, '5', 1, 0, 'C');
$pdf->Cell(8, 4, '6', 1, 0, 'C');
$pdf->Cell(8, 4, '7', 1, 0, 'C');
$pdf->Cell(10, 4, '8', 1, 0, 'C');
$pdf->Cell(10, 4, '9', 1, 0, 'C');
$pdf->Cell(14, 4, '10', 1, 0, 'C');
$pdf->Cell(14, 4, '11', 1, 0, 'C');
$pdf->Cell(8, 4, '12', 1, 0, 'C');
$pdf->Cell(15, 4, '13', 1, 0, 'C');
$pdf->Cell(15, 4, '14', 1, 0, 'C');
$pdf->Cell(22, 4, '15', 1, 0, 'C');
$pdf->Cell(22, 4, '16', 1, 0, 'C');
$pdf->Cell(25, 4, '17', 1, 0, 'C');
$pdf->Cell(35, 4, '18', 1, 0, 'C');
$pdf->Cell(12, 4, '19', 1, 0, 'C');
$pdf->Cell(12, 4, '20', 1, 0, 'C');
$pdf->Cell(12, 4, '21', 1, 0, 'C');
$pdf->Cell(9, 4, '22', 1, 0, 'C');

$pdf->SetAligns(array('C', 'L', 'R', 'C', 'C', 'C','C','C','C','C','C','C','R','R','L', 'L', 'C', 'C', 'C', 'C', 'C'));

$pdf->Ln(4);
$pdf->SetWidths(array(8, 40, 15, 15, 10, 8, 8, 10, 10, 14, 14, 8, 15, 15, 22, 22, 25, 35, 12, 12, 12, 9 ));

$no = 1;

$satker = '';

foreach ($data as $d) {
    if($satker != $d->namasatker) {
        $satker = $d->namasatker;
        $pdf->SetAligns(array('L'));
        $pdf->SetWidths(array(10+40+20+20+12+10+10+20+20+25+25+27+40+20+15+15+10));
        $pdf->Row(array($d->namasatker));    
        $pdf->SetWidths(array(8, 40, 15, 15, 10, 8, 8, 10, 10, 14, 14, 8, 15, 15, 22, 22, 25, 35, 12, 12, 12, 9 ));
        $pdf->SetAligns(array('C', 'L', 'R', 'C', 'C', 'C','C','C','C','C','C','C','R','R','L', 'L', 'C', 'C', 'C', 'C', 'C'));
    }

    $q=$this->db->get_where('proyek_sumber_dana', array('proyek_id' => $d->proyek_id));    
    $s = array();
    foreach($q->result_object() as $r) {
        $s[] = $r->sumber_dana_id;
    }

    $pdf->Row(array($no, $d->nama_paket, $d->pagu, $d->lokasi, $d->volume, 
        in_array(1, $s) ? 'V' : '-', in_array(2, $s) ? 'V' : '-', 
        $d->progres_id == 1 ? 'V' : '-', 
        $d->progres_id == 2 ? 'V' : '-',
        $d->progres_id == 3 ? 'V' : '-',
        $d->progres_id == 4 ? 'V' : '-',
        $d->progres_id == 5 ? 'V' : '-', 
        number_format($d->nilai_kontrak, 0, ',', '.'), 
        number_format($d->sisa_kontrak, 0, ',', '.'), 
        $d->nama_perusahaan, $d->alamat, $d->npwp, $d->no_kontrak, 
        DateTime::createFromFormat('Y-m-d', $d->tgl_kontrak)->format('d/m/Y'), 
        DateTime::createFromFormat('Y-m-d', $d->waktu_awal)->format('d/m/Y'), 
        DateTime::createFromFormat('Y-m-d', $d->waktu_akhir)->format('d/m/Y'), ''));
    $no++;
}

$pdf->Output();
