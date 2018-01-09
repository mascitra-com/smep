<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {	

	public function __construct()
	{
		parent::__construct();
		if(!$this->is_logged_in()) {
			redirect('/login/', 'refresh');
		}
	}

	public function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }

    function index($msg = '')
    {
        $q=$this->db->query(sprintf("
            SELECT a.*, b.namasatker
            FROM user a
            JOIN satker b ON a.satker_id = b.id
            WHERE a.id = %d
        ", $this->session->userdata('id')));
        $r=$q->row();
        $form = array(
            'id' => $this->session->userdata('id'),
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'nohp' => $r->nohp,
            'username' => $r->username,
            'namasatker' => $r->namasatker,
            'level' => $r->level
        );	
		
		$params['form'] = $form;
		$params['msg'] = $msg;

        $this->load->view('profil', $params);
    }

	function simpan() {
        $this->db->where('id', $this->input->post('id'));

		$edit = array(
            'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'nohp' => $this->input->post('nohp')
		);

		if(strlen($this->input->post('password')) > 0) {
			$edit = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'password' => md5($this->input->post('password'))
			);	
		}

		$this->db->update('user', $edit);

		redirect('/profil/index/saved', 'refresh');
	}	
}