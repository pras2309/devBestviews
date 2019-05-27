<?php 
/*
Plugin Name: Multi-Color Tag Cloud
Plugin URI: http://www.bestviewsreviews.com
description: A Plugin for fetching the tags and categories from the database and displaying it on the website.
Version: 1.0
Author: Mr. Manish Agarwal
License: GPL2
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//adding script into the plugin

class MTagCloud{
    public function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'wtc_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'wtc_styles'));
    }


    public function wtc_scripts(){

        wp_register_script('wtc-script', plugins_url('/js/jquery.min.js', __FILE__), array('jquery'));
        wp_register_script('script1', plugin_dir_url(__FILE__).'js/jquery.prettytag.js');
	wp_register_script('script2', plugin_dir_url(__FILE__).'js/script.js');
	wp_enqueue_script('wtc-script');
        wp_enqueue_script('script1');
        wp_enqueue_script('script2');

    }
    

    //adding up the styles
    public function wtc_styles(){
        wp_register_style('style', plugin_dir_url(__FILE__).'css/prettytag.css');
        wp_enqueue_style( 'style' );
    }

}

$wptag = new MTagCloud();



//creating short code
function wptagcloud_shortcode_init(){
    function wptagcloud_shortcode($atts){

         // get parameter(s) from the shortcode
    extract( shortcode_atts( array(
            "post_id"    => 'post_id',
        ), $atts ) );

        require_once 'view.php';
    }

    add_shortcode('multicolor-tag-cloud', 'wptagcloud_shortcode');
}
add_action('init', 'wptagcloud_shortcode_init');
