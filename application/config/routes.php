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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/login';
$route['login'] = 'login/index';
$route['login/dologin'] = 'login/dologin';
$route['register'] = 'register/index';

//$route['home'] = 'home/index';

$route['mdisaster'] = 'm_disaster';
$route['mdisaster/add'] = 'm_disaster/add';
$route['mdisaster/addsave'] = 'm_disaster/addsave';
$route['mdisaster/edit/(:num)'] = 'm_disaster/edit/$1';
$route['mdisaster/editsave'] = 'm_disaster/editsave';
$route['mdisaster/delete/(:num)'] = 'm_disaster/delete/$1';

$route['ggroupuser'] = 'g_groupuser';
$route['ggroupuser/add'] = 'g_groupuser/add';
$route['ggroupuser/addsave'] = 'g_groupuser/addsave';
$route['ggroupuser/edit/(:num)'] = 'g_groupuser/edit/$1';
$route['ggroupuser/editsave'] = 'g_groupuser/editsave';
$route['ggroupuser/delete/(:num)'] = 'g_groupuser/delete/$1';
$route['ggroupuser/editrole/(:num)'] = 'g_groupuser/editrole/$1';

$route['muser'] = 'm_user';
$route['muser/add'] = 'm_user/add';
$route['muser/addsave'] = 'm_user/addsave';
$route['muser/edit/(:num)'] = 'm_user/edit/$1';
$route['muser/editsave'] = 'm_user/editsave';
$route['muser/delete/(:num)'] = 'm_user/delete/$1';


$route['mprovince'] = 'm_province';
$route['mprovince/add'] = 'm_province/add';
$route['mprovince/addsave'] = 'm_province/addsave';
$route['mprovince/edit/(:num)'] = 'm_province/edit/$1';
$route['mprovince/editsave'] = 'm_province/editsave';
$route['mprovince/delete/(:num)'] = 'm_province/delete/$1';


$route['mcity'] = 'm_city';
$route['mcity/add'] = 'm_city/add';
$route['mcity/addsave'] = 'm_city/addsave';
$route['mcity/edit/(:num)'] = 'm_city/edit/$1';
$route['mcity/editsave'] = 'm_city/editsave';
$route['mcity/delete/(:num)'] = 'm_city/delete/$1';


$route['msubcity'] = 'm_subcity';
$route['msubcity/add'] = 'm_subcity/add';
$route['msubcity/addsave'] = 'm_subcity/addsave';
$route['msubcity/edit/(:num)'] = 'm_subcity/edit/$1';
$route['msubcity/editsave'] = 'm_subcity/editsave';
$route['msubcity/delete/(:num)'] = 'm_subcity/delete/$1';

$route['mvillage'] = 'm_village';
$route['mvillage/add'] = 'm_village/add';
$route['mvillage/addsave'] = 'm_village/addsave';
$route['mvillage/edit/(:num)'] = 'm_village/edit/$1';
$route['mvillage/editsave'] = 'm_village/editsave';
$route['mvillage/delete/(:num)'] = 'm_village/delete/$1';

$route['mfamilycard'] = 'm_familycard';
$route['mfamilycard/add'] = 'm_familycard/add';
$route['mfamilycard/addsave'] = 'm_familycard/addsave';
$route['mfamilycard/edit/(:num)'] = 'm_familycard/edit/$1';
$route['mfamilycard/edit/(:string)'] = 'm_familycard/edit/$1';
$route['mfamilycard/editsave'] = 'm_familycard/editsave';
$route['mfamilycard/delete/(:num)'] = 'm_familycard/delete/$1';
$route['mfamilycard/savefamilycarddetail'] = 'm_familycard/savefamilycarddetail';
$route['mfamilycard/editfamilycarddetail'] = 'm_familycard/editfamilycarddetail';
$route['mfamilycard/deletefamilycarddetail/(:num)/(:num)'] = 'm_familycard/deletefamilycarddetail/$1/$2';
$route['mfamilycard/savefamilycardanimal'] = 'm_familycard/savefamilycardanimal';
$route['mfamilycard/editfamilycardanimal'] = 'm_familycard/editfamilycardanimal';
$route['mfamilycard/deletefamilycardanimal/(:num)/(:num)'] = 'm_familycard/deletefamilycardanimal/$1/$2';

$route['manimal'] = 'm_animal';
$route['manimal/add'] = 'm_animal/add';
$route['manimal/addsave'] = 'm_animal/addsave';
$route['manimal/edit/(:num)'] = 'm_animal/edit/$1';
$route['manimal/editsave'] = 'm_animal/editsave';
$route['manimal/delete/(:num)'] = 'm_animal/delete/$1';

//API
$route['api/mdisaster']['GET'] = 'api_mdisaster/get_disaster';
$route['api/mdisaster/(:any)/(:any)'] = 'api_mdisaster/get_disaster/$1/$2';
$route['api/mdisaster/save']['POST'] = 'api_mdisaster/save_disaster';
