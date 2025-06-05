<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(array('url', 'notification')); // Load URL and notification helper

        // $this->load->helper(['url', 'form']);

        $this->load->library('phpmailer_lib');
        $this->load->database();
        $this->load->model("OperationModel");
        $this->load->model("CommonModel");
        // $this->note();
    }
 

    
    //************************************* AUTOFILLCODE*****************************************

    //***********************************AUTOFILLCODE ENDS HERE**********************************
    //================================================OFFICER===================================================

    public function Officer(){ //function to officer page
        $data['officers'] = $this->OperationModel->get_officers();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/officer', $data);
    }




    public function AddOfficer($id){ //function to load Add officer form
        $data['id'] = $id;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addofficer', $data);
    }


    public function InsertOfficer(){ //function to insert officer
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addOfficer($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Officer Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add officer');
            }
        }
        redirect("Officer");
    }


    public function EditOfficer($id){ //function to load edit officer form
        $data['officer'] = $this->OperationModel->getOfficerById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/editofficer', $data);
    }




    public function UpdateOfficer() {
        $formdata = $this->input->post();
        $oldaadhar = $formdata['oldaadhar'];
        $newaadhar = $formdata['aadhar_no'];
        $id = $formdata['id'];
    
        // Remove unnecessary fields from formdata
        unset($formdata['id'], $formdata['oldaadhar']);
    
        // Check if Aadhaar is unchanged or valid
        if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
            $updated = $this->OperationModel->updateOfficerById($id, $formdata);
    
            // Set feedback messages based on update result
            $message = $updated ? 'Officer Updated Successfully' : 'Officer Not Updated';
            $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
            $this->session->set_flashdata('swal_message', $message);
        } else {
            // If Aadhaar already exists
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        }
    
        redirect("Officer");
    }
    

    public function DropOfficer($id){ //function to drop officer
        $deleted = $this->OperationModel->deleteOfficer($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Officer Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Officer Not Deleted');
        }
        redirect("Officer");
    }



    // Add new officers
    public function AddOfficersToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_officers($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }



    // Fetch officer data (for AJAX)
    // public function FetchOfficers(){
    //     $officers = $this->OperationModel->get_officers();
    //     $mg = $this->OperationModel->get_ofc_maingate_data('OFC');

    //     echo json_encode($officers);
    // }



    public function FetchOfficers() {
        $officers = $this->OperationModel->get_officers(); // Array of officers
        $mg = $this->OperationModel->get_ofc_maingate_data('OFC'); // Array of maingate data
        // print_r($officers);die;

        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($officers as $officer) {
            $token = $officer['token_no'];
            $joined = $officer;
    
            // If a match exists in mg, merge it. Otherwise, skip mg data.
            if (isset($mg_indexed[$token])) {
               $joined['mg_data'] = $mg_indexed[$token]; // Add mg data under a key
            } else {
                $joined['mg_data'] = null; // Optional: or leave this key out
            }
    
            $result[] = $joined;
        }

        // print_r($result);die;
    
        echo json_encode($result);
    }
    


    //========================================================OFFICER END===================================================
    //==========================================================EMPLOYEE===================================================

    public function Employee(){
        $data['employees'] = $this->OperationModel->get_employees();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/employee', $data);
    }

    public function AddEmployee($id){
        $data['id'] = $id;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addemployee', $data);
    }

    public function InsertEmployee(){ //function to insert employee
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addEmployee($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Employee Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add employee');
            }
        }
        redirect("Employee");
    }


    public function EditEmployee($id){ //function to load edit employee form
        $data['employee'] = $this->OperationModel->getEmployeeById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/editemployee', $data);
    }


    public function UpdateEmployee(){ //function to update employee
    
    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateEmployeeById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Employee Updated Successfully' : 'Employeedated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }

        redirect("Employee");
    }
    public function DropEmployee($id){ //function to drop employee
        $deleted = $this->OperationModel->deleteEmployee($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Employee Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Employee Not Deleted');
        }
        redirect("Employee");
    }

    public function AddEmployeeToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_employees($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }


    // public function FetchEmployees(){
        // $employees = $this->OperationModel->get_employees();
    //     echo json_encode($employees);
    // }


    public function FetchEmployees() {
        $employees = $this->OperationModel->get_employees();
        $mg = $this->OperationModel->get_ofc_maingate_data('EMP'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($employees as $employee) {
            $token = $employee['token_no'];
            $joined = $employee;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        echo json_encode($result);
    }


    //===================================================EMPLOYEE END===================================================
    //====================================================CONTRACTOR===================================================
    public function Contractor(){
        $data['contractors'] = $this->OperationModel->get_contractors();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/contractor',$data);
    }

    public function AddContractor($id){
        $data['id'] = $id;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addcontractor', $data);
    }

    public function InsertContractor(){ //function to insert contractor
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addContractor($formdata);

            if ($inserted) {

                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Contractor Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add contractor');
            }
        }
        redirect("Contractor");
    }

    public function EditContractor($id){ //function to load edit contractor form
        $data['contractor'] = $this->OperationModel->getContractorById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/editcontractor', $data);
    }

    public function UpdateContractor(){ //function to update contractor

    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateContractorById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Contractor Updated Successfully' : 'Contractor Not Updated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }
        redirect("Contractor");
    }

    public function DropContractor($id){ //function to drop contractor
        $deleted = $this->OperationModel->deleteContractor($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Contractor Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Contractor Not Deleted');
        }
        redirect("Contractor");
    }

    public function AddContractorToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_contractors($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }

    // public function FetchContractors(){
        // $contractors = $this->OperationModel->get_contractors();
    //     echo json_encode($contractors);
    // }

    public function FetchContractors() {
        $contractors = $this->OperationModel->get_contractors();
        $mg = $this->OperationModel->get_ofc_maingate_data('CON'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($contractors as $contractor) {
            $token = $contractor['token_no'];
            $joined = $contractor;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        // echo "this";die;
        // print_r($result);die;
        echo json_encode($result);
    }


    //====================================================CONTRACTOR END===================================================
    //==================================================CONTRACTOR WORKMAN===================================================
    public function ContractorWorkman(){
        $data['contractorworkmen'] = $this->OperationModel->get_contractor_workman();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/contractorworkman', $data);
    }

    public function AddContractorWorkman($id){
        $data['id'] = $id;
        $data['contractors'] = $this->OperationModel->getContractorsForConw();
        // print_r($data['contractors']);die;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addcontractorworkman', $data);
    }

    public function InsertContractorWorkman(){ //function to insert contractor workman
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addContractorWorkman($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Contractor Workman Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add contractor workman');
            }
        }
        redirect("ContractorWorkman");
    }

    public function EditContractorWorkman($id){ //function to load edit contractor workman form
        $data['contractorworkman'] = $this->OperationModel->getContractorWorkmanById($id);
        $data['contractors'] = $this->OperationModel->getContractorsForConw();
        // $data = array_merge($data, $this->data); // Merge global notifications

        $this->load->view('operation/editcontractorworkman', $data);
    }

    public function UpdateContractorWorkman(){ //function to update contractor workman

    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateContractorWorkmanById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Contractor Workman Updated Successfully' : 'Contractor Workman Not Updated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }

        redirect("ContractorWorkman");
    }

    public function DropContractorWorkman($id){ //function to drop contractor workman

        $deleted = $this->OperationModel->deleteContractorWorkman($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Contractor Workman Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Contractor Workman Not Deleted');
        }
        redirect("ContractorWorkman");
    }

    public function AddContractorWorkmanToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_contractor_workman($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }

    // public function FetchContractorWorkmen(){
        // $contractorworkmen = $this->OperationModel->get_contractor_workman();
    //     echo json_encode($contractorworkmen);
    // }


    public function FetchContractorWorkmen() {
        $contractorworkmen = $this->OperationModel->get_contractor_workman();
        $mg = $this->OperationModel->get_ofc_maingate_data('CONW'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($contractorworkmen as $contractorworkman) {
            $token = $contractorworkman['token_no'];
            $joined = $contractorworkman;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        echo json_encode($result);
    }



    //=========================================CONTRACTOR WORKMAN END===================================================
        //=========================================MATHADI===================================================
        public function Mathadi(){
            $data['mathadi'] = $this->OperationModel->get_mathadi();
            // $data = array_merge($data, $this->data); // Merge global notifications
            $this->load->view('operation/mathadi', $data);
        }
    
        public function AddMathadi($id){
            $data['id'] = $id;
            // $data = array_merge($data, $this->data); // Merge global notifications
            $this->load->view('operation/addmathadi', $data);
        }
    
        public function InsertMathadi(){ //function to insert mathadi
            $formdata = $this->input->post();
            // Check for unique Aadhar number
            if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
            } else {
                $inserted = $this->OperationModel->addMathadi($formdata);
    
                if ($inserted) {
                    $this->session->set_flashdata('swal_type', 'success');
                    $this->session->set_flashdata('swal_message', 'Contractor Workman Added Successfully');
                } else {
                    $this->session->set_flashdata('swal_type', 'error');
                    $this->session->set_flashdata('swal_message', 'Failed to add contractor workman');
                }
            }
            redirect("Mathadi");
        }
    
        public function EditMathadi($id){ //function to load edit mathadi form
            $data['mathadi'] = $this->OperationModel->getMathadiById($id);
            // $data = array_merge($data, $this->data); // Merge global notifications
            $this->load->view('operation/editmathadi', $data);
        }
    
        public function UpdateMathadi(){ //function to update mathadi

        $formdata = $this->input->post();
        $oldaadhar = $formdata['oldaadhar'];
        $newaadhar = $formdata['aadhar_no'];
        $id = $formdata['id'];
    
        // Remove unnecessary fields from formdata
        unset($formdata['id'], $formdata['oldaadhar']);
    
        // Check if Aadhaar is unchanged or valid
        if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
            $updated = $this->OperationModel->updateMathadiById($id, $formdata);
    
            // Set feedback messages based on update result
            $message = $updated ? 'Mathadi Updated Successfully' : 'Mathadi Workman Not Updated';
            $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
            $this->session->set_flashdata('swal_message', $message);
        } else {
            // If Aadhaar already exists
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        }
    
            redirect("Mathadi");
        }
    
        public function DropMathadi($id){ //function to drop Mathadi
            $deleted = $this->OperationModel->deleteMathadi($id);
            if ($deleted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Mathadi Deleted Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Mathadi Not Deleted');
            }
            redirect("Mathadi");
        }
    
        public function AddMathadiToken(){
            if ($this->input->post('addtoken')) {
                $token = $this->input->post('addtoken');
                $this->OperationModel->add_mathadi($token);
                $response = array('status' => 'success', 'message' => 'Data Submitted');
            } else {
                $response = array('status' => 'error', 'message' => 'Invalid Token');
            }
            echo json_encode($response);
        }
    
        // public function FetchMathadi(){
        //     $mathadi = $this->OperationModel->get_mathadi();
        //     echo json_encode($mathadi);
        // }


        public function FetchMathadi() {
            $mathadis = $this->OperationModel->get_mathadi();
            $mg = $this->OperationModel->get_ofc_maingate_data('MT'); // Array of maingate data
            // print_r($officers);die;
            $mg_indexed = [];
            foreach ($mg as $entry) {
                $mg_indexed[$entry['token_no']] = $entry;
            }
        
            $result = [];
            foreach ($mathadis as $mathadi) {
                $token = $mathadi['token_no'];
                $joined = $mathadi;
        
                if (isset($mg_indexed[$token])) {
                    $joined['mg_data'] = $mg_indexed[$token]; 
                } else {
                    $joined['mg_data'] = null; 
                }
        
                $result[] = $joined;
            }    
            echo json_encode($result);
        }
    
    
    
        //========================================= MATHADI END===================================================
    //=========================================GAT===================================================

    public function Gat(){
        $data['gats'] = $this->OperationModel->get_gat();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/gat', $data);
    }

    public function AddGat($id){
        $data['id'] = $id;
        $this->load->view('operation/addgat', $data);
    }

    public function InsertGat(){ //function to insert gat
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addGat($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Gat added successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add gat');
            }
        }
        redirect("Gat");
    }

    public function EditGat($id){ //function to load edit gat form
        $data['gat'] = $this->OperationModel->getGatById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/editgat', $data);
    }

    public function UpdateGat(){ //function to update gat

    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateGatById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Gat Updated Successfully' : 'Gat Workman Not Updated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }
        redirect("Gat");
    }

    public function DropGat($id){ //function to drop gat
        $deleted = $this->OperationModel->deleteGat($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Gat Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Gat Not Deleted');
        }
        redirect("Gat");
    }

    public function AddGatToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_gat($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }

    // public function FetchGats(){
    //     $gats = $this->OperationModel->get_gat();
    //     echo json_encode($gats);
    // }


    public function FetchGats() {
        $gats = $this->OperationModel->get_gat();
        $mg = $this->OperationModel->get_ofc_maingate_data('GAT'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($gats as $gat) {
            $token = $gat['token_no'];
            $joined = $gat;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        echo json_encode($result);
    }

    //=========================================GAT END===================================================
    //=========================================TAT===================================================

    public function Tat(){
        $data['tats'] = $this->OperationModel->get_tat();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/tat', $data);
    }

    public function AddTat($id){
        $data['id'] = $id;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addtat', $data);
    }

    public function InsertTat(){ //function to insert tat
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addTat($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Tat Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed To Add Tat');
            }
        }
        redirect("Tat");
    }

    public function EditTat($id){ //function to load edit tat form
        $data['tat'] = $this->OperationModel->getTatById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/edittat', $data);
    }

    public function UpdateTat(){ //function to update tat
 

    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateTatById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Tat Updated Successfully' : 'Tat Workman Not Updated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }
        redirect("Tat");
    }


    public function DropTat($id){ //function to drop tat
        $deleted = $this->OperationModel->deleteTat($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Tat Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Tat Not Deleted');
        }
        redirect("Tat");
    }


    public function AddTatToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_tat($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }


    // public function FetchTats(){
    //     $tats = $this->OperationModel->get_tat();
    //     echo json_encode($tats);
    // }


    public function FetchTats() {
        $tats = $this->OperationModel->get_tat();
        $mg = $this->OperationModel->get_ofc_maingate_data('TAT'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($tats as $tat) {
            $token = $tat['token_no'];
            $joined = $tat;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        echo json_encode($result);
    }


    //=========================================TAT END===================================================
    //=========================================FEG===================================================

    public function Feg(){
        $data['fegs'] = $this->OperationModel->get_feg();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/feg', $data);
    }

    public function AddFeg($id){
        $data['id'] = $id;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addfeg', $data);
    }

    public function InsertFeg(){ //function to insert feg
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addFeg($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Feg Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed To Add Feg');
            }
        }
        redirect("Feg");
    }

    public function EditFeg($id){ //function to load edit feg form
        $data['feg'] = $this->OperationModel->getFegById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/editfeg', $data);
    }

    public function UpdateFeg(){ //function to update feg

    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateFegById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Feg Updated Successfully' : 'Feg Workman Not Updated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }
        redirect("Feg");
    }

    public function DropFeg($id){ //function to drop feg
        $deleted = $this->OperationModel->deleteFeg($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Feg Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Feg Not Deleted');
        }
        redirect("Feg");
    }

    public function AddFegToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_feg($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }

    // public function FetchFegs(){
    //     $fegs = $this->OperationModel->get_feg();
    //     echo json_encode($fegs);
    // }

    public function FetchFegs() {
        $fegs = $this->OperationModel->get_feg();
        $mg = $this->OperationModel->get_ofc_maingate_data('FEG'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($fegs as $feg) {
            $token = $feg['token_no'];
            $joined = $feg;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        echo json_encode($result);
    }

    //=========================================FEG END===================================================
    //=========================================SEC===================================================

    public function Sec(){
        $data['secs'] = $this->OperationModel->get_sec();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/sec', $data);
    }

    public function AddSec($id){
        $data['id'] = $id;
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/addsec', $data);
    }

    public function InsertSec(){ //function to insert sec
        $formdata = $this->input->post();
        // Check for unique Aadhar number
        if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
        } else {
            $inserted = $this->OperationModel->addSec($formdata);

            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Sec Added Successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed To Add Sec');
            }
        }
        redirect("Sec");
    }

    public function EditSec($id){ //function to load edit sec form
        $data['sec'] = $this->OperationModel->getSecById($id);
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('operation/editsec', $data);
    }

    public function UpdateSec(){ //function to update sec

    $formdata = $this->input->post();
    $oldaadhar = $formdata['oldaadhar'];
    $newaadhar = $formdata['aadhar_no'];
    $id = $formdata['id'];

    // Remove unnecessary fields from formdata
    unset($formdata['id'], $formdata['oldaadhar']);

    // Check if Aadhaar is unchanged or valid
    if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
        $updated = $this->OperationModel->updateSecById($id, $formdata);

        // Set feedback messages based on update result
        $message = $updated ? 'Sec Updated Successfully' : 'Sec Workman Not Updated';
        $this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
        $this->session->set_flashdata('swal_message', $message);
    } else {
        // If Aadhaar already exists
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
    }
        redirect("Sec");
    }

    public function DropSec($id){ //function to drop sec
        $deleted = $this->OperationModel->deleteSec($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Sec Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Sec Not Deleted');
        }
        redirect("Sec");
    }

    public function AddSecToken(){
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->OperationModel->add_sec($token);
            $response = array('status' => 'success', 'message' => 'Data Submitted');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }

    // public function FetchSec(){
    //     $secs = $this->OperationModel->get_sec();
    //     // print_r($secs);die;
    //     echo json_encode($secs);
    // }

    public function FetchSec() {
        $secs = $this->OperationModel->get_sec();
        $mg = $this->OperationModel->get_ofc_maingate_data('SEC'); // Array of maingate data
        // print_r($officers);die;
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        $result = [];
        foreach ($secs as $sec) {
            $token = $sec['token_no'];
            $joined = $sec;
    
            if (isset($mg_indexed[$token])) {
                $joined['mg_data'] = $mg_indexed[$token]; 
            } else {
                $joined['mg_data'] = null; 
            }
    
            $result[] = $joined;
        }    
        echo json_encode($result);
    }

    //=========================================SEC END===================================================



    // //                        ------------------ID CARD COMMON CODE-------------------



    // public function GenerateIdCard($token, $type) {

    // 	$qr = $this->OperationModel->getQrById($token, $type);
    // 	if ($qr['qr_code'] != '') {

    // 		$data['qrdata'] = $this->OperationModel->getQrDataById($token, $type);

    // 	} else {
    // 		$this->GenerateQr($token, $type);

    // 		$data['qrdata'] = $this->OperationModel->getQrDataById($token, $type);

    // 	}
    // 	$this->load->view('operation/opricard', $data);
    // }


    // public function GenerateQr($token_no, $type) {
    // 	if($type == 'officer'){
    // 		$submodule = 'OFC';
    // 	} else if($type == 'employee'){
    // 		$submodule = 'EMP';
    // 	} else if($type == 'contractor'){
    // 		$submodule = 'CON';
    // 	} else if($type == 'contractor_workman'){
    // 		$submodule = 'CONW';
    // 	} else if($type == 'gat'){
    // 		$submodule = 'GAT';
    // 	} else if($type == 'tat'){
    // 		$submodule = 'TAT';
    // 	} else if($type == 'feg'){
    // 		$submodule = 'FEG';
    // 	} else if($type == 'sec'){
    // 		$submodule = 'SEC';
    // 	} else {
    //         $submodule = 'OTH';
    //     }

    // 	$finalQr = $submodule . "/HPNSK/" . $token_no;

    // 	// including files for qrgeneration
    // 	include APPPATH . 'third_party/phpqrcode/qrlib.php';
    // 	// directory generation for qr_codes
    // 	$qr_img_dir = FCPATH . 'uploads/qr_code/';
    // 	if (!file_exists($qr_img_dir)) {
    // 		mkdir($qr_img_dir, 0777, true);
    // 	}

    // 	// qr image generation
    // 	$filename = $qr_img_dir . 'qr-' . md5($finalQr) . '.png';
    // 	QRcode::png($finalQr, $filename);

    // 	$data['qr_code'] = $finalQr;
    // 	$data['qr_path'] = 'qr-' . md5($finalQr) . '.png';

    // 	$qr = $this->OperationModel->generateQr($token_no, $type, $data);
    // 	if ($qr) {
    // 		$this->session->set_flashdata('swal_type', 'success');
    // 		$this->session->set_flashdata('swal_message', 'QR Code generated successfully');
    // 		// redirect("Officer");
    // 	} else {
    // 		$this->session->set_flashdata('swal_type', 'error');
    // 		$this->session->set_flashdata('swal_message', 'Failed to generate QR Code');
    // 		// redirect("Officer");
    // 	}
    // }



    // //                         --------------- ID CARD COMMON CODE END---------------


}