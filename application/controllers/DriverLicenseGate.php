<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DriverLicenseGate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load libraries
        $this->load->library(['session', 'form_validation', 'phpmailer_lib']);
        
        // Load database
        $this->load->database();
        
        // Load model
        $this->load->model("DriverLicenseModel");
        $this->load->model("MainGateModel");
        $this->load->model("LicenseGateModel");
    }

	public function DriverLicensegate()
	{
        // Get data from the model
       
      		$this->load->view('gates/trucklicensegate');
	}

    // -----------------------------------------LICENSEGATE CODE ------------------------------------------
public function GetExistRecord() {
    $uniqueValue = $this->input->get('unique_value');

    $parts = explode('/', $uniqueValue);
    $section = $parts[0];

    switch ($section) {
     
        case 'PT': $tableName = 'packed'; break;
        case 'BK': $tableName = 'bulk'; break;
        case 'TR': $tableName = 'transporter'; break;
        // case 'V': $tableName = 'visitor'; break;
    }

    $records = $this->DriverLicenseModel->GetExistRecord($uniqueValue, $tableName);

    $name = $records['full_name'];
    // print_r($name);die;
    $responseMessage = '';

$responseMessage = '';
if ($records) {
    // Check if the unique value exists in both MainGate and LicenseGate
    $CheckMaingate = $this->DriverLicenseModel->CheckMaingateExsist($uniqueValue);
    $CheckLicengateStatus = $this->DriverLicenseModel->CheckLicengateStatus($uniqueValue);
    $CheckRestrictedvalue = $this->MainGateModel->CheckRestricted($uniqueValue,$tableName);

    // Handle if no record is found in LicenseGate
    if (is_null($CheckLicengateStatus)) {
        $licensgatestatus = 0;  // No record in LicenseGate, set status to 0
    } else {
        $licensgatestatus = $CheckLicengateStatus->status;  // Access status if the record exists
    }

    if (is_null($CheckMaingate)) {
        $maingatestatus = 0;  // No record in LicenseGate, set status to 0
    } else {
        $maingatestatus = $CheckMaingate[0]->status;  // Access status if the record exists
    }

    // Get the maingate status from the first record (assuming CheckMaingate returns an array of objects)
    // $maingatestatus = $CheckMaingate[0]->status;  // Assuming $CheckMaingate is an array of objects

    // Check conditions for both MainGate and LicenseGate
    if ($licensgatestatus == 1 && $maingatestatus == 1 && $CheckRestrictedvalue == 0) {
        // If both MainGate and LicenseGate have status 1, exit from LicenseGate
        $UpdateStatus = $this->DriverLicenseModel->UpdateStatus($uniqueValue, 0);
        $UpdateStatus = $this->LicenseGateModel->UpdateStatus($uniqueValue, 0);

        if ($UpdateStatus) {
            $responseMessage = $name . ' Exit From License Gate';
        }
    } else if ($licensgatestatus == 0 && $maingatestatus == 1 && $CheckRestrictedvalue == 0) {
        // If LicenseGate status is 0, but MainGate status is 1, insert new LicenseGate record
        $InsertLicensgate = $this->DriverLicenseModel->InsertLicensgate($uniqueValue, $records, $CheckMaingate);
        $InsertLicensgate = $this->LicenseGateModel->InsertLicensgate($uniqueValue, $records, $CheckMaingate);

        $responseMessage = $name . ' Entered in License Gate';
    } else if ($maingatestatus == 0 && $licensgatestatus == 0 && $CheckRestrictedvalue == 0) {
        // If both MainGate and LicenseGate have status 0, prompt to first enter MainGate
        $responseMessage = 'First Enter Main Gate';
    }else if($CheckRestrictedvalue == 1){
        $responseMessage = 'Person is Restricted';

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
