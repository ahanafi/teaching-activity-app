<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'authentication';
$route['404_override'] = 'Errorpage';
$route['translate_uri_dashes'] = TRUE;

//Restrict page route
$route['restrict-page'] = 'Errorpage/restrict_page';

$route['login'] = 'authentication/index';
$route['logout'] = 'authentication/logout';

$route['program-studi'] = 'programstudi/index';
$route['program-studi/create'] = 'programstudi/create';
$route['program-studi/(:any)/(:num)'] = 'programstudi/$1/$2';

$route['mata-kuliah'] = 'matakuliah/index';
$route['mata-kuliah/create'] = 'matakuliah/create';
$route['mata-kuliah/(:any)/(:num)'] = 'matakuliah/$1/$2';

$route['jadwal-kuliah'] = 'jadwal/index';
$route['jadwal-kuliah/create'] = 'jadwal/create';
$route['jadwal-kuliah/(:any)/(:num)'] = 'jadwal/$1/$2';

$route['ruang-kelas'] = 'ruangan/index';
$route['ruang-kelas/create'] = 'ruangan/create';
$route['ruang-kelas/(:any)/(:num)'] = 'ruangan/$1/$2';

$route['berita-acara'] = 'beritaacara/index';
$route['berita-acara/create'] = 'beritaacara/create';
$route['berita-acara/(:any)/(:num)'] = 'beritaacara/$1/$2';

$route['laporan/generate'] = 'laporan/index';
$route['laporan/berita-acara/(:any)'] = 'laporan/berita-acara/$1';

$route['tahun-akademik'] = 'TahunAkademik/index';
