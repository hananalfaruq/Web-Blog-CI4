<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'BlogController::index');
$routes->get('post/(:segment)', 'BlogController::detail/$1');
$routes->get('category/(:segment)', 'BlogController::category/$1');
$routes->get('search', 'BlogController::search');

// Auth Routes
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/login', 'AuthController::loginProcess');
$routes->get('auth/logout', 'AuthController::logout');

// Admin Routes (protected)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    $routes->get('posts', 'Admin\PostController::index');
    $routes->get('posts/create', 'Admin\PostController::create');
    $routes->post('posts/store', 'Admin\PostController::store');
    $routes->get('posts/edit/(:num)', 'Admin\PostController::edit/$1');
    $routes->post('posts/update/(:num)', 'Admin\PostController::update/$1');
    $routes->get('posts/delete/(:num)', 'Admin\PostController::delete/$1');

    $routes->get('categories', 'Admin\CategoryController::index');
    $routes->post('categories/store', 'Admin\CategoryController::store');
    $routes->get('categories/delete/(:num)', 'Admin\CategoryController::delete/$1');
});