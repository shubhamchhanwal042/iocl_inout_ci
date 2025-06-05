<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LicenseGate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load libraries
        $this->load->library(['session', 'form_validation', 'phpmailer_lib']);

        // Load database
        $this->load->database();

        // Load model
        $this->load->model("LicenseGateModel");
        $this->load->model("MainGateModel");
        $this->load->model("DriverGateModel");
        $this->load->model("DriverLicenseModel");
    }

    public function LicenseGate()
    {
        // // Get data from the model
        // $data['maingatecount'] = $this->MainGateModel->GetIn();
        // $data['operation'] = $this->MainGateModel->OperationCount();

        // $data['sections'] = array("operation", "driver", "project", "visitor", "total");
        // $data['colors'] = array("danger", "primary", "warning", "secondary", "danger");
        // $data['drivergate'] = array( "driver", "truck", "total");


        // $data['mainGate'] = $this->MainGateModel->MainGate();
        // // print_r($data['mainGate']);die;
        // $data['licenseGate'] = $this->MainGateModel->LicenseGate();
        // $data['deLicenseArea'] = $this->MainGateModel->DeLicenseArea();
        // // print_r($data['deLicenseArea']);die;
        // $data['drivermainGate'] = $this->MainGateModel->DriverGate();
        // $data['driverLicenseGate'] = $this->MainGateModel->DriverLicenseGate();

        // //  print_r ($data);die;


        // $data['operation'] = $this->MainGateModel->totalOperationStaffCount();
        // $data['driver'] = $this->MainGateModel->totalDriverStaffCount();
        // $data['project'] = $this->MainGateModel->totalProjectStaffCount();
        // // print_r($data['project']);die;
        // $data['visitor'] = $this->MainGateModel->totalVisitorStaffCount();

        // // print_r($data['mainGate']['operation_count']);die;
        // // print_r($data['mainGate']);die;

        // // count of maingate
        // $data['maingatecount'] = array($data['mainGate']['operation_count'],$data['mainGate']['driver_count'],$data['mainGate']['project_count'],$data['mainGate']['visitor_count'],$data['mainGate']['total_count']);

        // // count of licnsegate        
        // $data['licensegatecount'] = array($data['licenseGate']['operation_count'],$data['licenseGate']['driver_count'],$data['licenseGate']['project_count'],$data['licenseGate']['visitor_count'],$data['licenseGate']['total_count']);

        // $data['delicensegatecount'] = array($data['deLicenseArea']['operation_count'],$data['deLicenseArea']['driver_count'],$data['deLicenseArea']['project_count'],$data['deLicenseArea']['visitor_count'],$data['deLicenseArea']['total_count']);


        // $data['drivermainGate'] = array(null,$data['mainGate']['driver_count'],null,null,$data['drivermainGate']['total_count']);
        // $data['driverLicenseGate'] = array(null,$data['licenseGate']['driver_count'],null,null,$data['driverLicenseGate']['total_count']);


        $this->load->view('gates/licensegate');
    }

    // -----------------------------------------LICENSEGATE CODE ------------------------------------------
    public function EnterLicengate()
    {
        $uniqueValue = $this->input->get('unique_value');

        $parts = explode('/', $uniqueValue);
        $section = $parts[0];

    switch ($section) {
        case 'OFC': $tableName = 'officer'; break;
        case 'EMP': $tableName = 'employee'; break;
        case 'CON': $tableName = 'contractor'; break;
        case 'CONW': $tableName = 'contractor_workman'; break;
        case 'GAT': $tableName = 'gat'; break;
        case 'TAT': $tableName = 'tat'; break;
        case 'FEG': $tableName = 'feg'; break;
        case 'SEC': $tableName = 'sec'; break;
        case 'PW': $tableName = 'workman'; break;
        case 'AMC': $tableName = 'amc'; break;
        case 'PT': $tableName = 'packed'; break;
        case 'BK': $tableName = 'bulk'; break;
        case 'MT': $tableName = 'mathadi'; break;
        case 'TR': $tableName = 'transporter'; break;
        case 'V': $tableName = 'visitor'; break;
    }

        $records = $this->LicenseGateModel->EnterLicengate($uniqueValue, $tableName);


        $name = $records['full_name'];
        // print_r($name);die;
        $responseMessage = '';

        $responseMessage = '';
        if ($records) {
            // Check if the unique value exists in both MainGate and LicenseGate
            $CheckMaingate = $this->LicenseGateModel->CheckMaingateExsist($uniqueValue);
            $CheckLicengateStatus = $this->LicenseGateModel->CheckLicengateStatus($uniqueValue);
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
                $maingatestatus = $CheckMaingate[0]->status;  // Assuming $CheckMaingate is an array of objects
            }

    $working_as = $records['working_as']; // The string is "Driver - packed"

    $split_words = explode(' ', $working_as);
    $first_word = $split_words[0];

            // Check conditions for both MainGate and LicenseGate
            if ($licensgatestatus == 1 && $maingatestatus == 1 && $CheckRestrictedvalue == 0) {
                // If both MainGate and LicenseGate have status 1, exit from LicenseGate
                $UpdateStatus = $this->LicenseGateModel->UpdateStatus($uniqueValue, 0);
                $UpdateDelicenseStatusExit = $this->MainGateModel->UpdateDelicenseStatusExit($uniqueValue, 0);

        if ($UpdateStatus) {
            $responseMessage = $name . ' Exit From License Gate';
        }
    } else if ($licensgatestatus == 0 && $maingatestatus == 1 && $CheckRestrictedvalue == 0) {
        // If LicenseGate status is 0, but MainGate status is 1, insert new LicenseGate record
        if($first_word == 'Driver') {
            $InsertLicensgate = $this->LicenseGateModel->InsertLicensgate($uniqueValue, $records, $CheckMaingate);
            $UpdateDelicenseStatus = $this->MainGateModel->UpdateDelicenseStatus($uniqueValue, 0);

            $responseMessage = $name . ' Entered in License Gate';
        }else {
            $InsertLicensgate = $this->LicenseGateModel->InsertLicensgate($uniqueValue, $records, $CheckMaingate);
           $UpdateDelicenseStatus = $this->MainGateModel->UpdateDelicenseStatus($uniqueValue, 0);

        $responseMessage = $name . ' Entered in License Gate';
        }
    } else if ($maingatestatus == 0 && $licensgatestatus == 0) {
        // If both MainGate and LicenseGate have status 0, prompt to first enter MainGate
        $responseMessage = 'First Enter Main Gate';
    } else if ($CheckRestrictedvalue == 1){
        // If MainGate status is 0, insert a new record in MainGate
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