<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function get_officer_notifications() {
    $CI = &get_instance(); // Get CI instance
    $CI->load->database(); // Load database
    $CI->load->library('session'); // Load session
    $CI->load->model('DashboardModel'); // Load the Dashboard model
    $officer_id = $CI->session->userdata('accessId');


    if (!$officer_id) {
        return [];
    }
    // Fetch today's notifications for the logged-in officer
    $CI->db->select('id, to_see_whom, purpose_to_visit, officer_id, visitor_id, access, status');
    $CI->db->where('officer_id', $officer_id);
    $CI->db->where('date', date('Y-m-d')); // Fetch only today's visits
    $CI->db->where('status', 0); // Fetch only unread notifications
    $query = $CI->db->get('notification');

    $notifications = $query->result();
    // Fetch visitor names for each notification
    foreach ($notifications as $not) {
        $not->full_name = $CI->DashboardModel->getVisitorName($not->visitor_id);
    }
    return $notifications;
}

function get_officer_notifications_count() {
    $CI = &get_instance();
    $CI->load->database();
    $CI->load->library('session');
    $officer_id = $CI->session->userdata('accessId');

    if (!$officer_id) {
        return 0;
    }
    $CI->db->where('officer_id', $officer_id);
    $CI->db->where('date', date('Y-m-d'));
    $CI->db->where('status', 0);
    return $CI->db->count_all_results('notification');
}

function getRemainingLicenseDays() {
    $CI = &get_instance(); // Get CI instance
    $CI->load->database(); // Load database
    $CI->load->library('session'); // Load session

    // Fetch license expiry date from the database
    $CI->db->select('expirydt');
    $CI->db->from('licnse'); // Assuming the expiry date is stored in a 'settings' table
    $query = $CI->db->get();
    $result = $query->row();

    if (!$result) {
        return null; // Return null if no expiry date is found
    }

    $today = date('Y-m-d');
    $expiry_date = date('Y-m-d', strtotime($result->expirydt));
    $diff = strtotime($expiry_date) - strtotime($today);
    return floor($diff / (60 * 60 * 24));
}

?>

