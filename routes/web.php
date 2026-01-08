<?php 
date_default_timezone_set('America/Sao_Paulo');

use Facades\Config;
use Facades\Requisition as Request;
use Facades\Router;
use \Core\Auth;

Config::env();


$router = new Router();
$request = new Request();

$router->get( '/', function() use($request) 
{
  $request->handle(Request::CALLABLE, "App\Controllers\Home@indexAction" ,$_REQUEST); 
});

$router->get( '/index', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Home@indexAction" ,$_REQUEST); 
});

$router->get( '/login', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@loginIndex" ,$_REQUEST); 
});

$router->before('POST', '/dologin', function()use($request)  {
    \App\Middleware\Auth::beforeAction();
});

$router->post( '/dologin', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@loginAction" ,$_REQUEST); 
});

$router->before('GET', '/dash', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/dash', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Dash@indexAction" ,$_REQUEST); 
});

$router->get( '/grupos', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Grupos@indexAction" ,$_REQUEST); 
});

$router->get( '/add_group', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Grupos@addGrupo" ,$_REQUEST); 
});

$router->post( '/add_group', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Grupos@newGrupo" ,$_REQUEST); 
});

$router->get( '/grupos/{fn}/{id}', function($fn, $id) use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Grupos@Action" ,['fn'=>$fn, 'id'=>$id]); 
});

$router->post( '/grupos/update', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Grupos@Update" ,$_REQUEST); 
});


$router->get('/projetos', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Projetos@indexAction" ,$_REQUEST); 
});

$router->get( '/add_projeto', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Projetos@addProjeto" ,$_REQUEST); 
});

$router->post( '/add_projeto', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Projetos@newProjeto" ,$_REQUEST); 
});


$router->get( '/projetos/{fn}/{id}', function($fn, $id) use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Projetos@Action" ,['fn'=>$fn, 'id'=>$id]); 
});


$router->post( '/projetos/update', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Projetos@Update" ,$_REQUEST); 
});


$router->post( '/todo', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Kanban@toDO" ,$_REQUEST); 
});

$router->before('GET', '/profile', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/profile', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@profileAction" ,$_REQUEST); 
});

$router->before('POST', '/profile', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->post('/profile', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@updateProfile" ,$_REQUEST); 
});

$router->before('POST', '/user.avatar', function()use($request)  {
    $request->handle(Request::CALLABLE, "App\Controllers\User@avatarAction" ,$_REQUEST); 
});

$router->post( '/user.avatar', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@avatarAction" ,$_REQUEST); 
});

$router->before('GET', '/admin', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/admin', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Admin@indexAction" ,$_REQUEST); 
});


$router->get( '/users/{fn}/{id}', function($fn, $id) use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Admin@usersAction" ,['fn'=>$fn, 'id'=>$id]); 
});

$router->post('/update/users', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Admin@updateUsersAction" ,$_REQUEST); 
});


$router->before('GET', '/logout', function() use($request)
{
    \App\Middleware\PreventBack::handle($request);
});

$router->get( '/logout', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@logoutAction" ,$_REQUEST); 
});



$router->run();
