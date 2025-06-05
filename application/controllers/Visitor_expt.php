<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->database();
        $this->load->model("VisitorModel");
        $this->load->model("CommonModel");
        $this->load->model("OperationModel");
        
        // Initialize upload library
        $config['upload_path'] = 'library_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);
    }

    // File upload helper
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
    }


    
public function Visitor(){ //function to VISITOR page
	$data['visitor'] = $this->VisitorModel->get_visitor();
	$this->load->view('visitor/visitor',$data);
}

// Fetch visitor data (for AJAX)
public function FetchVisitor() {
	$visitor = $this->VisitorModel->get_visitor();
	echo json_encode($visitor);
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


    // Add visitor form
    public function AddVisitor($id) {
        $data['id'] = $id; 
        $data['officers'] = $this->OperationModel->get_officers();
        $this->load->view('visitor/addVisitor', $data);
    }

    // Insert visitor
    public function InsertVisitor() {
        $formdata = $this->input->post();
        $formdata['access'] = isset($formdata['access']) ? implode(',', (array) $formdata['access']) : '';
        // Handle photo uploads
        $formdata['photo'] = $this->saveBase64Image($this->input->post('photo_data'), 'uploads/visitor_photos/');
        $formdata['idphoto'] = $this->saveBase64Image($this->input->post('idphoto'), 'uploads/visitor_photos/');


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


            // $access_string = implode(',', $this->input->post('access', TRUE));

            // Insert visitor record
            $inserted = $this->VisitorModel->addVisitor($formdata);
            $note= $this->VisitorModel->insertNotifications($formdata);

            if ($inserted && $note) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Visitor added successfully');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to add visitor');
            }
        }
        redirect("Visitor");
    }

    private function saveBase64Image($base64String, $folderPath) {
        if (empty($base64String)) return NULL;

        $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $base64String);
        $imageData = base64_decode($imageData);

        if ($imageData === false) return NULL; // Invalid base64 data

        $fileName = uniqid('photo_') . '.png';
        $filePath = $folderPath . $fileName;

        if (!is_dir($folderPath)) mkdir($folderPath, 0777, true); // Ensure folder exists
        file_put_contents($filePath, $imageData);

        return $filePath;
    }





    // Edit visitor
    public function EditVisitor($id) {
        $data['visitor'] = $this->VisitorModel->getVisitorById($id);
        $data['officers'] = $this->OperationModel->get_officers();
        $this->load->view('visitor/editVisitor', $data);
    }

    // Update visitor
    public function UpdateVisitor() {
        $formdata = $this->input->post();
        $id = $formdata['id'];
        unset($formdata['id']);

        $uploadPath = "uploads/visitors/";
        $uploadedFiles = [];

        // Handle photo upload if new photo is selected
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

        // Handle photoid upload if new photo ID is selected
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

        // Update visitor record
        $updated = $this->VisitorModel->updateVisitoById($id, $formdata);
        if ($updated) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Visitor updated successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Failed to update visitor');
        }

        redirect("Visitor");
    }

    // Delete visitor
    public function DropVisitor($id) {
        $deleted = $this->VisitorModel->deleteVisitor($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Visitor deleted successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Failed to delete visitor');
        }

        redirect("Visitor");
    }
}
?>