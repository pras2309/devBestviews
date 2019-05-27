<?php

///////////////////////////////////////////////////////////////////////////////////
//                                                                               //
// This is using a sample local WordPress Install and is not production safe     //
// It uses the  REST and Basic Auth plugins                                      //
//                                                                               //
///////////////////////////////////////////////////////////////////////////////////
require_once 'wp-config.php';
global $wpdb;
$get_categories = $wpdb->get_results("SELECT distinct(category) as category FROM bestviews.products GROUP BY category");
    foreach($get_categories as $prod_category){
            $category_slug = strtolower(preg_replace('/[_& ]/', '-', $prod_category->category ));
            $category_slug = preg_replace('/--+/', '-', $prod_category->category);
            // the standard end point for posts in an initialised Curl
            $process = curl_init('http://bestviewsreviews.com/wp-json/wp/v2/categories');

            // create an array of data to use, this is basic - see other examples for more complex inserts
            $data = array('description' => $prod_category->category, 
                            'name' => str_replace('&amp;','&', $prod_category->category) , 
                            'slug' => $category_slug
                        );
            $data_string = json_encode($data);

            // create the options starting with basic authentication
            curl_setopt($process, CURLOPT_USERPWD, 'admin'.":".'Best@xy123');
            curl_setopt($process, CURLOPT_TIMEOUT, 30);
            curl_setopt($process, CURLOPT_POST, 1);
            // curl_setopt($process, CURLOPT_VERBOSE, 1);
            curl_setopt($process, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            // make sure we are POSTing
            curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
            // this is the data to insert to create the post
            curl_setopt($process, CURLOPT_POSTFIELDS, $data_string);

            // allow us to use the returned data from the request
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);

            // process the request
            $return = curl_exec($process);

            $result = json_decode($return);

            curl_close($process);
            

            if($result->data->status != 400 ):
                echo "$prod_category->category has been created \n";
                //update the category taxonomy
            else:
                echo " Error: $result->message \n";
            endif;
        } //checking the category exists into wp or not.




###################################################################################
# This script is for adding the category (post-category) into the wordpress from  # 
#  our product table, if the category is not avilable into the post --> category  #  
# then it will added, if it is already there it will throw a Error Message;       #      
###################################################################################
