<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model
{
    private $db;

    public function __construct() {
        parent::__construct();

        $this->db = $this->load->database('default', true);
    }

    public function getRMK(){
        //Get all rmk info
        $this->db->select('id,slug,name');
        $this->db->from('rmk');
        $ret = $this->db->get()->result_array();

        return $ret;
    }

    public function insertRMK($data){
        //Check if user already exists
        $this->db->select('1,id');
        $this->db->from('users');
        $this->db->where('nrp',$data['user_id']);
        $ret = $this->db->get()->result_array();

        //1 User
        if(count($ret) == 1){
            //Check if user with rmk exists
            $this->db->select('1');
            $this->db->from('rmk_users');
            $this->db->where('user_id',$ret[0]['id']);
            $this->db->where('rmk_id',$data['rmk_id']);
            $ret2 = $this->db->get()->result_array();

            //0 data
            if(count($ret2) == 0){
                $this->db->trans_start();
                $data['user_id'] = $ret[0]['id'];
                $this->db->insert('rmk_users', $data);
                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    return "Gagal Melakukan Insert";
                }
                else{
                    return "Berhasil Insert RMK";
                }
            }
        }
        else{
            return "User Belum Ada";
        }
    }

    public function createUser($data){
        $this->db->select('1');
        $this->db->from('users');
        $this->db->where('nrp',$data['nrp']);
        $ret = $this->db->get()->result_array();

        //0 user
        if(count($ret) == 0){
            $this->db->trans_start();
            $this->db->insert('users', $data);
            $this->db->trans_complete();

            return $this->db->trans_status();
        }
        else{
            return FALSE;
        }
    }

    public function loginUser($data){
        //Check user with nrp and pass
        $this->db->select('id,nrp,name,email,privilege');
        $this->db->from('users');
        $this->db->where('nrp',$data['nrp']);
        $this->db->where('password',$data['pass']);
        $ret = $this->db->get()->result_array();

        if(count($ret) == 1){
            $this->session->set_userdata('login_data', $ret[0]);
            return $ret;
        }
        else{
            return FALSE;
        }
    }
    public function getRMKByNRP($data){
        //Get all rmk info
        $this->db->select('rmk_id,user_id');
        $this->db->from('rmk_users');
        $this->db->where('user_id',$data);
        $ret = $this->db->get()->result_array();

        return $ret;
    }
}