<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{




	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session', 'form_validation']);
		$this->load->helper(array('url', 'notification')); // Load URL and notification helper

		// $this->load->helper(['url', 'form']);

		$this->load->library('phpmailer_lib');
		$this->load->database();
		$this->load->model("ProjectModel");
		$this->load->model("CommonModel");
	}




	//************************************* AUTOFILLCODE*****************************************

	//***********************************AUTOFILLCODE ENDS HERE**********************************

	//----------------------------------------Workman----------------------------------------------

	public function Workman()
	{ //function to Workman page
		$data['workman'] = $this->ProjectModel->get_workman();
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('project/workman', $data);
	}


	public function AddWorkman($id)
	{ //function to load Add Workman form
		$data['id'] = $id;
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('project/addworkman', $data);
	}


	public function InsertWorkman()
	{ //function to insert Workman
		$formdata = $this->input->post();
		// Check for unique Aadhar number
		if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
		} else {
			$inserted = $this->ProjectModel->addWorkman($formdata);
			if ($inserted) {
				$this->session->set_flashdata('swal_type', 'success');
				$this->session->set_flashdata('swal_message', 'Workman Added Successfully');
			} else {
				$this->session->set_flashdata('swal_type', 'error');
				$this->session->set_flashdata('swal_message', 'Failed To Add Workman');
			}
		}
		redirect("Workman");
	}


	public function EditWorkman($id)
	{ //function to load edit Workman form
		$data['workman'] = $this->ProjectModel->getWorkmanById($id);
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('project/editworkman', $data);
	}


	public function UpdateWorkman()
	{ //function to update Workman


		$formdata = $this->input->post();
		$oldaadhar = $formdata['oldaadhar'];
		$newaadhar = $formdata['aadhar_no'];
		$id = $formdata['id'];

		// Remove unnecessary fields from formdata
		unset($formdata['id'], $formdata['oldaadhar']);

		// Check if Aadhaar is unchanged or valid
		if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
			$updated = $this->ProjectModel->updateWorkmanById($id, $formdata);

			// Set feedback messages based on update result
			$message = $updated ? 'Workman Updated Successfully' : 'Workman Workman Not Updated';
			$this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
			$this->session->set_flashdata('swal_message', $message);
		} else {
			// If Aadhaar already exists
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
		}

		redirect("Workman");
	}


	public function DropWorkman($id)
	{ //function to drop Workman
		// $formdata=$this->input->post();
		// $id=$formdata['id'];
		$deleted = $this->ProjectModel->deleteWorkman($id);
		if ($deleted) {
			$this->session->set_flashdata('swal_type', 'success');
			$this->session->set_flashdata('swal_message', 'Workman Deleted Successfully');
		} else {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Workman Not Deleted');
		}
		redirect("Workman");
	}



	// Add new packed
	public function AddWorkmanToken()
	{
		if ($this->input->post('addtoken')) {
			$token = $this->input->post('addtoken');
			$this->ProjectModel->add_workman($token);
			$response = array('status' => 'success', 'message' => 'Data Submitted');
		} else {
			$response = array('status' => 'error', 'message' => 'Invalid Token');
		}
		echo json_encode($response);
	}



	// Fetch packed data (for AJAX)
	// public function FetchWorkman()
	// {
	// 	$workman = $this->ProjectModel->get_workman();
	// 	echo json_encode($workman);
	// }
	public function FetchWorkman() {
        $workmans = $this->ProjectModel->get_workman(); // Array of officers
        $mg = $this->ProjectModel->get_pw_maingate_data('PW'); // Array of maingate data
        // print_r($mg);die;

        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($workmans as $workman) {
            $token = $workman['token_no'];
            $joined = $workman;
    
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


	//----------------------------------------WORKMAM END----------------------------------------------
	//----------------------------------------AMC----------------------------------------------


	public function Amc()
	{ //function to AMC page
		$data['amc'] = $this->ProjectModel->get_amc();
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('project/amc', $data);
	}


	public function AddAmc($id)
	{ //function to load Add Amc form
		$data['id'] = $id;
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('project/addamc', $data);
	}


	public function InsertAmc()
	{ //function to insert AMC
		$formdata = $this->input->post();
		// Check for unique Aadhar numbers
		if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
		} else {
			$inserted = $this->ProjectModel->addAmc($formdata);

			if ($inserted) {
				$this->session->set_flashdata('swal_type', 'success');
				$this->session->set_flashdata('swal_message', 'AMC Added Successfully');
			} else {
				$this->session->set_flashdata('swal_type', 'error');
				$this->session->set_flashdata('swal_message', 'Failed to add AMC');
			}
		}
		redirect("Amc");
	}


	public function EditAmc($id)
	{ //function to load edit Amc form
		$data['amc'] = $this->ProjectModel->getAmcById($id);
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('project/editamc', $data);
	}


	public function UpdateAmc()
	{ //function to update amc

		$formdata = $this->input->post();
		$oldaadhar = $formdata['oldaadhar'];
		$newaadhar = $formdata['aadhar_no'];
		$id = $formdata['id'];

		// Remove unnecessary fields from formdata
		unset($formdata['id'], $formdata['oldaadhar']);

		// Check if Aadhaar is unchanged or valid
		if ($oldaadhar === $newaadhar || !$this->CommonModel->checkAadharExists($newaadhar)) {
			$updated = $this->ProjectModel->updateAmcById($id, $formdata);

			// Set feedback messages based on update result
			$message = $updated ? 'Amc Updated Successfully' : ' Amc Not Updated';
			$this->session->set_flashdata('swal_type', $updated ? 'success' : 'error');
			$this->session->set_flashdata('swal_message', $message);
		} else {
			// If Aadhaar already exists
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exists.');
		}
		redirect("Amc");
	}


	public function DropAmc($id)
	{ //function to drop Amc
		$deleted = $this->ProjectModel->deleteAmc($id);
		if ($deleted) {
			$this->session->set_flashdata('swal_type', 'success');
			$this->session->set_flashdata('swal_message', 'Amc Deleted Successfully');
		} else {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Amc Not Deleted');
		}
		redirect("Amc");
	}



	// Add new Amc
	public function AddAmcToken()
	{
		if ($this->input->post('addtoken')) {
			$token = $this->input->post('addtoken');
			$this->ProjectModel->add_amc($token);
			$response = array('status' => 'success', 'message' => 'Data Submitted');
		} else {
			$response = array('status' => 'error', 'message' => 'Invalid Token');
		}
		echo json_encode($response);
	}



	// Fetch Amc data (for AJAX)
	public function FetchAmc()
	{
		$amcs = $this->ProjectModel->get_amc(); // Array of officers
        $mg = $this->ProjectModel->get_pw_maingate_data('AMC'); // Array of maingate data
        // print_r($mg);die;

        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($amcs as $amc) {
            $token = $amc['token_no'];
            $joined = $amc;
    
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

	//----------------------------------------Amc END----------------------------------------------




}
