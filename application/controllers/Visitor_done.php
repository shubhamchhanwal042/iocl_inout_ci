<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        // $this->load->helper(['url', 'form']);

        $this->load->library('phpmailer_lib');
        $this->load->database();
        $this->load->model("VisitorModel");
		$this->load->model("CommonModel");
		$this->load->model("OperationModel");



		$this->load->library('upload');

		$config['upload_path'] = 'library_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);


    }




	function UploadFile($path, $file, $type = 'jpg|jpeg|png|gif'){
        $returname = null;

        $config['upload_path'] = $path;
        $config['allowed_types'] = $type;
        $config['max_size'] = 51200;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (isset($_FILES[$file]) && is_uploaded_file($_FILES[$file]['tmp_name'])) {
            if (!$this->upload->do_upload($file)) {
                return ['error' => $this->upload->display_errors()];
            } else {
                $uploadData = $this->upload->data();
                $returname = $uploadData['file_name'];
            }
        } else {
            return ['error' => 'No file selected or invalid upload'];
        }

        return $returname;
    }   // function ends


	    //************************************* AUTOFILLCODE*****************************************


                // Method to check Aadhaar number using GET
                public function checkAadhar() {
                    $aadhar_no = $this->input->get('aadhar_no'); // Get Aadhaar number from GET request
            
                    if (!empty($aadhar_no)) {
                        $data = $this->ProjectModel->checkAadharExistGetData($aadhar_no); // Query the database
            
                        if ($data) {
                            // print_r($data);die;
                            // If found, return the data as JSON
                            echo json_encode(['status' => true, 'data' => $data]);
                        } else {
                            // If not found
                            echo json_encode(['status' => false, 'message' => 'Aadhaar number not found']);
                        }
                    } else {
                        // If no Aadhaar number provided
                        echo json_encode(['status' => false, 'message' => 'Invalid Aadhaar number']);
                    }
                }            


    //***********************************AUTOFILLCODE ENDS HERE**********************************

//----------------------------------------	VISITOR----------------------------------------------

public function Visitor(){ //function to VISITOR page
	$data['visitor'] = $this->VisitorModel->get_visitor();
	$this->load->view('visitor/visitor',$data);
}


public function AddVisitor($id){ //function to load Add visitor form
	$data['id'] = $id; 
	$data['officers']=$this->OperationModel->get_officers();
	$this->load->view('visitor/addVisitor', $data);
}



// public function InsertVisitor() { //function to insert visitor
// 	$formdata = $this->input->post();

// 		// Check for unique Aadhar number
// 		if ($this->VisitorModel->checkAadharExists($formdata['aadhar_no'])) {
// 			$this->session->set_flashdata('swal_type', 'error');
// 			$this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
// 		} else {
// 			$inserted = $this->VisitorModel->addVisitor($formdata);
// 			if ($inserted) {
// 				$this->session->set_flashdata('swal_type', 'success');
// 				$this->session->set_flashdata('swal_message', 'Workman added successfully');
// 			} else {
// 				$this->session->set_flashdata('swal_type', 'error');
// 				$this->session->set_flashdata('swal_message', 'Failed to add Workman');
// 			}
// 		}
// 	redirect("Visitor");
// }


public function InsertVisitor() {
    $formdata = $this->input->post();

    // Check for unique Aadhar number
    if ($this->VisitorModel->checkAadharExists($formdata['aadhar_no'])) {
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
    } else {
        $uploadPath = "uploads/visitors/";
        $uploadedFiles = [];

        // Handle photo upload
        if (!empty($_FILES['photo']['name'])) {
            $uploadResult = $this->UploadFile($uploadPath, 'photo');
            if (is_array($uploadResult) && isset($uploadResult['error'])) {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Error uploading photo.');
                redirect("Visitor");
                return;
            }
            $uploadedFiles['photo'] = $uploadResult;
        }

        // Handle photoid upload
        if (!empty($_FILES['photoid']['name'])) {
            $uploadResult = $this->UploadFile($uploadPath, 'photoid');
            if (is_array($uploadResult) && isset($uploadResult['error'])) {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Error uploading photo ID.');
                redirect("Visitor");
                return;
            }
            $uploadedFiles['photoid'] = $uploadResult;
        }

        // Add file paths to form data 
        if (!empty($uploadedFiles)) {
            $formdata = array_merge($formdata, $uploadedFiles);
        }

        // Insert visitor record
        $inserted = $this->VisitorModel->addVisitor($formdata);
        if ($inserted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Visitor added successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Failed to add visitor');
        }
    }
    redirect("Visitor");
}


public function EditVisitor($id){ //function to load edit visitor form
	$data['visitor'] = $this->VisitorModel->getVisitorById($id);
	$data['officers']=$this->OperationModel->get_officers();
	$this->load->view('visitor/editVisitor',$data);
}


public function UpdateVisitor(){ //function to update visitor
	$formdata=$this->input->post();
	$id=$formdata['id'];
	unset($formdata['id']);
	$updated = $this->VisitorModel->updateVisitoById($id,$formdata);
	if($updated){
		$this->session->set_flashdata('swal_type', 'success');
		$this->session->set_flashdata('swal_message', 'Workman Updated Successfully');

		}else{
		$this->session->set_flashdata('swal_type', 'error');
		$this->session->set_flashdata('swal_message', 'Workman Not Updated');
		}
	redirect("Visitor");   
}


public function DropVisitor($id){ //function to drop Visitor
	// $formdata=$this->input->post();
	// $id=$formdata['id'];
	$deleted = $this->VisitorModel->deleteVisitor($id);
	if($deleted){
		$this->session->set_flashdata('swal_type', 'success');
		$this->session->set_flashdata('swal_message', 'Visitor Deleted Successfully');
		}else{
		$this->session->set_flashdata('swal_type', 'error');
		$this->session->set_flashdata('swal_message', 'Visitor Not Deleted');
		}
	redirect("Visitor");   
}


// Add new Visitor
public function AddVisitorToken() {
	if ($this->input->post('addtoken')) {
		$token = $this->input->post('addtoken');
		$this->VisitorModel->add_visitor($token);
		$response = array('status' => 'success', 'message' => 'Data Submitted');
	} else {
		$response = array('status' => 'error', 'message' => 'Invalid Token');
	}
	echo json_encode($response);
}


// Fetch visitor data (for AJAX)
public function FetchVisitor() {
	$visitor = $this->VisitorModel->get_visitor();
	echo json_encode($visitor);
}


//----------------------------------------visitor END----------------------------------------------





	// public function Visitor()
	// {
	// 	$this->load->view('visitor/visitor');
	// }

	// public function AddVisitor()
	// {
	// 	$this->load->view('visitor/addvisitor');
	// }

	// public function EditVisitor()
	// {
	// 	$this->load->view('visitor/editvisitor');
	// }
}
