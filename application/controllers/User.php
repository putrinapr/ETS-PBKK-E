<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	private $login_data;

	public function __construct() {
		parent::__construct();
		$this->load->model('users');
		$this->load->library('session');
		$this->load->helper('url');
		$this->data = array();


		$this->login_data = $this->session->userdata('login_data');
		$this->data['login_data'] = $this->session->userdata('login_data');
	}


	public function register()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$send_array = array(
				'nrp' => $this->input->post('nrp'),
				'name' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('pass')),
				'privilege' => $this->input->post('privilege')
			);
			$res = $this->users->createUser($send_array);

			//Insert rmk untuk dosen dan verifikator RMK
			if($this->input->post('privilege') == 3 || $this->input->post('privilege') == 4){
				foreach($this->input->post('rmk') as $val){
					$rmk_array = array(
						'rmk_id' => $val,
						'user_id' => $this->input->post('nrp')
					);
					$ret = $this->users->insertRMK($rmk_array);
				}
			}

			//Insert rmk untuk administrator dan kepala prodi
			if($this->input->post('privilege') == 1 || $this->input->post('privilege') == 2){
				$listrmk = $this->users->getRMK();
				$endrmk = count($listrmk);
				for($i=1;$i<=$endrmk;++$i){
					$rmk_array = array(
						'rmk_id' => $i,
						'user_id' => $this->input->post('nrp')
					);
					$ret = $this->users->insertRMK($rmk_array);
				}
			}
            return redirect(base_url("user/login"));
		}

		//Method GET
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->data['title'] = "Log In";
			return $this->load->view('register_view',$this->data);
		}
	}

	public function login()
	{
		//Throw user to Home if already login
		if(isset($this->login_data) && $this->login_data != NULL){
            return redirect(base_url("home"));
		}

		//Method POST
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			//Request login
			$send_array = array(
				'nrp' => $this->input->post('nrp'),
				'pass' => md5($this->input->post('pass'))
			);
			$res = $this->users->loginUser($send_array);

            return redirect(base_url("home"));
		}

		//Method GET
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->data['title'] = "Log In";
			return $this->load->view('login_view',$this->data);
		}
	}

	public function logout()
	{
		//Only login user only that can logout
		if(isset($this->login_data) && $this->login_data != NULL){
			//Remove session
			$this->session->unset_userdata('login_data');
            return redirect(base_url("Welcome"));
		}
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
