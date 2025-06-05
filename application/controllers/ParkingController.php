<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParkingController extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'form_validation']);
        
        // $this->load->helper(['url', 'notification']);
     
        $this->load->library('phpmailer_lib');
        $this->load->database();
        $this->load->model("ParkingModel");
    }

 


    	public function AddParkingSlots()
	{
		    $count = $this->input->post('slot_count');

    if (is_numeric($count) && $count > 0) {
        $this->ParkingModel->AddParkingSlots($count);
        $this->session->set_flashdata('swal_type', 'success');
        $this->session->set_flashdata('swal_message', "$count parking slots added successfully");
    } else {
        $this->session->set_flashdata('swal_type', 'error');
        $this->session->set_flashdata('swal_message', 'Invalid slot count');
    }

        redirect('ParkingController/GetParking');
		
	}

	   public function GetParking() {
        	$data['slots'] = $this->ParkingModel->Get_All_Slots();
		    $data['slots'] = $this->ParkingModel->get_all_slots();
   			 $data['counts'] = $this->ParkingModel->get_slot_counts();
		// print_r($data);die;
        $this->load->view('gates/parking', $data);
    }

	public function update_slot() {
    $added = $this->ParkingModel->update_slot_data($this->input->post());
  
    $this->session->set_flashdata('swal_type', 'success');
    $this->session->set_flashdata('swal_message', 'Vechile Parked successfully');

    redirect('ParkingController/GetParking');
    
}

public function ParkOut() {
    $parkingslots = $this->input->post('parkingslots');
    $out = $this->ParkingModel->Clearslot($parkingslots);

    $this->session->set_flashdata('swal_type', 'success');
    $this->session->set_flashdata('swal_message', 'Vechile Parked Out successfully');
    redirect('ParkingController/GetParking');
}


public function ParkingList() {
       // Get all filled parking slots (where full_name is not empty)
    $data['filled_vehicles'] = $this->ParkingModel->ParkingList();
    $this->load->view('gates/parkinglsit', $data);
}

}