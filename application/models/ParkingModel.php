<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ParkingModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
        
    }   
  
public function AddParkingSlots($count) {
    // Get the current max value of 'parkingslots'
    $last_slot = $this->db->select_max('parkingslots')->get('parking')->row()->parkingslots ?? 0;


    for ($i = 1; $i <= $count; $i++) {
        $data = [
            'parkingslots'   => $last_slot + $i,
            'full_name'      => '',
            'aadhar_no'      => '',
            'vechile_type'   => '',
            'vechile_number' => '',
            'parking_date'   => '',
        ];
        $this->db->insert('parking', $data);
    }
}
       public function Get_All_Slots() {
        $query = $this->db->order_by('parkingslots', 'ASC')->get('parking');
        return $query->result();
    }

    public function update_slot_data($data) {
    $this->db->where('id', $data['id']);
        date_default_timezone_set('Asia/Kolkata');

    $current_time = date('Y-m-d H:i:s');
    $this->db->update('parking', [
        'full_name'      => $data['full_name'],
        'aadhar_no'      => $data['aadhar_no'],
        'vechile_type'   => $data['vechile_type'],
        'vechile_number' => $data['vechile_number'],
        'parking_date'   => $data['parking_date'],
        'time_in'        => $current_time

    ]);

     $slot = $this->db->get_where('parking', ['id' => $data['id']])->row();

    // Then, insert a record into parking_data table (like a log)
    $this->db->insert('parking_data', [
        'parkingslots'   => $slot->parkingslots,
        'full_name'      => $data['full_name'],
        'aadhar_no'      => $data['aadhar_no'],
        'vechile_type'   => $data['vechile_type'],
        'vechile_number' => $data['vechile_number'],
        'parking_date'   => $data['parking_date'],
        'time_in'        => $current_time
    ]);
    }


    public function Clearslot($parkingslots) {
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d H:i:s');
    $this->db->where('parkingslots', $parkingslots)->update('parking', [
        'full_name' => '',
        'aadhar_no' => '',
        'vechile_type' => '',
        'vechile_number' => '',
        'parking_date' => '',
        'time_in' => '',
    ]);

     $this->db->where('parkingslots', $parkingslots)->update('parking_data', [
        'out_time' => $current_time ,
        'parking_status' => '0'
    ]);
   }


   public function get_slot_counts() {
    $filled = $this->db->where("full_name != ''")->count_all_results('parking');

    // Count empty slots (where full_name is empty)
    $empty = $this->db->where("full_name", '')->count_all_results('parking');

    return [
        'filled' => $filled,
        'empty'  => $empty,
        'total'  => $filled + $empty
    ];
}

public function ParkingList() {
    return $this->db
        ->where("full_name != ''")
        ->order_by('parkingslots', 'ASC')
        ->get('parking')
        ->result();
        
}
}