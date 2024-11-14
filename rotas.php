<?php

use Pecee\SimpleRouter\SimpleRouter;
use sistema\Nucleo\Helpers;

try {
    SimpleRouter::setDefaultNamespace('sistema\Controlador');

    SimpleRouter::get(URL_SITE, 'SiteControlador@index');
    SimpleRouter::get(URL_SITE. 'index.php', 'SiteControlador@index');
    SimpleRouter::get(URL_SITE . 'sobre-nos', 'SiteControlador@sobre');
    SimpleRouter::get(URL_SITE . 'post/{slug}/{id}', 'SiteControlador@post');
    SimpleRouter::get(URL_SITE . 'categoria/{id}', 'SiteControlador@categoria');
    SimpleRouter::post(URL_SITE . 'buscar', 'SiteControlador@buscar');
    SimpleRouter::get(URL_SITE . '404', 'SiteControlador@erro404');
    
    //ROTAS ADMIN
    SimpleRouter::group(['namespace' => 'Admin'], function() {
        
        //ADMIN LOGIN
        SimpleRouter::match(['get','post'], URL_ADMIN.'login', 'Adminlogin@login');
        
        //DASHBOARD
        SimpleRouter::get(URL_ADMIN . 'dashboard', 'AdminDashboard@dashboard');
        SimpleRouter::get(URL_ADMIN . 'sair', 'AdminDashboard@sair');
        
        //ADMIN USUÁRIOS
        SimpleRouter::get(URL_ADMIN . 'usuarios/listar', 'AdminUsuarios@listar');
        SimpleRouter::match(['get','post'], URL_ADMIN.'usuarios/cadastrar',           'AdminUsuarios@cadastrar');
        SimpleRouter::match(['get','post'], URL_ADMIN.'usuarios/editar/{id}',           'AdminUsuarios@editar');
        SimpleRouter::get(URL_ADMIN.'usuarios/deletar/{id}','AdminUsuarios@deletar');
        
        //ADMIN POSTS
        SimpleRouter::get(URL_ADMIN . 'posts/listar', 'AdminPosts@listar');
        SimpleRouter::match(['get','post'], URL_ADMIN.'posts/cadastrar',           'AdminPosts@cadastrar');
        SimpleRouter::match(['get','post'], URL_ADMIN.'posts/editar/{id}',           'AdminPosts@editar');
        SimpleRouter::get(URL_ADMIN.'posts/deletar/{id}','AdminPosts@deletar');
        SimpleRouter::post(URL_ADMIN.'posts/datatable','AdminPosts@datatable');
        
        //ADMIN CATEGORIAS
        SimpleRouter::get(URL_ADMIN . 'categorias/listar', 'AdminCategorias@listar');
        SimpleRouter::match(['get','post'], URL_ADMIN.'categorias/cadastrar',           'AdminCategorias@cadastrar');
        SimpleRouter::match(['get','post'], URL_ADMIN.'categorias/editar/{id}',           'AdminCategorias@editar');
          SimpleRouter::get(URL_ADMIN.'categorias/deletar/{id}','AdminCategorias@deletar');
    });
        
    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {
    if (Helpers::localhost()) {
        echo $ex;
    } else {
        Helpers::redirecionar('404');
    }
}