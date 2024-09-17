<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['collection/(:any)'] = 'home/shop/$1';
$route['collection'] = 'home/shop/';
$route['product-detail/(:any)'] = 'product/product_detail/$1';
$route['shopping-cart'] = 'product/shoppingCart';
$route['wishlist-products'] = 'product/wishlistPros';
$route['user-checkout'] = 'product/checkout';
$route['user-checkout/(:any)'] = 'product/checkout/$1';
$route['user-logout'] = 'users/logout';	
$route['my-orders'] = 'users/orders';	
$route['my-orders/(:any)'] = 'users/ordersinfo/$1';	
$route['my-orders/(:any)/(:any)'] = 'users/ordersinfo/$1/$2';
$route['my-account'] = 'users/myaccount/';
$route['my-address-book'] = 'users/address_book/';
$route['user-registration'] = 'users/registration';	

$route["about-us"] = "home/about_us";
$route["terms-and-conditions"] = "home/terms_and_conditions";
$route["cancellation-and-refund-policy"] = "home/cancellation_and_Refund";
$route["privacy-policy"] = "home/privacy_policy";
$route["shipping-and-delivery_policy"] = "home/shipping_and_delivery_policy";
$route["contact-us"] = "home/contact";

$route['default_controller'] = 'home';
$route['404_override'] = 'home/not_found';
$route['translate_uri_dashes'] = FALSE;
