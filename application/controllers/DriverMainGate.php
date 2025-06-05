<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DriverMainGate extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Load libraries
		$this->load->library(['session', 'form_validation', 'phpmailer_lib']);

		// Load database
		$this->load->database();

		// Load model
		$this->load->model("MainGateModel");
		$this->load->model("DriverGateModel");

		
	}


	public function index()
	{
		// Get data from the model
	
      
     
		$this->load->view('gates/truckmaingate');
	}


	    // -------------------------------------------FUNCTIONS STARTS BY SHUBHAM CHHANWAL -------------------------

    // function to check if the record is available or not

    public function GetExistRecord() {
        $uniqueValue = $this->input->get('unique_value');
    
        $parts = explode('/', $uniqueValue);
        $section = $parts[0];
    
        switch ($section) {
            // case 'OFC': $tableName = 'officer'; break;
            // case 'EMP': $tableName = 'employee'; break;
            // case 'CON': $tableName = 'contractor'; break;
            // case 'CONW': $tableName = 'contractor_workman'; break;
            // case 'GAT': $tableName = 'gat'; break;
            // case 'TAT': $tableName = 'tat'; break;
            // case 'FEG': $tableName = 'feg'; break;
            // case 'SEC': $tableName = 'sec'; break;
            // case 'PW': $tableName = 'workman'; break;
            // case 'AMC': $tableName = 'amc'; break;
            case 'PT': $tableName = 'packed'; break;
            case 'BK': $tableName = 'bulk'; break;
            case 'TR': $tableName = 'transporter'; break;
            // case 'V': $tableName = 'visitor'; break;
        }
    
        $records = $this->DriverGateModel->GetExistRecord($uniqueValue, $tableName);
		// print_r($/);die;	
        $name = $records['full_name'];
        // print_r($name);die;
        $responseMessage = '';
  
   $responseMessage = '';
   if ($records) {
    // Get data from both MainGate and LicenseGate
    $CheckMaingate = $this->DriverGateModel->CheckMaingateExsist($uniqueValue);
    $CheckLicengateStatus = $this->DriverGateModel->CheckLicengateStatus($uniqueValue);
    $CheckRestrictedvalue = $this->MainGateModel->CheckRestricted($uniqueValue,$tableName);

    // Check if LicenseGate status is found
    if (empty($CheckLicengateStatus)) {
        // No record found in LicenseGate, set status to 0
        $licensgatestatus = 0;
    } else {
        // Access the 'status' from the first element of the array
        $licensgatestatus = $CheckLicengateStatus[0]->status;
    }


    if (empty($CheckMaingate)) {
        // No record found in LicenseGate, set status to 0
        $maingatestatus = 0;
    } else {
        // Access the 'status' from the first element of the array
        $maingatestatus = $CheckMaingate[0]->status;
    }
    // Access MainGate status from the first record (assuming $CheckMaingate is an array of objects)
    // $maingatestatus = $CheckMaingate[0]->status;

    // Logic to determine actions based on both LicenseGate and MainGate statuses
    if ($maingatestatus == 1 && $licensgatestatus == 0 && $CheckRestrictedvalue == 0) {
        // If MainGate status is 1 and LicenseGate status is 0, update MainGate status
        $UpdateStatus = $this->DriverGateModel->UpdateStatus($uniqueValue, 0);
        $UpdateMaingate = $this->MainGateModel->UpdateStatus($uniqueValue, 0);
        $UpdateDelicenseStatus = $this->MainGateModel->UpdateDelicenseStatus($uniqueValue, 0);

        if ($UpdateStatus) {
            $responseMessage = $name . ' Exit From Main Gate';
        }
    } else if ($maingatestatus == 1 && $licensgatestatus == 1 && $CheckRestrictedvalue == 0) {
        $responseMessage = 'First Exit License Gate';
        // If MainGate status is 0, insert a new record in MainGate
     
    } else if ($CheckRestrictedvalue == 1 ){
        $responseMessage = $name . '  Is Restricted';
        
    } else if ($records || $maingatestatus == 0 && $CheckRestrictedvalue == 0) {
        // If both MainGate and LicenseGate have status 1, show a message to exit LicenseGate first
        $InsertMaingate = $this->DriverGateModel->InsertMaingate($uniqueValue, $records, $CheckMaingate);
        $InsertMaingate = $this->MainGateModel->InsertMaingate($uniqueValue, $records, $CheckMaingate);

        $responseMessage = $name . ' Entered  Main Gate';

    }else {
        // Default response if no conditions are met
        $responseMessage = 'No data found';
    }

    // Send response with message and status
    echo json_encode([
        'exists' => $records ? true : false,
        'message' => $responseMessage,
        'data' => $records ? $records : null
    ]);
}

}

}
