<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("MainModel");
		$this->MainModel->createAdminAccount();
	}



	// public function index()
	// {
	// 	$this->load->view('Landing/Login');
	// }

	// function to load login page
	public function Login()
	{
		$licence = $this->ValidateLicenseKey();

		if(!empty($licence)){

			$username = $this->session->userdata('username');
			$role = $this->session->userdata('role');

			if (!empty($username) && !empty($role)) {
				redirect('Dashboard');
			} else {
				$this->load->view('Landing/Login');
			}
		} else {
			redirect('license');
		}
	}	// function ends

	// function to load license key page
	public function LicenseKey()
	{
		$licence = $this->ValidateLicenseKey();

		if(empty($licence)){

			$this->load->view("Landing/LicenseKey");
		} else {
			redirect('login');
		}
	}	// function ends

	public function ValidateLicenseKey()
	{
		$data = $this->MainModel->validateLicenseKey();

		if (!empty($data)) {
			return $data;
		} else {
			return NULL ;
		}
	}	// function ends

	// function to validate license key
	public function ValidateLicenceKeyPost()
	{

		$plantname = $this->input->post('plantname');

		$licensekey = file_get_contents($_FILES['licensekey']['tmp_name']);

		$data = $this->MainModel->validateLicenseKeyPost($plantname, $licensekey);

		if ($data) {

			redirect('login'); // redirect to login page
		} else {
			// handle invalid login
			$this->session->set_flashdata('error', 'Invalid license key. Please verify your license key and try again.');
			$this->load->view("Landing/LicenseKey");
		}
	}	// function ends

	// function for login validation
	public function LoginValidationPost()
	{
		// validate server request
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			redirect("accessblocked");
			return;
		}

		$username = $this->input->post('username');
		$password = $this->MainModel->encryptData($this->input->post('password'));

		$data = $this->MainModel->loginValidationPost($username, $password);

		if (isset($data['error'])) {
			// handle error
			$this->session->set_flashdata('error', $data['error']);
			redirect('login');
		} elseif ($data) {
			// set session data
			$this->session->set_userdata('id', $data['id']);
			$this->session->set_userdata('username', $data['username']);
			$this->session->set_userdata('role', $data['access']);
			$this->session->set_userdata('accessId', $data['access_id']);

			$this->session->set_userdata('logged_in', TRUE);

			redirect('Dashboard'); // redirect to dashboard or any other page
		} else {
			// handle invalid login
			$this->session->set_flashdata('error', 'Invalid login credentials. Please verify your username and password and try again.');
			redirect('login');
		}
	}	// function ends

	//functon to logout
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('login'); 
	}	// function ends

	// function to load access blocked page
	function AccessBlocked()
	{
		$this->load->view("Landing/AccessForbitten");
	}	// function ends	

	// function to load access blocked page
	function NoContent()
	{
		$this->load->view("Landing/NotFound");
	}	// function ends	


	// // function for login validation
	// public function LoginValidationPost() {
	// 	// validate server request
	// 	if ($_SERVER['REQUEST_METHOD'] != "POST") {
	// 		redirect("accessblocked");
	// 		return;
	// 	}

	// 	// check content
	// 	$formdata = $this->input->post();
	// 	if(empty($formdata)){
	// 		redirect("nocontent");
	// 		return;
	// 	}

	// 	// code from here


	// }	// function ends

}
