<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url', 'notification')); // Load URL and notification helper
		$this->load->model('DashboardModel');
		$this->load->model('MainModel');
		$this->load->model('ParkingModel');

	}

	public function Theme(){
		$this->load->view('include/theme.php');
	}

	
	
	public function Dashboard()
	{
		$data['notifications'] = []; // Default empty array

		// $data['notifications'] = get_officer_notifications($officer_id); // Get notifications
		$role = $this->session->userdata('role'); // Get logged-in officer ID

		if($role=='officer'){
			$officer_id = $this->session->userdata('accessId'); // Get logged-in officer ID
			// echo $officer_id;die;

			// $officer_id = '2'; // Get logged-in officer ID
			// $data['notifications'] = get_officer_notifications($officer_id); // Get today's notifications
			foreach($data['notifications'] as $not){
				$not->full_name = $this->DashboardModel->getVisitorName($not->visitor_id);
			}
		}

		// $data['visitorname'] = get_officer_notifications($officer_id); // Get today's notifications

		$this->load->view('dashboard/dashboard', $data);
	}

	public function GetDashboardCount(){
		$data['mainGate'] = $this->DashboardModel->MainGate();
		$data['licenseGate'] = $this->DashboardModel->LicenseGate();
		$data['deLicenseArea'] = $this->DashboardModel->DeLicenseArea();
		$data['driverGate'] = $this->DashboardModel->DriverGate();
		$data['driverMainGate'] = $this->DashboardModel->getTruckInDriverMainGate();
		$data['driverLicenseGate'] = $this->DashboardModel->getTruckInLicenseGate();

		$data['operation'] = $this->DashboardModel->totalOperationStaffCount();
		$data['driver'] = $this->DashboardModel->totalDriverStaffCount();
		$data['project'] = $this->DashboardModel->totalProjectStaffCount();
		$data['visitor'] = $this->DashboardModel->totalVisitorStaffCount();
		 $data['parkingcounts'] = $this->ParkingModel->get_slot_counts();

		$response = array('status' => 'success', 'data' => $data);
		echo json_encode($response);
	}

	public function update_visitor_status() {//notification
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $officer_id = $this->input->post('officer_id', TRUE);
            $visitor_id = $this->input->post('visitor_id', TRUE);
            $access = $this->input->post('access', TRUE);

            // Validate that the IDs are numeric
            if (is_numeric($officer_id) && is_numeric($visitor_id)) {
                $result = $this->DashboardModel->updateVisitorData($officer_id, $visitor_id, $access);

                if ($result) {
                    echo "success";
                } else {
                    echo "Error updating the records.";
                }
            } else {
                echo "Invalid ID.";
            }
        } else {
            echo "No ID received.";
        }
    }



	// public function update_visitor_status() {
    //     if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //         $officer_id = $this->input->post('officer_id');
    //         $visitor_id = $this->input->post('visitor_id');
    //         $access = $this->input->post('access');

    //         if ($this->VisitorModel->update_visitor_status($visitor_id, $officer_id, $access)) {
    //             echo "success";
    //         } else {
    //             echo "error";
    //         }
    //     }
    // }


	// function to generate conractor workman list
	function breakconwlist(){
		$data['contractorworkman'] = $this->DashboardModel->getContractorWorkmanList();
		// print_r($data['contractorworkman']);die;

		$data['contractors'] = $this->DashboardModel->getContractors();
		// print_r($data['contractors']);die;
		// echo "<br><br><br>";
		// print_r($data['contractorworkman']);die;

		$this->load->view("dashboard/breakcount", $data);
	}	// function ends






	public function ResetCount(){
		
		$password = $this->MainModel->encryptData($this->input->post('reset-pass'));

		$data = $this->DashboardModel->resetCount($password);

		if($data){
			$response = array('status' => 'success', 'message' => 'Count reset successfully');
			echo json_encode($response);
		} else {
			$response = array('status' => 'error', 'message' => 'Reset password is incorrect');
			echo json_encode($response);
		}
	}


	public function InfoMore($department, $gate)
	{
		if($department == 'operation'){
			if($gate == 'maingate'){
				$data['gateData'] = $this->DashboardModel->getStaffInMaingate($department);
			}else if($gate == 'licensegate'){
				$data['gateData'] = $this->DashboardModel->getStaffInLicensegate($department);
			}else if($gate == 'delicensearea'){
				$data['gateData'] = $this->DashboardModel->getStaffInDeLicenseArea($department);
			} else if($gate == 'drivergate'){
				$data['gateData'] = $this->DashboardModel->getStaffInDriverGate($department);
			}

			$data['subdepartment'] = ['All', 'Officer', 'Employee', 'Contractor', 'Contractor_Workman', 'Mathadi', 'Gat', 'Tat', 'Feg', 'Sec'];
			
		} else if($department == 'driver'){
			if($gate == 'maingate'){
				$data['gateData'] = $this->DashboardModel->getStaffInMaingate($department);
			}else if($gate == 'licensegate'){
				$data['gateData'] = $this->DashboardModel->getStaffInLicensegate($department);
			}else if($gate == 'delicensearea'){
				$data['gateData'] = $this->DashboardModel->getStaffInDeLicenseArea($department);
			} else if($gate == 'drivermaingate'){
				$data['gateData'] = $this->DashboardModel->getStaffInMaingate($department);
			} else if($gate == 'driverlicensegate'){
				$data['gateData'] = $this->DashboardModel->getStaffInLicensegate($department);
			}
			$data['subdepartment'] =  ['All', 'Packed', 'Bulk', 'Workman'];
		} else if($department == 'project'){
			if($gate == 'maingate'){
				$data['gateData'] = $this->DashboardModel->getStaffInMaingate($department);
			}else if($gate == 'licensegate'){
				$data['gateData'] = $this->DashboardModel->getStaffInLicensegate($department);
			}else if($gate == 'delicensearea'){
				$data['gateData'] = $this->DashboardModel->getStaffInDeLicenseArea($department);
			} else if($gate == 'drivergate'){
				$data['gateData'] = $this->DashboardModel->getStaffInDriverGate($department);
			}
			$data['subdepartment'] = ['All', 'Workman', 'AMC'];
		} else if($department == 'visitor'){
			if($gate == 'maingate'){
				$data['gateData'] = $this->DashboardModel->getStaffInMaingate($department);
			}else if($gate == 'licensegate'){
				$data['gateData'] = $this->DashboardModel->getStaffInLicensegate($department);
			}else if($gate == 'delicensearea'){
				$data['gateData'] = $this->DashboardModel->getStaffInDeLicenseArea($department);
			} else if($gate == 'drivergate'){
				$data['gateData'] = $this->DashboardModel->getStaffInDriverGate($department);
			}
			$data['subdepartment'] = ['All', 'Visitor'];
		}
		$this->load->view('dashboard/infomore.php', $data);
	}

	public function UpdateRestriction() {
		// Get data from the POST request
		$id = $this->input->post('id');
		$restricted = $this->input->post('restricted');
		$subdepartment = $this->input->post('subdepartment');
		$gateName = $this->input->post('gateName');
				// print_r($subdepartment);die;

		$tableName = '';
		switch ($subdepartment) {
			case 'Officer':
				$tableName = 'officer';
				break;
			case 'Employee':
				$tableName = 'employee';
				break;
			case 'Contractor':
				$tableName = 'contractor';
				break;
			case 'Contractor_Workman':
				$tableName = 'contractor_workman';
				break;
			case 'Gat':
				$tableName = 'gat';
				break;
			case 'Tat':
				$tableName = 'tat';
				break;
			case 'Feg':
				$tableName = 'feg';
				break;
			case 'Sec':
				$tableName = 'sec';
				break;
			case 'Workman':
				$tableName = 'workman';
				break;
			case 'Amc':
				$tableName = 'amc';
				break;
			case 'Packed':
				$tableName = 'packed';
				break;
			case 'Bulk':
				$tableName = 'bulk';
				break;
			case 'Transporter':
				$tableName = 'transporter';
				break;
			case 'Mathadi':
				$tableName = 'mathadi';
				break;
			case 'Visitor':
				$tableName = 'visitor';
				break;
			default:
				$response = array('status' => 'error', 'message' => 'Invalid subdepartment');
				echo json_encode($response);
				return;
		}

		// Call the model to update the restriction status
		$result = $this->DashboardModel->updateRestriction($id, $restricted, $tableName, $gateName);

		// Return the result of the operation as a response
		if ($result) {
			$response = array('status' => 'success', 'message' => 'Status updated successfully');
			echo json_encode($response);
		} else {
			$response = array('status' => 'error', 'message' => 'Status not updated');
			echo json_encode($response);
		}
	}


}
