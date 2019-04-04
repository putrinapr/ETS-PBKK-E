<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('skripsi');
		$this->load->library('session');
		$this->load->helper('url');
		$this->data = array();
		$this->login_data = $this->session->userdata('login_data');
		if(!isset($this->login_data) && $this->login_data == NULL){
			$this->data['title'] = "Access Denied";
			$this->data['msg'] = "Access Denied";
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
		if($this->login_data['privilege'] != 5){
			$this->data['title'] = "Access Denied";
			$this->data['msg'] = "Access Denied";
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
	}

	public function index()
	{
		$this->data['title'] = "Redirect";
		$this->data['msg'] = "Dialihkan ke Home";
		$this->data['rdr'] = "home";
		return $this->load->view('status',$this->data);
	}

	public function home()
	{
		$this->data['title'] = "Home Mahasiswa";
		$this->load->view('mahasiswa/headerMahasiswa',$this->data);
		return $this->load->view('mahasiswa/dashboardMahasiswa',$this->data);

	}

	public function proposal()
	{
		$this->data['title'] = "Submit Proposal";
		$this->load->view('mahasiswa/headerMahasiswa',$this->data);
		return $this->load->view('mahasiswa/proposalMahasiswa',$this->data);
	}

	public function edit()
	{
		$this->data['proposal'] = $this->skripsi->getProposal($this->login_data['id']);
		if(count($this->data['proposal'])==0){
			$this->data['title'] = "Error";
			$this->data['msg'] = "Mahasiswa Belum Upload Proposal";
			$this->data['rdr'] = "mahasiswa/proposal";
			return $this->load->view('status',$this->data);
		}
		$this->data['title'] = "Edit Proposal";
		$this->load->view('mahasiswa/headerMahasiswa',$this->data);
		return $this->load->view('mahasiswa/editProposalMahasiswa',$this->data);
	}

	public function ubah()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$flag = $this->skripsi->getProposal($this->login_data['id']);
			if(count($flag)==1){
				if($flag[0]['progress_id'] == 10 || $flag[0]['progress_id'] == 11 || $flag[0]['progress_id'] == 12){
					if (empty($_FILES['draftTA']['name'])) {
						$path = $flag[0]['path'];
					}
					else{
						$path = $this->_uploadTA();
					}

					$send_array = Array(
						'title' => $this->input->post('judul'),
						'dosen1_id' => $this->input->post('dosbing1'),
						'dosen2_id' => $this->input->post('dosbing2'),
						'rmk_id' => $this->input->post('rmk'),
						'progress_id' => $flag[0]['progress_id'],
						'path' => $path
					);
					$ret = $this->skripsi->updateProposal($this->login_data['id'],$send_array);
				}
				else{
					$this->data['title'] = "Error";
					$this->data['msg'] = "Tidak Bisa Dirubah! Proposal Sudah Disetujui.";
					$this->data['rdr'] = "home";
					return $this->load->view('status',$this->data);
				}

			}
			else{
				$ret = "Belum Submit Proposal";
			}
			$this->data['title'] = "Result";
			$this->data['msg'] = $ret;
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
	}

	private function _uploadTA()
	{
	    $config['upload_path']          = './uploads/';
	    $config['allowed_types']        = 'pdf';
	    $config['file_name']            = $this->login_data['nrp'];
	    $config['overwrite']			= true;
	    $config['max_size']             = 102400;

	    $this->load->library('upload', $config);

	    if ($this->upload->do_upload('draftTA')) {
	        return $this->upload->data("file_name");
	    }else{
	    	return print_r( $this->upload->display_errors());
	    }

	}

	public function ajukan()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$flag = $this->skripsi->getProposal($this->login_data['nrp']);
			if(count($flag)==0){
				$path = $this->_uploadTA();
				$send_array = Array(
					'user_id' => $this->login_data['id'],
					'title' => $this->input->post('judul'),
					'dosen1_id' => $this->input->post('dosbing1'),
					'dosen2_id' => $this->input->post('dosbing2'),
					'rmk_id' => $this->input->post('rmk'),
					'path' => $path,
					'progress_id' => '10'
				);
				$ret = $this->skripsi->sendProposal($send_array);
			}
			else{
				$ret = "User Sudah Submit Proposal TA";
			}
			$this->data['title'] = "Result";
			$this->data['msg'] = $ret;
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
	}

	public function list()
	{
		$this->data['title'] = "List Proposal TA";
		$this->load->view('mahasiswa/headerMahasiswa',$this->data);
		return $this->load->view('mahasiswa/listTA',$this->data);
	}

	public function getListTA()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$list_data = $this->skripsi->getAllProposal();
			$draw = intval($this->input->get("draw"));

			$data = array();
	          foreach($list_data as $r) {
	               $data[] = array(
	                    $r['mahasiswa_name'],
	                    $r['title'],
	                    $r['dosbing1_name'],
	                    $r['dosbing2_name'],
	                    $r['name']
	               );
	          }
			$start = intval($this->input->get("start"));
	        $length = intval($this->input->get("length"));
			$output = array(
				"draw" => $draw,
				"recordsTotal" => count($list_data),
			   	"recordsFiltered" => count($list_data),
			   	"data" => $data
			);
			echo json_encode($output);
			exit();
		}
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->data['title'] = "Access Denied";
			$this->data['msg'] = "Access Denied";
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
	}

	public function info()
	{
		$this->data['proposal'] = $this->skripsi->getProposal($this->login_data['id']);
		if(count($this->data['proposal'])==0){
			$this->data['title'] = "Error";
			$this->data['msg'] = "Mahasiswa Belum Upload Proposal";
			$this->data['rdr'] = "mahasiswa/proposal";
			return $this->load->view('status',$this->data);
		}
		$this->data['title'] = "Info Proposal TA";
		$this->load->view('mahasiswa/headerMahasiswa',$this->data);
		return $this->load->view('mahasiswa/infoProposalMahasiswa',$this->data);
	}

	/* SEMINAR Controller*/
	public function seminar()
	{
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->data['title'] = "Submit Jadwal Seminar";
			$this->load->view('mahasiswa/headerMahasiswa',$this->data);
			return $this->load->view('mahasiswa/seminarMahasiswa',$this->data);
		}
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$flag1 = $this->skripsi->getProposal($this->login_data['id']);
			$flag2 = $this->skripsi->getSeminar($this->login_data['id']);
			if(count($flag1)==1){
				if($flag1[0]['progress_id']==15){
					if(count($flag2)==0){
						$send_array = Array(
							'user_id' => $this->login_data['id'],
							'theme' => $this->input->post('tema'),
							'start_date' => $this->input->post('d_mulai'),
							'end_date' => $this->input->post('d_selesai'),
							'progress_id' => '20',
							'location' => $this->input->post('tempat')
						);
						$res = $this->skripsi->sendSeminar($send_array);

						if($res){
							$send_array2 = Array(
								'progress_id' => '16'
							);
							$ret = $this->skripsi->updateProposal($flag1[0]['user_id'],$send_array2);
							if($ret == "Berhasil Update Proposal"){
								$ret = "Berhasil Insert Jadwal Seminar";
							}
							else{
								$ret = "Gagal Update Status Proposal";
							}
						}
						else{
							$ret = "Gagal Melakukan Insert";
						}
					}
					else{
						$ret = "User Sudah Submit Jadwal Seminar TA";
					}
				}
				else{
					$ret = "User Belum Mendapat Persetujuan Kedua Dosen Pembimbing";
				}
			}
			else{
				$ret = "User Belum Submit Proposal TA";
			}
			$this->data['title'] = "Result";
			$this->data['msg'] = $ret;
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
	}

	public function change()
	{
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			$flag = $this->skripsi->getSeminar($this->login_data['id']);
			if(count($flag)==0){
				$this->data['title'] = "Error";
				$this->data['msg'] = "Mahasiswa Belum Submit Jadwal Seminar";
				$this->data['rdr'] = "mahasiswa/seminar";
				return $this->load->view('status',$this->data);
			}
			$this->data['seminar'] = $flag;
			$this->data['title'] = "Edit Jadwal Seminar";
			$this->load->view('mahasiswa/headerMahasiswa',$this->data);
			return $this->load->view('mahasiswa/editSeminarMahasiswa',$this->data);
		}

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$flag = $this->skripsi->getseminar($this->login_data['id']);
			if(count($flag)==1){
				if($flag[0]['progress_id'] == 20 || $flag[0]['progress_id'] == 21 || $flag[0]['progress_id'] == 22){
					$send_array = Array(
                        'theme' => $this->input->post('tema'),
                        'start_date' => $this->input->post('d_mulai'),
                        'end_date' => $this->input->post('d_selesai'),
						'progress_id' => $flag[0]['progress_id'],
						'location' => $this->input->post('tempat')
					);
					$ret = $this->skripsi->updateSeminar($this->login_data['id'],$send_array);
				}
				else{
					$this->data['title'] = "Error";
					$this->data['msg'] = "Tidak Bisa Dirubah! Seminar Sudah Disetujui.";
					$this->data['rdr'] = "home";
					return $this->load->view('status',$this->data);
				}

			}
			else{
				$ret = "Belum Submit Jadwal Seminar";
			}
			$this->data['title'] = "Result";
			$this->data['msg'] = $ret;
			$this->data['rdr'] = "home";
			return $this->load->view('status',$this->data);
		}
	}

	public function jadwal()
	{
		$this->data['seminar'] = $this->skripsi->getSeminar($this->login_data['id']);
		if(count($this->data['seminar'])==0){
			$this->data['title'] = "Error";
			$this->data['msg'] = "Mahasiswa Belum Submit Jadwal Seminar";
			$this->data['rdr'] = "mahasiswa/seminar";
			return $this->load->view('status',$this->data);
		}
		$this->data['title'] = "Info Seminar TA";
		$this->load->view('mahasiswa/headerMahasiswa',$this->data);
		return $this->load->view('mahasiswa/infoSeminarMahasiswa',$this->data);
	}
}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
