<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sumberdana extends CI_Controller {

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
			'nama' => '',
		);

		if($id > 0) {
			$q=$this->db->get_where('sumber_dana', array('id' => $id));
			$r=$q->row();
			$form = array(
				'id' => $id,
				'nama' => $r->nama
			);	
		}
		$this->db->from('sumber_dana');
        $this->db->where('status_delete', '0');
		$q=$this->db->get();
		$params['data'] = $q->result_object();
		$params['form'] = $form;
		$params['msg'] = $msg;

        $this->load->view('sumber_dana', $params);
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
		$this->db->insert('sumber_dana', array(
			'nama' => $this->input->post('nama')
		));

		redirect('/sumberdana/index/0/saved', 'refresh');
	}

	function ubah()
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('sumber_dana', array(
			'nama' => $this->input->post('nama')
		));

		redirect('/sumberdana/index/' . $this->input->post('id') . '/saved', 'refresh');
	}

    function hapus($id)
    {
        $this->db->where('id', $id);
		$this->db->update('sumber_dana', array('status_delete' => 1));
        redirect('/sumberdana', 'refresh');
    }
}