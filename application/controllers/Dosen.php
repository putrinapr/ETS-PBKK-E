<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

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
		if($this->login_data['privilege'] != 4){
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
		$this->data['title'] = "Home Dosen";
		$this->load->view('dosen/headerDosen',$this->data);
		return $this->load->view('dosen/dashboardDosen',$this->data);
	}

	public function list()
	{
		$this->data['title'] = "List Proposal TA";
		$this->load->view('dosen/headerDosen',$this->data);
		return $this->load->view('dosen/listTA',$this->data);
	}

	public function getListTA()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$list_data = $this->skripsi->getAllProposal();
			$draw = intval($this->input->get("draw"));

			$data = array();
			foreach($list_data as $r) {
			   	$data[] = array(
                    $r['user_id'],
			        $r['nrp'],
			        $r['title'],
			        $r['dosbing1_name'],
			        $r['dosbing2_name'],
			        $r['name'],
			        $r['text'],
			        $r['path']
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

	public function ubahStatusTA(){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$data = $this->skripsi->getProposal($this->input->post('nrp'));
			$current_status = $data[0]['progress_id'];
			$myID = $this->login_data['id'];

			if($current_status == 10){
				if($myID == $data[0]['dosbing1_id']){
					$perubahan = '11';
				}
				elseif($myID == $data[0]['dosbing2_id']){
					$perubahan = '12';
				}
				else{
					$perubahan = 'TETAP';
				}
			}
			elseif($current_status == 11){
				if($myID == $data[0]['dosbing1_id']){
					$perubahan = 'TETAP';
				}
				elseif($myID == $data[0]['dosbing2_id']){
					$perubahan = '13';
				}
				else{
					$perubahan = 'TETAP';
				}
			}
			elseif($current_status == 12){
				if($myID == $data[0]['dosbing1_id']){
					$perubahan = '13';
				}
				elseif($myID == $data[0]['dosbing2_id']){
					$perubahan = 'TETAP';
				}
				else{
					$perubahan = 'TETAP';
				}
			}
			else{
				$perubahan = 'TETAP';
			}

			if($perubahan!='TETAP'){
				$send_array = Array(
					'progress_id' => $perubahan
				);
				$ret = $this->skripsi->updateProposal($this->input->post('nrp'),$send_array);
			}
		}
	}

	/* Seminar Controller */
	public function jadwal()
	{
		$this->data['title'] = "List Jadwal Seminar TA";
		$this->load->view('dosen/headerDosen',$this->data);
		return $this->load->view('dosen/listSeminar',$this->data);
	}

	public function getListSeminar()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$list_data = $this->skripsi->getAllProposalByDosbing($this->login_data['id']);

			$data = array();
        	foreach($list_data as $r) {
            	array_push($data,$r['user_id']);
          	}
          	$list_seminar = $this->skripsi->getSeminarByNRP($data);
			$xdata = array();
			foreach($list_seminar as $r) {
			   	$xdata[] = array(
			        $r['user_id'],
			        $r['nrp'],
			        $r['theme'],
			        $r['start_date'],
			        $r['end_date'],
			        $r['location'],
			        $r['text']
			   	);
			}
			$draw = intval($this->input->get("draw"));
			$start = intval($this->input->get("start"));
	        $length = intval($this->input->get("length"));
			$output = array(
				"draw" => $draw,
				"recordsTotal" => count($list_seminar),
			   	"recordsFiltered" => count($list_seminar),
			   	"data" => $xdata
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

	public function ubahStatusSeminar(){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$data = $this->skripsi->getProposal($this->input->post('nrp'));
			$xdata = $this->skripsi->getSeminar($this->input->post('nrp'));

			$current_status = $xdata[0]['progress_id'];
			$myID = $this->login_data['id'];

			if($current_status == 20){
				if($myID == $data[0]['dosbing1_id']){
					$perubahan = '21';
				}
				elseif($myID == $data[0]['dosbing2_id']){
					$perubahan = '22';
				}
				else{
					$perubahan = 'TETAP';
				}
			}
			elseif($current_status == 21){
				if($myID == $data[0]['dosbing1_id']){
					$perubahan = 'TETAP';
				}
				elseif($myID == $data[0]['dosbing2_id']){
					$perubahan = '23';
				}
				else{
					$perubahan = 'TETAP';
				}
			}
			elseif($current_status == 22){
				if($myID == $data[0]['dosbing1_id']){
					$perubahan = '23';
				}
				elseif($myID == $data[0]['dosbing2_id']){
					$perubahan = 'TETAP';
				}
				else{
					$perubahan = 'TETAP';
				}
			}
			else{
				$perubahan = 'TETAP';
			}

			if($perubahan!='TETAP'){
				$send_array = Array(
					'progress_id' => $perubahan
				);
				$ret = $this->skripsi->updateSeminar($this->input->post('nrp'),$send_array);
			}
		}
	}

}

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */
