<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satker extends CI_Controller {	

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
			'kdsatker' => '',
			'namasatker' => ''
		);

		if($id > 0) {
			$q=$this->db->get_where('satker', array('id' => $id));
			$r=$q->row();
			$form = array(
				'id' => $id,
				'kdsatker' => $r->kdsatker,
				'namasatker' => $r->namasatker
			);	
		}

		$q=$this->db->get('satker');
		$params['data'] = $q->result_object();
		$params['form'] = $form;
		$params['msg'] = $msg;

        $this->load->view('satker', $params);
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
		$this->db->insert('satker', array(
			'kdsatker' => $this->input->post('kdsatker'),
			'namasatker' => $this->input->post('namasatker')
		));

		redirect('/satker/index/0/saved', 'refresh');
	}

	function ubah()
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('satker', array(
			'kdsatker' => $this->input->post('kdsatker'),
			'namasatker' => $this->input->post('namasatker')
		));

		redirect('/satker/index/' . $this->input->post('id') . '/saved', 'refresh');
	}

    function hapus($id)
    {
        $this->db->delete('satker', array('id' => $id));
        redirect('/satker', 'refresh');
    }
}