<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $login_data;

	public function __construct() {
		parent::__construct();
		$this->load->model('skripsi');
		$this->load->library('session');
		$this->load->helper('url');
		$this->data = array();
		$this->login_data = $this->session->userdata('login_data');
	}

	public function index()
	{
		if(!isset($this->login_data) && $this->login_data == NULL){
			return redirect(base_url('user/login'));
		}
		else{
			$this->data['login_data'] = $this->session->userdata('login_data');
			if($this->login_data['privilege']==1){
				return redirect(base_url('user/logout'));
			}
			if($this->login_data['privilege']==2){
				return redirect(base_url('kaprodi/home'));
			}
			if($this->login_data['privilege']==3){
				return redirect(base_url('verifikator/home'));
			}
			if($this->login_data['privilege']==4){
				return redirect(base_url('dosen/home'));
			}
			if($this->login_data['privilege']==5){
				return redirect(base_url('mahasiswa/home'));
			}
		}
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */