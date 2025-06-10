<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Register_Form_Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['Theme'] = 'Dashboard/Theme'; 
 
// Routes for Login Page
$route['license'] = 'Main/LicenseKey';
// Login Page Routes Ends
 
// Routes for Login Page
$route['login'] = 'Main/Login';
// Login Page Routes Ends

$route['logout'] = 'Main/Logout';


// Route for loading access blocked page
$route['accessblocked'] = 'Main/AccessBlocked';

// Route for loading access blocked page
$route['nocontent'] = 'Main/NoContent';

//DASHBOARD
$route['Dashboard'] = 'Dashboard/Dashboard';
$route['InfoMore'] = 'Dashboard/InfoMore';
//END DASHBOARD

//++++++++++++++++++++++++++++++++++OPERATION+++++++++++++++++++++++++++++++ 
// $route['OprId/(:num)'] = 'Operation/GenerateIdCard/$1';
$route['OprId/(:num)/(:any)'] = 'Common/GenerateIdCard/$1/$2';


$route['Officer'] = 'Operation/Officer';
$route['EditOfficer/(:num)'] = 'Operation/EditOfficer/$1';
$route['AddOfficer/(:num)'] = 'Operation/AddOfficer/$1';
$route['DropOfficer/(:num)'] = 'Operation/DropOfficer/$1';

$route['Employee'] = 'Operation/Employee';
$route['EditEmployee/(:num)'] = 'Operation/EditEmployee/$1';
$route['AddEmployee/(:num)'] = 'Operation/AddEmployee/$1';
$route['DropEmployee/(:num)'] = 'Operation/DropEmployee/$1';

$route['Contractor'] = 'Operation/Contractor';
$route['EditContractor/(:num)'] = 'Operation/EditContractor/$1';
$route['AddContractor/(:num)'] = 'Operation/AddContractor/$1';
$route['DropContractor/(:num)'] = 'Operation/DropContractor/$1';

$route['ContractorWorkman'] = 'Operation/ContractorWorkman';
$route['EditContractorWorkman/(:num)'] = 'Operation/EditContractorWorkman/$1';
$route['AddContractorWorkman/(:num)'] = 'Operation/AddContractorWorkman/$1';
$route['DropContractorWorkman/(:num)'] = 'Operation/DropContractorWorkman/$1';


$route['Mathadi'] = 'Operation/Mathadi';
$route['EditMathadi/(:num)'] = 'Operation/EditMathadi/$1';
$route['AddMathadi/(:num)'] = 'Operation/AddMathadi/$1';
$route['DropMathadi/(:num)'] = 'Operation/DropMathadi/$1';


$route['Gat'] = 'Operation/Gat';
$route['EditGat/(:num)'] = 'Operation/EditGat/$1';
$route['AddGat/(:num)'] = 'Operation/AddGat/$1';
$route['DropGat/(:num)'] = 'Operation/DropGat/$1';

$route['Tat'] = 'Operation/Tat';
$route['EditTat/(:num)'] = 'Operation/EditTat/$1';
$route['AddTat/(:num)'] = 'Operation/AddTat/$1';
$route['DropTat/(:num)'] = 'Operation/DropTat/$1';

$route['Feg'] = 'Operation/Feg';
$route['EditFeg/(:num)'] = 'Operation/EditFeg/$1';
$route['AddFeg/(:num)'] = 'Operation/AddFeg/$1';
$route['DropFeg/(:num)'] = 'Operation/DropFeg/$1';

$route['Sec'] = 'Operation/Sec';
$route['EditSec/(:num)'] = 'Operation/EditSec/$1';
$route['AddSec/(:num)'] = 'Operation/AddSec/$1';
$route['DropSec/(:num)'] = 'Operation/DropSec/$1';



// $route['OfficerICard'] = 'Operation/OfficerICard';
// $route['EmployeeICard'] = 'Operation/EmployeeICard';
// $route['ContractorICard'] = 'Operation/ContractorICard';
// $route['ContractorWorkmanICard'] = 'Operation/ContractorWorkmanICard';
// $route['GatICard'] = 'Operation/GatICard';
// $route['TatICard'] = 'Operation/TatICard';
// $route['FegICard'] = 'Operation/FegICard';
// $route['SecICard'] = 'Operation/SecICard';
//++++++++++++++++++++END OPERATION++++++++++++++++++++++++++++++++++++ 

//DRIVER
//  $route['DrId/(:num)/(:any)'] = 'Common/GenerateIdCard/$1/$2';

$route['Packed'] = 'Driver/Packed';
$route['EditPacked/(:num)'] = 'Driver/EditPacked/$1'; 
$route['AddPacked/(:num)'] = 'Driver/AddPacked/$1';
$route['DropPacked/(:num)'] = 'Driver/DropPacked/$1';

$route['Bulk'] = 'Driver/Bulk';
$route['EditBulk/(:num)']= 'Driver/EditBulk/$1';
$route['AddBulk/(:num)'] = 'Driver/AddBulk/$1';
$route['DropBulk/(:num)'] = 'Driver/DropBulk/$1';


$route['Transporter'] = 'Driver/Transporter';
$route['EditTransporter/(:num)']= 'Driver/EditTransporter/$1';
$route['AddTransporter/(:num)'] = 'Driver/AddTransporter/$1';
$route['DropTransporter/(:num)'] = 'Driver/DropTransporter/$1';


// $route['Packed'] = 'Driver/Packed';
// $route['Bulk'] = 'Driver/Bulk';
// $route['Transporter'] = 'Driver/Transporter';
// $route['AddPacked'] = 'Driver/AddPacked';
// $route['AddBulk'] = 'Driver/AddBulk';
// $route['AddTransporter'] = 'Driver/AddTransporter';
// $route['EditPacked'] = 'Driver/EditPacked';
// $route['EditBulk'] = 'Driver/EditBulk';
// $route['EditTransporter'] = 'Driver/EditTransporter';
// $route['PackedIdCard'] = 'Driver/PackedIdCard';
// $route['BulkIdCard'] = 'Driver/BulkIdCard';
// $route['TransporterIdCard'] = 'Driver/TransporterIdCard';

//END DRIVER


//PROJECT
// $route['PrId/(:num)/(:any)'] = 'Common/GenerateIdCard/$1/$2';

$route['Workman'] = 'Project/Workman';
$route['EditWorkman/(:num)'] = 'Project/EditWorkman/$1'; 
$route['AddWorkman/(:num)'] = 'Project/AddWorkman/$1';
$route['DropWorkman/(:num)'] = 'Project/DropWorkman/$1';

$route['Amc'] = 'Project/Amc';
$route['EditAmc/(:num)']= 'Project/EditAmc/$1';
$route['AddAmc/(:num)'] = 'Project/AddAmc/$1';
$route['DropAmc/(:num)'] = 'Project/DropAmc/$1';



// $route['Workman'] = 'Project/Workman';
// $route['AddWorkman'] = 'Project/AddWorkman';
// $route['EditWorkman'] = 'Project/EditWorkman';
// $route['Amc'] = 'Project/Amc';
// $route['AddAmc'] = 'Project/AddAmc';
// $route['EditAmc'] = 'Project/EditAmc';
// $route['WorkmanIdCard'] = 'Project/WorkmanIdCard';
// $route['AmcIdCard'] = 'Project/AmcIdCard';

//END PROJECT

 
//VISITOR
$route['Visitor'] = 'Visitor/Visitor';
$route['AddVisitor/(:num)'] = 'Visitor/AddVisitor/$1';
$route['EditVisitor/(:num)'] = 'Visitor/EditVisitor/$1';
$route['DropVisitor/(:num)'] = 'Visitor/DropVisitor/$1';

$route['passsearch'] = 'Visitor/searchpass';
$route['GatePass/(:num)/(:any)'] = 'Visitor/generatepass/$1/$2';

//END VISITOR



//REPORT
$route['AdvancedReport'] = 'Report/AdvancedReport';
// route for night report
$route['NightReport'] = 'Report/NightReport';
$route['parkingreport'] = 'Report/Parkingreportform';
// $route['NightReport/(:any)'] = 'Report/NightReport/$1';
$route['WorkingHours'] = 'Report/WorkingHoursReport';
//END REPORT

$route['Parking'] = 'ParkingController/GetParking';

//SETTINGS

$route['Settings'] = 'Setting/Settings';
//END SETTINGS

//DRIVERMAINGATE
$route['maingate'] = 'MainGate/MainGate';
//END DRIVERMAINGATE

//LICENSEGATE
$route['licensegate'] = 'LicenseGate/Licensegate';
//END LICENSEGATE

//DRIVERGATE
$route['drivergate'] = 'DriverGate/DriverGate';
//END DRIVERGATE


// $route['drivergate'] = 'DriverGate/DriverGate';



// ROUTE of DRIVERMAINGATE
$route['truckmaingate'] = 'DriverMainGate/index';
// ROUTE FOR DRIVER LICENSE GATE
// C:\Xamp\htdocs\hpcl_inout_org\application\views\gates\trucklicensegate.php
// ROUTE of DRIVERMAINGATE
$route['trucklicensegate'] = 'DriverLicenseGate/DriverLicensegate';
// ROUTE FOR DRIVER LICENSE GATE



//DRIVERLICENSEGATE

//END DRIVERLICENSEGATE


//ASSEMBLYGATE
//END ASSEMBLYGATE


