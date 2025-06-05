<?php defined('BASEPATH') or exit('No direct script access allowed');

class Visitor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(array('url', 'notification')); // Load URL and notification helper

        $this->load->database();
        $this->load->model("VisitorModel");
        $this->load->model("CommonModel");
        $this->load->model("OperationModel");
        $this->load->helper(array('url', 'notification')); // Load URL and notification helper

        // Initialize upload library
        $config['upload_path'] = 'library_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);
    }

    // File upload helper
    function UploadFile($path, $file, $type = 'jpg|jpeg|png|gif')
    {
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



    public function Visitor()
    { //function to VISITOR page
        $data['visitor'] = $this->VisitorModel->get_visitor();
        $data['last_token'] = $this->VisitorModel->getLastTokenNo();
        $data['last_srno'] = $this->VisitorModel->getLastSrno();
        // $data = array_merge($data, $this->data); // Merge global notifications

        $this->load->view('visitor/visitor', $data);
    }

    // Fetch visitor data (for AJAX)
    public function FetchVisitor()
    {
        $visitors = $this->VisitorModel->get_visitor();
        $mg = $this->OperationModel->get_ofc_maingate_data('V'); // Array of maingate data
        // print_r($officers);die;

        // Index mg array by token_no for quick lookup
        $mg_indexed = [];
        foreach ($mg as $entry) {
            $mg_indexed[$entry['token_no']] = $entry;
        }
    
        // Prepare final result with left join behavior
        $result = [];
        foreach ($visitors as $visitor) {
            $token = $visitor['token_no'];
            $joined = $visitor;
    
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

    public function AddVisitorToken()
    { // Add new Visitor
        if ($this->input->post('addtoken')) {
            $token = $this->input->post('addtoken');
            $this->VisitorModel->add_visitor($token);
            $response = array('status' => 'success', 'message' => 'Data Added Succesfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid Token');
        }
        echo json_encode($response);
    }


    // Add visitor form
    public function AddVisitor($id)
    {
        $data['id'] = $id;
        $data['officers'] = $this->VisitorModel->get_officers();
        // $data = array_merge($data, $this->data); // Merge global notifications
        $this->load->view('visitor/addvisitor', $data);
    }

    public function InsertVisitor()
    {
        $formdata = $this->input->post();
        // $formdata['access'] = implode(',', (array) $formdata['access']);

        // Process Base64 Images
        $formdata['photo'] = $this->saveBase64Image($this->input->post('photo'), 'uploads/visitor_photos/');
        $formdata['idphoto'] = $this->saveBase64Image($this->input->post('idphoto'), 'uploads/visitor_photos/');

        if ($this->VisitorModel->checkAadharExists($formdata['aadhar_no'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Aadhar number already exists.');
        } else {
            $uploadedFiles = [];

            // File Upload Handling
            $uploadPath = "uploads/visitors/";
            foreach (['photo', 'photoid'] as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $uploadResult = $this->UploadFile($uploadPath, $field);
                    if (isset($uploadResult['error'])) {
                        $this->session->set_flashdata('swal_type', 'error');
                        $this->session->set_flashdata('swal_message', "Error uploading {$field}.");
                        redirect("Visitor");
                        return;
                    }
                    $uploadedFiles[$field] = $uploadResult;
                }
            }

            // Merge Uploaded Files Data
            $formdata = array_merge($formdata, $uploadedFiles);

            // Insert Visitor Record
            $inserted = $this->VisitorModel->addVisitor($formdata);
            $note = $this->VisitorModel->insertNotifications($formdata);

            if ($inserted && $note) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'Visitor Added Successfully.');
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed To Add Visitor.');
            }
        }
        redirect("Visitor");
    }

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




    public function EditVisitor($id)
    { // edit visitor form
        $data['visitor'] = $this->VisitorModel->getVisitorById($id);
        $data['officers'] = $this->VisitorModel->get_officers();
        // $data = array_merge($data, $this->data); // Merge global notifications

        $this->load->view('visitor/editvisitor', $data);
    }



    // public function generatepass($token, $encodedData) { // Generate visitor pass
    //     // Decode JSON data from the URL
    //     $decodedData = json_decode(urldecode($encodedData), true);

    //     // Fetch visitor details from the model if not already provided in `$decodedData`
    //     if (!isset($decodedData['visitor'])) {
    //         $visitor = $this->VisitorModel->get_visitor_by_token($token);
    //         $decodedData['last_srno'] = $this->VisitorModel->get_last_srno(); // Fetch last SR No.

    //         if ($visitor) {
    //             $visitor['status'] = 'success';
    //             $visitor['message'] = 'Visitor Found';
    //         } else {
    //             $visitor = array('status' => 'error', 'message' => 'Visitor Not Found');
    //         }
    //         $decodedData['visitor'] = $visitor;
    //     }

    //     // $data = array_merge($data, $this->data); // Merge global notifications

    //     // Pass data to the view
    //     $this->load->view('visitor/visitorentrypass', $decodedData);
    //}

    public function generatepass($token, $encodedData)
    { // Generate visitor pass
        // Decode JSON data from the URL
        $decodedData = json_decode(urldecode($encodedData), true);

        // Fetch visitor details from the model if not already provided in `$decodedData`
        if (!isset($decodedData['visitor'])) {
            $visitor = $this->VisitorModel->get_visitor_by_token($token);
            $decodedData['last_srno'] = $this->VisitorModel->get_last_srno(); // Fetch last SR No.

            if ($visitor) {
                $visitor['status'] = 'success';
                $visitor['message'] = 'Visitor Found';
            } else {
                $visitor = array('status' => 'error', 'message' => 'Visitor Not Found');
            }
            $decodedData['visitor'] = $visitor;
        }

        // $decodedData = array_merge($decodedData, $this->data); // Merge global notifications

        // Pass data to the view
        $this->load->view('visitor/visitorentrypass', $decodedData);
    }




    public function processVisitor()
    {
        $this->output->set_content_type('application/json');

        $token = $this->input->get('token');
        $srno  = $this->input->get('srno');

        if (!$token || !$srno) {
            echo json_encode(['success' => false, 'message' => "Token or SrNo is missing"]);
            return;
        }
        // $this->load->model('VisitorModel');
        $result = $this->VisitorModel->processVisitor($token, $srno);
        // print_r($result);die;

        echo json_encode($result);
    }




    public function processForm()
    { // manage srno of visitor
        if ($this->input->post('submit')) {
            $token = $this->input->post('addtoken');

            $last_token = $this->VisitorModel->getLastTokenNo();
            $total = $token + $last_token;

            if ($this->VisitorModel->insertTokens($last_token + 1, $total)) {
                redirect('VisitorController');
            } else {
                echo "Error inserting tokens!";
            }
        }
    }



    public function changeSrNo()
    { // to change srno

        $sr_no = $this->input->post('sr_no');

        if ($this->VisitorModel->insertSrNo($sr_no)) {
            redirect('Visitor');
        } else {
            echo "Error inserting Sr No!";
        }
    }



    public function search()
    { //for search visitor
        // $this->output->set_content_type('application/json');
        $sr_no = $this->input->post('inputsrno');
        $visitor = $this->VisitorModel->get_visitor_by_srno($sr_no);

        if ($visitor) {
            echo json_encode($visitor);
        } else {
            echo json_encode(['status' => 'not_found']);
        }
    }

    public function searchpass()
    {
        $this->load->view('visitor/searchgatepass');
    }








    public function UpdateVisitor()
    { // for visitor updation
        $formdata = $this->input->post();

        // Check if 'new_photo' is provided and save it
        if (!empty($formdata['new_photo'])) {
            $formdata['new_photo'] = $this->saveBase64Image($this->input->post('new_photo'), 'uploads/visitor_photos/');
            $formdata['photo'] = $formdata['new_photo'];
        }
        unset($formdata['new_photo']);  // Remove 'new_photo' key after processing
        // print_r($formdata);die;

        // Check if 'new_photoid' is provided and save it
        if (!empty($formdata['new_photoid'])) {
            $formdata['new_photoid'] = $this->saveBase64Image($this->input->post('new_photoid'), 'uploads/visitor_photos/');
            $formdata['idphoto'] = $formdata['new_photoid'];
        }
        unset($formdata['new_photoid']);  // Remove 'new_photoid' key after processing

        // print_r($formdata);die;



        // Ensure 'id' exists for the update operation
        if (!isset($formdata['id'])) {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Visitor ID is missing.');
            redirect("Visitor");
            return;
        }

        $id = $formdata['id'];
        unset($formdata['id']);  // Remove 'id' key from the formdata
        // Update the visitor record in the database
        // print_r($formdata);die;
        $updated = $this->VisitorModel->updateVisitorById($id, $formdata);
        $note = $this->VisitorModel->updateNotifications($id, $formdata);


        if ($updated && $note) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Visitor Updated Successfully.');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Failed to update visitor.');
        }

        redirect("Visitor");
    }




    // Delete visitor
    public function DropVisitor($id)
    {
        $deleted = $this->VisitorModel->deleteVisitor($id);
        if ($deleted) {
            $this->session->set_flashdata('swal_type', 'success');
            $this->session->set_flashdata('swal_message', 'Visitor Deleted Successfully');
        } else {
            $this->session->set_flashdata('swal_type', 'error');
            $this->session->set_flashdata('swal_message', 'Failed to Delete Visitor');
        }

        redirect("Visitor");
    }
}
