<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {	

	public function __construct()
	{
		parent::__construct();
		if(!$this->is_logged_in()) {
			redirect('/login/', 'refresh');
		}
		
		if(!in_array($this->session->userdata('level'), array(1, 2, 3))) {
			redirect('/login/', 'refresh');
		}
	}

	public function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }

    function index($id = 0, $msg = '')
    {
		$params['ubah'] = false;
		$form = array(
			'id' => 0,
            'nama' => '',
			'alamat' => '',
			'nohp' => '',
            'username' => '',
            'satker_id' => 1,
            'level' => 4
		);

		if($id > 0) {
			$params['ubah'] = true;
			$q=$this->db->get_where('user', array('id' => $id));
			$r=$q->row();
			$form = array(
				'id' => $id,
                'nama' => $r->nama,
                'alamat' => $r->alamat,
                'nohp' => $r->nohp,
                'username' => $r->username,
                'satker_id' => $r->satker_id,
                'level' => $r->level
			);	
		}

		$q=$this->db->query("
            SELECT a.*, b.namasatker FROM user a
            JOIN satker b ON a.satker_id = b.id                
        ");
		$params['data'] = $q->result_object();
		$params['form'] = $form;
		$params['msg'] = $msg;
        $q_satker=$this->db->get('satker');
        $params['satker'] = $q_satker->result_object();

        $this->load->view('user', $params);
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
		$this->db->insert('user', array(
            'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'nohp' => $this->input->post('nohp'),
			'satker_id' => $this->input->post('satker_id'),
            'level' => $this->input->post('level'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
		));



		redirect('/user/index/0/saved', 'refresh');
	}

	function ubah()
	{
		$this->db->where('id', $this->input->post('id'));

		$edit = array(
            'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'nohp' => $this->input->post('nohp'),
			'satker_id' => $this->input->post('satker_id'),
            'level' => $this->input->post('level'),
            'username' => $this->input->post('username')
		);

		if(strlen($this->input->post('password')) > 0) {
			$edit = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'nohp' => $this->input->post('nohp'),
				'satker_id' => $this->input->post('satker_id'),
				'level' => $this->input->post('level'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);	
		}

		$this->db->update('user', $edit);

		redirect('/user/index/' . $this->input->post('id') . '/saved', 'refresh');
	}

	
    function hapus($id)
    {
        $this->db->delete('user', array('id' => $id));
        redirect('/user', 'refresh');
    }
}