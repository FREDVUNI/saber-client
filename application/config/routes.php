<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*backend routes*/
$route['login'] = 'backend/Auth/index';
$route['forgot-password'] = 'backend/Auth/forgotPassword';
$route['reset-password']="backend/Auth/resetPassword";
$route['change-password'] = 'backend/Auth/changePassword';
$route['logout']='backend/Auth/logout';
$route['dashboard'] = 'backend/Admin/index';

$route['admin'] = 'backend/Admin/create';
$route['admin/(:any)/delete'] = 'backend/Admin/delete/$1';

$route['bookings'] = 'backend/Booking/index';
$route['booking'] = 'backend/Booking/create';
$route['booking/(:any)/delete'] = 'backend/Booking/delete/$1';

$route['drivers'] = 'backend/Driver/index';
$route['driver'] = 'backend/Driver/create';
$route['driver/(:any)'] = 'backend/Driver/edit/$1';
$route['driver/(:any)/delete'] = 'backend/Driver/delete/$1';

$route['vehicles'] = 'backend/Vehicle/index';
$route['vehicle'] = 'backend/Vehicle/create';
$route['vehicle/(:any)'] = 'backend/Vehicle/edit/$1';
$route['vehicle/(:any)/delete'] = 'backend/Vehicle/delete/$1';

$route['vehicle-types'] = 'backend/VehicleType/index';
$route['vehicle-type'] = 'backend/VehicleType/create';
$route['vehicle-type/(:any)'] = 'backend/VehicleType/edit/$1';
$route['vehicle-type/(:any)/delete'] = 'backend/VehicleType/delete/$1';

$route['users'] = 'backend/User/index';
$route['user'] = 'backend/User/create';
$route['user/(:any)'] = 'backend/User/edit/$1';
$route['user/(:any)/delete'] = 'backend/User/delete/$1';

$route['service-list'] = 'backend/Service/index';
$route['service'] = 'backend/Service/create';
$route['service/(:any)'] = 'backend/Service/edit/$1';
$route['service/(:any)/delete'] = 'backend/Service/delete/$1';

$route['departments'] = 'backend/Department/index';
$route['department'] = 'backend/Department/create';
$route['department/(:any)'] = 'backend/Department/edit/$1';
$route['department/(:any)/delete'] = 'backend/Department/delete/$1';

$route['vendors'] = 'backend/Vendor/index';
$route['vendor'] = 'backend/Vendor/create';
$route['vendor/(:any)'] = 'backend/Vendor/edit/$1';
$route['vendor/(:any)/delete'] = 'backend/Vendor/delete/$1';

$route['admins'] = 'backend/Admin/admins';
$route['admin'] = 'backend/Admin/create';
$route['profile'] = 'backend/Admin/profile';
$route['admin/(:any)/delete'] = 'backend/Admin/delete/$1';
/*backend routes*/

$route['default_controller'] = 'welcome';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;
