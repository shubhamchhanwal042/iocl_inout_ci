<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CI_Qr
{

    // variable to store API base url
    private $api_url;
    private $controllerurl;
    private $encryptdata;

    // constructor
    public function __construct()
    {
        $CI = &get_instance();
        $this->api_url = $CI->config->item('api_url');
        // Load the custom encryptdata library
        $CI->load->library('encryptdata');
        $this->encryptdata = $CI->encryptdata; // 
    }   // constructor ends

    
}
