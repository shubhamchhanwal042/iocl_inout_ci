<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(['session', 'form_validation']);
		$this->load->helper(array('url', 'notification')); // Load URL and notification helper

		// $this->load->helper(['url', 'form']);

		$this->load->library('phpmailer_lib');
		$this->load->database();
		$this->load->model("DriverModel");
		$this->load->model("CommonModel");
		$this->load->model("OperationModel");

	}


function Parking(){
	$this->load->view('gates/parking');
}



	//************************************* AUTOFILLCODE*****************************************



	//***********************************AUTOFILLCODE ENDS HERE**********************************

	//----------------------------------------PACKED----------------------------------------------

	public function Packed()
	{ //function to packed page
		$data['packed'] = $this->DriverModel->get_packed();
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/packed', $data);
	}


	public function AddPacked($id)
	{ //function to load Add packed form
		$data['id'] = $id;
		$this->load->view('driver/addpacked', $data);
	}

	public function InsertPacked() {
        $formdata = $this->input->post();
    
        // Process Base64 Images
        $formdata['photo'] = $this->saveBase64Image($this->input->post('photo'), 'uploads/packed/');
        $formdata['idphoto'] = $this->saveBase64Image($this->input->post('idphoto'), 'uploads/packed/');
    
        if ($this->DriverModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
        } else {
            $uploadedFiles = [];
    
            // File Upload Handling
            $uploadPath = "uploads/packed/";
            foreach (['photo', 'photoid'] as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $uploadResult = $this->UploadFile($uploadPath, $field);
                    if (isset($uploadResult['error'])) {
                        $this->session->set_flashdata('swal_type', 'error');
                        $this->session->set_flashdata('swal_message', "Error uploading {$field}.");
                        redirect("Packed");
                        return;
                    }
                    $uploadedFiles[$field] = $uploadResult;
                }
            }
    
            // Merge Uploaded Files Data
            $formdata = array_merge($formdata, $uploadedFiles);
    
            // Insert Packed Record
            $inserted = $this->DriverModel->addPacked($formdata);
    
            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Packed Added Successfully.');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add Packed.');
            }
        }
        redirect("Packed");
    }

	// public function InsertPacked()
	// { //function to insert packed
	// 	$formdata = $this->input->post();
	// 	// Check for unique Aadhar number
	// 	if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
	// 		$this->session->set_flashdata('swal_type', 'error');
	// 		$this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
	// 	} else {
	// 		$inserted = $this->DriverModel->addPacked($formdata);

	// 		if ($inserted) {
	// 			$this->session->set_flashdata('swal_type', 'success');
	// 			$this->session->set_flashdata('swal_message', 'packed added successfully');
	// 		} else {
	// 			$this->session->set_flashdata('swal_type', 'error');
	// 			$this->session->set_flashdata('swal_message', 'Failed to add packed');
	// 		}
	// 	}
	// 	redirect("Packed");
	// }


	public function EditPacked($id)
	{ //function to load edit packed form
		$data['packed'] = $this->DriverModel->getPackedById($id);
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/editpacked', $data);
	}


	public function UpdatePacked()
	{ //function to update packed
		$formdata = $this->input->post();

		// Check if 'new_photo' is provided and save it
		if (!empty($formdata['new_photo'])) {
			$formdata['new_photo'] = $this->saveBase64Image($this->input->post('new_photo'), 'uploads/packed/');
			$formdata['photo'] = $formdata['new_photo'];
		}
		unset($formdata['new_photo']);  // Remove 'new_photo' key after processing
		// print_r($formdata);die;

		// Check if 'new_photoid' is provided and save it
		if (!empty($formdata['new_photoid'])) {
			$formdata['new_photoid'] = $this->saveBase64Image($this->input->post('new_photoid'), 'uploads/packed/');
			$formdata['id_proof'] = $formdata['new_photoid'];
		}
		unset($formdata['new_photoid']);  // Remove 'new_photoid' key after processing

		// print_r($formdata);die;

		$id = $formdata['id'];
		unset($formdata['id']);
		if (!$this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exist.');
		} else {
			$updated = $this->DriverModel->updatePackedById($id, $formdata);
			if ($updated) {
				$this->session->set_flashdata('swal_type', 'success');
				$this->session->set_flashdata('swal_message', 'Packed Updated Successfully');
			} else {
				$this->session->set_flashdata('swal_type', 'error');
				$this->session->set_flashdata('swal_message', 'Packed Not Updated');
			}
		}
		redirect("Packed");
	}


	public function DropPacked($id)
	{ //function to drop packed
		$deleted = $this->DriverModel->deletePacked($id);
		if ($deleted) {
			$this->session->set_flashdata('swal_type', 'success');
			$this->session->set_flashdata('swal_message', 'Packed Deleted Successfully');
		} else {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'packed Not Deleted');
		}
		redirect("Packed");
	}



	// Add new packed
	public function AddPackedToken()
	{
		if ($this->input->post('addtoken')) {
			$token = $this->input->post('addtoken');
			$this->DriverModel->add_packed($token);
			$response = array('status' => 'success', 'message' => 'Data Submitted');
		} else {
			$response = array('status' => 'error', 'message' => 'Invalid Token');
		}
		echo json_encode($response);
	}



	// Fetch packed data (for AJAX)
	public function FetchPacked()
	{
		$packeds = $this->DriverModel->get_packed();
		$mg = $this->DriverModel->get_driver_maingate_data('PT'); // Array of maingate data
        // print_r($mg);die;

        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry; 
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($packeds as $packed) {
            $token = $packed['token_no'];
            $joined = $packed;
    
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
		// echo json_encode($packed);
	}



	//----------------------------------------PACKED END----------------------------------------------
	//----------------------------------------BULK----------------------------------------------


	public function Bulk()
	{ //function to bulk page
		$data['bulk'] = $this->DriverModel->get_bulk();
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/bulk', $data);
	}


	public function AddBulk($id)
	{ //function to load Add bulk form
		$data['id'] = $id;
		$this->load->view('driver/addbulk', $data);
	}

	public function InsertBulk() {
        $formdata = $this->input->post();
    
        // Process Base64 Images
        $formdata['photo'] = $this->saveBase64Image($this->input->post('photo'), 'uploads/bulk/');
        $formdata['idphoto'] = $this->saveBase64Image($this->input->post('idphoto'), 'uploads/bulk/');
    
        if ($this->DriverModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar Number Already Exist.');
        } else {
            $uploadedFiles = [];
    
            // File Upload Handling
            $uploadPath = "uploads/bulk/";
            foreach (['photo', 'photoid'] as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $uploadResult = $this->UploadFile($uploadPath, $field);
                    if (isset($uploadResult['error'])) {
                        $this->session->set_flashdata('swal_type', 'error');
                        $this->session->set_flashdata('swal_message', "Error uploading {$field}.");
                        redirect("Bulk");
                        return;
                    }
                    $uploadedFiles[$field] = $uploadResult;
                }
            }
    
            // Merge Uploaded Files Data
            $formdata = array_merge($formdata, $uploadedFiles);
    
            // Insert bulk Record
            $inserted = $this->DriverModel->addBulk($formdata);
    
            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Bulk Added Successfully.');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed To Add Bulk.');
            }
        }
        redirect("Bulk");
    }

	// public function InsertBulk()
	// { //function to insert bulk
	// 	$formdata = $this->input->post();
	// 	// Check for unique Aadhar number
	// 	if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
	// 		$this->session->set_flashdata('swal_type', 'error');
	// 		$this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
	// 	} else {
	// 		$inserted = $this->DriverModel->addBulk($formdata);

	// 		if ($inserted) {
	// 			$this->session->set_flashdata('swal_type', 'success');
	// 			$this->session->set_flashdata('swal_message', 'bulk added successfully');
	// 		} else {
	// 			$this->session->set_flashdata('swal_type', 'error');
	// 			$this->session->set_flashdata('swal_message', 'Failed to add bulk');
	// 		}
	// 	}
	// 	redirect("Bulk");
	// }


	public function EditBulk($id)
	{ //function to load edit bulk form
		$data['bulk'] = $this->DriverModel->getBulkById($id);
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/editbulk', $data);
	}


	public function UpdateBulk()
	{ //function to update bulk
		$formdata = $this->input->post();
		// Check if 'new_photo' is provided and save it
		if (!empty($formdata['new_photo'])) {
			$formdata['new_photo'] = $this->saveBase64Image($this->input->post('new_photo'), 'uploads/bulk/');
			$formdata['photo'] = $formdata['new_photo'];
		}
		unset($formdata['new_photo']);  // Remove 'new_photo' key after processing
		// print_r($formdata);die;

		// Check if 'new_photoid' is provided and save it
		if (!empty($formdata['new_photoid'])) {
			$formdata['new_photoid'] = $this->saveBase64Image($this->input->post('new_photoid'), 'uploads/bulk/');
			$formdata['id_proof'] = $formdata['new_photoid'];
		}
		unset($formdata['new_photoid']);  // Remove 'new_photoid' key after processing

		$id = $formdata['id'];
		unset($formdata['id']);
		if (!$this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exist.');
		} else {
			$updated = $this->DriverModel->updateBulkById($id, $formdata);
			if ($updated) {
				$this->session->set_flashdata('swal_type', 'success');
				$this->session->set_flashdata('swal_message', 'Bulk Updated Successfully');
			} else {
				$this->session->set_flashdata('swal_type', 'error');
				$this->session->set_flashdata('swal_message', 'Bulk Not Updated');
			}
		}
		redirect("Bulk");
	}


	public function DropBulk($id)
	{ //function to drop Bulk
		// $formdata=$this->input->post();
		// $id=$formdata['id'];
		$deleted = $this->DriverModel->deleteBulk($id);
		if ($deleted) {
			$this->session->set_flashdata('swal_type', 'success');
			$this->session->set_flashdata('swal_message', 'Bulk Deleted Successfully');
		} else {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Bulk Not Deleted');
		}
		redirect("Bulk");
	}



	// Add new Bulk
	public function AddBulkToken()
	{
		if ($this->input->post('addtoken')) {
			$token = $this->input->post('addtoken');
			$this->DriverModel->add_bulk($token);
			$response = array('status' => 'success', 'message' => 'Data Submitted');
		} else {
			$response = array('status' => 'error', 'message' => 'Invalid Token');
		}
		echo json_encode($response);
	}



	// Fetch bulk data (for AJAX)
	public function FetchBulk()
	{
		$bulks = $this->DriverModel->get_bulk();
		// $mg = $this->OperationModel->get_ofc_maingate_data('BK'); // Array of maingate data
		$mg = $this->DriverModel->get_driver_maingate_data('BK'); // Array of maingate data
        // print_r($mg);die;
        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($bulks as $bulk) {
            $token = $bulk['token_no'];
            $joined = $bulk;
    
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




	//----------------------------------------BULK END----------------------------------------------
	//----------------------------------------TRANSPORTER----------------------------------------------



	public function Transporter()
	{ //function to Transporter page
		$data['tranporter'] = $this->DriverModel->get_transporter();
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/transporter', $data);
	}


	public function AddTransporter($id)
	{ //function to load Add Transporter form
		$data['id'] = $id;
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/addtransporter', $data);
	}



	public function InsertTransporter() {
        $formdata = $this->input->post();
    
        // Process Base64 Images
        $formdata['photo'] = $this->saveBase64Image($this->input->post('photo'), 'uploads/transporter/');
        $formdata['idphoto'] = $this->saveBase64Image($this->input->post('idphoto'), 'uploads/transporter/');
    
        if ($this->DriverModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
        } else {
            $uploadedFiles = [];
    
            // File Upload Handling
            $uploadPath = "uploads/transporter/";
            foreach (['photo', 'photoid'] as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $uploadResult = $this->UploadFile($uploadPath, $field);
                    if (isset($uploadResult['error'])) {
                        $this->session->set_flashdata('swal_type', 'error');
                        $this->session->set_flashdata('swal_message', "Error uploading {$field}.");
                        redirect("Transporter");
                        return;
                    }
                    $uploadedFiles[$field] = $uploadResult;
                }
            }
    
            // Merge Uploaded Files Data
            $formdata = array_merge($formdata, $uploadedFiles);
    
            // Insert Transporter Record
            $inserted = $this->DriverModel->addTransporter($formdata);
    
            if ($inserted) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Transporter Added Successfully.');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed To Add Transporter.');
            }
        }
        redirect("Transporter");
    }


	// public function InsertTransporter()
	// { //function to insert Transporter
	// 	$formdata = $this->input->post();
	// 	// Check for unique Aadhar number
	// 	if ($this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
	// 		$this->session->set_flashdata('swal_type', 'error');
	// 		$this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
	// 	} else {
	// 		$inserted = $this->DriverModel->addTransporter($formdata);

	// 		if ($inserted) {
	// 			$this->session->set_flashdata('swal_type', 'success');
	// 			$this->session->set_flashdata('swal_message', 'Transporter added successfully');
	// 		} else {
	// 			$this->session->set_flashdata('swal_type', 'error');
	// 			$this->session->set_flashdata('swal_message', 'Failed to add Transporter');
	// 		}
	// 	}
	// 	redirect("Transporter");
	// }


	public function EditTransporter($id)
	{ //function to load edit Transporter form
		$data['transporter'] = $this->DriverModel->getTransporterById($id);
		// $data = array_merge($data, $this->data); // Merge global notifications
		$this->load->view('driver/edittransporter', $data);
	}


	public function UpdateTransporter()
	{ //function to update Transporter
		$formdata = $this->input->post();

		// Check if 'new_photo' is provided and save it
		if (!empty($formdata['new_photo'])) {
			$formdata['new_photo'] = $this->saveBase64Image($this->input->post('new_photo'), 'uploads/transporter/');
			$formdata['photo'] = $formdata['new_photo'];
		}
		unset($formdata['new_photo']);  // Remove 'new_photo' key after processing
		// print_r($formdata);die;

		// Check if 'new_photoid' is provided and save it
		if (!empty($formdata['new_photoid'])) {
			$formdata['new_photoid'] = $this->saveBase64Image($this->input->post('new_photoid'), 'uploads/transporter/');
			$formdata['id_proof'] = $formdata['new_photoid'];
		}
		unset($formdata['new_photoid']);  // Remove 'new_photoid' key after processing


		$id = $formdata['id'];
		unset($formdata['id']);
		if (!$this->CommonModel->checkAadharExists($formdata['aadhar_no'])) {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Aadhar Number Already Exist.');
		} else {
			$updated = $this->DriverModel->updateTransporterById($id, $formdata);
			if ($updated) {
				$this->session->set_flashdata('swal_type', 'success');
				$this->session->set_flashdata('swal_message', 'Transporter Updated Successfully');
			} else {
				$this->session->set_flashdata('swal_type', 'error');
				$this->session->set_flashdata('swal_message', 'Transporter Not Updated');
			}
		}
		redirect("Transporter");
	}


	public function DropTransporter($id)
	{ //function to drop Transporter
		$deleted = $this->DriverModel->deleteTransporter($id);
		if ($deleted) {
			$this->session->set_flashdata('swal_type', 'success');
			$this->session->set_flashdata('swal_message', 'Transporter Deleted Successfully');
		} else {
			$this->session->set_flashdata('swal_type', 'error');
			$this->session->set_flashdata('swal_message', 'Transporter Not Deleted');
		}
		redirect("Transporter");
	}



	// Add new Transporter
	public function AddTransporterToken()
	{
		if ($this->input->post('addtoken')) {
			$token = $this->input->post('addtoken');
			$this->DriverModel->add_transporter($token);
			$response = array('status' => 'success', 'message' => 'Data Submitted');
		} else {
			$response = array('status' => 'error', 'message' => 'Invalid Token');
		}
		echo json_encode($response);
	}



	// Fetch Transporter data (for AJAX)
	public function FetchTransporter()
	{
		$transporters = $this->DriverModel->get_transporter();
		$mg = $this->DriverModel->get_driver_maingate_data('TR'); // Array of maingate data

        // print_r($mg);die;

        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($transporters as $transporter) {
            $token = $transporter['token_no'];
            $joined = $transporter;
    
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


	//----------------------------------------TRANSPORTER END----------------------------------------------

	// //                        ------------------ID CARD COMMON CODE-------------------


	// //                         --------------- ID CARD COMMON CODE END---------------
	// //=========================================ID CARD===================================================




	//========================================ID END================================================




	private function saveBase64Image($base64String, $folderPath)
	{
		if (empty($base64String)) return NULL;

		$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64String));
		if (!$imageData) return NULL;

		$fileName = uniqid('photo_') . '.png';
		$filePath = $folderPath . $fileName;

		if (!is_dir($folderPath)) mkdir($folderPath, 0777, true);
		if (file_put_contents($filePath, $imageData)) {
			return $filePath;
		}
		return NULL;
	}
}
