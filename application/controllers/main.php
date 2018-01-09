<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {	

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

	public function index()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 6) {
			$this->load->view('dashboard_satker');
		} else {
			$this->load->view('dashboard');
		}
	}
}
