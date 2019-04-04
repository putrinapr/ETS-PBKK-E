<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends CI_Model {

	private $db;

    public function __construct() {
        parent::__construct();

        $this->db = $this->load->database('default', true);
    }

    public function getProposal($data){
        $this->db->select("proposal.user_id,proposal.title, dosbing_1.nrp as 'dosbing1_nrp', dosbing_2.nrp as 'dosbing2_nrp',dosbing_1.id as 'dosbing1_id', dosbing_2.id as 'dosbing2_id',proposal.rmk_id,proposal.path,proposal.progress_id, rmk.slug,rmk.name,progress_proposal.text, dosbing_1.name as 'dosbing1_name', dosbing_2.name as 'dosbing2_name'");
        $this->db->from('proposal');
        $this->db->join('rmk','rmk.id=proposal.rmk_id');
        $this->db->join('progress_proposal','progress_proposal.id=proposal.progress_id');
        $this->db->join('users as dosbing_1','dosbing_1.id=proposal.dosen1_id');
        $this->db->join('users as dosbing_2 ','dosbing_2.id=proposal.dosen2_id');
        $this->db->where('proposal.user_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;
    }

    public function getRMKByNRP($data){
        //Get all rmk info
        $this->db->select('rmk_id,user_id');
        $this->db->from('rmk_users');
        $this->db->where('user_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;
    }

    public function getProposalByRMK($data){
        $this->db->select("mahasiswa.name as mahasiswa_name, mahasiswa.nrp as nrp,
        proposal.user_id,proposal.title,proposal.dosen1_id as 'dosbing1_nrp',
        proposal.dosen2_id as 'dosbing2_nrp',proposal.rmk_id,proposal.path,
        proposal.progress_id,rmk.slug,rmk.name,progress_proposal.text, 
        dosbing_1.name as 'dosbing1_name',dosbing_2.name as 'dosbing2_name'");
        $this->db->from('proposal');
        $this->db->join('rmk','rmk.id=proposal.rmk_id');
        $this->db->join('progress_proposal','progress_proposal.id=proposal.progress_id');
        $this->db->join('users as dosbing_1','dosbing_1.id=proposal.dosen1_id');
        $this->db->join('users as dosbing_2 ','dosbing_2.id=proposal.dosen2_id');
        $this->db->join('users as mahasiswa','mahasiswa.id=proposal.user_id');
        $this->db->where('proposal.rmk_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;
    }

    public function getAllProposal(){
        $this->db->select("mahasiswa.name as mahasiswa_name, mahasiswa.nrp as nrp,
        proposal.user_id,proposal.title,proposal.dosen1_id as 'dosbing1_nrp',
        proposal.dosen2_id as 'dosbing2_nrp',proposal.rmk_id,proposal.path,
        proposal.progress_id,rmk.slug,rmk.name,progress_proposal.text, 
        dosbing_1.name as 'dosbing1_name',dosbing_2.name as 'dosbing2_name'");
        $this->db->from('proposal');
        $this->db->join('rmk','rmk.id=proposal.rmk_id');
        $this->db->join('progress_proposal','progress_proposal.id=proposal.progress_id');
        $this->db->join('users as dosbing_1','dosbing_1.id=proposal.dosen1_id');
        $this->db->join('users as dosbing_2 ','dosbing_2.id=proposal.dosen2_id');
        $this->db->join('users as mahasiswa','mahasiswa.id=proposal.user_id');
        $ret = $this->db->get()->result_array();
        return $ret;        
    }

    public function getAllProposalByDosbing($data){
        $this->db->select("proposal.user_id");
        $this->db->from('proposal');
        $this->db->where('proposal.dosen1_id',$data);
        $this->db->or_where('proposal.dosen2_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;        
    }

    public function sendProposal($data){
        $this->db->select("id");
        $this->db->from("users");
        $this->db->where("nrp",$data['dosen1_id']);
        $ret = $this->db->get()->result_array();
        if($ret) {
            $data['dosen1_id'] = $ret["0"]["id"];
        }
        $this->db->select("id");
        $this->db->from("users");
        $this->db->where("nrp",$data['dosen2_id']);
        $ret = $this->db->get()->result_array();
        if($ret) {
            $data['dosen2_id'] = $ret["0"]["id"];
        }
        $this->db->trans_start();
        $this->db->insert('proposal', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return "Gagal Melakukan Insert";
        }
        else{
            return "Berhasil Insert Proposal";
        }
    }

    public function updateProposal($userid,$data){
        if(isset($data['dosen1_id'])) {
            $this->db->select("id");
            $this->db->from("users");
            $this->db->where("nrp", $data['dosen1_id']);
            $ret = $this->db->get()->result_array();
            if ($ret) {
                $data['dosen1_id'] = $ret["0"]["id"];
            }
        }
        if(isset($data['dosen2_id'])) {
            $this->db->select("id");
            $this->db->from("users");
            $this->db->where("nrp", $data['dosen2_id']);
            $ret = $this->db->get()->result_array();
            if ($ret) {
                $data['dosen2_id'] = $ret["0"]["id"];
            }
        }
        $this->db->trans_start();
        $this->db->where('user_id',$userid);
        $this->db->update('proposal', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return "Gagal Melakukan Update";
        }
        else{
            return "Berhasil Update Proposal";
        }
    }

    /* SEMINAR MODEL */
    public function sendSeminar($data){
        $this->db->trans_start();
        $this->db->insert('seminar', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return 0;
        }
        else{
            return 1;
        }
    }
    public function getSeminar($data){
        $this->db->select("users.nrp as nrp, seminar.theme,seminar.user_id,seminar.progress_id,seminar.start_date,seminar.end_date,seminar.location,progress_proposal.text");
        $this->db->from('seminar');
        $this->db->join('progress_proposal','progress_proposal.id=seminar.progress_id');
        $this->db->join('users','users.id=seminar.user_id');
        $this->db->where('seminar.user_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;
    }

    public function updateSeminar($nrp,$data){
        $this->db->trans_start();
        $this->db->where('user_id',$nrp);
        $this->db->update('seminar', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return "Gagal Melakukan Update";
        }
        else{
            return "Berhasil Update Seminar";
        }
    }

    public function getSeminarByNRP($data){
        $this->db->select("users.nrp as nrp, seminar.theme,seminar.user_id,seminar.progress_id,seminar.start_date,seminar.end_date,seminar.location,progress_proposal.text");
        $this->db->from('seminar');
        $this->db->join('progress_proposal','progress_proposal.id=seminar.progress_id');
        $this->db->join('users','users.id=seminar.user_id');
        $this->db->where_in('seminar.user_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;
    }

    public function getAllSeminar(){
        $this->db->select("users.nrp as nrp, seminar.theme,seminar.user_id,seminar.progress_id,seminar.start_date,seminar.end_date,seminar.location,progress_proposal.text");
        $this->db->from('seminar');
        $this->db->join('progress_proposal','progress_proposal.id=seminar.progress_id');
        $this->db->join('users','users.id=seminar.user_id');
        $ret = $this->db->get()->result_array();

        return $ret;
    }
}

/* End of file skripsi.php */
/* Location: ./application/models/skripsi.php */
