<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan extends CI_Controller {	

	public function __construct()
	{
		parent::__construct();
		if(!$this->is_logged_in()) {
			redirect('/login/', 'refresh');
		}

		if($this->session->userdata('level') > 1) {
			redirect('/login/', 'refresh');
		}
	}

	public function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }

    function index($program_id=0, $id = 0, $msg = '')
    {
		$form = array(
			'id' => 0,
            'program_id' => 0,
			'kdkegiatan' => '',
			'namakegiatan' => ''
		);

		if($id > 0) {
			$q=$this->db->get_where('kegiatan', array('id' => $id));
			$r=$q->row();
			$form = array(
				'id' => $id,
                'program_id' => $r->program_id,
				'kdkegiatan' => $r->kdkegiatan,
				'namakegiatan' => $r->namakegiatan
			);	
		}

		$q=$this->db->get_where('kegiatan', array('program_id'=> $program_id, 'tahun_anggaran' => $this->session->userdata('tahun_anggaran')));
		$params['data'] = $q->result_object();
		$params['form'] = $form;
		$params['msg'] = $msg;
        $q_program=$this->db->get_where('program', array('tahun_anggaran' => $this->session->userdata('tahun_anggaran')));
        $params['program'] = $q_program->result_object();
        $params['program_id'] = $program_id;

        $this->load->view('kegiatan', $params);
    }

	function simpan() {
		if($this->input->post('id') > 0) {
			$this->ubah();
		} else {
			$this->tambah();
		}
	}

	function tambah()
	{
		$this->db->insert('kegiatan', array(
            'program_id' => $this->input->post('program_id'),
			'kdkegiatan' => $this->input->post('kdkegiatan'),
			'namakegiatan' => $this->input->post('namakegiatan'),
			'tahun_anggaran' => $this->session->userdata('tahun_anggaran')
		));



		redirect('/kegiatan/index/' . $this->input->post('program_id') . '/0/saved', 'refresh');
	}

	function ubah()
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('kegiatan', array(            
			'kdkegiatan' => $this->input->post('kdkegiatan'),
			'namakegiatan' => $this->input->post('namakegiatan')
		));

		redirect('/kegiatan/index/' . $this->input->post('program_id') . '/' . $this->input->post('id') . '/saved', 'refresh');
	}

	
    function hapus($id)
    {
        $this->db->delete('kegiatan', array('id' => $id));
        redirect('/kegiatan', 'refresh');
    }
}