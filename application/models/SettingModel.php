<?php
defined("BASEPATH") or exit("No direct script access allowed");

class SettingModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
 
    }

    public function UpdatePassword($id, $OldPassword, $NewPassword){
        $this->db->where('id', $id);
        $this->db->where('password', $OldPassword);
        $data = $this->db->get('login');
        if($data->num_rows() > 0){
            $this->db->where('id', $id);
            $this->db->update('login', array('password' => $NewPassword));
            return 1;
        } else {
            return 0;
        }
    }

    public function ResetDashboardCountKey($password){

        $data = $this->db->get('reset_pass')->row_array();

        if(!empty($data)){
            $this->db->update('reset_pass', array('password' => $password));
            return 1;
        } else {
            return $this->db->insert('reset_pass', array('password' => $password));
        }

    }

    public function AddUserPost($formdata){
        $data = $this->db->insert('login', $formdata);
        if($data){
            return 1;
        } else {
            return 0;
        }
    }

    public function DeleteUser($id){
        $this->db->where('id', $id);
        $this->db->set('status', '0');
        $data = $this->db->update('login');
        if($data){
            return 1;
        } else {
            return 0;
        }
    }

    public function GetAllUsers(){
        $this->db->where('status', 1);
        $data = $this->db->get('login')->result_array();
        return $data;
    }

    public function GetAllOfficers(){
        $this->db->select('id, full_name');
        $this->db->where('full_name !=', NULL);
        $data = $this->db->get('officer')->result_array();
        return $data;
    }

    public function GetAllSecurity(){
        $this->db->select('id, full_name');
        $this->db->where('full_name !=', NULL);
        $data = $this->db->get('sec')->result_array();
        return $data;
    }


}