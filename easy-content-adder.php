<?php
/*
Plugin Name: Easy Content Adder
Plugin URI: http://mightyhut.co
Description: Easily add content to all of your Pages, Posts, and Custom Post Types.
Author: Byron Johnson
Author URI: https://byronj.me
Version: 1.0.2
*/



/****************************
* global variables
****************************/

$my_plugin_name = 'Easy Content Adder';


// retrieve our plugin settings from options table
$beca_options = get_option('beca_settings');




/****************************
* includes
****************************/

include('includes/scripts.php');
// include('includes/data-processing.php');
include('includes/display-functions.php');
include('includes/admin-page.php'); // plugin options page
?>