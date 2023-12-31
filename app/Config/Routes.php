<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('productdetails','ProductdetailsController::productdetails');
$routes->get('login','AuthController::login');
$routes->match(['get','post'],"register","AuthController::register");

$routes->group('admin', static function ($routes) {
    $routes->get("/","Admin\DashboardController::index");

    // Categories Routes
    $routes->get("categories","Admin\CategoryController::index");
    $routes->get("categories/data","Admin\CategoryController::getCategories");
    $routes->post("categories/create","Admin\CategoryController::createCategories");
    $routes->post("categories/delete","Admin\CategoryController::deleteCategories");
    



    // Subcategories Routes
    $routes->get("subcategories","Admin\SubCategoryController::index");
    $routes->get("subcategories/data","Admin\SubCategoryController::getSubCategories");
    $routes->post("subcategories/create","Admin\SubCategoryController::createsubCategories");
    $routes->post("subcategories/delete","Admin\SubCategoryController::deletesubCategories");

    
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
