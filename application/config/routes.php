<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'authentication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'authentication/index';

$route['program-studi'] = 'programstudi/index';
$route['program-studi/create'] = 'programstudi/create';
$route['program-studi/(:any)/(:num)'] = 'programstudi/$1/$2';
