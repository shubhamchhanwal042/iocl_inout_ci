<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        
        // $this->load->helper(['url', 'notification']);
     
        $this->load->library('phpmailer_lib');
        $this->load->database();
        $this->load->model("CommonModel");
    }
    
    //************************************* AUTOFILLCODE*****************************************


                // Method to check Aadhaar number using GET
                public function checkAadhar() {
                    $aadhar_no = $this->input->get('aadhar_no'); // Get Aadhaar number from GET request
            
                    if (!empty($aadhar_no)) {
                        $data = $this->CommonModel->checkAadharExistGetData($aadhar_no); // Query the database
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

        //                        ------------------ID CARD COMMON CODE-------------------
    
    

        public function GenerateIdCard($token, $type) { // apply switch or if else for redirection

            $qr = $this->CommonModel->getQrById($token, $type);
            if ($qr['qr_code'] != '') {
    
                $data['qrdata'] = $this->CommonModel->getQrDataById($token, $type);
                if($type == 'contractor_workman'){
                    $data['type'] = 'Contractor Workman';
                } else {
                    $data['type'] = $type;
                }

            } else {
                $this->GenerateQr($token, $type);
    
                $data['qrdata'] = $this->CommonModel->getQrDataById($token, $type);
                
                if($type == 'contractor_workman'){
                    $data['type'] = 'Contractor Workman';
                } else {
                    $data['type'] = $type;
                }    
            }

            switch (true) {
                case in_array($type, ['officer', 'employee', 'contractor', 'contractor_workman', 'mathadi', 'gat', 'tat', 'feg', 'sec']):
                    $this->load->view('operation/opricard', $data);
                    break;

                case in_array($type, ['packed', 'bulk', 'transporter']):
                    $this->load->view('driver/icard', $data);
                    break;

                case in_array($type, ['workman', 'amc']):
                    $this->load->view('project/icard', $data);
                    break;

                case in_array($type, ['visitor']):
                    // print_r($data);die;
                    redirect('GatePass/' . $token.'/'. $data);
                    // $this->load->view('visitor/visitorentrypass', $data);
                    break;
            
                default:
                    redirect('Dashboard');
                    break;
            }

            // $this->load->view('operation/opricard', $data);
        }
    
    
        public function GenerateQr($token_no, $type) {
            if($type == 'officer'){
                $submodule = 'OFC';
            } else if($type == 'employee'){
                $submodule = 'EMP';
            } else if($type == 'contractor'){
                $submodule = 'CON';
            } else if($type == 'contractor_workman'){
                $submodule = 'CONW';
            } else if($type == 'mathadi'){
                $submodule = 'MT';
            } else if($type == 'gat'){
                $submodule = 'GAT';
            } else if($type == 'tat'){
                $submodule = 'TAT';
            } else if($type == 'feg'){
                $submodule = 'FEG';
            } else if($type == 'sec'){
                $submodule = 'SEC';
            } else if($type == 'packed'){
                $submodule = 'PT';
            } else if($type == 'bulk'){
                $submodule = 'BK';
            } else if($type == 'transporter'){
                $submodule = 'TR';
            } else if($type == 'workman'){
                $submodule = 'PW';
            } else if($type == 'amc'){
                $submodule = 'AMC';
            } else if($type == 'visitor'){
                $submodule = 'V';
            }else {
                $submodule = 'OTH';
            }
    
            $finalQr = $submodule . "/IONSK/" . $token_no;
    
            // including files for qrgeneration
            include APPPATH . 'third_party/phpqrcode/qrlib.php';
            // directory generation for qr_codes
            $qr_img_dir = FCPATH . 'uploads/qr_code/';
            if (!file_exists($qr_img_dir)) {
                mkdir($qr_img_dir, 0777, true);
            }
    
            // qr image generation
            $filename = $qr_img_dir . 'qr-' . md5($finalQr) . '.png';
            QRcode::png($finalQr, $filename);
    
            $data['qr_code'] = $finalQr;
            $data['qr_path'] = 'qr-' . md5($finalQr) . '.png';
    
            $qr = $this->CommonModel->generateQr($token_no, $type, $data);
            if ($qr) {
                $this->session->set_flashdata('swal_type', 'success');
                $this->session->set_flashdata('swal_message', 'QR Code generated successfully');
                // redirect("Officer");
            } else {
                $this->session->set_flashdata('swal_type', 'error');
                $this->session->set_flashdata('swal_message', 'Failed to generate QR Code');
                // redirect("Officer");
            }
        }
    
    
    
        //                         --------------- ID CARD COMMON CODE END---------------

        
    }
        ?>