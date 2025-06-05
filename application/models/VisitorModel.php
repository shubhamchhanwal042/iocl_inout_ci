<?php
defined("BASEPATH") or exit("No direct script access allowed");

class VisitorModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
    } 

    public function checkAadharExists($aadhar_no) { //function to check if aadhar number exitsts
         $this->db->where('aadhar_no', $aadhar_no);
        $query = $this->db->get('uni_aadhar')->row();
    // print_r($query);die;
    if($query){   
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

        } elseif($query->role=='V'){
            $this->db->select('*');
            $this->db->from('visitor');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row(); 
        } else {
             return false;
        }

    } else {
            return false;   
    }
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





    //========================================VISITOR========================================================

    public function addVisitor($data) { //function to  add workman 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'V'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `workman` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'to_see_whom' =>  $data['to_see_whom'],
            'purpose_to_visit' =>  $data['purpose_to_visit'],
            'photo' => $data['photo'] ?? null,
            'idphoto' => $data['idphoto'] ?? null,

             'access' => $data['access'],

        ];
        return $this->db->update('visitor', $updateData);
    }


    public function getVisitorById($id){
        $this->db->select ('*');
        $this->db->from('visitor');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateVisitorById($id,$data){
        // Perform the update operation
        $this->db->where('id', $id);  
        return $this->db->update('visitor', $data);  
        
    }


    public function get_visitor_by_token($token) {
        $this->db->where('token_no', $token);
        $query = $this->db->get('visitor'); 
        return $query->row_array(); // Returns a single row as an associative array
    } 

    public function get_last_srno() {
        $query = $this->db->query("SELECT MAX(srno) AS last_srno FROM srno");
        return ($query->num_rows() > 0) ? $query->row()->last_srno : null;
    }



    
// public function get_last_srno() {
//     $query = $this->db->select_max('srno', 'last_srno')->get('srno');
//     return $query->row()->last_srno;
// }

    public function deleteVisitor($id) { // Function to delete visitor details by setting fields to NULL
        // Retrieve Aadhar number from `visitor`
        $this->db->select('aadhar_no');
        $this->db->from('visitor');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');
    
        // Update `visitor` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'to_see_whom' => null,
            'purpose_to_visit' => null,


             'access' => null,
            'qr_code' => null, 
            'qr_path' => null,

        ];
        return $this->db->update('visitor', $updateData);
    }
     
 

        // Fetch visitor from the database
        public function get_visitor() {
            $this->db->select('*');
            $this->db->from('visitor');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        // Add visitor to the database
        public function add_visitor($token) {
            $token_no = $this->db->count_all('visitor');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('visitor', $data);
            }
        }
    



        public function processVisitor($token, $srno) {
            date_default_timezone_set('Asia/Kolkata');
            $intime = date('H:i:s');
        
            // Fetch visitor details
            $visitor = $this->db->get_where('visitor', ['token_no' => $token])->row_array();
            if (!$visitor) {
                return ['success' => false, 'message' => "Visitor detail not found"];
            }
        
            // Prepare data for insertion into `srno`
            $visitorData = [
                'srno'              => $srno,
                'token_no'          => $visitor['token_no'],
                'aadhar'         => $visitor['aadhar_no'],
                'full_name'         => $visitor['full_name'],
                'mobile_no'         => $visitor['mobile_no'],
                'address'           => $visitor['address'],
                'to_see_whom'       => $visitor['to_see_whom'],
                'purpose_to_visit'  => $visitor['purpose_to_visit'],
                'is_regular'        => $visitor['is_regular'],
                'date'              => $visitor['date'],
                'working_as'        => $visitor['working_as'],
                'photo'             => $visitor['photo'],
                'idphoto'           => $visitor['idphoto'],
                'qr_code'           => $visitor['qr_code'],
                'qr_path'           => $visitor['qr_path'],
                'timein'            => $intime,  // Ensure consistency in column names
                'timeout'           => $visitor['time_out'] ?? NULL, // Handle NULL values
                'restricted'        => $visitor['restricted'],
                // 'visitor_status'    => $visitor['visitor_status'],
                // 'access'            => $visitor['access']
            ];
        // print_r($visitorData);die;
            // Insert into `srno` table
            $this->db->insert('srno', $visitorData);
        
            // Update `visitor` table with `srno` and `time_in`
            $this->db->where('token_no', $token)->update('visitor', [
                'srno'     => $srno,
                'time_in'  => $intime
            ]);
        
            return ['success' => true, 'message' => "Data sent successfully"];
        }
        


        public function get_visitor_by_srno($sr_no) { //for search pass
            $this->db->where('srno', $sr_no);
            $query = $this->db->get('visitor'); // Assuming 'visitors' is your table
    
            if ($query->num_rows() > 0) {
                return $query->row_array(); // Return visitor details
            } else {
                return false;
            }
        }
    



        public function get_officers()
        {
            $this->db->select('*');
            $this->db->from('officer');
            $query = $this->db->get();
            return $query->result_array();
        }




        







        public function getCurrentVisitors() {
            $this->db->where('is_regular', '1');
            $this->db->or_where('date', date('Y-m-d'));
            $this->db->or_where('aadhar_no', NULL);
            return $this->db->get('visitor')->result_array();
        }
    
        // Get the last token number
        public function getLastTokenNo() {
            $this->db->select_max('token_no', 'last_token');
            $query = $this->db->get('visitor');
            return $query->row()->last_token ?? 0; // Return 0 if no token exists
        }
    
        // Get the last srno number
        public function getLastSrno() {
            $this->db->select_max('srno', 'last_srno');
            $query = $this->db->get('srno');
            return $query->row()->last_srno ?? 0; // Return 0 if no srno exists
        }
    
        // Insert new tokens into visitor table
        public function insertTokens($startToken, $totalTokens) {
            $data = [];
            for ($x = $startToken; $x <= $totalTokens; $x++) {
                $data[] = ['token_no' => $x];
            }
            return $this->db->insert_batch('visitor', $data); // Insert multiple rows at once
        }

        //insert new srno
        public function insertSrNo($sr_no) {
            return $this->db->insert('srno', ['srno' => $sr_no]);
        }
    ///=======================================VISITOR END=================================================================

    //========================================ICARD===========================================================
//                              -------------ICARD COMMON CODE----------

// public function getQrById($token_no ,$table) {
//     $this->db->select('qr_code');
//     $this->db->from($table);
//     $this->db->where('token_no', $token_no);
//     $query = $this->db->get();
//     return $query->row_array();
// }

// public function generateQr($token_no, $table, $data){
//     $this->db->where('token_no', $token_no);
//     return $this->db->update($table, $data);
// }

// public function getQrDataById($token_no ,$table) {
//     $this->db->select('*');
//     $this->db->from($table);
//     $this->db->where('token_no', $token_no);
//     $query = $this->db->get();
//     return $query->row_array();
// }


//                           ---------------ICARD COMMON CODE END----------------


//=============================================NOTIFICATIONS=================================================================

public function insertNotifications($data) {
    $notifications = [];
    foreach (explode(',', $data['access']) as $access) {
        $notifications[] = [
            'to_see_whom' => $data['to_see_whom'],
            'purpose_to_visit' => $data['purpose_to_visit'],
            'officer_id' => $data['officer_id'],
            'access' => $access,
            'visitor_id' => $data['visitor_id'],
            
        ];
    }
    return !empty($notifications) ? $this->db->insert_batch('notification', $notifications) : false;
}


//pass officer id correctly then this part will be done and notifications will work properly
public function updateNotifications($id, $data) {
    // Check if notifications exist for the visitor
    $this->db->where('visitor_id', $id);
    $query = $this->db->get('notification');

    if ($query->num_rows() > 0) {
        // If notifications exist, update them
        foreach (explode(',', $data['access']) as $access) {
            $update_data = [
                'to_see_whom' => $data['to_see_whom'],
                'purpose_to_visit' => $data['purpose_to_visit'],
                'officer_id' => $data['officer_id'],
                'access' => $access
            ];
            $this->db->where('visitor_id', $id);
            $this->db->where('access', $access);
            $this->db->update('notification', $update_data);
        }
        return true;
    } else {
        // If no existing notifications, insert new ones
        return false;
    }
}



// public function updateNotifications($id, $data) {
//     $notifications = [];
//     foreach (explode(',', $data['access']) as $access) {
//         $notifications[] = [
//             'to_see_whom' => $data['to_see_whom'],
//             'purpose_to_visit' => $data['purpose_to_visit'],
//             'officer_id' => $data['officer_id'],
//             'access' => $access,
//             'visitor_id' => $data['visitor_id'],
            
//         ];
//     }
//     return !empty($notifications) ? $this->db->insert_batch('notification', $notifications) : false;
// }

//========================================NOTIFICATIONS END===========================================================



}
?>