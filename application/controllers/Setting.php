<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url', 'notification')); // Load URL and notification helper

		$this->load->model("MainModel");
		$this->load->model("CommonModel");

		$this->load->model("SettingModel");
		
	}

	public function Settings(){
		$data['users'] = $this->SettingModel->GetAllUsers();
		$data['officer'] = $this->SettingModel->GetAllOfficers();
		$data['security'] = $this->SettingModel->GetAllSecurity();
		// $data = array_merge($data, $this->data); // Merge global notifications

		$this->load->view('settings/settings', $data);
	}

	public function UpdatePassword()
	{
		$id = $this->input->post('id');
		$oldPassword = $this->MainModel->encryptData($this->input->post('oldpassword'));
		$newPassword = $this->MainModel->encryptData($this->input->post('newpassword'));

		$data = $this->SettingModel->UpdatePassword($id, $oldPassword, $newPassword);
		if($data == 1){
			$this->session->set_flashdata('success', 'Your password has been updated successfully.');
			redirect('Settings');
		} else {
			$this->session->set_flashdata('error', 'The old password you entered is incorrect. Please try again.');
			redirect('Settings');
		}
	}

	public function ResetDashboardCountKey()
	{
		$key = $this->MainModel->encryptData($this->input->post('passwordkey'));

		$data = $this->SettingModel->ResetDashboardCountKey($key);
		if($data == 1){
			$this->session->set_flashdata('success', 'The dashboard count key has been reset successfully.');
		} else {
			$this->session->set_flashdata('error', 'An error occurred while resetting the dashboard count key. Please try again.');
		}
		redirect('Settings');
	}

	public function AddUserPost(){
		$formdata = $this->input->post();
// print_r($formdata);die;
		list($id, $name) = explode('-', $formdata['access_id']);
		$formdata['access_id'] = $id;
		// $formdata['access_name'] = $name;
		$formdata['password'] = $this->MainModel->encryptData($formdata['password']);
// 
		$data = $this->SettingModel->AddUserPost($formdata);
		if($data == 1){
			$this->session->set_flashdata('success', 'User has been added successfully.');
		} else {
			$this->session->set_flashdata('error', 'An error occurred while adding the user. Please try again.');
		}
		redirect('Settings');
	}

	public function DeleteUser($id){
		$data = $this->SettingModel->DeleteUser($id);
		if($data == 1){
			$response = array('status' => 'success', 'message' => 'User has been deleted successfully.');
		} else {
			$response = array('status' => 'error', 'message' => 'An error occurred while deleting the user. Please try again.');
		}
		echo json_encode($response);
	}

}
