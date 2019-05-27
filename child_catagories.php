<?php

///////////////////////////////////////////////////////////////////////////////////
//                                                                               //
// This is using a sample local WordPress Install and is not production safe     //
// It uses the  REST and Basic Auth plugins                                      //
//                                                                               //
///////////////////////////////////////////////////////////////////////////////////
require_once 'wp-config.php';
global $wpdb;
//get all subcategory
$get_categories = $wpdb->get_results("SELECT subcategory FROM bestviews.products 
WHERE  wp_post_id = 0 AND subcategory_processed = 1 
AND (s3_output_url IS NOT NULL AND s3_output_url !='') 
AND s3_input_url IS NOT NULL GROUP BY subcategory");

    foreach($get_categories as $subcategory){
            $get_category = $wpdb->get_results("SELECT distinct(category) as category FROM bestviews.products WHERE subcategory='".esc_sql($subcategory->subcategory)."'");
            $category_name = $get_category[0]->category;
            
            //now get the category id from the wp.
            $category_name = str_replace('&', '&amp;', $category_name);
            $get_category_details = $wpdb->get_results("SELECT t.term_id AS category_id, t.name as `category_name`
                FROM   wp_terms t
                LEFT JOIN wp_term_taxonomy tt
                ON t.term_id = tt.term_id 
                WHERE t.`name` = '".$category_name."'");
            $main_category_id = $get_category_details[0]->category_id;    
            $category_slug = strtolower(preg_replace('/[_& ]/', '-', $subcategory->subcategory ));
            $category_slug = preg_replace('/--+/', '-', $subcategory->subcategory);
            // the standard end point for posts in an initialised Curl
            $process = curl_init('http://bestviewsreviews.com/wp-json/wp/v2/categories');
           
            // create an array of data to use, this is basic - see other examples for more complex inserts
            $data = array('description' => $subcategory->subcategory, 
                            'name' => str_replace('&amp;','&', $subcategory->subcategory), 
                            'slug' => $category_slug,
                            'parent' => $main_category_id
                        );
            // print_r($data); exit;                        
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
                echo "$subcategory->subcategory has been created \n";
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
