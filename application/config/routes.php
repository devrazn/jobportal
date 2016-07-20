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
|	http://codeigniter.com/user_guide/general/routing.html
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

// $route['default_controller'] = 'login';
$route['default_controller'] = "home/landing";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//$route['register'] = 'home/register';
$route['admin'] = "login_admin";
$route['about_us'] = "home/footer_contents/about_us";
$route['t_a_c'] = "home/footer_contents/t_a_c";
$route['f_a_qs'] = "home/footer_contents/f_a_qs";
$route['advertise'] = "home/footer_contents/advertise";
$route['how_it_works'] = "home/footer_contents/how_it_works";
$route['contact_us'] = "home/contact_us";
$route['login'] = "login_user";
$route['jobs/(:any)'] = "home/job_details/$1";
$route['employer/(:any)'] = "home/employer_details/$1";
$route['category/(:any)'] = "home/job_by_category/$1";
$route['category/(:any)/(:any)'] = "home/job_by_category/$1/$2";
$route['search'] = "home/search";

/*
*to call any function call inside login_user controller create a route as below.
*Because, otherwise all the calls will be directed to login controller for admin.

to call function without parameter
$route['login/my_demo_function'] = "login/demo_function";

to call function with parameters (suppose two parameters)
$route['login/my_demo_function/(:any)/(:any)'] = "login/my_demo_function/$1/$2";
*
*/


//$route['login/validate_admin_pw_reset_credentials/(:any)/(:any)'] = "login/validate_admin_pw_reset_credentials/$1/$2";

