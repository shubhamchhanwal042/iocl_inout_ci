<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {

    public function index() {
        $this->load->view('face_scan_view');
    }

    public function log_entry() {
        $name = $this->input->post('name');
        $this->load->model('Entry_model');
        $this->Entry_model->add_entry($name);
        echo json_encode(['status' => 'success']);
    }
}
