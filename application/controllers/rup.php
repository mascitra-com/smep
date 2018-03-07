<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Rup extends CI_Controller {

	private $arr_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');

	public function __construct() {
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login/', 'refresh');
		}

		if (!in_array($this->session->userdata('level'), array(1, 4, 6))) {
			redirect('/login/', 'refresh');
		}
	}

	public function is_logged_in() {
		return $this->session->userdata('is_logged_in');
	}

	public function index() {
		$filter = "";
		if ($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$filter = sprintf(" AND a.satker_id=%d", $this->session->userdata('satker_id'));
		} else if($satker_id = $this->input->get('satker_id')){
            $data['satker_id'] = $satker_id;
            $filter = sprintf(" AND a.satker_id=%d", $satker_id);
        }
		$sql = sprintf("
			SELECT
				a.`id`, a.`id_rup`, a.`satker_id`, f.namasatker nama_satker, a.`tahun_anggaran`, a.`program_id`, a.`kegiatan_id`,
				a.`nama_paket`, a.`jenis_pengadaan_id`, b.nama jenis_pengadaan, a.`volume`, a.`lokasi`, a.`detail_lokasi`,
				a.`deskripsi`, a.`spesifikasi`, a.`sumber_dana`, a.`pagu`, a.`mak`, a.`metode_pemilihan_id`,
				a.`metode_awal`, a.`metode_akhir`, a.`waktu_awal`, a.`waktu_akhir`
			FROM
				rup a
			JOIN jenis_pengadaan b ON a.jenis_pengadaan_id = b.id
			JOIN program c ON a.program_id = c.id
			JOIN kegiatan d ON a.kegiatan_id = d.id
			JOIN metode_pemilihan3 e ON a.metode_pemilihan_id = e.id
			JOIN satker f ON a.satker_id = f.id
			WHERE a.tahun_anggaran = %d	" . $filter . "
			ORDER BY
				a.`id`
		", $this->session->userdata('tahun_anggaran'));

		$q = $this->db->query($sql);
		$data['data'] = $q->result_object();

        $q=$this->db->get('satker');
        $data['satker'] = $q->result_object();

		$this->load->view('rup', $data);
	}

	public function form($id = 0, $msg = '', $view = FALSE) {
		$params = array();
		$data = array(
			'id' => 0,
			'satker_id' => '',
			'tahun_anggaran' => $this->session->userdata('tahun_anggaran'),
			'id_rup' => 0,
			'program_id' => '',
			'kegiatan_id' => '',
			'nama_paket' => '',
			'jenis_pengadaan_id' => '',
			'volume' => '',
			'lokasi' => '',
			'detail_lokasi' => '',
			'deskripsi' => '',
			'spesifikasi' => '',
			'sumber_dana' => '',
			'pagu' => '',
			'mak' => '',
			'jenis_belanja_id' => '',
			'metode_pemilihan_id' => '',
			'metode_awal' => '',
			'metode_akhir' => '',
			'waktu_awal' => '',
			'waktu_akhir' => '',
		);

		if ($id > 0) {
			$q = $this->db->get_where('rup', array('id' => $id));
			$r = $q->row();
			$data = array(
				'id' => $r->id,
				'satker_id' => $r->satker_id,
				'tahun_anggaran' => $r->tahun_anggaran,
				'id_rup' => $r->id_rup,
				'program_id' => $r->program_id,
				'kegiatan_id' => $r->kegiatan_id,
				'nama_paket' => $r->nama_paket,
				'jenis_pengadaan_id' => $r->jenis_pengadaan_id,
				'volume' => $r->volume,
				'lokasi' => $r->lokasi,
				'detail_lokasi' => $r->detail_lokasi,
				'deskripsi' => $r->deskripsi,
				'spesifikasi' => $r->spesifikasi,
				'sumber_dana' => $r->sumber_dana,
				'pagu' => $r->pagu,
				'mak' => $r->mak,
				'jenis_belanja_id' => $r->jenis_belanja_id,
				'metode_pemilihan_id' => $r->metode_pemilihan_id,
				'pengadaan_melalui_id' => $r->pengadaan_melalui_id,
				'metode_awal' => $r->metode_awal,
				'metode_akhir' => $r->metode_akhir,
				'waktu_awal' => $r->waktu_awal,
				'waktu_akhir' => $r->waktu_akhir,
			);

			$metode = $this->db->get_where('metode_pemilihan3', array('id' => $r->metode_pemilihan_id))->result_array();
			$params['catatan'] = $metode[0]['keterangan'];
		}

		$q_satker = $this->db->get("satker");
		$q_namasatker = $this->db->get_where('satker', array('id' => $this->session->userdata('satker_id')));
		$q_program = $this->db->get_where("program", array("tahun_anggaran" => $this->session->userdata("tahun_anggaran")));
		$q_jenispengadaan = $this->db->get("jenis_pengadaan");
		if ($id > 0) {
		$q_metodepemilihan = $this->db->get_where("metode_pemilihan3", array('jenis_pengadaan_id'=> $r->jenis_pengadaan_id));
		} else {
		$q_metodepemilihan = $this->db->get_where("metode_pemilihan3", array('jenis_pengadaan_id'=> 1));
		}

		$params["satker"] = $q_satker->result_object();
		if ($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$s = $q_namasatker->row();
			$params['namasatker'] = $s->namasatker;
		}
		$params["program"] = $q_program->result_object();
		$params["jenispengadaan"] = $q_jenispengadaan->result_object();
		$params["metodepemilihan"] = $q_metodepemilihan->result_object();
		$params["data"] = $data;
		$params['msg'] = $msg;

		if ($id > 0) {
			$q_kegiatan = $this->db->get_where('kegiatan', array('program_id' => $data['program_id']));
			$params['kegiatan'] = $q_kegiatan->result_object();
		}
		$this->load->model('sumber_dana_m');
        $params['sumber_dana'] = $this->sumber_dana_m->get_all();
        if($view == 'view'){
            $this->load->view('rup_view', $params);
        } else {
            $this->load->view('rup_form', $params);
        }
	}

	public function get_kegiatan($program_id) {
		$data = "";
		$q = $this->db->get_where("kegiatan", array("program_id" => $program_id, "tahun_anggaran" => $this->session->userdata("tahun_anggaran")));

		foreach ($q->result_object() as $r) {
			echo "<option value=\"" . $r->id . "\">" . $r->kdkegiatan . " - " . $r->namakegiatan . "</option>";
		}
	}

	public function simpan() {
		if ($this->input->post('id') == 0) {
			$this->tambah();
		} else {
			$this->ubah();
		}
	}

	public function ubah() {
		$data = array(
			'satker_id' => ($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) ? $this->session->userdata('satker_id') : $this->input->post('satker_id'),
			'tahun_anggaran' => $this->input->post('tahun_anggaran'),
			'program_id' => $this->input->post('program_id'),
			'kegiatan_id' => $this->input->post('kegiatan_id'),
			'nama_paket' => $this->input->post('nama_paket'),
			'jenis_belanja_id' => $this->input->post('jenis_belanja_id'),
			'jenis_pengadaan_id' => $this->input->post('jenis_pengadaan_id'),
			'volume' => $this->input->post('volume'),
			'lokasi' => $this->input->post('lokasi'),
			'detail_lokasi' => $this->input->post('detail_lokasi'),
			'deskripsi' => $this->input->post('deskripsi'),
			'spesifikasi' => $this->input->post('spesifikasi'),
			'sumber_dana' => $this->input->post('sumber_dana'),
			'pagu' => str_replace('.', '', $this->input->post('pagu')),
			'mak' => $this->input->post('mak'),
			'metode_pemilihan_id' => $this->input->post('metode_pemilihan_id'),
			'pengadaan_melalui_id' => $this->input->post('pengadaan_melalui_id'),
			'metode_awal' => $this->input->post('metode_awal'),
			'metode_akhir' => $this->input->post('metode_akhir'),
			'waktu_awal' => $this->input->post('waktu_awal'),
			'waktu_akhir' => $this->input->post('waktu_akhir'),
			'id_rup' => $this->input->post('id_rup'),
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('rup', $data);

		redirect('/rup');
	}

	public function tambah() {
		$data = array(
			'satker_id' => ($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) ? $this->session->userdata('satker_id') : $this->input->post('satker_id'),
			'tahun_anggaran' => $this->input->post('tahun_anggaran'),
			'program_id' => $this->input->post('program_id'),
			'kegiatan_id' => $this->input->post('kegiatan_id'),
			'nama_paket' => $this->input->post('nama_paket'),
			'jenis_belanja_id' => $this->input->post('jenis_belanja_id'),
			'jenis_pengadaan_id' => $this->input->post('jenis_pengadaan_id'),
			'volume' => $this->input->post('volume'),
			'lokasi' => $this->input->post('lokasi'),
			'detail_lokasi' => $this->input->post('detail_lokasi'),
			'deskripsi' => $this->input->post('deskripsi'),
			'spesifikasi' => $this->input->post('spesifikasi'),
			'sumber_dana' => $this->input->post('sumber_dana'),
			'pagu' => str_replace('.', '', $this->input->post('pagu')),
			'mak' => $this->input->post('mak'),
			'metode_pemilihan_id' => $this->input->post('metode_pemilihan_id'),
			'pengadaan_melalui_id' => $this->input->post('pengadaan_melalui_id'),
			'metode_awal' => $this->input->post('metode_awal'),
			'metode_akhir' => $this->input->post('metode_akhir'),
			'waktu_awal' => $this->input->post('waktu_awal'),
			'waktu_akhir' => $this->input->post('waktu_akhir'),
			'id_rup' => $this->input->post('id_rup'),
		);

		$this->db->insert('rup', $data);

		redirect('/rup');
	}

	public function get_metode_pemilihan($jenis_pengadaan_id) {
		$metode = $this->db->get_where('metode_pemilihan3', array('jenis_pengadaan_id' => $jenis_pengadaan_id))->result();

		foreach ($metode as $r) {
			echo "<option value=\"" . $r->id . "\">" . $r->nama . "</option>";
		}
	}

	public function get_catatan_metode($metode_pemilihan_id) {
		$metode = $this->db->get_where('metode_pemilihan3', array('id   ' => $metode_pemilihan_id))->result_array();
		echo $metode[0]['keterangan'];
	}

	function hapus($id) {
		$this->db->delete('rup', array('id' => $id));
		redirect('/rup', 'refresh');
	}

	function export() {
		$filter = "";
		if ($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$filter = sprintf(" AND a.satker_id=%d", $this->session->userdata('satker_id'));
		}
		$sql = sprintf("
			SELECT
				a.`id_rup`, f.namasatker as nama_satker, a.`tahun_anggaran`, c.`namaprogram` as nama_program, d.`namakegiatan` as nama_kegiatan,
				a.`nama_paket`, g.nama as belanja_langsung, b.nama as jenis_pengadaan, h.nama as metode_pemilihan, i.nama as pengadaan_melalui, a.`volume`, a.`lokasi`, a.`detail_lokasi`,
				a.`deskripsi`, a.`spesifikasi`, a.`sumber_dana`, a.`pagu`, a.`mak`,
				a.`metode_awal`, a.`metode_akhir`, a.`waktu_awal`, a.`waktu_akhir`
			FROM
				rup a
			JOIN jenis_pengadaan b ON a.jenis_pengadaan_id = b.id
			JOIN program c ON a.program_id = c.id
			JOIN kegiatan d ON a.kegiatan_id = d.id
			JOIN metode_pemilihan3 e ON a.metode_pemilihan_id = e.id
			JOIN satker f ON a.satker_id = f.id
            JOIN jenis_belanja g ON a.jenis_belanja_id = g.id
            JOIN metode_pemilihan3 h ON a.metode_pemilihan_id = h.id
            JOIN pengadaan_melalui i ON a.pengadaan_melalui_id = i.id
			WHERE a.tahun_anggaran = %d	" . $filter . "
			ORDER BY
				a.`id`
		", $this->session->userdata('tahun_anggaran'));

		$q = $this->db->query($sql);

		$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
		$this->load->helper('download');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("title")
			->setDescription("description");
		for ($col = 'A'; $col !== 'X'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		$this->kop($objPHPExcel, "DAFTAR RENCANA UMUM PENGADAAN BARANG DAN JASA", 1);
		$this->kop($objPHPExcel, "PEMERINTAH KABUPATEN LUMAJANG", 2);
		$this->kop($objPHPExcel, "TAHUN " . $this->session->userdata('tahun_anggaran'), 3);
		$headTable = array('No.', 'ID RUP', 'Satuan Kerja', 'Tahun Anggaran', 'Program', 'Kegiatan', 'Nama Paket', 'Belanja Langsung',
			'Jenis Pengadaan', 'Metode Pemilihan Penyedia', 'Pengadaan Melalui', 'Volume', 'Lokasi', 'Detail Lokasi', 'Deskripsi', 'Spesifikasi', 'Sumber Dana',
			'Pagu', 'MAK', 'Awal Pemilihan Penyedia', 'Akhir Pemilihan Penyedia', 'Awal Waktu Pekerjaan', 'Akhir Waktu Pekerjaan');
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
		for ($i = 0; $i < 23; $i++) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $headTable[$i]);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, 5)->applyFromArray($styleArray);
			$col++;
		}

		// Mengambil data dari tabel excel
		$row = 6;
		$fields = $q->list_fields();

		foreach ($q->result() as $data) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $row - 5);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0, $row)->applyFromArray($styleArray);
			$col = 1;
			foreach ($fields as $field) {
				if (in_array($field, array('metode_awal', 'metode_akhir', 'waktu_awal', 'waktu_akhir'))) {
					$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, strip_tags($this->arr_bulan[$data->$field - 1]));
				} else {
					$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, strip_tags($data->$field));
				}
				$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray($styleArray);
				$col++;
			}
			$row++;
		}

		// Save it as an excel 2003 file
		$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');

		// It will be called file.xls
		header('Content-Disposition: attachment; filename="RUP.xls"');
		$objWriter->save('php://output');
	}

	private function kop($objPHPExcel, $text, $row) {
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->setCellValueByColumnAndRow(0, $row, $text);
		$sheet->mergeCells('A' . $row . ':W' . $row);
		$style = array(
			'font' => array(
				'bold' => true,
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
		);
		$sheet->getStyle('A' . $row . ':W' . $row)->applyFromArray($style);
	}
}