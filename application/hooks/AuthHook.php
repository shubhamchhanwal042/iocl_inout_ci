<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthHook
{
    public function validate_session()
    {
        $CI = &get_instance();

        // Fetch current controller and method
        $current_route = $CI->router->fetch_class();
        $current_method = $CI->router->fetch_method();

        // Public routes and controllers that don't require login
        $public_routes = array('login', 'license', 'accessblocked', 'nocontent');
        $public_controllers = array('Main', 'MainGate', 'LicenseGate', 'DriverMainGate', 'DriverLicenseGate', 'DriverGate'); // Add your public controllers here

        // Skip session validation for public routes and controllers
        if (!in_array($current_route, $public_routes) && !in_array($current_route, $public_controllers)) {
            if (!$CI->session->userdata('logged_in')) {
                redirect('login');
            }
        }
    }
}
