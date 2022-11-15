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
$route['default_controller'] = 'clients';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['users/signin'] = 'users/process_signin';
$route['users/signoff'] = 'users/logoff';
$route['users/application'] = 'users/process_application';

$route['users/verify/(:any)'] = 'users/verify/$1';

$route['dashboards/user_list'] = 'dashboards/user_list';
$route['dashboards/add'] = 'dashboards/add';
$route['dashboards/delete/(:any)'] = 'dashboards/delete/$1';
$route['dashboards/transaction_list'] = 'dashboards/transaction_list';
$route['dashboards/product_list'] = 'dashboards/product_list';
$route['dashboards/product/(:any)'] = 'dashboards/delete_product/$1';
$route['dashboards/edit_product/(:any)'] = 'dashboards/edit_product/$1';

$route['dashboards/application_show/(:any)'] = 'clients/show/$1';
$route['dashboards/product_show/(:any)'] = 'clients/product_show/$1';
$route['dashboards/cancel/(:any)'] = 'dashboards/cancel/$1';
$route['dashboards/view/(:any)'] = 'dashboards/application_view/$1';
$route['dashboards/steps_update'] = 'dashboards/steps_update';

$route['clients/send_verification'] = 'clients/send';
$route['clients/check_out/(:any)'] = 'clients/check_out/$1';

$route['payments/success'] = 'payments/success';
$route['payments/cancel'] = 'payments/cancel';
$route['payments/counter/(:any)'] = 'payments/counter/$1';
