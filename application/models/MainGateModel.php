<?php
defined("BASEPATH") or exit("No direct script access allowed");

class MainGateModel extends CI_Model
{

    // constructor
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function GetIn()
    {
        $this->db->where('status', 1); // Add condition for stats = 1
        $query = $this->db->get('maingate'); // Query the maigngat table

        if ($query->num_rows() > 0) {
            return $query->result(); // Return result as an array of objects
        } else {
            return null; // Return null if no data found
        }
    }

    function OperationCounts()
    {
        $this->db->where('status', 1); // Add condition for stats = 1
        $this->db->where('department', 'operation');
        $query = $this->db->get('maingate'); // Query the maigngat table

        if ($query->num_rows() > 0) {
            return $query->result(); // Return result as an array of objects
        } else {
            return null; // Return null if no data found
        }
    }

    function MainGate()
    {
        // Define the departments you want to count
        $departments = ['operation', 'driver', 'project', 'visitor'];
        $counts = [];
        $total_count = 0;
        // print_r($departments);die;
        // Loop through each department and get the count
        foreach ($departments as $department) {
            $this->db->where('status', 1);
            $this->db->where('department', $department);
            $count = $this->db->count_all_results('maingate');
            $counts["{$department}_count"] = $count;
            $total_count += $count;
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }

    function LicenseGate()
    {
        // Define the departments you want to count
        $departments = ['operation', 'driver', 'project', 'visitor'];

        $counts = [];
        $total_count = 0;

        // Loop through each department and get the count
        foreach ($departments as $department) {
            $this->db->where('status', 1);
            $this->db->where('department', $department);
            $count = $this->db->count_all_results('licensegate');
            $total_count += $count;
            $counts['total_count'] = $total_count;

            return $counts;
        }
    }

    function DeLicenseArea()
    {
        // Define the departments you want to count
        $departments = ['operation', 'driver', 'project', 'visitor'];
        $counts = [];
        $total_count = 0;

        // Loop through each department and get the count of entries in maingate but not in licensegate
        foreach ($departments as $department) {
            $this->db->from('maingate');
            $this->db->join('licensegate', 'maingate.qr_code = licensegate.qr_code AND licensegate.status = 0 AND licensegate.department = \'' . $department . '\'', 'left');
            $this->db->where('maingate.status', 1);
            $this->db->where('maingate.department', $department);
            $this->db->where('licensegate.qr_code IS NULL');
            $count = $this->db->count_all_results();
            $counts["{$department}_count"] = $count;
            $total_count += $count;
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }

    public function DriverGate()
    {
        // Define the departments you want to count
        $departments = ['driver'];
        $counts = [];
        $total_count = 0;

        // Loop through each department and get the count of entries in maingate and licensegate
        foreach ($departments as $department) {
            $this->db->from('drivermaingate');
            // $this->db->join('driverlicensegate', 'drivermaingate.qr_code = driverlicensegate.qr_code AND driverlicensegate.status = 0 AND driverlicensegate.department = \'' . $department . '\'', 'inner');
            $this->db->where('drivermaingate.status', 1);
            $this->db->where('drivermaingate.department', $department);
            $count = $this->db->count_all_results();
            $counts["{$department}_count"] = $count;
            $total_count += $count;
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }



    public function DriverLicenseGate()
    {
        // Define the departments you want to count
        $departments = ['driver'];
        $counts = [];
        $total_count = 0;

        // Loop through each department and get the count of entries in maingate and licensegate
        foreach ($departments as $department) {
            $this->db->from('driverlicensegate');
            // $this->db->join('driverlicensegate', 'drivermaingate.qr_code = driverlicensegate.qr_code AND driverlicensegate.status = 0 AND driverlicensegate.department = \'' . $department . '\'', 'inner');
            $this->db->where('driverlicensegate.status', 1);
            $this->db->where('driverlicensegate.department', $department);
            $count = $this->db->count_all_results();
            $counts["{$department}_count"] = $count;
            $total_count += $count;
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }


    // Total operation staff count
    public function totalOperationStaffCount()
    {
        $this->db->select('
            (SELECT COUNT(*) FROM officer WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM contractor WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM contractor_workman WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM employee WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM gat WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM tat WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM feg WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM sec WHERE full_name IS NOT NULL) AS total_count
        ', FALSE);  // FALSE prevents escaping of the query
        $query = $this->db->get_compiled_select();

        $result = $this->db->query($query)->row();
        return $result->total_count ?? 0;  // Return the total count
    }

    // Total driver staff count
    public function totalDriverStaffCount()
    {
        $this->db->select('
            (SELECT COUNT(*) FROM packed WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM bulk WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM transporter WHERE full_name IS NOT NULL) AS total_count
        ', FALSE);  // FALSE prevents escaping of the query
        $query = $this->db->get_compiled_select();

        $result = $this->db->query($query)->row();
        return $result->total_count ?? 0;  // Return the total count
    }

    // Total project staff count
    public function totalProjectStaffCount()
    {
        $this->db->select('
            (SELECT COUNT(*) FROM amc WHERE full_name IS NOT NULL) +
            (SELECT COUNT(*) FROM workman WHERE full_name IS NOT NULL) AS total_count
        ', FALSE);
        $query = $this->db->get_compiled_select();

        $result = $this->db->query($query)->row();
        return $result->total_count ?? 0;  // Return the total count
    }

    // Total visitor staff count
    public function totalVisitorStaffCount()
    {
        $this->db->select('COUNT(*) AS total_count');
        $this->db->from('visitor');
        $this->db->where('srno IS NOT NULL');
        $query = $this->db->get();

        $result = $query->row();
        return $result->total_count ?? 0;  // Return the total count
    }

    function OperationCount()
    {
        $this->db->where('status', 1); // Add condition for stats = 1
        $this->db->where('section', 'OFC');
        $query = $this->db->get('maingate'); // Query the maigngat table

        if ($query->num_rows() > 0) {
            return $query->result(); // Return result as an array of objects
        } else {
            return null; // Return null if no data found
        }
    }

    // function CheckMaingateExsist()
    // {
    //     $this->db->where('status', 1); // Add condition for stats = 1
    //     $query = $this->db->get('maingate'); // Query the maigngat table

    //     if ($query->num_rows() > 0) {
    //         return $query->result(); // Return result as an array of objects
    //     } else {
    //         return null; // Return null if no data found
    //     }
    // }

    function CheckMaingateExsist($uniqueValue)
    {
        // Perform the query to find the record based on the unique QR code
        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by ID descending to get the latest record

        // Execute the query
        $query = $this->db->get('maingate', 1); // Limit the result to 1 row

        if ($query->num_rows() > 0) {
            // Return the result as an array of objects
            return $query->result();
        } else {
            // Return null if no matching record is found
            return null;
        }
    }




    //  --------------------------------------------SHUBHAM CHHANWAL GATES CODES STARTS ---------------------------
    public function GetExistRecord($uniqueValue, $table)
    {
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


    function CheckRestricted($uniqueValue,$tableName)
    {
        // Define the tables to check for restricted status
        $this->db->where('restricted', 1);
        $this->db->where('qr_code',$uniqueValue);
        $query = $this->db->get($tableName);

        if ($query->num_rows() > 0) {
            return 1;  // Return 1 if a restricted record is found
        } else {
            return 0;  // Return 0 if no restricted record is found
        }
    }
    


    public function UpdateStatus($uniqueValue)
    {

        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by created_at to get the latest record
        $query = $this->db->get('maingate', 1); // Limit the query to just the latest record

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
            $this->db->update('maingate', ['status' => $newStatus, 'outtime' => $outtime]);

            return true;  // Return true to indicate the update was successful
        } else {
            return false; // Return false if no record is found
        }
    }
    // print_r('id');die;
    function UpdateDelicenseStatus($uniqueValue)
    {
        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by created_at to get the latest record
        $query = $this->db->get('delicense', 1); // Limit the query to just the latest record

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
            $this->db->update('delicense', ['status' => $newStatus, 'outtime' => $outtime]);

            return true;  // Return true to indicate the update was successful
        } else {
            return false; // Return false if no record is found
        }
    }

    function UpdateDelicenseStatusExit($uniqueValue)
    {
        $this->db->where('qr_code', $uniqueValue);
        $this->db->order_by('id', 'DESC');  // Order by created_at to get the latest record
        $query = $this->db->get('delicense', 1); // Limit the query to just the latest record

        // Check if the record exists
        if ($query->num_rows() > 0) {
            // Get the most recent record
            $result = $query->row();  // Fetch the first (and only) row from the query result
            $currentStatus = $result->status; // Get the current status of the most recent record
            date_default_timezone_set('Asia/Kolkata');  // IST Timezone

            $newStatus = 1;
            $outtime = date('H:i:s'); // Get the current time in HH:MM:SS format


            $this->db->where('id', $result->id);  // Ensure we're updating the latest entry by using the ID
            // print_r('id');die;
            $this->db->update('delicense', ['status' => $newStatus, 'outtime' => $outtime]);

            return true;  // Return true to indicate the update was successful
        } else {
            return false; // Return false if no record is found
        }
    }

    public function InsertMaingate($uniqueValue, $records, $CheckMaingate)
    {
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

            // 'truck_no' => isset($records['truck_no']) ? $records['truck_no'] : null,  // If truck_no exists, use it, otherwise set it as null
        ];
        // print_r($data);die; 
        // Insert the record into the database
        $this->db->insert('maingate', $data);

        // Return true if insert was successful
        return true;
    }


    public function InsertDelicense($uniqueValue, $records, $CheckMaingate)
    {
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

            // 'truck_no' => isset($records['truck_no']) ? $records['truck_no'] : null,  // If truck_no exists, use it, otherwise set it as null
        ];
        // print_r($data);die; 
        // Insert the record into the database
        $this->db->insert('delicense', $data);

        // Return true if insert was successful
        return true;
    }

    // 'truck_no' => isset($records['truck_no']) ? $records['truck_no'] : NULL,  // If truck_no exists, use it, otherwise set it as null
    function CheckLicengateStatus($uniqueValue)
    {
        $this->db->select('*');
        $this->db->from('licensegate');
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
    
        // Return the number of affected rows (how many records were inserted)
