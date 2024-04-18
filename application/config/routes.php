<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['project1'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profileUpdate'] = "user/profileUpdate";
$route['profileUpdate/(:any)'] = "user/profileUpdate/$1";

$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['changePassword/(:any)'] = "user/changePassword/$1";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

$route['roleListing'] = "roles/roleListing";
$route['roleListing/(:num)'] = "roles/roleListing/$1";
$route['roleListing/(:num)/(:num)'] = "roles/roleListing/$1/$2";
$route['roles/delete/(:num)'] = 'roles/deleteRole/$1'; // Menyesuaikan dengan fungsi deleteRole

$route['project1'] = 'project1';

$route['project2'] = 'project2';

$route['project3'] = 'project3';

$route['project4'] = 'project4';

$route['neck'] = 'neck';
$route['neck/taskListing'] = 'neck/taskListing';
$route['neck/add'] = 'neck/add';
$route['neck/addNewTask'] = 'neck/addNewTask';
$route['neck/edit/(:num)'] = 'neck/edit/$1';
$route['neck/editTask'] = 'neck/editTask';

$route['body'] = 'body';
$route['body/taskListing'] = 'body/taskListing';
$route['body/add'] = 'body/add';
$route['body/addNewTask'] = 'body/addNewTask';
$route['body/edit/(:num)'] = 'body/edit/$1';
$route['body/editTask'] = 'body/editTask';

$route['bottom'] = 'bottom';
$route['bottom/taskListing'] = 'bottom/taskListing';
$route['bottom/add'] = 'bottom/add';
$route['bottom/addNewTask'] = 'bottom/addNewTask';
$route['bottom/edit/(:num)'] = 'bottom/edit/$1';
$route['bottom/editTask'] = 'bottom/editTask';

$route['neck2'] = 'neck2';
$route['neck2/taskListing'] = 'neck2/taskListing';
$route['neck2/add'] = 'neck2/add';
$route['neck2/addNewTask'] = 'neck2/addNewTask';
$route['neck2/edit/(:num)'] = 'neck2/edit/$1';
$route['neck2/editTask'] = 'neck2/editTask';

$route['body2'] = 'body2';
$route['body2/taskListing'] = 'body2/taskListing';
$route['body2/add'] = 'body2/add';
$route['body2/addNewTask'] = 'body2/addNewTask';
$route['body2/edit/(:num)'] = 'body2/edit/$1';
$route['body2/editTask'] = 'body2/editTask';

$route['bottom2'] = 'bottom2';
$route['bottom2/taskListing'] = 'bottom2/taskListing';
$route['bottom2/add'] = 'bottom2/add';
$route['bottom2/addNewTask'] = 'bottom2/addNewTask';
$route['bottom2/edit/(:num)'] = 'bottom2/edit/$1';
$route['bottom2/editTask'] = 'bottom2/editTask';

$route['neck3'] = 'neck3';
$route['neck3/taskListing'] = 'neck3/taskListing';
$route['neck3/add'] = 'neck3/add';
$route['neck3/addNewTask'] = 'neck3/addNewTask';
$route['neck3/edit/(:num)'] = 'neck3/edit/$1';
$route['neck3/editTask'] = 'neck3/editTask';

$route['body3'] = 'body3';
$route['body3/taskListing'] = 'body3/taskListing';
$route['body3/add'] = 'body3/add';
$route['body3/addNewTask'] = 'body3/addNewTask';
$route['body3/edit/(:num)'] = 'body3/edit/$1';
$route['body3/editTask'] = 'body3/editTask';

$route['inner'] = 'inner';
$route['inner/taskListing'] = 'inner/taskListing';
$route['inner/add'] = 'inner/add';
$route['inner/addNewTask'] = 'inner/addNewTask';
$route['inner/edit/(:num)'] = 'inner/edit/$1';
$route['inner/editTask'] = 'inner/editTask';

$route['head'] = 'head';
$route['head/taskListing'] = 'head/taskListing';
$route['head/add'] = 'head/add';
$route['head/addNewTask'] = 'head/addNewTask';
$route['head/edit/(:num)'] = 'head/edit/$1';
$route['head/editTask'] = 'head/editTask';

$route['pin'] = 'pin';
$route['pin/taskListing'] = 'pin/taskListing';
$route['pin/add'] = 'pin/add';
$route['pin/addNewTask'] = 'pin/addNewTask';
$route['pin/edit/(:num)'] = 'pin/edit/$1';
$route['pin/editTask'] = 'pin/editTask';















/* End of file routes.php */
/* Location: ./application/config/routes.php */
