<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proyek extends CI_Controller {	

	private $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->is_logged_in()) {
			redirect('/login/', 'refresh');
		}

		if(!in_array($this->session->userdata('level'), array(1, 4, 6))) {
			redirect('/login/', 'refresh');
		}
	}

	public function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }

    public function index()
    {
		$filter = "";
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$filter = sprintf(" AND b.satker_id=%d", $this->session->userdata('satker_id'));
		} else if($satker_id = $this->input->get('satker_id')){
            $filter = sprintf(" AND b.satker_id=%d", $satker_id);
            $data['satker_id'] = $satker_id;
        }

		$sql = sprintf("
			SELECT 
				a.`id`, b.id as `rup_id`, b.`id_rup`, a.`tahun_anggaran`, a.`nama_ppk`, a.`jenis_belanja_id`, a.`jenis_pengadaan_id`, a.
				`metode_pemilihan3_id`, a.`waktu_awal`, a.`waktu_akhir`, a.`nama_perusahaan`, a.`alamat`, a.`npwp`, a.
				`nama_kontak`, a.`telp`, a.`nilai_kontrak`, a.`no_kontrak`, a.`tgl_kontrak`, a.`no_adendum`, a.
				`tgl_adendum`, a.`progres_id`, a.`no_urut`, 
				b.nama_paket, c.nama jenis_pengadaan, d.nama metode_pemilihan, e.namasatker, a.tgl_selesai, f.nama as progres
			FROM 
				proyek a
			JOIN rup b ON a.rup_id = b.id	
			JOIN jenis_pengadaan c ON a.jenis_pengadaan_id = c.id
			JOIN metode_pemilihan3 d ON a.metode_pemilihan3_id = d.id
			JOIN satker e ON b.satker_id = e.id			
			JOIN progres f ON a.progres_id = f.id		
			WHERE a.tahun_anggaran = %d " . $filter . "
			ORDER BY 
				a.`id` DESC
			", $this->session->userdata('tahun_anggaran'));

		$q = $this->db->query($sql)->result_object();


		foreach($q as $key => $value) {
		    $this->db->select('a.id, a.proyek_id, a.sumber_dana_id, b.nama');
		    $this->db->from('proyek_sumber_dana a');
		    $this->db->join('sumber_dana b', 'a.sumber_dana_id = b.id');
		    $this->db->where('proyek_id',$value->id);
            $q_sumber_dana = $this->db->get();
    		$sdana =  $q_sumber_dana->result_object();
			$sumberdana = '';
			foreach($sdana as $s) {
		        $sumberdana .= ($s->nama ." ");
			}
			$q[$key]->sumberdana = $sumberdana;
		}
		$data['data'] = $q;

        $q=$this->db->get('satker');
        $data['satker'] = $q->result_object();
        $this->load->view('proyek', $data);
    }

	public function form($rup_id, $id = 0, $no_urut = 0, $msg = '') 
	{
        $params=array();
        $data = array(
			'id' => 0, 
			'rup_id' => $rup_id, 
			'tahun_anggaran' => $this->session->userdata('tahun_anggaran'), 
			'nama_ppk' => '', 
			'jenis_belanja_id' => '', 
			'jenis_pengadaan_id' => '', 
			'metode_pemilihan3_id' => '',
			'waktu_awal' => date('d/m/Y'), 
			'waktu_akhir' => date('d/m/Y'),
			'tgl_pengumuman' => date('d/m/Y'), 
			'nama_perusahaan' => '', 
			'alamat' => '', 
			'npwp' => '', 
			'nama_kontak' => '', 
			'telp' => '', 
			'nilai_kontrak' => 0, 
			'no_kontrak' => '', 
			'tgl_kontrak' => '',
			'tgl_selesai_kontrak' => '',
			'no_adendum' => '',
			'tgl_adendum' => '', 
			'progres_id' => '', 
			'no_urut' => '',
			'tgl_selesai' => ''
		);

		if($id > 0) 
		{
			$q = $this->db->get_where('proyek', array('id' => $id));
			$r = $q->row();

			$data = array(
				'id' => $id, 
				'rup_id' => $rup_id, 
				'tahun_anggaran' => $this->session->userdata('tahun_anggaran'), 
				'nama_ppk' => $r->nama_ppk, 
				'jenis_belanja_id' => $r->jenis_belanja_id, 
				'jenis_pengadaan_id' => $r->jenis_pengadaan_id, 
				'metode_pemilihan3_id' => $r->metode_pemilihan3_id,
				'pengadaan_melalui_id' => $r->pengadaan_melalui_id,
				'waktu_awal' => DateTime::createFromFormat('Y-m-d', $r->waktu_awal)->format('d/m/Y'),
				'waktu_akhir' => DateTime::createFromFormat('Y-m-d', $r->waktu_akhir)->format('d/m/Y'), 
				'tgl_pengumuman' => DateTime::createFromFormat('Y-m-d', $r->tgl_pengumuman)->format('d/m/Y'), 
				'nama_perusahaan' => $r->nama_perusahaan, 
				'alamat' => $r->alamat, 
				'npwp' => $r->npwp, 
				'nama_kontak' => $r->nama_kontak, 
				'telp' => $r->telp, 
				'nilai_kontrak' => $r->nilai_kontrak, 
				'no_kontrak' => $r->no_kontrak, 
				'tgl_kontrak' => DateTime::createFromFormat('Y-m-d', $r->tgl_kontrak)->format('d/m/Y'), 
				'tgl_selesai_kontrak' => DateTime::createFromFormat('Y-m-d', $r->tgl_selesai_kontrak)->format('d/m/Y'),
				'no_adendum' => $r->no_adendum,
				'tgl_adendum' => strlen($r->tgl_adendum) > 0 ? DateTime::createFromFormat('Y-m-d', $r->tgl_adendum)->format('d/m/Y') : '', 
				'progres_id' => $r->progres_id, 
				'no_urut' => $no_urut == 0 ? $r->no_urut : $no_urut,
				'tgl_selesai' => strlen($r->tgl_selesai) > 0 ? DateTime::createFromFormat('Y-m-d', $r->tgl_selesai)->format('d/m/Y') : '', 
			);


            $metode = $this->db->get_where('metode_pemilihan3', array('id   ' => $r->metode_pemilihan3_id))->result_array();
            $params['catatan'] = $metode[0]['keterangan'];
		}

        $sql_rup = sprintf("
			SELECT 
				a.`id`, a.`satker_id`, f.namasatker nama_satker, a.`tahun_anggaran`, a.`program_id`, c.kdprogram, c.namaprogram, 
				a.`kegiatan_id`, d.namakegiatan, d.kdkegiatan,
				a.`nama_paket`, a.jenis_belanja_id, a.`jenis_pengadaan_id`, b.nama jenis_pengadaan, a.`volume`, a.`lokasi`, a.`detail_lokasi`, 
				a.`deskripsi`, a.`spesifikasi`, a.`sumber_dana`, a.`pagu`, a.`mak`, a.`metode_pemilihan_id`,
				a.`metode_awal`, a.`metode_akhir`, a.`waktu_awal`, a.`waktu_akhir`, e.nama as nama_metode_pemilihan
			FROM 
				rup a
			JOIN jenis_pengadaan b ON a.jenis_pengadaan_id = b.id
			JOIN program c ON a.program_id = c.id
			JOIN kegiatan d ON a.kegiatan_id = d.id
			JOIN metode_pemilihan3 e ON a.metode_pemilihan_id = e.id		
			JOIN satker f ON a.satker_id = f.id
			JOIN jenis_belanja g ON a.jenis_belanja_id = g.id
			WHERE a.id = %d
		", $rup_id);

		$q_rup = $this->db->query($sql_rup);
		$params['rup'] = $q_rup->row();
        
        $this->db->where('status_delete', '0');
		$q_sdana = $this->db->get('sumber_dana');
		$params['sdana'] = $q_sdana->result_object();	

		$q_jenis_belanja = $this->db->get('jenis_belanja');
		$params['jenis_belanja'] = $q_jenis_belanja->result_object();	

		$q_jenis_pengadaan = $this->db->get('jenis_pengadaan');
		$params['jenis_pengadaan'] = $q_jenis_pengadaan->result_object();

		$q_metode_pemilihan = $this->db->get_where('metode_pemilihan3', array('jenis_pengadaan_id' => 1));
		$params['metode_pemilihan'] = $q_metode_pemilihan->result_object();	

		$q_progres = $this->db->get('progres');
		$params['progres'] = $q_progres->result_object();

		$params["no_urut"] = $no_urut;	

		$params['data'] = $data;	
		$params['msg'] = $msg;

		$arr = array();
		if($id > 0) {
			$q_sumber_dana = $this->db->get_where('proyek_sumber_dana', array('proyek_id' => $id));
			$sdana =  $q_sumber_dana->result_object();						
			foreach($sdana as $s) {
				$arr[] = $s->sumber_dana_id;
			}			
		}
		$params['sumber_dana'] = $arr;

        $params['photos'] = $this->db->get_where('lampiran', array('proyek_id' => $id))->result_object();
		$this->load->view('proyek_form', $params);
	}

	public function pilih_rup($id = 0, $rup_id = 0, $no_urut = 0)
	{
		$filter = "";
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$filter = sprintf(" AND a.satker_id=%d", $this->session->userdata('satker_id'));
		}

		$sql = sprintf("
			SELECT 
				a.`id`, a.`satker_id`, f.namasatker nama_satker, a.`tahun_anggaran`, a.`program_id`, a.`kegiatan_id`, 
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
			WHERE a.tahun_anggaran = %d	AND a.id NOT IN (SELECT rup_id FROM proyek WHERE tahun_anggaran = %d) " . $filter ."
			ORDER BY 
				a.`id` DESC
		", $this->session->userdata('tahun_anggaran'), $this->session->userdata('tahun_anggaran'));

		$q = $this->db->query($sql);
		
		$data['data'] = $q->result_object();
		$data['id'] = $id;
		$data['rup_id'] = $rup_id;
		$data['no_urut'] = $no_urut;

        $this->load->view('pilih_rup', $data);
	}

	function pilih_proyek($rup_id, $id, $no_urut)
	{
		$filter = "";
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$filter = sprintf(" AND b.satker_id=%d", $this->session->userdata('satker_id'));
		}

		$sql = sprintf("
			SELECT 
				a.`id`, a.`rup_id`, a.`tahun_anggaran`, a.`nama_ppk`, a.`jenis_belanja_id`, a.`jenis_pengadaan_id`, a.
				`metode_pemilihan3_id`, a.`waktu_awal`, a.`waktu_akhir`, a.`nama_perusahaan`, a.`alamat`, a.`npwp`, a.
				`nama_kontak`, a.`telp`, a.`nilai_kontrak`, a.`no_kontrak`, a.`tgl_kontrak`, a.`no_adendum`, a.
				`tgl_adendum`,  a.`progres_id`, a.`no_urut`,
				b.nama_paket, c.nama jenis_pengadaan, d.nama metode_pemilihan, e.namasatker, a.tgl_selesai
			FROM 
				proyek a
			JOIN rup b ON a.rup_id = b.id	
			JOIN jenis_pengadaan c ON a.jenis_pengadaan_id = c.id
			JOIN metode_pemilihan3 d ON a.metode_pemilihan3_id = d.id
			JOIN satker e ON b.satker_id = e.id			
			WHERE a.tahun_anggaran = %d AND a.id <> %d " . $filter . "
			ORDER BY 
				a.`id` DESC
			", $this->session->userdata('tahun_anggaran'), $id);

		$q = $this->db->query($sql);
		
		$data['data'] = $q->result_object();	
		$data['rup_id'] = $rup_id;
		$data['id'] = $id;
        $this->load->view('pilih_proyek', $data);
	}

	function simpan()
	{
	    
		if ($this->input->post('id') == 0) {
			$this->tambah();
		} else {
			$this->ubah();
		}
	}

	function ubah()
	{
	   // print_r($_POST);
		
		$data = array(
			'rup_id' => $this->input->post('rup_id'),
			'jenis_belanja_id' => $this->input->post('jenis_belanja_id'),
            'jenis_pengadaan_id' => $this->input->post('jenis_pengadaan_id'),
            'metode_pemilihan3_id' => $this->input->post('metode_pemilihan_id'),
            'pengadaan_melalui_id' => $this->input->post('pengadaan_melalui_id'),
			'tahun_anggaran' => $this->input->post('tahun_anggaran'),
			'nama_ppk' => $this->input->post('nama_ppk'),
			'tgl_pengumuman' => DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_pengumuman'))->format('Y-m-d'),
			'nama_perusahaan' =>  $this->input->post('nama_perusahaan'),
			'alamat' => $this->input->post('alamat'),
			'npwp' => $this->input->post('npwp'),
			'nama_kontak' =>$this->input->post('nama_kontak'),
			'telp' => $this->input->post('telp'),
            'nilai_kontrak' => str_replace('.', '', $this->input->post('nilai_kontrak')),
			'no_kontrak' => $this->input->post('no_kontrak'),
			'tgl_kontrak' => DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_kontrak'))->format('Y-m-d'),
			'no_adendum' => $this->input->post('no_adendum'),
			'tgl_adendum' => strlen($this->input->post('tgl_adendum')) > 0 ? DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_adendum'))->format('Y-m-d') : NULL,			
			'progres_id' => $this->input->post('progres_id'),
			'tgl_selesai' => strlen($this->input->post('tgl_selesai')) > 0 ? DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_selesai'))->format('Y-m-d') : NULL,			
		);		

        // Di disabled

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('proyek', $data);

		$this->db->delete('proyek_sumber_dana', array('proyek_id' => $this->input->post('id')));
		$sumber_dana = $this->input->post('sumber_dana_id');
		foreach($sumber_dana as $s) {
			$this->db->insert('proyek_sumber_dana', array('proyek_id' => $this->input->post('id'), 'sumber_dana_id' => $s));
		}

		redirect('/proyek/form/' . $this->input->post('rup_id') . '/' .  $this->input->post('id') . '/' . $this->input->post('no_urut') . '/saved', 'refresh');
	}

	function tambah()
	{		
		//print_r($_POST);
		$this->db->select_max('no_urut');
		$q = $this->db->get_where('proyek', array('tahun_anggaran' => $this->session->userdata('tahun_anggaran')));
		$no_urut = $q->row()->no_urut + 1;
		$data = array(
			'rup_id' => $this->input->post('rup_id'),
			'jenis_belanja_id' => $this->input->post('jenis_belanja_id'),
            'jenis_pengadaan_id' => $this->input->post('jenis_pengadaan_id'),
            'metode_pemilihan3_id' => $this->input->post('metode_pemilihan_id'),
            'pengadaan_melalui_id' => $this->input->post('pengadaan_melalui_id'),
			'tahun_anggaran' => $this->input->post('tahun_anggaran'),
			'nama_ppk' => $this->input->post('nama_ppk'),
			'tgl_pengumuman' => DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_pengumuman'))->format('Y-m-d'),
			'nama_perusahaan' =>  $this->input->post('nama_perusahaan'),
			'alamat' => $this->input->post('alamat'),
			'npwp' => $this->input->post('npwp'),
			'nama_kontak' =>$this->input->post('nama_kontak'),
			'telp' => $this->input->post('telp'),
            'nilai_kontrak' => str_replace('.', '', $this->input->post('nilai_kontrak')),
			'no_kontrak' => $this->input->post('no_kontrak'),
			'tgl_kontrak' => DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_kontrak'))->format('Y-m-d'),
			'no_adendum' => $this->input->post('no_adendum'),
			'tgl_adendum' => strlen($this->input->post('tgl_adendum')) > 0 ? DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_adendum'))->format('Y-m-d') : NULL,			
			'progres_id' => $this->input->post('progres_id'),
			'no_urut' => $no_urut,
			'tgl_selesai' => strlen($this->input->post('tgl_selesai')) > 0 ? DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_selesai'))->format('Y-m-d') : NULL,			
		);		

		$this->db->insert('proyek', $data);

		$insert_id = $this->db->insert_id();

		$sumber_dana = $this->input->post('sumber_dana_id');
		foreach($sumber_dana as $s) {
			$this->db->insert('proyek_sumber_dana', array('proyek_id' => $insert_id, 'sumber_dana_id' => $s));
		}

		redirect('/proyek/form/' . $this->input->post('rup_id') . '/' .  $insert_id . '/0/saved', 'refresh');
	}

	function hapus($id)
	{
		$this->db->delete('proyek', array('id' => $id));
		$this->db->delete('proyek_sumber_dana', array('proyek_id' => $id));
		redirect('/proyek', 'refresh');
	}

	function input_realisasi($id)
	{
		$data['id'] = $id;
		$q = $this->db->get_where('realisasi_keuangan', array('proyek_id' => $id));
		$data['data'] = $q->result_object();
		$q = $this->db->get_where('proyek', array('id' => $id));
		$data['proyek'] = $q->row();

		$this->load->view('input_realisasi', $data);
	}

	function simpan_realisasi()
	{
		$tgl = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl'))->format('Y-m-d');
		$jumlah = strlen($this->input->post('jumlah')) == 0 ? 0 : str_replace('.', '', $this->input->post('jumlah'));
		$id = $this->input->post('proyek_id');

        $this->db->select('satker.id as satker_id');
        $this->db->from('satker');
        $this->db->join('rup', 'satker.id = rup.satker_id');
        $this->db->join('proyek', 'rup.id = proyek.rup_id');
        $this->db->where('proyek.id', $id);
        $satker_id = $this->db->get()->row()->satker_id;

        $where = array(
            'id_satker' => $satker_id,
            'bulan' => DateTime::createFromFormat('d/m/Y', $this->input->post('tgl'))->format('n'),
            'tahun' => DateTime::createFromFormat('d/m/Y', $this->input->post('tgl'))->format('Y')
        );

        $this->db->from('target');
        $this->db->where($where);
        $realisasi = $this->db->get()->row()->realisasi;
        $realisasi += intval($jumlah);

        $this->db->set('realisasi', $realisasi);
        $this->db->where($where);
        $this->db->update('target');

		$this->db->insert('realisasi_keuangan', array('proyek_id' => $id, 'tgl' => $tgl, 'jumlah' => $jumlah));
	}

	function hapus_realisasi($id, $proyek_id) 
	{
		$this->db->delete('realisasi_keuangan', array('id' => $id));
		$this->input_realisasi($proyek_id);
	}


    public function simpanFile($proyek_id = null)
    {
        if (!empty($_FILES)) {
            $filename = $this->db->query('SELECT uuid() as id')->row()->id;
            $config['file_name'] = $filename . $_FILES['file']['file_ext'];
            $config['upload_path'] = './file/';

            $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|pdf';
            $config['max_size'] = 10000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $this->message($this->upload->display_errors(), 'danger');
            }
            $file_data = $this->upload->data();
            $link = $filename . $file_data['file_ext'];
            $data = [
                'proyek_id' => $proyek_id,
                'name' => $_FILES['file']['name'],
                'photo' => $link,
                'ext' => $file_data['file_ext']
            ];
            $this->db->insert('lampiran', $data);
        } else {
            return FALSE;
        }
    }

    public function remove_multiple($rup_id, $proyek_id, $no_urut)
    {
        $status = FALSE;
        if (!empty($_POST['check_list'])) {
            foreach ($_POST['check_list'] as $id) {
                $photo = $this->db->get_where('lampiran', array('id' => $id))->result_array();
                $photo = $photo[0]['photo'];
                $file_path = 'file/'. $photo;
                if (file_exists($file_path) && unlink($file_path) && $this->db->delete('lampiran', array('id' => $id))) {
                    $status = TRUE;
                }
            }
        } else {
            redirect('/proyek/form/' . $rup_id . '/' .  $proyek_id . '/' . $no_urut . '/saved', 'refresh');
        }
        redirect('/proyek/form/' . $rup_id . '/' .  $proyek_id . '/' . $no_urut . '/saved', 'refresh');
    }

    public function export()
    {
        $filter = "";
        if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
            $filter = sprintf(" AND b.satker_id=%d", $this->session->userdata('satker_id'));
        }

        $sql = sprintf("
			SELECT 
				a.`id`, b.`id_rup`, e.namasatker, a.`tahun_anggaran`, f.kdprogram, f.namaprogram, g.kdkegiatan, g.namakegiatan, b.nama_paket, b.lokasi,
				b.volume, b.pagu, a.`nama_ppk`, b.sumber_dana, c.`nama` as belanja_langsung, d.`nama` as metode_pemilihan, h.nama as pengadaan_melalui, tgl_pengumuman,
				 a.`nama_perusahaan`, a.`alamat`, a.`npwp`, a.`nama_kontak`, a.`telp`, a.`nilai_kontrak`, a.`no_kontrak`, a.`tgl_kontrak`, a.`no_adendum`, a.
				`tgl_adendum`, i.`nama` as nama_progress, a.`tgl_selesai_kontrak`
			FROM 
				proyek a
			JOIN rup b ON a.rup_id = b.id	
			JOIN jenis_pengadaan c ON a.jenis_pengadaan_id = c.id
			JOIN metode_pemilihan3 d ON b.metode_pemilihan_id = d.id
			JOIN satker e ON b.satker_id = e.id
            JOIN program f ON b.program_id = f.id
            JOIN kegiatan g ON b.kegiatan_id = g.id
            JOIN pengadaan_melalui h ON b.pengadaan_melalui_id = h.id
            JOIN progres i ON a.progres_id = i.id
			WHERE a.tahun_anggaran = %d " . $filter . "
			ORDER BY 
				a.`id` DESC
			", $this->session->userdata('tahun_anggaran'));

        $q = $this->db->query($sql);

        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->helper('download');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
            ->setDescription("description");
        for($col = 'A'; $col !== 'AF'; $col++) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }
		
        $this->kop($objPHPExcel, "DAFTAR PROYEK PENGADAAN BARANG DAN JASA", 1);
        $this->kop($objPHPExcel, "PEMERINTAH KABUPATEN LUMAJANG", 2);
        $this->kop($objPHPExcel, "TAHUN ". $this->session->userdata('tahun_anggaran'), 3);
        $headTable = array('No.', 'ID Proyek', 'ID RUP', 'Satuan Kerja', 'Tahun Anggaran', 'Kode Program', 'Nama Program', 'Kode Kegiatan', 'Nama Kegiatan',
            'Nama Paket', 'Lokasi', 'Volume', 'Pagu', 'Nama PPK', 'Belanja Langsung', 'Jenis Pengadaan', 'Metode Pemilihan', 'Pengadaan Melalui', 'Tanggal Pengumuman Lelang',
            'Nama Perusahaan', 'Alamat Perusahaan', 'NPWP', 'Nama Kontak', 'Telp', 'Nilai Kontrak', 'No Kontrak', 'Tanggal Kontrak',
            'No Adendum', 'Tanggal Adendum', 'Progres', 'Tanggal Selesai Kontrak');
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
        for ($i = 0; $i < 31; $i++) {
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
				$objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, strip_tags($data->$field));
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
        header('Content-Disposition: attachment; filename="Proyek.xls"');
        $objWriter->save('php://output');
    }
	private function kop($objPHPExcel, $text, $row)
    {
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setCellValueByColumnAndRow(0, $row, $text);
        $sheet->mergeCells('A'.$row.':AE'.$row);
        $style = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $sheet->getStyle('A'.$row.':AE'.$row)->applyFromArray($style);
    }
}