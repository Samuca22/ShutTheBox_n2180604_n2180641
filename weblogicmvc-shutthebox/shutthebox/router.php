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
Router::get('home/como-jogar',	'HomeController/comojogar');
Router::get('home/como-jogar-game',	'HomeController/comojogargame');
Router::get('home/topten',  'HomeController/topten');
Router::get('home/login', 'HomeController/login');
Router::get('home/backoffice',  'HomeController/backoffice');

Router::get('auth/logout', 'AuthController/logout');
Router::post('auth/login', 'AuthController/login');
Router::get('game/game',  'GameController/game');
Router::get('game/lancarDados',  'GameController/lancarDados');
Router::get('game/bloquearNumero',  'GameController/bloquearNumero');
Router::get('game/resultado', 'GameController/resultado');
Router::get('game/novoJogo', 'GameController/novoJogo');
Router::get('game/sairJogo', 'GameController/sairJogo');


Router::resource('user', 'UserController');












/************** End of URLEncoder Routing Rules ************************************/