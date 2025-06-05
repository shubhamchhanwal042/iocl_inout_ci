<?php
defined("BASEPATH") or exit("No direct script access allowed");

class MainModel extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->database();  
 
    }

    // functions for encryption and decryptions
    
    // function to encrypt data
    function encryptData($data)
    {
        $iv = substr(hash('sha256', $data, true), 0, 16);
        $key = hash('sha256', $iv, true);
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($iv . $encryptedData);
    }   // functione ends

    // function to decrypt data
    function decryptData($encryptedData)
    {
        $decodedData = base64_decode($encryptedData);
        $iv = substr($decodedData, 0, 16);
        $encryptedData = substr($decodedData, 16);
        $key = hash('sha256', $iv, true);
        $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
        return $decryptedData;
    }   // function ends

    //auto create admin account
    public function createAdminAccount(){
        $this->db->select('*');
        $this->db->from('login');
        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            $password = $this->encryptData('admin');
            $data = array(
                'username' => 'admin',
                'password' => $password,
                'access' => 'admin',
                'status' => '1'
            );
            $this->db->insert('login', $data);
        }
    }


    public function loginValidationPost($username, $password){
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('username', $username);
        $this->db->where('status !=', '0');
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->row_array();
            // echo $password;
            // echo $username;
            // print_r($user);die;
            // Decrypt the stored password and compare with input
            if ($user['username'] === $username && $password == $user['password']) {
                return $user;
            } elseif ($user['username'] !== $username) {
                return array('error' => 'The username you entered is incorrect. Please verify your credentials and try again.');
            } else {
                return array('error' => 'The password you entered is incorrect. Please verify your credentials and try again.');
            }
        } else {
            return false; // Username not found
        }
    }
    public function validateLicenseKeyPost($plantname, $licensekey){
       
        $this->db->where('plantname', $plantname);
        $this->db->where('licensekey', $licensekey);
        $this->db->set('activestatus', '1');
        $query = $this->db->update('licnse');

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function validateLicenseKey(){
        $this->db->select('*');
        $this->db->from('licnse');
        $this->db->where('activestatus !=', '0');
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


}