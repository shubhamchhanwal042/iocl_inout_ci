<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainGate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load libraries
        $this->load->library(['session', 'form_validation', 'phpmailer_lib']);
        
        // Load database
        $this->load->database();
        $this->load->model('DashboardModel');
        date_default_timezone_set('Asia/Kolkata');
        // Load model
        $this->load->model("MainGateModel");
    }

    // Default method when accessing the controller
    public function MainGate() {
        // Get data from the model
        $data['maingatecount'] = $this->MainGateModel->GetIn();
		$data['operation'] = $this->MainGateModel->OperationCount();
        
        $data['sections'] = array("operation", "driver", "project", "visitor", "total");
        $data['colors'] = array("danger", "primary", "warning", "secondary", "danger");


        $data['mainGate'] = $this->MainGateModel->MainGate();
		$data['licenseGate'] = $this->MainGateModel->LicenseGate();
		$data['deLicenseArea'] = $this->MainGateModel->DeLicenseArea();
        // print_r($data['deLicenseArea']);die;
		$data['driverGate'] = $this->MainGateModel->DriverGate();
        //  print_r($data['driverGate']);die;


		$data['operation'] = $this->MainGateModel->totalOperationStaffCount();
		$data['driver'] = $this->MainGateModel->totalDriverStaffCount();
		$data['project'] = $this->MainGateModel->totalProjectStaffCount();
		$data['visitor'] = $this->MainGateModel->totalVisitorStaffCount();

        // print_r($data['mainGate']['operation_count']);die;
        // print_r($data['mainGate']);die;

        // count of maingate
        $data['maingatecount'] = array($data['mainGate']['operation_count'],$data['mainGate']['driver_count'],$data['mainGate']['project_count'],$data['mainGate']['visitor_count'],$data['mainGate']['total_count']);

        // count of licnsegate        
        $data['licensegatecount'] = array($data['licenseGate']['operation_count'],$data['licenseGate']['driver_count'],$data['licenseGate']['project_count'],$data['licenseGate']['visitor_count'],$data['licenseGate']['total_count']);

        $data['delicensegatecount'] = array($data['deLicenseArea']['operation_count'],$data['deLicenseArea']['driver_count'],$data['deLicenseArea']['project_count'],$data['deLicenseArea']['visitor_count'],$data['deLicenseArea']['total_count']);


        $data['trucklicensegatecount'] = array(null,$data['driverGate']['driver_count'],null,null,$data['driverGate']['total_count']);

        $this->load->view('gates/maingate',$data);
}




    // -------------------------------------------FUNCTIONS STARTS BY SHUBHAM CHHANWAL -------------------------

    // function to check if the record is available or not

    public function GetExistRecord() {

        $uniqueValue = $this->input->get('unique_value');

        $parts = explode('/', $uniqueValue);
        $section = $parts[0];

        switch ($section) {
            case 'OFC':
            $tableName = 'officer';
            break;
            case 'EMP':
            $tableName = 'employee';
            break;
            case 'CON':
            $tableName = 'contractor';
            break;
            case 'CONW':
            $tableName = 'contractor_workman';
            break;
            case 'GAT':
            $tableName = 'gat';
            break;
            case 'TAT':     
            $tableName = 'tat';
            break;
            case 'FEG':
            $tableName = 'feg';
            break;
            case 'SEC':
            $tableName = 'sec';
            break;
            case 'PW':
            $tableName = 'workman';
            break;
            case 'AMC':
            $tableName = 'amc';
            break;
            case 'PT':
            $tableName = 'packed';
            break;
            case 'BK':
            $tableName = 'bulk';
            break;
            case 'TR':
            $tableName = 'transporter';
            break;
            case 'MT':
            $tableName = 'mathadi';
            break;
            case 'V':
            $tableName = 'visitor';
            break;
        }

        $records = $this->MainGateModel->GetExistRecord($uniqueValue, $tableName);

        // if (empty($uniqueValue)) {
        //     echo json_encode(['exists' => false]);
        //     return;
        // }


 
        // to check the record is availabe
        if ($records == true) {

            // if avialable then check wheater it is in maingate or not
            $CheckMaingate = $this->MainGateModel->CheckMaingateExsist($uniqueValue);
            

            $CheckLicengateStatus = $this->MainGateModel->CheckLicengateStatus($uniqueValue);
            // print_r($CheckLicengateStatus);die;
                $status = $CheckMaingate[0]->status;
        
                if ($status == 1 && $CheckLicengateStatus == 0) {
                    // if available in maingate and has status 1 then update it to 1
                    $UpdateStatus = $this->MainGateModel->UpdateStatus($uniqueValue, 0);
                    // echo "status updated to 0";
                } elseif ($status == 0) {
                    // If status is 0, insert new data
                    // echo "inserting the new data";
                    // if available and status is 0 then insert the new data
                    $InsertMaingate = $this->MainGateModel->InsertMaingate($uniqueValue, $records, $CheckMaingate);
                }
           
        } else {
            echo "no data found";
        }

        if ($uniqueValue || $records) {
            // Wrap both "exists" and "data" into a list
            echo json_encode(['exists' => true, 'data' => $records]);
        } else {
            // Wrap "exists" into an array as well
            echo json_encode([['exists' => false]]);
        }
    }
    
}
