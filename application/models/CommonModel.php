


<?php
defined("BASEPATH") or exit("No direct script access allowed");

class CommonModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
    } 



    public function checkAadharExists($aadhar_no) { //function to check if aadhar number exitsts
        $this->db->where('aadhar_no', $aadhar_no);
        $query = $this->db->get('uni_aadhar')->row();

        if($query){
            return true;
        } else {
            return false;
        }
    }

    public function getVisitorName($id){
        $this->db->select('full_name');
        $this->db->where('id', $id);
        $query = $this->db->get('visitor');
        if($query->num_rows() > 0){
            return $query->row()->full_name;
        } else {
            return 'Unknown';
        }

    }



    public function checkAadharExistGetData($aadhar_no) { //function to check if aadhar number exitsts for autofill
        $this->db->where('aadhar_no', $aadhar_no);
        $query = $this->db->get('uni_aadhar')->row();

        if($query->role=='OFC'){
            $this->db->select('*');
            $this->db->from('officer');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='EMP'){
            $this->db->select('*');
            $this->db->from('employee');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='CON'){
            $this->db->select('*');
            $this->db->from('contractor');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='CONW'){
            $this->db->select('*');
            $this->db->from('contractor_workman');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='GAT'){
            $this->db->select('*');
            $this->db->from('gat');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='TAT'){
            $this->db->select('*');
            $this->db->from('tat');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='FEG'){
            $this->db->select('*');
            $this->db->from('feg');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='SEC'){
            $this->db->select('*');
            $this->db->from('sec');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='PT'){
            $this->db->select('*');
            $this->db->from('packed');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='BK'){
            $this->db->select('*');
            $this->db->from('bulk');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='TR'){
            $this->db->select('*');
            $this->db->from('transporter');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='PW'){
            $this->db->select('*');
            $this->db->from('workman');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        }elseif($query->role=='AMC'){
            $this->db->select('*');
            $this->db->from('amc');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();

        }else{
            return false;
        }
    }


    //========================================ICARD===========================================================
//                              -------------ICARD COMMON CODE----------

public function getQrById($token_no ,$table) {
    $this->db->select('qr_code');
    $this->db->from($table);
    $this->db->where('token_no', $token_no);
    $query = $this->db->get();
    return $query->row_array();
}

public function generateQr($token_no, $table, $data){
    $this->db->where('token_no', $token_no);
    return $this->db->update($table, $data);
}

public function getQrDataById($token_no ,$table) {
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where('token_no', $token_no);
    $query = $this->db->get();
    return $query->row_array();
}


//                           ---------------ICARD COMMON CODE END----------------

//========================================ICARD END===========================================================

}
?>