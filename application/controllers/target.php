<?php

/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 7/24/2017
 * Time: 15:05
 */
class Target extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!$this->is_logged_in()) {
            redirect('/login/', 'refresh');
        }

        if (!in_array($this->session->userdata('level'), array(1, 4, 6))) {
            redirect('/login/', 'refresh');
        }
    }

    public function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }

    public function index()
    {
        if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
            $this->target_by_satker();
        } else {
            $this->all_target();
        }
    }

    public function target_by_satker(){
        $satker_id = $this->session->userdata('satker_id');
        $params['data'] = $this->db->select('target, realisasi, bulan')
            ->get_where('target', array('id_satker' => $satker_id, 'tahun' => $this->session->userdata('tahun_anggaran')))
            ->result_object();;
        $this->load->view('target2', $params);
    }

    public function all_target(){
        $q=$this->db->get('satker');
        $satker = $q->result_object();
        foreach ($satker as $key => $value) {
            $satker[$key]->target = $this->db->select('target, realisasi')->get_where('target', array('id_satker' => $value->id, 'tahun' => $this->session->userdata('tahun_anggaran')))->result_object();
        }
        $params['data'] = $satker;
        $this->load->view('target', $params);
    }

    public function export()
    {
        $q=$this->db->get('satker');
        $satker = $q->result_object();
        foreach ($satker as $key => $value) {
            $satker[$key]->target = $this->db->select('target, realisasi')->get_where('target', array('id_satker' => $value->id))->result_object();
        }
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->helper('download');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
            ->setDescription("description");
        for($col = 'A'; $col !== 'AN'; $col++) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $this->kop($objPHPExcel, "TARGET DAN REALISASI PENGADAAN BARANG DAN JASA", 1);
        $this->kop($objPHPExcel, "PEMERINTAH KABUPATEN LUMAJANG", 2);
        $this->kop($objPHPExcel, "TAHUN ". $this->session->userdata('tahun_anggaran'), 3);
        $this->kop($objPHPExcel, '', 4);
        $headTable = array('No.', 'Kode Satker', 'Nama Satker');
        $col = 0;
        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ));
        $temp = str_split('ABC');
        for ($i = 0; $i < 3; $i++) {
            $objPHPExcel->getActiveSheet()->mergeCells($temp[$i].'5:'.$temp[$i].'6');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $headTable[$i]);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 5)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 6)->applyFromArray($styleArray);
            $col++;
        }


        $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
        $count = 0;
        $alphabet = array();
        $i = 0;
        for($col = 'D'; $col !== 'AN'; $col++) {
            $alphabet[$i++] = $col;
        }
        for ($i = 3; $i < 39; $i+=3) {
            $objPHPExcel->getActiveSheet()->mergeCells($alphabet[$i - 3] . '5:'.$alphabet[$i-1].'5');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 5, $arr_bulan[$count++]);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i, 5)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i + 1, 5)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i + 2, 5)->applyFromArray($styleArray);
        }

        $count = 0;
        $temp = array('Target', 'Realisasi', '%');
        for ($i = 3; $i < 39; $i++) {
            if($count == 3) {
                $count = 0;
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 6, $temp[$count++]);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i, 6)->applyFromArray($styleArray);
        }

        // Mengambil data dari tabel excel
        $row = 7;
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ));

        $fields = $q->list_fields();

        foreach ($satker as $data) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $row - 5);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row)->applyFromArray($styleArray);
            $col = 1;
            foreach ($fields as $field) {
                if($field != 'id') {
                    $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, strip_tags($data->$field));
                    $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray);
                    $col++;
                }
            }
            $fields2 = array('target', 'realisasi', 'percent');
            foreach ($data->target as $target) {
                $target->percent = ($target->realisasi && $target->realisasi) ? number_format($target->target / $target->realisasi  * 100, 0) : 0;
                foreach ($fields2 as $field) {
                    $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, strip_tags($target->$field));
                    $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray);
                    $col++;
                }
            }
            $row++;
        }

        // Save it as an excel 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="Target.xls"');
        $objWriter->save('php://output');
    }

    public function simpan()
    {
        $januari = (array) $this->input->post('januari');
        $februari = (array) $this->input->post('februari');
        $maret = (array) $this->input->post('maret');
        $april = (array) $this->input->post('april');
        $mei = (array) $this->input->post('mei');
        $juni = (array) $this->input->post('juni');
        $juli = (array) $this->input->post('juli');
        $agustus = (array) $this->input->post('agustus');
        $september = (array) $this->input->post('september');
        $oktober = (array) $this->input->post('oktober');
        $november = (array) $this->input->post('november');
        $desember = (array) $this->input->post('desember');

        $this->db->distinct('id_satker');
        $this->db->select('id_satker as id');
        $id_satker = $this->db->from('target')->get()->result();
        foreach ($id_satker as $key => $value) {
            // Januari
            if($januari[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '1',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $januari[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Februari
            if($februari[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '2',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $februari[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Maret
            if($maret[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '3',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $maret[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // April
            if($april[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '4',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $april[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Mei
            if($mei[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '5',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $mei[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Juni
            if($juni[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '6',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $juni[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Juli
            if($juli[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '7',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $juli[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Agustus
            if($agustus[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '8',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $agustus[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // September
            if($september[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '9',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $september[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Oktober
            if($oktober[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '10',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $oktober[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // November
            if($november[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '11',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $november[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
            // Desember
            if($desember[$key]) {
                $where = array(
                    'id_satker' => $value->id,
                    'bulan' => '12',
                    'tahun' => $this->session->userdata('tahun_anggaran')
                );
                $this->db->set(array('target' => str_replace('.', '', $desember[$key])));
                $this->db->where($where);
                $this->db->update('target');
            }
        }
        redirect('target');
    }

    private function kop($objPHPExcel, $text, $row)
    {
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setCellValueByColumnAndRow(0, $row, $text);
        $sheet->mergeCells('A'.$row.':AM'.$row);
        $style = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $sheet->getStyle('A'.$row.':AM'.$row)->applyFromArray($style);
    }
}