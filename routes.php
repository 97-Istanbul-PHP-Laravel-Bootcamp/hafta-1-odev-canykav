<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");
include "database.php";

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');
get('/cart', 'views/cart.php');
get('/products', 'views/products.php');
get('/products/$id', 'views/product.php');
get('/login', 'views/login.php');
get('/checkout', 'views/checkout.php');


get('/admin', 'admin/views/index.php');
get('/admin/products', 'admin/views/products/index.php');
get('/admin/products/new', 'admin/views/products/new.php');
get('/admin/categories', 'admin/views/categories/index.php');
get('/admin/categories/new', 'admin/views/categories/new.php');
post('/admin/categories/new', 'admin/views/categories/new.php');
post('/admin/categories/delete/$id', 'admin/views/categories/index.php');


post('/login', 'views/login.php');
post('/signup', 'views/login.php');
post('/admin/products/new', 'admin/views/products/new.php');
post('/admin/products/delete/$id', 'admin/views/products/index.php');


// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
get('/user/$id', 'user.php');
/*
// Dynamic GET. Example with 2 variables
// The $name will be available in user.php
// The $last_name will be available in user.php
get('/user/$name/$last_name', 'user.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
get('/product/$type/color/:color', 'product.php');

// Dynamic GET. Example with 1 variable and 1 query string
// In the URL -> http://localhost/item/car?price=10
// The $name will be available in items.php which is inside the views folder
get('/item/$name', 'views/items.php');

*/
// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','/views/404.php');