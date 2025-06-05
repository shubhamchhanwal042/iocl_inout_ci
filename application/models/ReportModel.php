<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends CI_Model
{

    // public function __construct() {
    //     parent::__construct();
    //     // Load libraries
    //     $this->load->library([ 'form_validation', 'phpmailer_lib']);

    //     // Load database
    //     $this->load->database();

    //     // Load model
    //     $this->load->model("ReportModel");
    //     $this->load->model('DashboardModel');
    //     date_default_timezone_set('Asia/Kolkata');

    // }





    // public function truncateReportTable() {
    //     return $this->db->truncate('report');
    // }

    // public function insertReport($data) {
    //     $this->db->insert('report', $data);
    //     return $this->db->insert_id(); // Return last inserted ID
    // }

    // public function getLastReportId() {
    //     $this->db->select('report_id');
    //     $this->db->order_by('report_id', 'DESC');
    //     $this->db->limit(1);
    //     $query = $this->db->get('report');

    //     return ($query->num_rows() > 0) ? $query->row()->report_id : null;
    // }







    //*
    public function getSqlQuery($params)
    {
        $fromdate = $params['fd'];
        $todate = $params['td'];
        $from_time = $params['ft'];
        $to_time = $params['tt'];
        $section = $this->getSection($params['sub_dept']);
        $name_filter = ($params['nm'] !== "all") ? " AND name = '" . $params['nm'] . "'" : "";

        $gates = ($params['gate'] === "all") ? ["maingate", "licensegate"] : [$params['gate']];
        if (in_array($params['dept'], ['driver', 'truck'])) {
            $gates = array_merge($gates, ["drivermaingate", "driverlicensegate"]);
        }

        $queries = [];
        foreach ($gates as $gate) {
            $query = "SELECT '$gate' AS source_table, id, qr_code, intime, outtime, date, section, token_no, department, 
                      adhar, name, mobile, address, status, restricted 
                      FROM $gate 
                      WHERE date BETWEEN '$fromdate' AND '$todate' 
                      AND (intime >= '$from_time' OR outtime <= '$to_time')";

            if ($section !== "all") {
                $query .= " AND section = '$section'";
            }

            $query .= $name_filter;
            $queries[] = $query;
        }

        $sql = implode(" UNION ALL ", $queries);
        return ["sql" => $sql, "reportid" => $params['id'], "tablename" => $params['gate']];
    }

    public function getDataFromSql($returnedSql)
    {
        $sql = $returnedSql['sql'];
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $this->db->truncate('report_data'); // Ensure safe truncation after data retrieval
            
            return ["report_id" => $returnedSql['reportid'], "data" => $data];
        }else{
            return [null];
        }
    }

    private function getSection($sub_depart)
    {
        $sections = [
            'officer' => 'OFC',
            'employee' => 'EMP',
            'contractor' => 'CON',
            'contractor workman' => 'CONW',
            'gat' => 'GAT',
            'tat' => 'TAT',
            'feg' => 'FEG',
            'sec' => 'SEC',
            'mathadi' => 'MT',
            'packed' => 'PT',
            'bulk' => 'BK',
            'transporter' => 'TR',
            'amc' => 'AMC',
            'workman' => 'PW',
            'visitor' => 'V',
            'all' => 'all',
            'All' => 'all'
        ];
        return $sections[$sub_depart] ?? null;
    }

    //---------

    public function get_all_reportdata()
    { //*
        $query = $this->db->get('report'); // Fetch all records from the report table
        return $query->result_array(); // Return as an associative array
    }


    public function truncate_report_table()
    { //*
        return $this->db->truncate('report'); // CodeIgniter query builder function
    }

    public function insert_report_data($data)
    { //*
        $insert_data = [
            'report_gen_time' => date('Y-m-d H:i:s'), // Use current timestamp
            'from_date'       => $data['from_date'],
            'to_date'         => $data['to_date'],
            'department'      => $data['department'],
            'sub_department'  => $data['sub_department'],
            'name'            => $data['name'],
            'gate'            => $data['gate']
        ];

        return $this->db->insert('report', $insert_data); // Insert data into the report table
    }

    public function get_latest_report_id()
    { //*
        $query = $this->db->select('report_id')->from('report')->order_by('report_id', 'DESC')->limit(1)->get();
        return $query->row_array();
    }











    public function insertReportData($data)
    {
        $insert_data = [
            'report_id'      => $data['report_id'],
            'name'           => $data['name'],
            'department'     => $data['department'],
            'sub_department' => $data['sub_department'],
            'time_in'        => $data['time_in'],
            'time_out'       => $data['time_out'],
            'check_in_dt'    => $data['check_in_dt'],
            'check_out_dt'   => $data['check_out_dt'],
            'gate_name'      => $data['gate']
        ];
        return $this->db->insert('report_data', $insert_data);
    }


    // advanced report functions

    // function to truncate report table
    function TruncateReport()
    {
        return $this->db->truncate("report");
    }   // function ends

    // function to insert new report
    function newReportPost($reportData)
    {
        $insertstatus = $this->db->insert("report", $reportData);
        if ($insertstatus) {
            return array(
                'report_id' => $this->db->insert_id()
            );
        } else {
            return false;
        }
    }   // function ends


    // Function to generate advanced report
    function generatedAdvancedReport($formdata)
    {
        // Define table names
        $allTables = ['maingate', 'licensegate', 'drivermaingate', 'driverlicensegate'];

        // Check if a specific table is requested, else use all tables
        $tables = ($formdata['gate'] === 'All' || $formdata['gate'] === 'all') ? $allTables : array($formdata['gate']);

        $query_parts = [];

        foreach ($tables as $table) {
            // Select all fields and add table name as 'gatename'
            $this->db->select("*, '$table' AS gatename");
            $this->db->from($table);
            $this->db->where('1 = 1'); // Ensures valid WHERE clause

            // Apply filters dynamically
            if (!empty($formdata['fromdate']) && !empty($formdata['todate'])) {
                $this->db->where("date BETWEEN '{$formdata['fromdate']}' AND '{$formdata['todate']}'");
            }

            if (!empty($formdata['department']) && $formdata['department'] !== 'All') {
                $this->db->where('department', $formdata['department']);
            }

            if (!empty($formdata['sub_department']) && $formdata['sub_department'] !== 'All') {
                $this->db->where('section', $this->getSection($formdata['sub_department']));
            }

            if (!empty($formdata['name']) && $formdata['name'] !== 'All') {
                $this->db->where('name', $formdata['name']);
            }
            // $this->db->group_by("name"); 

            // Store each query as a string
            $query_parts[] = $this->db->get_compiled_select();
        }

        // Combine all queries using UNION ALL
        $final_query = implode(" UNION ALL ", $query_parts);

        // Execute query
        $query = $this->db->query($final_query);
        return $query->result_array();
    } // Function ends


    function Parkingreport($formdata){
    
    $this->db->select('*');
    $this->db->from('parking_data');
    $this->db->where('parking_date >=', $formdata['fromdate']);
    $this->db->where('parking_date <=', $formdata['todate']);
    
    $query = $this->db->get();
    return $query->result_array();
    
    }

    public function getNamesBySubDepartment($sub_department)
    {
        $this->db->select('full_name');
        $this->db->from($sub_department);
        $this->db->where('full_name !=', '');
        $query = $this->db->get();
        return $query->result_array();
    }

}
