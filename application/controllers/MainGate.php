<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainGate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load libraries
        $this->load->library(['session', 'form_validation', 'phpmailer_lib']);

        // Load database
        $this->load->database();
        $this->load->model('DashboardModel');
        date_default_timezone_set('Asia/Kolkata');
        // Load model
        $this->load->model("MainGateModel");
        $this->load->model("DriverGateModel");
    }

    // Default method when accessing the controller
    public function MainGate()
    {
        // // Get data from the model
        // // $data['maingatecount'] = $this->DashboardModel->GetIn();
        // // $data['operation'] = $this->DashboardModel->OperationCount();

        // $data['sections'] = array("operation", "driver", "project", "visitor", "total");
        // $data['colors'] = array("danger", "primary", "warning", "secondary", "danger");
        // $data['drivergate'] = array( "driver", "truck", "total");


        // $data['mainGate'] = $this->DashboardModel->MainGate();
        // // print_r($data['mainGate']);die;
        // $data['licenseGate'] = $this->DashboardModel->LicenseGate();
        // $data['deLicenseArea'] = $this->DashboardModel->DeLicenseArea();
        // // print_r($data['deLicenseArea']);die;
        // $data['drivermainGate'] = $this->DashboardModel->DriverGate();
        // $data['driverLicenseGate'] = $this->DashboardModel->DriverLicenseGate();

        // //  print_r ($data);die;


        // $data['operation'] = $this->DashboardModel->totalOperationStaffCount();
        // $data['driver'] = $this->DashboardModel->totalDriverStaffCount();
        // $data['project'] = $this->DashboardModel->totalProjectStaffCount();
        // // print_r($data['project']);die;
        // $data['visitor'] = $this->DashboardModel->totalVisitorStaffCount();

        // // print_r($data['mainGate']['operation_count']);die;
        // // print_r($data['mainGate']);die;


        // $data['mainGate'] = $this->DashboardModel->MainGate();
        // $data['licenseGate'] = $this->DashboardModel->LicenseGate();
        // $data['deLicenseArea'] = $this->DashboardModel->DeLicenseArea();
        // // print_r($data['deLicenseArea']);die;
        // $data['driverGate'] = $this->DashboardModel->DriverGate();
        // //  print_r($data['driverGate']);die;


        // $data['operation'] = $this->DashboardModel->totalOperationStaffCount();
        // $data['driver'] = $this->DashboardModel->totalDriverStaffCount();
        // $data['project'] = $this->DashboardModel->totalProjectStaffCount();
        // $data['visitor'] = $this->DashboardModel->totalVisitorStaffCount();

        // // print_r($data['mainGate']['operation_count']);die;
        // // print_r($data['mainGate']);die;

        // // count of maingate
        // $data['maingatecount'] = array($data['mainGate']['operation_count'],$data['mainGate']['driver_count'],$data['mainGate']['project_count'],$data['mainGate']['visitor_count'],$data['mainGate']['total_count']);

        // // count of licnsegate        
        // $data['licensegatecount'] = array($data['licenseGate']['operation_count'],$data['licenseGate']['driver_count'],$data['licenseGate']['project_count'],$data['licenseGate']['visitor_count'],$data['licenseGate']['total_count']);

        // $data['delicensegatecount'] = array($data['deLicenseArea']['operation_count'],$data['deLicenseArea']['driver_count'],$data['deLicenseArea']['project_count'],$data['deLicenseArea']['visitor_count'],$data['deLicenseArea']['total_count']);


        // $data['drivermainGate'] = array(null,$data['mainGate']['driver_count'],null,null,$data['drivermainGate']['total_count']);
        // $data['driverLicenseGate'] = array(null,$data['licenseGate']['driver_count'],null,null,$data['driverLicenseGate']['total_count']);

        $this->load->view('gates/maingate');
    }




    // -------------------------------------------FUNCTIONS STARTS BY SHUBHAM CHHANWAL -------------------------

    // function to check if the record is available or not

    public function GetExistRecord()
    {
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
        $name = $records['full_name'];
        // print_r($name);die;
        $responseMessage = '';

        $responseMessage = '';
        if ($records) {
            // Get data from both MainGate and LicenseGate
            $CheckMaingate = $this->MainGateModel->CheckMaingateExsist($uniqueValue);
            $CheckLicengateStatus = $this->MainGateModel->CheckLicengateStatus($uniqueValue);
            $CheckRestrictedvalue = $this->MainGateModel->CheckRestricted($uniqueValue,$tableName);
            // print_r($CheckRestricted);die;
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

            // Logic to determine actions based on both LicenseGate and MainGate statuses
            if ($maingatestatus == 1 && $licensgatestatus == 0 && $CheckRestrictedvalue == 0) {
                // If MainGate status is 1 and LicenseGate status is 0, update MainGate status
                $UpdateStatus = $this->MainGateModel->UpdateStatus($uniqueValue, 0);
                $UpdateDelicenseStatus = $this->MainGateModel->UpdateDelicenseStatus($uniqueValue, 0);

                if ($UpdateStatus) {
                    $responseMessage = $name . ' Exit From Main Gate';
                }
            } else if ($maingatestatus == 1 && $licensgatestatus == 1) {
                $responseMessage = 'First Exit License Gate';

            }else if ($CheckRestrictedvalue == 1){
                // If MainGate status is 0, insert a new record in MainGate
                $responseMessage = 'Person is Restricted';

            } else if ($records || $maingatestatus == 0) {
                // If both MainGate and LicenseGate have status 1, show a message to exit LicenseGate first
                $InsertMaingate = $this->MainGateModel->InsertMaingate($uniqueValue, $records, $CheckMaingate);
                $InsertDelicense = $this->MainGateModel->InsertDelicense($uniqueValue, $records, $CheckMaingate);
                // <!-- $InsertMaingate = $this->DriverGateModel->InsertMaingate($uniqueValue, $records, $CheckMaingate); -->

                $responseMessage = $name . ' Entered  Main Gate';
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
