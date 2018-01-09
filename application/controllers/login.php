<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {	

	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
    {
        $this->load->view('login');
    }

	public function proses()
	{
		$q = $this->db->get_where("user", array('username' => $this->input->post('username'), 'password' => md5($this->input->post('password'))));

		if($q->num_rows() > 0) {
			$user = $q->row();
			$this->session->set_userdata('is_logged_in', TRUE);
			$this->session->set_userdata('tahun_anggaran', $this->input->post('tahun_anggaran'));
			$this->session->set_userdata('level', $user->level);
			$this->session->set_userdata('satker_id', $user->satker_id);
			$this->session->set_userdata('id', $user->id);
			redirect('/main/', 'refresh');		
		} else {
			redirect('/login/', 'refresh');	
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login/', 'refresh');
	}
}
