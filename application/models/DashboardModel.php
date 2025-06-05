<?php
defined("BASEPATH") or exit("No direct script access allowed");

class DashboardModel extends CI_Model
{

    // constructor
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function MainGate()
{
    // Define the departments you want to count
    $departments = ['Operation', 'Driver', 'Project', 'Visitor'];
    $counts = [];
    $total_count = 0;

    // Subquery: Get the latest date+intime per qr_code
    $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
        ->from('maingate')
        ->group_by('qr_code')
        ->get_compiled_select();

    // Main query: Join with original table to get full rows
    $this->db->select('m.department, COUNT(*) AS department_count')
        ->from('maingate m')
        ->join("($subquery) latest", 'm.qr_code = latest.qr_code AND CONCAT(m.date, " ", m.intime) = latest.latest_datetime')
        ->where('m.status', 1)
        ->where_in('m.department', $departments)
        ->group_by('m.department');

    // Execute the query and store the results
    $results = $this->db->get()->result_array();

    // Initialize all counts to 0
    foreach ($departments as $department) {
        $counts["{$department}_count"] = 0;
    }

    // Populate counts from query
    foreach ($results as $row) {
        $counts["{$row['department']}_count"] = (int)$row['department_count'];
        $total_count += (int)$row['department_count'];
    }

    $counts['total_count'] = $total_count;
    return $counts;
}



    function LicenseGate()
    {
        // Define the departments you want to count
        $departments = ['Operation', 'Driver', 'Project', 'Visitor'];
        $counts = [];
        $total_count = 0;

        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('licensegate')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the count for each department in one query
        $this->db->select('l.department, COUNT(*) AS department_count')
            ->from('licensegate l')
            ->join("($subquery) latest", 'l.qr_code = latest.qr_code AND CONCAT(l.date, " ", l.intime) = latest.latest_datetime')
            ->where('l.status', 1)
            ->where_in('l.department', $departments)
            ->group_by('l.department');

        // Execute the query and store the results
        $results = $this->db->get()->result_array();

        // Process the results
        foreach ($departments as $department) {
            $counts["{$department}_count"] = 0; // Initialize with 0
        }

        foreach ($results as $row) {
            $counts["{$row['department']}_count"] = $row['department_count'];
            $total_count += $row['department_count'];
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }

    function DeLicenseArea()
    {
        // Define the departments you want to count
        $departments = ['Operation', 'Driver', 'Project', 'Visitor'];
        $counts = [];
        $total_count = 0;

        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('delicense')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the count for each department in one query
        $this->db->select('d.department, COUNT(*) AS department_count')
            ->from('delicense d')
            ->join("($subquery) latest", 'd.qr_code = latest.qr_code AND CONCAT(d.date, " ", d.intime) = latest.latest_datetime')
            ->where('d.status', 1)
            ->where_in('d.department', $departments)
            ->group_by('d.department');

        // Execute the query and store the results
        $results = $this->db->get()->result_array();

        // Process the results
        foreach ($departments as $department) {
            $counts["{$department}_count"] = 0; // Initialize with 0
        }

        foreach ($results as $row) {
            $counts["{$row['department']}_count"] = $row['department_count'];
            $total_count += $row['department_count'];
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }

    public function DriverGate()
    {
        // Define the departments you want to count
        $departments = ['Driver'];
        $counts = [];
        $total_count = 0;

        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('licensegate')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the count for each department in one query
        $this->db->select('l.department, COUNT(*) AS department_count')
            ->from('licensegate l')
            ->join("($subquery) latest", 'l.qr_code = latest.qr_code AND CONCAT(l.date, " ", l.intime) = latest.latest_datetime')
            ->where('l.status', 1)
            ->where_in('l.department', $departments)
            ->group_by('l.department');

        // Execute the query and store the results
        $results = $this->db->get()->result_array();

        // Process the results
        foreach ($departments as $department) {
            $counts["{$department}_count"] = 0; // Initialize with 0
        }

        foreach ($results as $row) {
            $counts["{$row['department']}_count"] = $row['department_count'];
            $total_count += $row['department_count'];
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }

    function getTruckInDriverMainGate()
    {
        // Define the departments you want to count
        $departments = ['Driver'];
        $counts = [];
        $total_count = 0;

        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('drivermaingate')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the count for each department in one query
        $this->db->select('m.department, COUNT(*) AS department_count')
            ->from('drivermaingate m')
            ->join("($subquery) latest", 'm.qr_code = latest.qr_code AND CONCAT(m.date, " ", m.intime) = latest.latest_datetime')
            ->where('m.status', 1)
            ->where_in('m.department', $departments)
            ->group_by('m.department');

        // Execute the query and store the results
        $results = $this->db->get()->result_array();

        // Process the results
        foreach ($departments as $department) {
            $counts["Truck_count"] = 0; // Initialize with 0
        }

        foreach ($results as $row) {
            $counts["Truck_count"] = $row['department_count'];
            $total_count += $row['department_count'];
        }

        // Add the total count to the result
        $counts['total_count'] = $total_count;

        return $counts;
    }

    function getTruckInLicenseGate()
    {
        // Define the departments you want to count
        $departments = ['Driver'];
        $counts = [];
        $total_count = 0;

        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('driverlicensegate')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the count for each department in one query
        $this->db->select('l.department, COUNT(*) AS department_count')
            ->from('driverlicensegate l')
            ->join("($subquery) latest", 'l.qr_code = latest.qr_code AND CONCAT(l.date, " ", l.intime) = latest.latest_datetime')
            ->where('l.status', 1)
            ->where_in('l.department', $departments)
            ->group_by('l.department');

        // Execute the query and store the results
        $results = $this->db->get()->result_array();

        // Process the results
        foreach ($departments as $department) {
            $counts["Truck_count"] = 0; // Initialize with 0
        }

        foreach ($results as $row) {
            $counts["Truck_count"] = $row['department_count'];
            $total_count += $row['department_count'];
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
        ', FALSE);  // FALSE prevents escaping of the query
        $query = $this->db->get_compiled_select();

        $result = $this->db->query($query)->row();
        return $result->total_count ?? 0;  // Return the total count
    }

    // Total visitor staff count
    public function totalVisitorStaffCount()
    {
        $this->db->select('COUNT(*) AS total_count');
        $this->db->from('visitor');
        $this->db->where('full_name IS NOT NULL');
        $query = $this->db->get();

        $result = $query->row();
        return $result->total_count ?? 0;  // Return the total count
    }

    public function getStaffInMaingate($department)
    {
        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('maingate')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the latest entry for each department
        $this->db->select('m.*, (CASE 
            WHEN m.section = "OFC" THEN "Officer" 
            WHEN m.section = "EMP" THEN "Employee" 
            WHEN m.section = "CON" THEN "Contractor" 
            WHEN m.section = "CONW" THEN "Contractor_Workman"
            WHEN m.section = "MT" THEN "Mathadi" 
            WHEN m.section = "GAT" THEN "Gat" 
            WHEN m.section = "TAT" THEN "Tat" 
            WHEN m.section = "FEG" THEN "Feg" 
            WHEN m.section = "SEC" THEN "Sec"
            WHEN m.section = "PT" THEN "Packed"
            WHEN m.section = "BK" THEN "Bulk"
            WHEN m.section = "TR" THEN "Transporter"
            WHEN m.section = "AMC" THEN "Amc"
            WHEN m.section = "PW" THEN "Workman"
            WHEN m.section = "V" THEN "Visitor"
            ELSE "Unknown" 
        END) as subdepartment')
            ->from('maingate m')
            ->join("($subquery) latest", 'm.qr_code = latest.qr_code AND CONCAT(m.date, " ", m.intime) = latest.latest_datetime')
            ->where('m.status', 1)
            ->where('m.department', $department);

        return $this->db->get()->result_array();
    }

    public function getStaffInLicensegate($department)
    {
        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('licensegate')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the latest entry for each department
        $this->db->select('l.*, (CASE 
            WHEN l.section = "OFC" THEN "Officer" 
            WHEN l.section = "EMP" THEN "Employee" 
            WHEN l.section = "CON" THEN "Contractor" 
            WHEN l.section = "CONW" THEN "Contractor_Workman"
            WHEN l.section = "MT" THEN "Mathadi" 
            WHEN l.section = "GAT" THEN "Gat" 
            WHEN l.section = "TAT" THEN "Tat" 
            WHEN l.section = "FEG" THEN "Feg" 
            WHEN l.section = "SEC" THEN "Sec"
            WHEN l.section = "PT" THEN "Packed"
            WHEN l.section = "BK" THEN "Bulk"
            WHEN l.section = "TR" THEN "Transporter"
            WHEN l.section = "AMC" THEN "Amc"
            WHEN l.section = "PW" THEN "Workman"
            WHEN l.section = "V" THEN "Visitor"
            ELSE "Unknown" 
        END) as subdepartment')
            ->from('licensegate l')
            ->join("($subquery) latest", 'l.qr_code = latest.qr_code AND CONCAT(l.date, " ", l.intime) = latest.latest_datetime')
            ->where('l.status', 1)
            ->where('l.department', $department);

        return $this->db->get()->result_array();
    }

    public function getStaffInDeLicenseArea($department)
    {
        // Create a subquery to get the latest intime per qr_code
        $subquery = $this->db->select('qr_code, MAX(CONCAT(date, " ", intime)) AS latest_datetime')
            ->from('delicense')
            ->group_by('qr_code')
            ->get_compiled_select();

        // Now fetch the latest entry for each department
        $this->db->select('m.*, (CASE 
            WHEN m.section = "OFC" THEN "Officer" 
            WHEN m.section = "EMP" THEN "Employee" 
            WHEN m.section = "CON" THEN "Contractor" 
            WHEN m.section = "CONW" THEN "Contractor_Workman"
            WHEN m.section = "MT" THEN "Mathadi" 
            WHEN m.section = "GAT" THEN "Gat" 
            WHEN m.section = "TAT" THEN "Tat" 
            WHEN m.section = "FEG" THEN "Feg" 
            WHEN m.section = "SEC" THEN "Sec"
            WHEN m.section = "PT" THEN "Packed"
            WHEN m.section = "BK" THEN "Bulk"
            WHEN m.section = "TR" THEN "Transporter"
            WHEN m.section = "AMC" THEN "Amc"
            WHEN m.section = "PW" THEN "Workman"
            WHEN m.section = "V" THEN "Visitor"
            ELSE "Unknown" 
        END) as subdepartment')
            ->from('delicense m')
            ->join("($subquery) latest", 'm.qr_code = latest.qr_code AND CONCAT(m.date, " ", m.intime) = latest.latest_datetime')
            ->where('m.status', 1)
            ->where('m.department', $department);

        return $this->db->get()->result_array();
    }

    public function getStaffInDriverGate($department)
    {
        $this->db->select('maingate.*, (CASE 
            WHEN maingate.section = "PT" THEN "Packed"
            WHEN maingate.section = "BK" THEN "Bulk"
            WHEN maingate.section = "TR" THEN "Transporter" 
            ELSE "Unknown" 
        END) as subdepartment');
        $this->db->from('maingate');
        $this->db->join('licensegate', 'maingate.qr_code = licensegate.qr_code AND licensegate.status = 1 AND licensegate.department = \'' . $department . '\'', 'inner');
        $this->db->where('maingate.status', 1);
        $this->db->where('maingate.department', $department);
        return $this->db->get()->result_array();
    }

    public function resetCount($password)
    {

        // Check if the password is correct
        $this->db->where('password', $password);
        $data = $this->db->get('reset_pass');
        if ($data->num_rows() == 0) {
            return FALSE;
        }
        $maingate = $this->db->update('maingate', ['status' => 0, 'outtime' => date('H:i:s')]);
        $licensegete = $this->db->update('licensegate', ['status' => 0, 'outtime' => date('H:i:s')]);
        $delicense = $this->db->update('delicense', ['status' => 0, 'outtime' => date('H:i:s')]);
        $drivermaingate = $this->db->update('drivermaingate', ['status' => 0, 'outtime' => date('H:i:s')]);
        $driverlicensegate = $this->db->update('driverlicensegate', ['status' => 0, 'outtime' => date('H:i:s')]);

        if ($maingate && $licensegete && $drivermaingate && $driverlicensegate) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateRestriction($id, $restricted, $tableName, $gateName)
    {
        if($gateName == 'drivermaingate'){
            $gateName = 'maingate';
        } else if($gateName == 'driverlicensegate'){
            $gateName = 'licensegate';
        } else if($gateName == 'delicensearea'){
            $gateName = 'delicense';
        } else {
            $gateName = $gateName;
        }

        $this->db->select('token_no');
        $this->db->from($gateName);
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        if ($query) {
            $data = ['restricted' => $restricted];
    
            $this->db->update($tableName, $data, ['id' => $query->token_no]);
            $this->db->update($gateName, $data, ['id' => $id]);
            $this->db->trans_complete();
            return $this->db->trans_status();
        } else {
            return FALSE; // No record found
        }
    }


    public function getVisitorName($id)
    {
        $this->db->select('full_name');
        $this->db->where('id', $id);
        $query = $this->db->get('visitor');
        if ($query->num_rows() > 0) {
            return $query->row()->full_name;
        } else {
            return 'Unknown';
        }
    }





    public function updateVisitorData($officer_id, $visitor_id, $gates)
    {
        // Data sanitization is handled automatically in CI when using query bindings

        $this->db->trans_start(); // Start Transaction

        // Update notification status
        $this->db->set('status', 1)
            ->where('officer_id', $officer_id)
            ->where('visitor_id', $visitor_id)
            ->update('notification');

        $this->db->set('access', $gates)
            ->where('officer_id', $officer_id)
            ->where('visitor_id', $visitor_id)
            ->update('notification');


        // Update visitor status
        $this->db->set('visitor_status', 1)
            ->where('id', $visitor_id)
            ->update('visitor');

        // Update access gates
        $this->db->set('access', $gates)
            ->where('id', $visitor_id)
            ->update('visitor');

        $this->db->trans_complete(); // Complete Transaction

        return $this->db->trans_status(); // Returns TRUE on success, FALSE on failure
    }


    // function to get break count list
    function getContractorWorkmanList()
    {
        $this->db->select('m.*, c.contractor AS contractorid, co.full_name AS contractor_name');
        $this->db->from('maingate m');

        // Subquery to get the latest intime for each qr_code for today
        $subquery = "(
            SELECT qr_code, MAX(intime) AS latest_intime
            FROM maingate
            WHERE DATE(date) = CURDATE()
            GROUP BY qr_code
        ) latest";

        $this->db->join($subquery, 'm.qr_code = latest.qr_code AND m.intime = latest.latest_intime', 'inner', false);
        $this->db->join('contractor_workman c', 'm.token_no = c.id', 'inner');
        $this->db->join('contractor co', 'c.contractor = co.id', 'inner');

        $this->db->where('m.status', 1);
        $this->db->where_in('m.section', ['CONW']);
        $this->db->order_by('c.contractor', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }   // function ends

    // funtion to get ocntractor list
    function getContractors()
    {
        $this->db->select("id, full_name as name");
        $this->db->from("contractor");
        $this->db->where("aadhar_no != ''");
        $dbresponse = $this->db->get()->result_array();
        if ($dbresponse != null) {
            return $dbresponse;
        } else {
            return null;
        }
    }   // function ends

}