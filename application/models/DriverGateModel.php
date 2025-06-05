

<?php
defined("BASEPATH") or exit("No direct script access allowed");

class DriverGateModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
 
    }
    public function GetExistRecord($uniqueValue, $table) {
        // Query the table to check if the record exists by matching the QR code
        $this->db->where('qr_code', $uniqueValue);
        $query = $this->db->get($table);
        
        // If the query returns 1 or more rows, that means the QR code exists
        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return the first row as an object (single record)
        } else {
            return null; // No record found
        }
    }
    

    function CheckMaingateExsist($uniqueValue) {
        // Perform the query to find the record based on the unique QR code
        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by ID descending to get the latest record
    
        // Execute the query
        $query = $this->db->get('drivermaingate', 1); // Limit the result to 1 row
        
        if ($query->num_rows() > 0) {
            // Return the result as an array of objects
            return $query->result();
        } else {
            // Return null if no matching record is found
            return null;
        }
    }
    

    public function UpdateStatus($uniqueValue) {
            
        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by created_at to get the latest record
        $query = $this->db->get('drivermaingate', 1); // Limit the query to just the latest record

        // Check if the record exists
        if ($query->num_rows() > 0) {
            // Get the most recent record
            $result = $query->row();  // Fetch the first (and only) row from the query result
            $currentStatus = $result->status; // Get the current status of the most recent record
            date_default_timezone_set('Asia/Kolkata');  // IST Timezone

            $newStatus = 0;
            $outtime = date('H:i:s'); // Get the current time in HH:MM:SS format

    
            $this->db->where('id', $result->id);  // Ensure we're updating the latest entry by using the ID
            // print_r('id');die;
            $this->db->update('drivermaingate', ['status' => $newStatus, 'outtime' => $outtime]);
    
            return true;  // Return true to indicate the update was successful
        } else {
            return false; // Return false if no record is found
        }
    }


    

    public function InsertMaingate($uniqueValue, $records, $CheckMaingate) {
        // Assuming $CheckMaingate is an array of objects and we want to get the first record
        // $existingRecord = $CheckMaingate[0]; // The first record (since you ordered by DESC in your model)
        date_default_timezone_set('Asia/Kolkata');  // IST Timezone

        $parts = explode('/', $uniqueValue);

       $section =  $parts[0];
        // print_r($section);die;
        
        // Prepare the data for insertion
        $data = [
            'qr_code' => $uniqueValue,
            'intime' => date('H:i:s'), 
            'token_no' => $records['token_no'],  
            'section' => $section,  
            'department' => isset($records['working_as']) ? trim(explode('-', $records['working_as'])[0]) : trim($records['working_as']),
            'adhar' => $records['aadhar_no'], 
            'name' => $records['full_name'],  
            'mobile' => $records['mobile_no'], 
            'address' => $records['address'],  
            'date' => date('Y-m-d'),
            
            'truck_no' => isset($records['truck_no']) ? $records['truck_no'] : null,  // If truck_no exists, use it, otherwise set it as null
        ];
    // print_r($data);die; 
        // Insert the record into the database
        $this->db->insert('drivermaingate', $data);
    
        // Return true if insert was successful
        return true;
    }

    function CheckLicengateStatus($uniqueValue) {
        $this->db->select('*');
        $this->db->from('driverlicensegate');
        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by id in descending order to get the latest entry
        $this->db->limit(1);  // Limit to just the most recent entry
    
        $query = $this->db->get();
    
        // Check if a result was returned
        if ($query->num_rows() > 0) {
            // Return the result as an array of objects
            return $query->result();
        } else {
            // Return null if no matching record is found
            return null;
        }
    }
    
}
?>