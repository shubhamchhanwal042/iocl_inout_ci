<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ProjectModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
    } 

    public function checkAadharExists($aadhar_no) { //function to check if aadhar number exitsts
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

    // public function get_project_maingate_data($section)
    // {
    //     return $this->db
    //         ->select('token_no, status, section')
    //         ->get_where('maingate', [
    //             'section'      => $section,
    //             'status'       => '1'
    //             // 'reset_status' => '0'
    //         ])
    //         ->result_array();
    // }
    

    public function checkAadharExistGetData($aadhar_no) { //function to check if aadhar number exitsts
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





    //========================================WORKMAN========================================================

    public function addWorkman($data) { //function to  add workman 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'PW'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `workman` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],

        ];
        return $this->db->update('workman', $updateData);
    }


    public function getWorkmanById($id){
        $this->db->select ('*');
        $this->db->from('workman');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateWorkmanById($id,$data){
        $currentAadhar = $this->db->select("aadhar_no")->from("workman")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }
        // Perform the update operation
        $this->db->where('id', $id);  
        return $this->db->update('workman', $data);  
    }



    public function deleteWorkman($id) { // Function to delete workman details by setting fields to NULL
        // Retrieve Aadhar number from `workman`
        $currentAadhar = $this->db->select("aadhar_no")->from("workman")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');

        $this->db->select('aadhar_no');
        $this->db->from('workman');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');
    
        // Update `workman` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'firm_name' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('workman', $updateData);
    }
     


        // Fetch workman from the database
        public function get_workman() {
            $this->db->select('*');
            $this->db->from('workman');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_pw_maingate_data($section)
{
    return $this->db
        ->select('token_no, status, section')
        ->get_where('maingate', [
            'section'      => $section,
            'status'       => '1'
            // 'reset_status' => '0'
        ])
        ->result_array();
}
    
        // Add workman to the database
        public function add_workman($token) {
            $token_no = $this->db->count_all('workman');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('workman', $data);
            }
        }
    



    ///=======================================WORKMAN END==================================================================
    //========================================AMC========================================================

    public function addAmc($data) { //function to  add amc 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'AMC'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `amc` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],
        ];
        return $this->db->update('amc', $updateData);
    }


    public function getAmcById($id){
        $this->db->select ('*');
        $this->db->from('amc');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateAmcById($id,$data){
        // Perform the update operation
        $currentAadhar = $this->db->select("aadhar_no")->from("amc")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }
        $this->db->where('id', $id);  
        return $this->db->update('amc', $data);  
    }



    public function deleteAmc($id) { // Function to delete amc details by setting fields to NULL
        // Retrieve Aadhar number from `amc`
        $currentAadhar = $this->db->select("aadhar_no")->from("amc")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');

        $this->db->select('aadhar_no');
        $this->db->from('amc');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');
    
        // Update `amc` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'firm_name' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('amc', $updateData);
    }
    


        // Fetch amc from the database
        public function get_amc() {
            $this->db->select('*');
            $this->db->from('amc');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        // Add amc to the database
        public function add_amc($token) {
            $token_no = $this->db->count_all('amc');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('amc', $data);
            }
        }
    



    ///=======================================AMC END==================================================================

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