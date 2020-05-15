<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName@methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');
Router::get('home/login',	'HomeController/login');
Router::get('home/registo', 'HomeController/registo');
Router::get('home/topten',  'HomeController/topten');
Router::get('home/game',  'HomeController/game');
Router::get('home/backoffice',  'HomeController/backoffice');

Router::post('home/login', 'AuthController/login');
Router::get('home/logout', 'AuthController/logout');


Router::resource('user', 'UserController');
Router::resource('pontuacao', 'UserController');












/************** End of URLEncoder Routing Rules ************************************/