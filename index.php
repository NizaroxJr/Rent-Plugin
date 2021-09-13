<?php
/*
Plugin Name: Rent Plugin
Plugin URI: https://github.com/NizaroxJr
Description: A  plugin to manage renting Products
Author: Nizar Jr
Version: 1.0
Author URI: https://github.com/NizaroxJr
*/



include 'includes/functions.php';
include 'admin/options.php';
include 'admin/orders.php';
include 'admin/products.php';
include 'admin/clients.php';
include 'admin/pickup.php';
include 'admin/return.php';
include 'front/shortcode.php';
include 'admin/customPost.php';


add_action('admin_menu', 'rp_menu');

/*redirect Users To Products Page After Login
function ProductsPage() {
  return get_option('rp_application_link');
}

add_filter('login_redirect', 'ProductsPage');*/



function rp_init() {
   global $wpdb;

      

$query = "

CREATE TABLE ".$wpdb->prefix . "rp_clients (
  ClientID int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) ,
  adresse varchar(255) ,
  phone varchar(255) ,
  email varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY (ClientID)
) ;

CREATE TABLE ".$wpdb->prefix . "rp_products (
  ProductID int(11) NOT NULL AUTO_INCREMENT,
  Pname varchar(255) NOT NULL,
  pQuantity int(11) NOT NULL,
  photo varchar(255) NOT NULL,
  description text NOT NULL,
  HourlyRPrice FLOAT(10,2) NOT NULL,
  DailyRPrice FLOAT(10,2) NOT NULL,
  WeeklyRPrice FLOAT(10,2) NOT NULL,
  MonthlyRPrice FLOAT(10,2) NOT NULL,
  rStatus varchar(255) NOT NULL,
  PRIMARY KEY (ProductID)
) ;

CREATE TABLE ".$wpdb->prefix . "rp_orders (
  OrderID int(11) NOT NULL AUTO_INCREMENT,
  PID int(11) NOT NULL ,
  CID int(11) NOT NULL ,
  StartDate varchar(255) NOT NULL,
  EndDate varchar(255) NOT NULL,
  Quantity int(11) NOT NULL,
  Price int(11) NOT NULL,
  duration int(11) NOT NULL,
  Status varchar(255) NOT NULL, 
  PRIMARY KEY (OrderID)
) ;

CREATE TABLE ".$wpdb->prefix . "rp_payement(
  PayementID int(11) NOT NULL AUTO_INCREMENT,
  OID int(11) NOT NULL  ,
  amount int(11) NOT NULL,
  PayementDate date,
  PayementStatus varchar(255),
  Type varchar(255),
  Note varchar(255),
  ccn int(11),
  ccexpdate date,
  cname VARCHAR(255) NOT NULL,  
  PRIMARY KEY (PayementID)
  ) ;
";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');


dbDelta($query);
}

register_activation_hook(__FILE__,'rp_init');



function wpb_adding_styles() {
wp_register_style('my_stylesheet', plugins_url('style.css', __FILE__));
wp_enqueue_style('my_stylesheet');
}

  
function wpb_adding_scripts() {
 
wp_register_script('my_amazing_script', plugins_url('index.js', __FILE__), array('jquery'),'1.1', true);
 
wp_enqueue_script('my_amazing_script');
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_styles' ); 
add_action( 'admin_enqueue_scripts','wpb_adding_styles');
add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' ); 
add_action( 'admin_enqueue_scripts', 'wpb_adding_scripts' );  


function rp_menu() {
	
	
	

	  add_menu_page( 'Rp', 'Rent Plugin',  'manage_options', 'Rp', 'RpOptionsPage');
	  add_submenu_page( 'Rp', 'Orders', 'Orders', 'manage_options', 'RpOrders', 'RpOrderInit');
	  add_submenu_page( 'Rp', 'Pickup List', 'Pickup List', 'manage_options', 'RpPickup', 'RpPickupManager');
    add_submenu_page( 'Rp', 'Return List', 'Return List', 'manage_options', 'RpReturn', 'RpReturnManager');
    add_submenu_page( 'Rp', 'Products', 'Products', 'manage_options', 'RpProducts', 'RpManageProducts');
    add_submenu_page( 'Rp', 'Clients', 'Clients', 'manage_options', 'RpClients', 'RpManageClients');
    

	 

}


?>