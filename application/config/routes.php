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
$api_ver = 'api/v1/';
//rudra_nurse_category API Routes
$t_name = 'auto_scripts/Rudra_nurse_category_apis/';    
$route[$api_ver.'nurse/(:any)'] = $t_name.'rudra_rudra_nurse_category/$1';

$t_name = 'auto_scripts/Rudra_user_apis/';    
$route[$api_ver.'user/(:any)'] = $t_name.'rudra_user/$1';

$t_name = 'auto_scripts/Rudra_jobs_apis/';    
$route[$api_ver.'jobs/(:any)'] = $t_name.'rudra_rudra_jobs/$1';

$t_name = 'auto_scripts/Rudra_facility_owner_apis/';    
$route[$api_ver.'facility/(:any)'] = $t_name.'rudra_rudra_facility_owner/$1';

$t_name = 'api_ctrls/Rudra_user_apis/';    
$route['api/user/(:any)'] = $t_name.'rudra_user/$1';

//Video Category API Routes
$t_name = 'auto_scripts/Rudra_video_category_apis/';    
$route[$api_ver.'video_category/(:any)'] = $t_name.'rudra_rudra_video_category/$1';

//Video Sub Category API Routes
$t_name = 'auto_scripts/Rudra_video_subcategory_apis/';    
$route[$api_ver.'video_subcategory/(:any)'] = $t_name.'rudra_rudra_video_subcategory/$1';
//Video  API Routes
$t_name = 'auto_scripts/Rudra_videos_apis/';    
$route[$api_ver.'videos/(:any)'] = $t_name.'rudra_rudra_videos/$1';


$crm = 'crm/';
//Daddy CRUD MASTER Routes
//Crud Master
$crud_master = $crm . "Crudmasterstatic/";
$route['crudmaster'] = $crud_master . 'index';
$route['crudmaster/index'] = $crud_master . 'index';
$route['crudmaster/list'] = $crud_master . 'list';
$route['crudmaster/post_actions/(:any)'] = $crud_master.'post_actions/$1';
//Rudra_facility_owner_crtl ROUTES
$crud_master = $crm . "Rudra_facility_owner_crtl/";
$route['facility-owner'] = $crud_master . 'index';
$route['facility-owner/index'] = $crud_master . 'index';
$route['facility-owner/list'] = $crud_master . 'list';
$route['facility-owner/post_actions/(:any)'] = $crud_master.'post_actions/$1';
$route['facility-owner/search'] = $crud_master.'search';
$route['clearNotifications'] = $crud_master.'clear_notifications';
//Rudra_nurse_category_crtl ROUTES
$crud_master = $crm . "Rudra_nurse_category_crtl/";
$route['nurse-category'] = $crud_master . 'index';
$route['nurse-category/index'] = $crud_master . 'index';
$route['nurse-category/list'] = $crud_master . 'list';
$route['nurse-category/post_actions/(:any)'] = $crud_master.'post_actions/$1';
$route['nurse-category/searchNcat'] = $crud_master . 'searchNcat';
//Rudra_testw_crtl ROUTES
$crud_master = $crm . "Rudra_testw_crtl/";
$route['rudra_testw'] = $crud_master . 'index';
$route['rudra_testw/index'] = $crud_master . 'index';
$route['rudra_testw/list'] = $crud_master . 'list';
$route['rudra_testw/post_actions/(:any)'] = $crud_master.'post_actions/$1';
//Rudra_jobs_crtl ROUTES
$crud_master = $crm . "Rudra_jobs_crtl/";
$route['jobs'] = $crud_master . 'index';
$route['jobs/index'] = $crud_master . 'index';
$route['jobs/list'] = $crud_master . 'list';
$route['jobs/post_actions/(:any)'] = $crud_master.'post_actions/$1';

//Daddy Admin Codes
$route['crm/admin'] = 'crm/admin';
$route['admin-login'] = 'crm/admin/login';
$route['do-admin-login'] = 'crm/Admin/check_login_admin';
$route['admin/dashboard'] = 'crm/Admin/index';
$route['dashboard-data'] = 'crm/Admin/get_dashboard_data';
$route['load-ajax-data'] = 'crm/Dashboard_ajax/get_data';
$route['admin-update-profile'] = 'crm/Admin/update_profile';
$route['admin-edit-password'] = 'crm/Admin/edit_password';
$route['admin/logout'] = 'crm/Admin/logout';
$route['admin/profile'] = 'crm/Admin/profile';
$crud_master = $crm . "Rudra_facility_wallet_crtl/";
$route['facility-wallet'] = $crud_master . 'index';
$route['facility-wallet/index'] = $crud_master . 'index';
$route['facility-wallet/list'] = $crud_master . 'list';
$route['facility-wallet/post_actions/(:any)'] = $crud_master.'post_actions/$1';
//Admin 
//Shift Manager  ROUTES
$crud_master = $crm . "Rudra_shift_manager_crtl/";
$route['shift-manager'] = $crud_master . 'index';
$route['shift-manager/index'] = $crud_master . 'index';
$route['shift-manager/list'] = $crud_master . 'list';
$route['shift-manager/post_actions/(:any)'] = $crud_master.'post_actions/$1';
$route['shift-manager/searchbymanager'] = $crud_master.'searchbySM';
//Rudra_facility_owner_crtl ROUTES
$crud_master = $crm . "Rudra_facility_transactions_crtl/";
$route['facility-transactions'] = $crud_master . 'index';
$route['facility-transactions/index'] = $crud_master . 'index';
$route['facility-transactions/list'] = $crud_master . 'list';
$route['facility-transactions/post_actions/(:any)'] = $crud_master.'post_actions/$1';
$route['facility-transactions/searchByNurse'] = $crud_master.'searchByNurse';
$route['facility-transactions/searchbyjob'] = $crud_master.'searchbyjob';
$route['facility-invoice/(:any)'] = $crud_master.'invoice/$1';
$route['facility-single/(:any)'] = $crud_master.'rudra_facility_single/$1';
$crud_master = $crm . "Rudra_care_giver_crtl/";
$route['care-giver'] = $crud_master . 'index';
$route['care-giver/index'] = $crud_master . 'index';
$route['care-giver/list'] = $crud_master . 'list';
$route['care-giver/post_actions/(:any)'] = $crud_master.'post_actions/$1';	
$route['care-giver/view/(:num)'] = $crud_master . 'viewDetail/$1';

$crud_master = $crm . "Rudra_facility_category_crtl/";
$route['facility-category'] = $crud_master . 'index';
$route['facility-category/index'] = $crud_master . 'index';
$route['facility-category/list'] = $crud_master . 'list';
$route['facility-category/post_actions/(:any)'] = $crud_master.'post_actions/$1';
$route['facility-category/searchCat'] = $crud_master . 'searchCat';
//Facility Owner Codes
//$route['crm/facilityOwner'] = 'fo/admin';
$route['facility-login'] = 'fo/FacilityOwner/login';
$route['do-facility-login'] = 'fo/FacilityOwner/check_login_facility';
$route['facility-forget-pass/(:any)'] = 'fo/FacilityOwner/fo_forget_pass/$1';
$route['facility-ajaxforget-pass'] = 'fo/FacilityOwner/fo_ajaxforget_pass';

$route['facility-reset-password'] = 'fo/FacilityOwner/fo_reset_pass';
$route['facility-ajaxreset-pass'] = 'fo/FacilityOwner/fo_ajaxreset_pass';
$route['facility-change_pass'] = 'fo/FacilityOwner/fo_change_pass';
$route['facility-AjaxChangePass'] = 'fo/FacilityOwner/AjaxChangePass';
$route['facility'] = 'fo/FacilityOwner/index';
$route['dashboard-data'] = 'fo/FacilityOwner/get_dashboard_data';
$route['load-ajax-data'] = 'fo/Dashboard_ajax/get_data';
$route['fo_clear_notifications'] = 'fo/FacilityOwner/fo_clear_notifications';
$route['facility-profile'] = 'fo/FacilityOwner/profile';
$route['facility-update-profile'] = 'fo/FacilityOwner/update_profile';
$route['facility-edit-password'] = 'fo/FacilityOwner/edit_password';
$route['facility-logout'] = 'fo/FacilityOwner/logout';
$focrm = 'fo/';

//Rudra_facility_owner_crtl ROUTES
$fo_crud_master = $focrm . "Rudra_facility_transactions_crtl/";
$route['facility-facility-transactions'] = $fo_crud_master . 'index';
$route['facility-facility-transactions/index'] = $fo_crud_master . 'index';
$route['facility-facility-transactions/list'] = $fo_crud_master . 'list';
$route['facility-nurse-transactions'] = $fo_crud_master . 'nurse';
$route['facility-nurse-transactions/index'] = $fo_crud_master . 'nurse';
$route['facility-facility-nurse-transactions/list'] = $fo_crud_master . 'nurselist';

$route['facility-facility-transactions/post_actions/(:any)'] = $fo_crud_master.'post_actions/$1';
$route['facility-facility-invoice/(:any)'] = $fo_crud_master.'invoice/$1';
$route['facility-facility-transactions/searchbyjob'] = $fo_crud_master . 'searchbyjob';
$route['facility-facility-transactions/searchByNurse'] = $fo_crud_master.'searchByNurse';
$fo_crud_master = $focrm . "Rudra_shift_manager_crtl/";
$route['facility-shift-manager'] = $fo_crud_master. 'index';
$route['facility-shift-manager/index'] = $fo_crud_master . 'index';
$route['facility-shift-manager/list'] = $fo_crud_master . 'list';
$route['facility-shift-manager/post_actions/(:any)'] = $fo_crud_master.'post_actions/$1';
$route['facility-shift-manager/searchbymanager'] = $fo_crud_master.'searchbySM';
$fo_crud_master = $focrm . "Rudra_fc_category_crtl/";
$route['facility-fc-category'] = $fo_crud_master . 'index';
$route['facility-fc-category/index'] = $fo_crud_master . 'index';
$route['facility-fc-category/list'] = $fo_crud_master . 'list';
$route['facility-fc-category/post_actions/(:any)'] = $fo_crud_master.'post_actions/$1';
$route['facility-fc-category/searchCat'] = $fo_crud_master . 'searchCat';
//Rudra_jobs_crtl ROUTES
$fo_crud_master = $focrm . "Rudra_jobs_crtl/";
$route['facility-jobs'] = $fo_crud_master . 'index';
$route['facility-jobs/index'] = $fo_crud_master . 'index';
$route['facility-jobs/list'] = $fo_crud_master . 'list';
$route['facility-jobs/post_actions/(:any)'] = $fo_crud_master.'post_actions/$1';

//TV Owner Codes
//$route['crm/facilityOwner'] = 'fo/admin';
$route['tv-login'] = 'tv/TV/login';
$route['do-tv-login'] = 'tv/TV/check_login_tv';
$route['tv-owner/dashboard'] = 'tv/TV/index';
$route['tv-dashboard-data'] = 'tv/TV/get_dashboard_data';
$route['tv-load-ajax-data'] = 'tv/Dashboard_ajax/get_data';
$route['tv-owner-logout'] = 'tv/TV/logout';
$tvcrm = 'tv/';
$tv_crud_master = $tvcrm . "Rudra_video_category_crtl/";
$route['rudra_video_category'] = $tv_crud_master . 'index';
$route['rudra_video_category/index'] = $tv_crud_master . 'index';
$route['rudra_video_category/list'] = $tv_crud_master . 'list';
$route['rudra_video_category/post_actions/(:any)'] = $tv_crud_master.'post_actions/$1';
	
//Rudra_video_subcategory_crtl ROUTES
$tv_crud_master = $tvcrm . "Rudra_video_subcategory_crtl/";
$route['rudra_video_subcategory'] = $tv_crud_master . 'index';
$route['rudra_video_subcategory/index'] = $tv_crud_master . 'index';
$route['rudra_video_subcategory/list'] = $tv_crud_master . 'list';
$route['rudra_video_subcategory/post_actions/(:any)'] = $tv_crud_master.'post_actions/$1';	
//Rudra_videos_crtl ROUTES
$tv_crud_master = $tvcrm . "Rudra_videos_crtl/";
$route['rudra_videos'] = $tv_crud_master . 'index';
$route['rudra_videos/index'] = $tv_crud_master . 'index';
$route['rudra_videos/list'] = $tv_crud_master . 'list';
$route['rudra_videos/post_actions/(:any)'] = $tv_crud_master.'post_actions/$1';	

	
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Rudra_keywords_crtl ROUTES
$crud_master = $crm . "Rudra_keywords_crtl/";
$route['keywords'] = $crud_master . 'index';
$route['keywords/index'] = $crud_master . 'index';
$route['keywords/list'] = $crud_master . 'list';
$route['keywords/post_actions/(:any)'] = $crud_master.'post_actions/$1';

//Rudra_facility_crtl ROUTES
$crud_master = $crm . "Rudra_facility_crtl/";
$route['all-facility'] = $crud_master . 'index';
$route['facility/index'] = $crud_master . 'index';
$route['facility/list'] = $crud_master . 'list';
$route['facility/post_actions/(:any)'] = $crud_master.'post_actions/$1';