<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    // private $table; // Declare class property




    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'notification')); // Load URL and notification helper

        $this->load->model('ReportModel');
    }


    public function AdvancedReport()
    {
        $this->load->view('Report/advancedreport');
    }


    // function for advanced report post
    function AdvanceReportPost()
    {
        date_default_timezone_set('Asia/Kolkata');
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            return;
        }

        $formdata = $this->input->post();
        $reportData = array(
            'report_gen_time' => date('Y-m-d H:i:s'),
            'from_date' => $formdata['fromdate'],
            'to_date' => $formdata['todate'],
            'department' => $formdata['department'],
            'sub_department' => $formdata['sub_department'],
            'name' => $formdata['name'],
            'gate' => $formdata['gate']
        );
        // truncate existing reports
        $truncateStatus = $this->ReportModel->TruncateReport();
        // print_r($truncateStatus);die;
        if ($truncateStatus) {
            // insert new report
            $insertStatus = $this->ReportModel->newReportPost($reportData);
        }

        if ($insertStatus) {

            // Load the MainModel
            $this->load->model("MainModel");

            // Encrypt data
            $formdata['name'] = $this->MainModel->encryptData($formdata['name']);
            $formdata['id'] = isset($insertStatus['report_id']) ? $this->MainModel->encryptData($insertStatus['report_id']) : '';
            $formdata['gate'] = isset($reportData['gate']) ? $this->MainModel->encryptData($reportData['gate']) : '';

            // print_r($reportData['gate']);die;
            // Build query string
            $query_string = http_build_query($formdata);


            // Redirect to the generated report
            redirect('Report/generatedAdvancedReport?' . $query_string);
        }
    }    // function ends

    // function to display generated report
    public function generatedAdvancedReport()
    {
        $formdata = $this->input->get();
        // Load MainModel
        $this->load->model("MainModel");

        // Decrypt data`
        $formdata['name'] = $this->MainModel->decryptData($formdata['name']);
        $formdata['id'] = $this->MainModel->decryptData($formdata['id']);
        $formdata['gate'] = $this->MainModel->decryptData($formdata['gate']);

        $data['reportdata'] = $this->ReportModel->generatedAdvancedReport($formdata);
        $data['urldata'] = $formdata;
        $this->load->view("Report/GeneratedRepo", $data);
    }    // function ends



    // function to load night report
    public function NightReport()
    {
        $inputdata = $this->input->get(); // Fetch GET parameters

        if (empty($inputdata)) {
            $this->load->view("Report/NightReport");
        } else {
            $reportdata = $this->ReportModel->getSqlQuery($inputdata);
            $dataFromSql = $this->ReportModel->getDataFromSql($reportdata);
            if (!empty($dataFromSql['data']) && is_array($dataFromSql['data'])) {
                // $report_id = $data['data']['report_id'];
                $report_id = isset($dataFromSql['report_id']) ? $dataFromSql['report_id'] : null;

                foreach ($dataFromSql['data'] as $entry) {

                    $formdata = [
                        'report_id'      => $report_id,
                        'name'           => $entry['name'] ?? '',
                        'department'     => $entry['department'] ?? '',
                        'sub_department' => $entry['section'] ?? '',
                        'time_in'        => $entry['intime'] ?? '',
                        'time_out'       => $entry['outtime'] ?? '',
                        'check_in_dt'    => $entry['date'] ?? null,
                        'check_out_dt'   => $entry['date'] ?? null,
                        'gate'           => $reportdata['table_name'] ?? '', // Ensure correct key
                    ];

                    // print_r($formdata);die;
                    $reportBulkData = $this->ReportModel->insertReportData($formdata);
                }
                $reportdatapudhepathavaysathi['data1'] = $dataFromSql;
                // $mergeddata = array_merge($reportdatapudhepathavaysathi, $this->data); // Merge global notifications


                if (!empty($dataFromSql['data'])) {
                    // data found
                    $this->session->set_flashdata("Success", "Data Found!");
                    $this->load->view("Report/NightReport", $reportdatapudhepathavaysathi);
                } else {
                    // data not found
                    $this->session->set_flashdata("Error", "Data Unavailable!");
                    redirect("Report/NightReport");
                }
            } else {
                // data not found
                $this->session->set_flashdata("Error", "Data Unavailable!");
                redirect("Report/NightReport");
            }
        }
    }

    public function generate()
    {
        $data = $this->input->get();

        if ($data) {
            $fromdate = $data['fromdate'];
            $todate = $data['todate'];
            $fromtime = $data['fromtime'];
            $totime = $data['totime'];

            $data = [
                'from_date' => $fromdate,
                'to_date' => $todate,
                'department' => 'all',
                'sub_department' => 'all',
                'name' => 'all',
                'gate' => 'all',
                'report_gen_time' => date('Y-m-d H:i:s')
            ];

            $reportdata = $this->ReportModel->get_all_reportdata();
            if (!empty($reportdata)) {
                if ($this->ReportModel->truncate_report_table()) {
                    echo "Truncated";
                } else {
                    echo "Error truncating";
                    return;
                }
            }

            $insert_id = $this->ReportModel->insert_report_data($data);

            if ($insert_id) {
                $latest_report = $this->ReportModel->get_latest_report_id();
                // print_r($latest_report);die;

                if ($latest_report) {
                    $id = $latest_report['report_id'];

                    $query_params = http_build_query([
                        'id' => $id,
                        'dept' => $data['department'],
                        'sub_dept' => $data['sub_department'],
                        'gate' => $data['gate'],
                        'nm' => $data['name'],
                        'ft' => $fromtime,
                        'tt' => $totime,
                        'fd' => $fromdate,
                        'td' => $todate
                    ]);

                    redirect("Report/NightReport?$query_params");
                } else {
                    echo "Error fetching report ID.";
                }
            } else {
                echo "Error inserting report data.";
            }
        }
    }


    public function getReport()
    {
        $params = $this->input->get();
        $sqlData = $this->ReportModel->getSqlQuery($params);
        $reportData = $this->ReportModel->getDataFromSql($sqlData);

        $data = array_merge(['data' => $reportData], $this->data); // Merge global notifications

        if ($reportData) {
            $this->load->view('Report/NightReport', $data);
        } else {
            echo "No data found";
        }
    }














    public function insert_data()
    {
        $data = [
            'report_id'      => $this->input->post('report_id'),
            'name'           => $this->input->post('name'),
            'department'     => $this->input->post('department'),
            'sub_department' => $this->input->post('sub_department'),
            'time_in'        => $this->input->post('time_in'),
            'time_out'       => $this->input->post('time_out'),
            'check_in_dt'    => $this->input->post('check_in_dt'),
            'check_out_dt'   => $this->input->post('check_out_dt'),
            'gate_name'      => $this->input->post('gate_name')
        ];

        if ($this->ReportModel->insertReportData($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
        }
    }

    public function getNames()
    {
        $sub_department = $this->input->get('sub_department');
        

        if (!empty($sub_department)) {
            $data = $this->ReportModel->getNamesBySubDepartment($sub_department);
        }

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
        }


    // -------------------------------------PARKING SECTION REPORT ---------------------------------

function Parkingreportform(){

    $this->load->view('Report/parkingreport');
}

    function Parkingreport(){

        $formdata = $this->input->post();

       $data['fromdate'] =  $formdata['fromdate'];
       $data['todate'] = $formdata['todate'];
        $data['reportdata'] = $this->ReportModel->Parkingreport($formdata);
        // print_r($data);die;
        $this->load->view("Report/Generatedparkingreport", $data);
    }

    // -------------------------------------ENDS HERE----------------------------------------------
}
