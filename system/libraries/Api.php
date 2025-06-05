<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CI_Api
{

    // variable to store API base url
    private $api_url;
    private $controllerurl;
    // private $encryptdata;

    // constructor
    public function __construct()
    {
        $CI = &get_instance();
        $this->api_url = $CI->config->item('api_url');
        // Load the custom encryptdata library
        // $CI->load->library('encryptdata');
        // $this->encryptdata = $CI->encryptdata; // 
    }   // constructor ends

    //////////////////////////////////////////////          Getting data : Get method
    /**
     * Function to fetch data from API and return it as JSON.
     *
     * @param string $endpoint The endpoint to append to the base API URL.
     * @return array The response data in an associative array, or an empty array on failure.
     */
    public function getDataInJson($endpoint)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) {
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        // Check for success in the API response
        if (isset($response_data['status']) && $response_data['status'] === 'success') {
            return $response_data['data'] ? $response_data['data'] : [];
        }

        // Log API-level errors
        $error_message = $response_data['message'] ?? 'Unknown API Error';
        log_message('error', "API Error: $error_message");
        return [];
    }   // function ends

    /**
     * Function to fetch data from API by ID and return it as JSON.
     *
     * @param string $endpoint The endpoint to append to the base API URL.
     * @param array|string $param The parameters to include in the query string.
     * @return array The response data in an associative array, or an empty array on failure.
     */
    public function getDataInJsonById($endpoint, $param)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // If parameters are provided, append them to the URL as a query string
        if (!empty($param)) {
            $query_string = is_array($param) ? http_build_query($param) : $param;
            $url .= '?' . $query_string;
        }

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) {
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        // Check for success in the API response
        if (isset($response_data['status']) && $response_data['status'] === 'success') {
            return $response_data['data'] ?? [];
        }

        // Log API-level errors
        $error_message = $response_data['message'] ?? 'Unknown API Error';
        log_message('error', "API Error: $error_message");
        return [];
    }   // function ends

    /**
     * Function to fetch data from API by sending multiple parameters.
     *
     * @param string $endpoint The endpoint to append to the base API URL.
     * @param array $params The parameters to include in the query string.
     * @return array The response data in an associative array, or an empty array on failure.
     */
    public function getDataInJsonByParams($endpoint, array $params = [])
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // If parameters are provided, append them as a query string
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) {
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        // Check for success in the API response
        if (isset($response_data['status']) && $response_data['status'] === 'success') {
            return $response_data['data'] ?? [];
        }

        // Log API-level errors
        $error_message = $response_data['message'] ?? 'Unknown API Error';
        log_message('error', "API Error: $error_message");
        return [];
    }   // function ends

    /**
     * Function to fetch data from API by sending multiple parameters.
     *
     * @param string $endpoint The endpoint to append to the base API URL.
     * @param array $params The parameters to include in the query string.
     * @return array The response data in an associative array, or an empty array on failure.
     */
    public function getDataInJsonByParamsPost($endpoint, array $data = [])
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // Initialize cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send data as JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        // Execute cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return ['status' => 'error', 'message' => 'Failed to connect to API.'];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Handle JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return ['status' => 'error', 'message' => 'Invalid JSON response from API.'];
        }

        // Handle non-200 HTTP status codes
        // if ($http_code !== 200) {
        //     log_message('error', "HTTP Error: $http_code for URL: $url");
        //     return ['status' => 'error', 'message' => "API responded with HTTP code $http_code.", 'response' => $response_data];
        // }

        if ($response_data != null) {
            return $response_data;
        } else {
            $error_message = $response_data['message'] ?? 'Unknown API Error';
            log_message('error', "API Error: $error_message");
        }

        // Log API-level errors
        $error_message = $response_data['message'] ?? 'Unknown API Error';
        log_message('error', "API Error: $error_message");

        return ['status' => 'error', 'message' => $error_message];
    }

    // function ends

    ////////////////////////////////////////////////        For Updating 

    /**
     * Function to update data by ID using an API endpoint.
     *
     * @param string $endpoint The endpoint to append to the base API URL.
     * @param int|string $id The ID of the record to update.
     * @param array $data The data to update in key-value format.
     * @return array The API response, or an empty array on failure.
     */
    public function updateDataById($endpoint, $id, array $data)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/') . '/' . $id;

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
            CURLOPT_CUSTOMREQUEST  => 'PUT', // HTTP PUT request
            CURLOPT_POSTFIELDS     => json_encode($data), // Send JSON data
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json', // Indicate JSON payload
                'Accept: application/json',      // Accept JSON response
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) {
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        return $response_data;
    }   // function ends
    /**
     * Function to update a record using multiple data conditions.
     *
     * @param string $endpoint The API endpoint.
     * @param array $conditions The conditions for identifying the record(s) to update.
     * @param array $data The data to update in key-value format.
     * @return array The API response, or an empty array on failure.
     */
    public function updateRecordWithConditions($endpoint, array $conditions, array $data)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // Merge conditions and data into a single payload if required by the API
        $payload = [
            'conditions' => $conditions,
            'data'       => $data,
        ];

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
            CURLOPT_CUSTOMREQUEST  => 'PUT', // HTTP PUT request
            CURLOPT_POSTFIELDS     => json_encode($payload), // Send JSON data
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json', // Indicate JSON payload
                'Accept: application/json',      // Accept JSON response
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) {
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        return $response_data;
    }   // function ends

    ///////////////////////////////////////////////     Inserting data
    /**
     * Function to insert data using an API endpoint.
     *
     * @param string $endpoint The API endpoint to insert data.
     * @param array $data The data to insert in key-value format.
     * @return array The API response, or an empty array on failure.
     */
    public function insertData($endpoint, array $data, $file = null)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // Initialize cURL
        $ch = curl_init();

        // Handle file upload if provided
        if ($file != null && isset($file['tmp_name']) && file_exists($file['tmp_name'])) {
            $data['document'] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
        } elseif ($file != null) {
            throw new Exception("Invalid file input: file path is empty or does not exist.");
        }

        // return json_encode($data);die;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute the cURL request
        $response = curl_exec($ch);

        // return json_decode($response, true);

        // Check HTTP status code
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Decode JSON response
        $response_data = json_decode($response, true);
        $response_data['http_code'] = $http_code;

        // Return the response data
        return $response_data;
    } // Function ends


    /**
     * Function to delete a record by its ID.
     *
     * @param string $endpoint The API endpoint for deletion.
     * @param int|string $id The ID of the record to delete.
     * @return array The API response, or an empty array on failure.
     */
    public function deleteById($endpoint, $id)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/') . '/' . $id;

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
            CURLOPT_CUSTOMREQUEST  => 'DELETE', // HTTP DELETE request
            CURLOPT_HTTPHEADER     => [
                'Accept: application/json', // Accept JSON response
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) { // 200 OK or similar status code for successful deletion
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        return $response_data;
    }   // function ends

    /**
     * Function to delete records by multiple data parameters.
     *
     * @param string $endpoint The API endpoint for deletion.
     * @param array $params An associative array of key-value pairs representing the data parameters.
     * @return array The API response, or an empty array on failure.
     */
    public function deleteByMultipleData($endpoint, array $params)
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // Convert parameters to a query string format
        $query_string = http_build_query($params);
        $url = $query_string ? $url . '?' . $query_string : $url;

        // Initialize cURL
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
            CURLOPT_CUSTOMREQUEST  => 'DELETE', // HTTP DELETE request
            CURLOPT_HTTPHEADER     => [
                'Accept: application/json', // Accept JSON response
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return [];
        }

        // Handle non-200 HTTP status codes
        if ($http_code !== 200) { // 200 OK or similar status code for successful deletion
            log_message('error', "HTTP Error: $http_code for URL: $url");
            return [];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return [];
        }

        return $response_data;
    }   // function ends

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // ------------------------------------------------------------------------------------------------------------------------------------------------
    //          functions to post data in json format
    //          

    //      function to send json data by post request
    public function requestForPost($endpoint, array $params = [])
    {
        // Ensure the endpoint is appended to the API base URL
        $url = rtrim($this->api_url, '/') . '/' . ltrim($endpoint, '/');

        // Initialize cURL
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Skip SSL verification for localhost or testing
            CURLOPT_TIMEOUT        => 10,   // Timeout after 10 seconds
            CURLOPT_POST           => true, // Use POST method
            CURLOPT_POSTFIELDS     => json_encode($params), // Send data as JSON
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        // Handle cURL errors
        if ($response === false) {
            log_message('error', "cURL Error: $curl_error");
            return ['status' => 'error', 'message' => 'Failed to connect to API.'];
        }

        // Decode JSON response
        $response_data = json_decode($response, true);

        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', "JSON Decode Error: " . json_last_error_msg());
            return ['status' => 'error', 'message' => 'Invalid JSON response from API.'];
        }

        // Return API response as is (without checking HTTP status code)
        return $response_data;
    }
}
