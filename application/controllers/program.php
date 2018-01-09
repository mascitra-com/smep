<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller {	

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

    function index($id = 0, $msg = '')
    {
		$form = array(
			'id' => 0,
			'kdprogram' => '',
			'namaprogram' => ''
		);

		if($id > 0) {
			$q=$this->db->get_where('program', array('id' => $id));
			$r=$q->row();
			$form = array(
				'id' => $id,
				'kdprogram' => $r->kdprogram,
				'namaprogram' => $r->namaprogram
			);	
		}

		$q=$this->db->get_where('program', array('tahun_anggaran' => $this->session->userdata('tahun_anggaran')));
		$params['data'] = $q->result_object();
		$params['form'] = $form;
		$params['msg'] = $msg;

        $this->load->view('program', $params);
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
		$this->db->insert('program', array(
			'kdprogram' => $this->input->post('kdprogram'),
			'namaprogram' => $this->input->post('namaprogram'),
			'tahun_anggaran' => $this->session->userdata('tahun_anggaran')
		));

		redirect('/program/index/0/saved', 'refresh');
	}

	function ubah()
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('program', array(
			'kdprogram' => $this->input->post('kdprogram'),
			'namaprogram' => $this->input->post('namaprogram')
		));

		redirect('/program/index/' . $this->input->post('id') . '/saved', 'refresh');
	}

	
    function hapus($id)
    {
        $this->db->delete('program', array('id' => $id));
        redirect('/program', 'refresh');
    }
}