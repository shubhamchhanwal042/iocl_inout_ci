<?php
defined("BASEPATH") or exit("No direct script access allowed");

class DriverModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
    } 


    public function checkAadharExists($aadhar_no) { //function to check if aadhar number exitsts
         $this->db->where('aadhar_no', $aadhar_no);
        $query = $this->db->get('uni_aadhar')->row();

         if ($query) {
            switch ($query->role) {
            case 'OFC':
                $table = 'officer';
                break;
            case 'EMP':
                $table = 'employee';
                break;
            case 'CON':
                $table = 'contractor';
                break;
            case 'CONW':
                $table = 'contractor_workman';
                break;
            case 'GAT':
                $table = 'gat';
                break;
            case 'TAT':
                $table = 'tat';
                break;
            case 'FEG':
                $table = 'feg';
                break;
            case 'SEC':
                $table = 'sec';
                break;
            case 'PT':
                $table = 'packed';
                break;
            case 'BK':
                $table = 'bulk';
                break;
            case 'TR':
                $table = 'transporter';
                break;
            case 'PW':
                $table = 'workman';
                break;
            case 'AMC':
                $table = 'amc';
                break;
            case 'V':
                $table = 'visitor';
                break;
            default:
                return false;
            }
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where('aadhar_no', $aadhar_no);
            return $this->db->get()->row();
        } else {
            return false; // Aadhar number does not exist
        }
    }


    public function get_driver_maingate_data($section)
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





    //========================================PACKED========================================================

    public function addPacked($data) { //function to  add packed 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'PT'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `packed` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],
            'truck_no' => $data['truck_no'],
            'photo' => $data['photo'],
            'id_proof' => $data['idphoto'],


        ];
        return $this->db->update('packed', $updateData);
    }


    public function getPackedById($id){
        $this->db->select ('*');
        $this->db->from('packed');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updatePackedById($id,$data){
        // Perform the update operation
        $this->db->where('id', $id);  // Assuming 'employeeId' is the column for employee identifier
        return $this->db->update('packed', $data);  // Assuming 'employee_leave_table' is the table name
    }



    public function deletePacked($id) { // Function to delete packed details by setting fields to NULL
        // Retrieve Aadhar number from `packed`
        $this->db->select('aadhar_no');
        $this->db->from('packed');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');
    
        // Update `packed` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'firm_name' => null,
            'truck_no' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('packed', $updateData);
    }
     


        // Fetch packed from the database
        public function get_packed() {
            $this->db->select('*');
            $this->db->from('packed');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        // Add packed to the database
        public function add_packed($token) {
            $token_no = $this->db->count_all('packed');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('packed', $data);
            }
        }
    



    ///=======================================PACKED END==================================================================
    //========================================BULK========================================================

    public function addBulk($data) { //function to  add bulk 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'BK'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `bulk` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],
            'truck_no' => $data['truck_no'],
            'photo' => $data['photo'],
            'id_proof' => $data['idphoto'],


        ];
        return $this->db->update('bulk', $updateData);
    }


    public function getBulkById($id){
        $this->db->select ('*');
        $this->db->from('bulk');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateBulkById($id,$data){
        // Perform the update operation
        $this->db->where('id', $id);  
        return $this->db->update('bulk', $data);  
    }



    public function deleteBulk($id) { // Function to delete bulk details by setting fields to NULL
        // Retrieve Aadhar number from `bulk`
        $this->db->select('aadhar_no');
        $this->db->from('bulk');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');
    
        // Update `bulk` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'firm_name' => null,
            'truck_no' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('bulk', $updateData);
    }
    


        // Fetch bulk from the database
        public function get_bulk() {
            $this->db->select('*');
            $this->db->from('bulk');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        // Add bulk to the database
        public function add_bulk($token) {
            $token_no = $this->db->count_all('bulk');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('bulk', $data);
            }
        }
    



    ///=======================================BULK END==================================================================
    //========================================TRANSPORTER========================================================

    public function addTransporter($data) { //function to  add transporter 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'TR'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `transporter` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],
            'truck_no' => $data['truck_no'],
            'photo' => $data['photo'],
            'id_proof' => $data['idphoto'],


        ];
        return $this->db->update('transporter', $updateData);
    }


    public function getTransporterById($id){
        $this->db->select ('*');
        $this->db->from('transporter');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateTransporterById($id,$data){
        // Perform the update operation
        $this->db->where('id', $id);  
        return $this->db->update('transporter', $data);  
    }



    public function deleteTransporter($id) { // Function to delete transporter details by setting fields to NULL
        // Retrieve Aadhar number from `bulk`
        $this->db->select('aadhar_no');
        $this->db->from('transporter');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');
    
        // Update `transporter` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'firm_name' => null,
            'truck_no' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('transporter', $updateData);
    }
    


        // Fetch transporter from the database
        public function get_transporter() {
            $this->db->select('*');
            $this->db->from('transporter');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        // Add transporter to the database
        public function add_transporter($token) {
            $token_no = $this->db->count_all('transporter');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('transporter', $data);
            }
        }
    



    ///=======================================TRANSPORTER END==================================================================


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
public function get_bulk_maingate_data($section)
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

function add_parking($formdata){
    // Add current intime
    $formdata['intime'] = date('Y-m-d H:i:s');
    $this->db->insert('parking', $formdata);
    return $this->db->insert_id();
}
}
?>