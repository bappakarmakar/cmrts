<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// CMRTS Update Profile Register Route
$route['user_creation/Register'] = 'register';
// Incident Form Route
$route['reporting/incident/incident_form'] = 'reporting/incident/incident_form';
// Incident Form Edit Route
$route['reporting/incident/incident_form/edit/(:any)'] = 'reporting/incident/incident_form/incident_form_edit/$1';
// Address Change Route
$route['reporting/incident/incident_list/address_change/(:any)'] = 'reporting/address_change/address_change_form/index/$1';
// Home Visit Minor Form Route
// $route['reporting/incident/incident_list/home_visit_minor_form/(:any)'] = 'reporting/home_visit/home_visit_minor_form/index/$1';

$route['reporting/incident/incident_list/home_visit_minor_form/(:any)/(:any)/(:any)'] = 'reporting/home_visit/home_visit_minor_form/index/$1/$2/$3';
// Home Visit Adult Form Route
$route['reporting/incident/incident_list/home_visit_adult_form/(:any)/(:any)/(:any)'] = 'reporting/home_visit/home_visit_adult_form/index/$1/$2/$3';
// Home Visit Minor Form Edit Route
$route['reporting/home_visit/home_visit_minor_form/edit/(:any)'] = 'reporting/home_visit/home_visit_minor_form/home_visit_minor_form_edit/$1';
// Home Visit Adult Form Edit Route
$route['reporting/home_visit/home_visit_adult_form/edit/(:any)'] = 'reporting/home_visit/home_visit_adult_form/edit/$1';
// Follow Up Visit Form Route
$route['reporting/incident/incident_list/follow_up_visit_form/(:any)/(:any)/(:any)'] = 'reporting/follow_up_visit/follow_up_visit_form/index/$1/$2/$3';
// $route['reporting/incident/incident_list/follow_up_visit_form/(:any)'] = 'reporting/follow_up_visit/follow_up_visit_form/index/$1';
// Follow Up Visit Form Edit Route
$route['reporting/follow_up_visit/follow_up_visit_form/edit/(:any)'] = 'reporting/follow_up_visit/follow_up_visit_form/follow_up_visit_form_edit/$1';
// Police Case Route
$route['reporting/incident/incident_list/police_cases/(:any)/(:any)/(:any)'] = 'reporting/police_case/police_case_form/index/$1/$2/$3';
// Police Case Edit Route
$route['reporting/police_case/police_case_list/edit/(:any)/(:any)'] = 'reporting/police_case/police_case_list/edit_police_case/$1/$2';
// Forgot Password Route
$route['forgot_password'] = 'forgot_password/forgot_password_form';
// Forgot Password OTP Route
$route['forgot_password/check_otp/(:any)'] = 'forgot_password/forgot_password_form/otp_check/$1';
// Forgot Password Reset Route
$route['forgot_password/password_reset/(:any)/(:any)'] = 'forgot_password/forgot_password_form/password_reset/$1/$2';
// Incident Print Route
$route['reporting/incident/incident_list/print/(:any)'] = 'reporting/incident/incident_print/print_incident/$1';
// Incident Download Route
$route['reporting/incident/incident_list/download/(:any)'] = 'reporting/incident/incident_downloads/download_incident/$1';
// Incident List Print Route
$route['reporting/incident/incident_list/list_print'] = 'reporting/incident/incident_print/list_print';
// Incident List Download Route
$route['reporting/incident/incident_list/list_download'] = 'reporting/incident/incident_downloads/List_Download_Excel';
// CWC Proceedings Form Route
$route['reporting/incident/incident_list/child_welfare_committee_proceedings_cp_one_form/(:any)'] = 'reporting/cwc_proceedings/child_welfare_committee_proceedings_form/index/$1';

$route['reporting/incident/incident_list/child_welfare_committee_proceedings_cp_two_form/(:any)'] = 'reporting/cwc_proceedings/child_welfare_committee_proceedings_form/child_welfare_committee_proceedings_cp_two_form/$1';

// CWC Proceedings List Edit Route
$route['reporting/cwc_proceedings/child_welfare_committee_proceedings_list/edit/(:any)/(:any)'] = 'reporting/cwc_proceedings/child_welfare_committee_proceedings_list/cwc_edit/$1/$2';
// Home Visit List Download Route
$route['reporting/home_visit/home_visits_list/list_download'] = 'reporting/home_visit/home_visits_list/list_download';
// Home Visit List Print Route
$route['reporting/home_visit/home_visits_list/list_print'] = 'reporting/home_visit/home_visits_list/list_print';
// Follow Up Visit List Print Route
$route['reporting/follow_up_visit/follow_up_visits_list/list_print'] = 'reporting/follow_up_visit/follow_up_visits_list/list_print';
// Follow Up Visit List Download Route
$route['reporting/follow_up_visit/follow_up_visits_list/list_download'] = 'reporting/follow_up_visit/follow_up_visits_list/list_download';
// Police Cases List Print Route
$route['reporting/police_case/police_case_list/list_print'] = 'reporting/police_case/police_case_list/list_print';
// Police Cases List Download Route
$route['reporting/police_case/police_case_list/list_download'] = 'reporting/police_case/police_case_list/list_download';
// CWC Proceedings List Print Route
$route['reporting/cwc_proceedings/child_welfare_committee_proceedings_list/list_print'] = 'reporting/cwc_proceedings/child_welfare_committee_proceedings_list/list_print';
// CWC Proceedings List Download Route
$route['reporting/cwc_proceedings/child_welfare_committee_proceedings_list/list_download'] = 'reporting/cwc_proceedings/child_welfare_committee_proceedings_list/list_download';
// Incident Draft Form Route
$route['reporting/incident/incident_draft_form/(:any)'] = 'reporting/incident/incident_form/incident_draft_form/$1';
// Create New SDO Users Route
$route['user_list/user/create_new_user'] = 'user_list/create_user_form';
// Add Address Route
$route['reporting/address/address_list/add_address/(:any)'] = 'reporting/address/address_list/add_incident_address/$1';
// CP One Current Address Edit
$route['reporting/address/address_list/add_cp_one_current_address/edit/(:any)'] = 'reporting/address/address_list/edit_cp_one_current_address/$1';
// CP Two Current Address Edit
$route['reporting/address/address_list/add_cp_two_current_address/edit/(:any)'] = 'reporting/address/address_list/edit_cp_two_current_address/$1';




$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['password/reset_password/(:any)/(:any)'] = 'password/reset_password';
