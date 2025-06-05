<?php
defined("BASEPATH") or exit("No direct script access allowed");

class OperationModel extends CI_Model
{

    // constructor
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    // public function checkAadharExists($aadhar_no) { //function to check if aadhar number exitsts
    //     $this->db->where('aadhar_no', $aadhar_no);
    //     $query = $this->db->get('uni_aadhar')->row();

    //     if($query){
    //         return $query->num_rows() > 0;
    //     }else{
    //         return false;
    //     }
    // }



    public function checkAadharExistGetData($aadhar_no)
    { //function to check if aadhar number exitsts for autofill
        $this->db->where('aadhar_no', $aadhar_no);
        $query = $this->db->get('uni_aadhar')->row();

        if ($query->role == 'OFC') {
            $this->db->select('*');
            $this->db->from('officer');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'EMP') {
            $this->db->select('*');
            $this->db->from('employee');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'CON') {
            $this->db->select('*');
            $this->db->from('contractor');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'CONW') {
            $this->db->select('*');
            $this->db->from('contractor_workman');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'MT') {
            $this->db->select('*');
            $this->db->from('mathadi');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'GAT') {
            $this->db->select('*');
            $this->db->from('gat');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'TAT') {
            $this->db->select('*');
            $this->db->from('tat');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'FEG') {
            $this->db->select('*');
            $this->db->from('feg');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'SEC') {
            $this->db->select('*');
            $this->db->from('sec');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'PT') {
            $this->db->select('*');
            $this->db->from('packed');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'BK') {
            $this->db->select('*');
            $this->db->from('bulk');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'TR') {
            $this->db->select('*');
            $this->db->from('transporter');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'PW') {
            $this->db->select('*');
            $this->db->from('workman');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } elseif ($query->role == 'AMC') {
            $this->db->select('*');
            $this->db->from('amc');
            $this->db->where('aadhar_no', $aadhar_no);
            return $query = $this->db->get()->row();
        } else {
            return false;
        }
    }




    //========================================OFFICER========================================================

    public function addOfficer($data)
    { //function to  add officer 
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'OFC'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `officer` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
        ];
        return $this->db->update('officer', $updateData);
    }


    public function getOfficerById($id)
    {
        $this->db->select('*');
        $this->db->from('officer');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateOfficerById($id, $data)
    {
        // Retrieve the current Aadhar number for the officer
        $currentAadhar = $this->db->select("aadhar_no")->from("officer")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('officer', $data);
    }



    public function deleteOfficer($id)
    { // Function to delete officer details by setting fields to NULL
        // Retrieve Aadhar number from `officer`
        $currentAadhar = $this->db->select("aadhar_no")->from("officer")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');

        $this->db->select('aadhar_no');
        $this->db->from('officer');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');

        // Update `officer` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('officer', $updateData);
    }



    // Fetch officers from the database
    public function get_officers()
    {
        $this->db->select('*');
        $this->db->from('officer');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_officers_maingate()
    {
        $this->db->select('*');
        $this->db->from('officer');
        $query = $this->db->get();
        return $query->result_array();
    }



    // Add officers to the database
    public function add_officers($token)
    {
        $token_no = $this->db->count_all('officer');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('officer', $data);
        }
    }




    ///=======================================OFFICER END==================================================================
    //============================================EMPLOYEE===================================================
    public function addEmployee($data)
    { //function to  add employee
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'EMP'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `employee` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
        ];
        return $this->db->update('employee', $updateData);
    }

    public function getEmployeeById($id)
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateEmployeeById($id, $data)
    {
        $currentAadhar = $this->db->select("aadhar_no")->from("employee")->where("id", $id)->get()->row_array();
// print_r($data);die;
        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);

    }

    public function deleteEmployee($id)
    { // Function to delete employee details by setting fields to NULL
        // Remove Aadhar number from `uni_aadhar`
        $currentAadhar = $this->db->select("aadhar_no")->from("employee")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');

        $subQuery = $this->db->select('aadhar_no')
            ->from('employee')
            ->where('id', $id)
            ->limit(1)
            ->get_compiled_select();
        $this->db->where("aadhar_no = ($subQuery)", null, false);
        $this->db->delete('uni_aadhar');

        // Update `employee` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'qr_code' => null,
            'qr_path' => null,

        ]; 
        return $this->db->update('employee', $updateData);
    }

    public function get_employees()
    {
        $this->db->select('*');
        $this->db->from('employee');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_employees($token)
    {
        $token_no = $this->db->count_all('employee');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('employee', $data);
        }
    }

    //=========================================EMPLOYEE END===================================================
    //=========================================CONTRACTOR=========================================================
    public function addContractor($data)
    { //function to  add contractor
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'CON'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `contractor` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],

        ];
        return $this->db->update('contractor', $updateData);
    }

    public function getContractorById($id)
    {
        $this->db->select('*');
        $this->db->from('contractor');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateContractorById($id, $data)
    {
        $currentAadhar = $this->db->select("aadhar_no")->from("contractor")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('contractor', $data);

    }


    public function deleteContractor($id)
    { // Function to delete contractor details by setting fields to NULL
        // Retrieve Aadhar number from `contractor`
        $currentAadhar = $this->db->select("aadhar_no")->from("contractor")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');

        $this->db->select('aadhar_no');
        $this->db->from('contractor');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');

        // Update `contractor` table to set fields to NULL
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
        return $this->db->update('contractor', $updateData);
    }

    public function get_contractors()
    {
        $this->db->select('*');
        $this->db->from('contractor');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_contractors($token)
    {
        $token_no = $this->db->count_all('contractor');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('contractor', $data);
        }
    }

    //=========================================CONTRACTOR END=========================================================

    //=========================================CONTRACTOR WORKMAN=========================================================
    public function addContractorWorkman($data)
    { //function to  add contractor workman
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'COW'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `contractor_workman` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],
            'contractor' => $data['contractor'],
        ];
        return $this->db->update('contractor_workman', $updateData);
    }

    public function getContractorWorkmanById($id)
    {
        $this->db->select('*');
        $this->db->from('contractor_workman');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }

    public function updateContractorWorkmanById($id, $data)
    {
        // Perform the update operation
        $currentAadhar = $this->db->select("aadhar_no")->from("contractor_workman")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('contractor_workman', $data);
    }

    public function deleteContractorWorkman($id)
    { // Function to delete contractor workman details by setting fields to NULL
        // Remove Aadhar number from `uni_aadhar`
        $currentAadhar = $this->db->select("aadhar_no")->from("contractor_workman")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');

        $subQuery = $this->db->select('aadhar_no')
            ->from('contractor_workman')
            ->where('id', $id)
            ->limit(1)
            ->get_compiled_select();
        $this->db->where("aadhar_no = ($subQuery)", null, false);
        $this->db->delete('uni_aadhar');

        // Update `contractor_workman` table to set fields to NULL
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
        return $this->db->update('contractor_workman', $updateData);
    }

    public function get_contractor_workman()
    {
        $this->db->select('*');
        $this->db->from('contractor_workman');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_contractor_workman($token)
    {
        $token_no = $this->db->count_all('contractor_workman');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('contractor_workman', $data);
        }
    }

    // function to get conractor data for contractor workman form vaues
    public function getContractorsForConw(){
        $this->db->select('id, full_name');
        $this->db->from('contractor');
        $this->db->where("aadhar_no != ''");
        $query = $this->db->get();
        return $query->result_array();
    }

    //=========================================CONTRACTOR WORKMAN END=================================================

        //=========================================MATHADI=========================================================
        public function addMathadi($data)
        { //function to  add mathadi
            // Insert Aadhar number into `uni_aadhar`
            $aadharData = [
                'aadhar_no' => $data['aadhar_no'],
                'role' => 'COW'
            ];
            $this->db->insert('uni_aadhar', $aadharData);
    
            // Update `mathadi` table
            $this->db->where('id', $data['id']);
            $updateData = [
                'aadhar_no' => $data['aadhar_no'],
                'full_name' => $data['full_name'],
                'mobile_no' => $data['mobile_no'],
                'address' => $data['address'],
                'firm_name' => $data['firm_name'],
    
            ];
            return $this->db->update('mathadi', $updateData);
        }
    
        public function getMathadiById($id)
        {
            $this->db->select('*');
            $this->db->from('mathadi');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->row_array(); // Return results as an array
    
        }
    
        public function updateMathadiById($id, $data){
            $currentAadhar = $this->db->select("aadhar_no")->from("mathadi")->where("id", $id)->get()->row_array();

            // Check if the Aadhar number has changed
            if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
                // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
                $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
                $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
            }
    
            // Update the officer's details
            $this->db->where('id', $id);
            return $this->db->update('mathadi', $data);
    
        }
    
        public function deleteMathadi($id){ // Function to delete mathadi details by setting fields to NULL
            // Remove Aadhar number from `uni_aadhar`
            $currentAadhar = $this->db->select("aadhar_no")->from("mathadi")->where("id", $id)->get()->row_array();

            // Check if the Aadhar number exists in `uni_aadhar`
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->delete('uni_aadhar');

            $subQuery = $this->db->select('aadhar_no')
                ->from('mathadi')
                ->where('id', $id)
                ->limit(1)
                ->get_compiled_select();
            $this->db->where("aadhar_no = ($subQuery)", null, false);
            $this->db->delete('uni_aadhar');
    
            // Update `contractor_workman` table to set fields to NULL
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
            return $this->db->update('mathadi', $updateData);
        }
    
        public function get_mathadi()
        {
            $this->db->select('*');
            $this->db->from('mathadi');
            $query = $this->db->get();
            return $query->result_array();
        }
    
        public function add_mathadi($token){
            $token_no = $this->db->count_all('mathadi');
            $start_no = $token_no == 0 ? 1 : $token_no + 1;
            $total = $start_no + $token - 1;
            for ($x = $start_no; $x <= $total; $x++) {
                $data = array(
                    'token_no' => $x,
                );
                $this->db->insert('mathadi', $data);
            }
        }
    
        //=========================================MATHADI END=================================================
    //=========================================GAT===========================================================

    public function addGat($data)
    { //function to  add gat
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'GAT'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `gat` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
        ];
        return $this->db->update('gat', $updateData);
    }


    public function getGatById($id)
    {
        $this->db->select('*');
        $this->db->from('gat');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }


    public function updateGatById($id, $data)
    {
        $currentAadhar = $this->db->select("aadhar_no")->from("gat")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('gat', $data);

    }


    public function deleteGat($id)
    { // Function to delete gat details by setting fields to NULL
        // Retrieve Aadhar number from `gat`
        $currentAadhar = $this->db->select("aadhar_no")->from("gat")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');
        $this->db->select('aadhar_no');
        $this->db->from('gat');
        $this->db->where('id', $id);
        $aadhar_no = $this->db->get()->row()->aadhar_no;

        // Remove Aadhar number from `uni_aadhar`
        $this->db->where('aadhar_no', $aadhar_no);
        $this->db->delete('uni_aadhar');

        // Update `gat` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('gat', $updateData);
    }


    public function get_gat()
    {
        $this->db->select('*');
        $this->db->from('gat');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function add_gat($token)
    {
        $token_no = $this->db->count_all('gat');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('gat', $data);
        }
    }


    //=========================================GAT END=========================================================
    //=========================================TAT=========================================================

    public function addTat($data)
    { //function to  add tat
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'TAT'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `tat` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
        ];
        return $this->db->update('tat', $updateData);
    }


    public function getTatById($id)
    {
        $this->db->select('*');
        $this->db->from('tat');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }


    public function updateTatById($id, $data)
    {
        $currentAadhar = $this->db->select("aadhar_no")->from("tat")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('tat', $data);
    }


    public function deleteTat($id)
    { // Function to delete tat details by setting fields to NULL
        // Remove Aadhar number from `uni_aadhar`
        $currentAadhar = $this->db->select("aadhar_no")->from("tat")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');
        $subQuery = $this->db->select('aadhar_no')
            ->from('tat')
            ->where('id', $id)
            ->limit(1)
            ->get_compiled_select();
        $this->db->where("aadhar_no = ($subQuery)", null, false);
        $this->db->delete('uni_aadhar');

        // Update `tat` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('tat', $updateData);
    }


    public function get_tat()
    {
        $this->db->select('*');
        $this->db->from('tat');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function add_tat($token)
    {
        $token_no = $this->db->count_all('tat');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('tat', $data);
        }
    }


    //=========================================TAT END======================================================
    //=========================================FEG=========================================================

    public function addFeg($data)
    { //function to  add feg
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'FEG'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `feg` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
        ];
        return $this->db->update('feg', $updateData);
    }



    public function getFegById($id)
    {
        $this->db->select('*');
        $this->db->from('feg');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }


    public function updateFegById($id, $data)
    {
        $currentAadhar = $this->db->select("aadhar_no")->from("feg")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('feg', $data);
    }


    public function deleteFeg($id)
    { // Function to delete feg details by setting fields to NULL
        // Remove Aadhar number from `uni_aadhar`
        $currentAadhar = $this->db->select("aadhar_no")->from("feg")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');
        $subQuery = $this->db->select('aadhar_no')
            ->from('feg')
            ->where('id', $id)
            ->limit(1)
            ->get_compiled_select();
        $this->db->where("aadhar_no = ($subQuery)", null, false);
        $this->db->delete('uni_aadhar');

        // Update `feg` table to set fields to NULL
        $this->db->where('id', $id);
        $updateData = [
            'aadhar_no' => null,
            'full_name' => null,
            'mobile_no' => null,
            'address' => null,
            'qr_code' => null,
            'qr_path' => null,

        ];
        return $this->db->update('feg', $updateData);
    }


    public function get_feg()
    {
        $this->db->select('*');
        $this->db->from('feg');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function add_feg($token)
    {
        $token_no = $this->db->count_all('feg');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('feg', $data);
        }
    }


    //=========================================FEG END======================================================

    //=========================================SEC=========================================================


    public function addSec($data)
    { //function to  add sec
        // Insert Aadhar number into `uni_aadhar`
        $aadharData = [
            'aadhar_no' => $data['aadhar_no'],
            'role' => 'SEC'
        ];
        $this->db->insert('uni_aadhar', $aadharData);

        // Update `sec` table
        $this->db->where('id', $data['id']);
        $updateData = [
            'aadhar_no' => $data['aadhar_no'],
            'full_name' => $data['full_name'],
            'mobile_no' => $data['mobile_no'],
            'address' => $data['address'],
            'firm_name' => $data['firm_name'],

        ];
        return $this->db->update('sec', $updateData);
    }


    public function getSecById($id)
    {
        $this->db->select('*');
        $this->db->from('sec');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Return results as an array

    }



    public function updateSecById($id, $data)
    {
        $currentAadhar = $this->db->select("aadhar_no")->from("sec")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number has changed
        if ($currentAadhar['aadhar_no'] != $data['aadhar_no']) {
            // Update the Aadhar number in `uni_aadhar` with the new Aadhar number
            $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
            $this->db->update('uni_aadhar', ['aadhar_no' => $data['aadhar_no']]);
        }

        // Update the officer's details
        $this->db->where('id', $id);
        return $this->db->update('sec', $data);
    }


    public function deleteSec($id)
    { // Function to delete sec details by setting fields to NULL
        // Remove Aadhar number from `uni_aadhar`
        $currentAadhar = $this->db->select("aadhar_no")->from("sec")->where("id", $id)->get()->row_array();

        // Check if the Aadhar number exists in `uni_aadhar`
        $this->db->where('aadhar_no', $currentAadhar['aadhar_no']);
        $this->db->delete('uni_aadhar');
        $subQuery = $this->db->select('aadhar_no')
            ->from('sec')
            ->where('id', $id)
            ->limit(1)
            ->get_compiled_select();
        $this->db->where("aadhar_no = ($subQuery)", null, false);
        $this->db->delete('uni_aadhar');

        // Update `sec` table to set fields to NULL
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
        return $this->db->update('sec', $updateData);
    }


    public function get_sec()
    {
        $this->db->select('*');
        $this->db->from('sec');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function add_sec($token)
    {
        $token_no = $this->db->count_all('sec');
        $start_no = $token_no == 0 ? 1 : $token_no + 1;
        $total = $start_no + $token - 1;
        for ($x = $start_no; $x <= $total; $x++) {
            $data = array(
                'token_no' => $x,
            );
            $this->db->insert('sec', $data);
        }
    }

    //=========================================SEC END======================================================

    //========================================ICARD===========================================================
    //                              -------------ICARD COMMON CODE----------

    public function getQrById($token_no, $table)
    {
        $this->db->select('qr_code');
        $this->db->from($table);
        $this->db->where('token_no', $token_no);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function generateQr($token_no, $table, $data)
    {
        $this->db->where('token_no', $token_no);
        return $this->db->update($table, $data);
    }

    public function getQrDataById($token_no, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('token_no', $token_no);
        $query = $this->db->get();
        return $query->row_array();
    }


    //                           ---------------ICARD COMMON CODE END----------------




//     public function get_ofc_maingate_data($section)
// {
//     // Manually join before get_where
//     $this->db->join('officer o', 'mg.adhar = o.aadhar_no');
//     $this->db->order_by('mg.id');
//     // $this->db->limit(1);

//     // Conditions
//     $where = array(
//         // 'mg.token_no'     => $token_no,
//         'mg.section'      => $section,
//         'mg.status'       => '1',
//         'mg.reset_status' => '0'
//     );

//     // Execute query
//     $query = $this->db->get_where('maingate mg', $where);
//     return $query->row_array(); // returns associative array
// }

// public function get_ofc_maingate_data($section)
// {
//     return $this->db->get_where('maingate', [
//         'section'      => $section,
//         'status'       => '1'
//         // 'reset_status' => '0'
//     ])->result_array();
// }


public function get_ofc_maingate_data($section)
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

    //========================================ICARD END===========================================================





    // function UpdateOfficer($formdata){
    //     $adharresponse = $this->db->select("adhar_no")->from("officer")->where("id",$formdata['id'])->get()->row_array();
    //     $this->db->where("adhar_no",$adharresponse['adhar_no']);
    //     $this->db->update("uni_aadhar",array("adhar_no"=>$formdata['adhar_no']));
    // }
// function getOldAadhar($id) {
//     $this->db->select('aadhar_no');
//     $this->db->from('officer');
//     $this->db->where('id', $id);
//     $query = $this->db->get();
//     return $query->row()->aadhar_no;
// }





}
