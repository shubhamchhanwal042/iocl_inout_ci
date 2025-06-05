<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DriverGate extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Load libraries
		$this->load->library(['session', 'form_validation', 'phpmailer_lib']);

		// Load database
		$this->load->database();

		// Load model
		$this->load->model("DriverGateModel");
		$this->load->model("MainGateModel");
	}


	public function DriverGate()
	{
		// Get data from the model
		$data['maingatecount'] = $this->MainGateModel->GetIn();
		$data['operation'] = $this->MainGateModel->OperationCount();

		$data['sections'] = array("operation", "driver", "project", "visitor", "total");
		$data['colors'] = array("danger", "primary", "warning", "secondary", "danger");

		// count of maingate
		$data['maingatecount'] = array(23, 34, 28, 93, 29);

		// count of licnsegate
		$data['licensegatecount'] = array(23, 34, 28, 93, 29);

		// count of truck maingate
		$data['truckmaingatecount'] = array(23, 34, 28, 93, 29);

		// count of truck licnsegate
		$data['trucklicensegatecount'] = array(23, 34, 28, 93, 29);

		$this->load->view('gates/drivergate', $data);
	}

// ---------------------------------GATES CODE BY SHUBHAM CHHANWAL ------------------------------



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
        $name = $records['full_name'];
        // print_r($name);die;
        $responseMessage = '';
  
   $responseMessage = '';
   if ($records) {
    // Get data from both MainGate and LicenseGate
    $CheckMaingate = $this->DriverGateModel->CheckMaingateExsist($uniqueValue);
    $CheckLicengateStatus = $this->DriverGateModel->CheckLicengateStatus($uniqueValue);

    // Check if LicenseGate status is found
    if (empty($CheckLicengateStatus)) {
        // No record found in LicenseGate, set status to 0
        $licensgatestatus = 0;
    } else {
        // Access the 'status' from the first element of the array
        $licensgatestatus = $CheckLicengateStatus[0]->status;
    }

    // Access MainGate status from the first record (assuming $CheckMaingate is an array of objects)
    $maingatestatus = $CheckMaingate[0]->status;

    // Logic to determine actions based on both LicenseGate and MainGate statuses
    if ($maingatestatus == 1 && $licensgatestatus == 0) {
        // If MainGate status is 1 and LicenseGate status is 0, update MainGate status
        $UpdateStatus = $this->DriverGateModel->UpdateStatus($uniqueValue, 0);
        // $UpdateDelicenseStatus = $this->DriverGateModel->UpdateDelicenseStatus($uniqueValue, 0);

        if ($UpdateStatus) {
            $responseMessage = $name . ' Exit From MainGate';
        }
    } else if ($maingatestatus == 1 && $licensgatestatus == 1) {
        $responseMessage = 'First Exit LicenseGate';
        // If MainGate status is 0, insert a new record in MainGate
     
    } else if ($records || $maingatestatus == 0) {
        // If both MainGate and LicenseGate have status 1, show a message to exit LicenseGate first
        $InsertMaingate = $this->DriverGateModel->InsertMaingate($uniqueValue, $records, $CheckMaingate);
        // $InsertDelicense = $this->DriverGateModel->InsertDelicense($uniqueValue, $records, $CheckMaingate);

        $responseMessage = $name . 'Entered in MainGate';
    } else {
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
