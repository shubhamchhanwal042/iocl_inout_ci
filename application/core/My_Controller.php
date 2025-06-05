<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class My_Controller extends CI_Controller {
    // public function __construct() {
    //     parent::__construct();
    //     $this->load->model('CommonModel');
    //     $this->load->helper('notification_helper');
    //     $this->load->library('session');
        
    //     $this->loadGlobalData();
    // }




    public function __construct() {
        parent::__construct();

        // Load commonly used libraries
        $this->load->library(['session', 'form_validation', 'upload', 'phpmailer_lib']);

        // Load commonly used helpers
        $this->load->helper(['url', 'notification']);

        // Load database connection
        $this->load->database();

        // Load commonly used models
        $this->load->model("CommonModel");

        // Dynamically load required models based on controller
        $controller = $this->router->fetch_class(); // Get current controller name

        $models = [
            'Dashboard' => ['DashboardModel'],
            'Operation' => ['OperationModel'],
            'Project'   => ['ProjectModel'],
            'Driver'    => ['DriverModel'],
            'Main'      => ['MainModel'],
            'Visitor'   => ['VisitorModel'],
            'Report'    => ['ReportModel'],
            'Setting'   => ['SettingModel']
        ];

        if (isset($models[$controller])) {
            foreach ($models[$controller] as $model) {
                $this->load->model($model);
            }
        }


        // Initialize upload library
        $config['upload_path'] = 'library_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->upload->initialize($config);

        $this->loadGlobalData();

    }





    private function loadGlobalData() {
        $this->data['notifications'] = [];

        if ($this->session->userdata('role') == 'officer') {
            $officer_id = $this->session->userdata('accessId');
            if ($officer_id) {
                $this->data['notifications'] = get_officer_notifications($officer_id);
            }
        }
    }
}
?>