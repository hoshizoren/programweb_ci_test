<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/menu', 'Home::menu');
$routes->get('logout', 'Home::logout');
$routes->post('/ceklogin', 'Home::ceklogin');
$routes->get('/mahasiswa', 'Mahasiswa::index');
$routes->get('/matakuliah', 'Home::inputmatakuliah');
$routes->post('/mahasiswa/simpan', 'Mahasiswa::simpan');
$routes->get('/mahasiswa/edit', 'Mahasiswa::edit');


