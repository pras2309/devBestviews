<?php
require_once 'wp-config.php';
global $wpdb;
if(isset($_POST['submit']) && $_POST['submit']=="Submit"){
    if(isset($_POST['buyLink']) &&  $_POST['buyLink'] == 'BuyLinkAffiliate'){
        print_r($_POST);
        //update the buy link , image_snippet  and affiliate_in_process = 1
        $bvr_product_id = $_POST['bvr_prod_id'];
        $buy_link = stripslashes_deep($_POST['buy_url']);
        $image_snippet = stripslashes_deep($_POST['image_snippet']);
        // echo "UPDATE bestviews.products SET affiliate_in_process=1,  buy_url = '".$buy_link."', image_snippet = '".$image_snippet."' WHERE id=$bvr_product_id";
        // exit;
        $result = $wpdb->query($wpdb->prepare("UPDATE bestviews.products SET affiliate_in_process=1,  buy_url = %s, image_snippet = %s WHERE id=%d", array($buy_link, $image_snippet, $bvr_product_id)));
        if($result == true){
            $location = get_site_url() . "/submit-affiliate-link?result=success";
            wp_redirect($location, 301);
        }else{
            $location = get_site_url() . "/submit-affiliate-link?result=failed";
            wp_redirect($location, 301);
        }
    }
}