<?php
require_once 'wp-config.php';
global $wpdb;
//check wordpress category matched with the product table, and get the category ID from the wordpress table.

$get_product = $wpdb->get_results("SELECT * FROM bestviews.products 
WHERE  wp_post_id = 0 AND subcategory_processed = 1 
AND (s3_output_url IS NOT NULL AND s3_output_url !='') 
AND s3_input_url IS NOT NULL AND s3_input_url!='' LIMIT 5");


//read product information::::
  foreach($get_product  as $product){
    $content = '';
	  //   echo $product->model;
    if($product->category != '' && $product->category != NULL){
        $product_category = str_replace('&amp;','&',$product->category);
        $product_category = str_replace("s'","'s",$product->category);
        }
        if($product->subcategory != '' && $product->subcategory!=NULL){
        $product_subcategory = str_replace('&amp;','&',$product->subcategory);
        $product_subcategory = str_replace("s'","'s",$product->subcategory);
        }
        $product_title='';
        if($product->product_title!='' && $product->product_title!= NULL){
        $product_title = str_replace("?", ' ', $product->product_title);  
        
        }
        $product_description = '';
        if($product->description!='' && $product->description!= NULL){
        $product_description = $product->description;
        }
        $prduct_image_url = '';
        if($product->image_url != '' && $product->image_url!= NULL){
        $prduct_image_url = $product->image_url;
        }
        if($product->id){
        $product_id = $product->id;
        }
        $json_file_url = '';
        if($product->s3_output_url != '' && $product->s3_output_url !=NULL){
        $json_file_url = $product->s3_output_url;
        }
        $youtube_url = '';
        if($product->youtube_url != '' && $product->youtube_url != NULL){
            $youtube_url = $product->youtube_url;
        }
        $image_content = '';
        if($product->image_snippet != '' && $product->image_snippet != NULL){
            $image_content =  $product->image_snippet;
        }

        //get product price
        $product_msrp = '';
        if($product->msrp != ''
            && $product->msrp != NULL){
            $product_msrp = $product->msrp;
        }



        $buy_link = '';
        if($product->buy_url != '' && $product->buy_url != NULL){
            $buy_link = $product->buy_url;
        }
        //get product feature:
        $product_feature = '';
        $prod_tags_list = array();
        if($product->product_feature != ''  && $product->product_feature !=NULL){
            $product_feature = $product->product_feature;
            $feature_list = explode(',', $product_feature);
            foreach($feature_list as $feature ){
                $feature = str_replace('{', '', $feature);
                $feature = str_replace('}', '', $feature);
                $feature = str_replace("'", '', $feature);
                array_push($prod_tags_list, $feature);
            }
        }
        
        //read the summary text
        $prod_summary_url = '';
        if($product->summary_url != '' && $product->summary_url !=NULL){
            $prod_summary_url = $product->summary_url;
            $summary_text = @file_get_contents($prod_summary_url);

        }
        
        
	//get category or subcategory id of the product:
        $get_category_details = $wpdb->get_results("SELECT t.term_id AS category_id
                        FROM   wp_terms t
                        LEFT JOIN wp_term_taxonomy tt
                        ON t.term_id = tt.term_id
                        WHERE  t.`name` = '".esc_sql(trim($product_subcategory))."' AND tt.taxonomy = 'category'");
        $category_id = $get_category_details[0]->category_id;
	
//get product information from the product json file.
$json_data = @file_get_contents($json_file_url);
$decode_json =  json_decode($json_data, false);

//get product rank
$product_rank = '';
if($decode_json->bestviewsreviews_product_analysis->rank != ''
    && $decode_json->bestviewsreviews_product_analysis->rank != NULL
    && $decode_json->bestviewsreviews_product_analysis->rank != 'nan'){
    $product_rank = $decode_json->bestviewsreviews_product_analysis->rank;
}



//get score of the product
$product_score = '';
if($decode_json->bestviewsreviews_product_analysis->score_out_of_10 != ''
    && $decode_json->bestviewsreviews_product_analysis->score_out_of_10 != NULL
    && $decode_json->bestviewsreviews_product_analysis->score_out_of_10 != 'nan'){
    $product_score = $decode_json->bestviewsreviews_product_analysis->score_out_of_10;
}else{
	$product_score = '0';
}
//get no of products
$no_of_products = '';
if($decode_json->bestviewsreviews_product_analysis->num_products != '' 
        && $decode_json->bestviewsreviews_product_analysis->num_products != NULL
        && $decode_json->bestviewsreviews_product_analysis->num_products != 'nan'){
    $no_of_products = $decode_json->bestviewsreviews_product_analysis->num_products;
}else{
	$no_of_products = '0';
}
//get total reviews for this category.
$total_reviews_category = '';
if($decode_json->bestviewsreviews_product_analysis->total_reviews_category != ''
    &&  $decode_json->bestviewsreviews_product_analysis->total_reviews_category != NULL
    && $decode_json->bestviewsreviews_product_analysis->total_reviews_category != 'nan'){
    $total_reviews_category = $decode_json->bestviewsreviews_product_analysis->total_reviews_category;
}
else{
	$total_reviews_category = '0';
}
//get historical no of reviews
$total_reviews_entire_life = '';
if($decode_json->bestviewsreviews_product_analysis->total_reviews_entire_life != ''
        && $decode_json->bestviewsreviews_product_analysis->total_reviews_entire_life  != NULL
        && $decode_json->bestviewsreviews_product_analysis->total_reviews_entire_life != 'nan'){
    $total_reviews_entire_life = $decode_json->bestviewsreviews_product_analysis->total_reviews_entire_life;
}else{
	$total_reviews_entire_life = '0';
}
//get total reviews (last 6 months)
$total_reviews_last_6_months = '';
if($decode_json->bestviewsreviews_product_analysis->total_reviews_last_6_months != ''
    && $decode_json->bestviewsreviews_product_analysis->total_reviews_last_6_months != NULL
    &&  $decode_json->bestviewsreviews_product_analysis->total_reviews_last_6_months != 'nan'){
    $total_reviews_last_6_months = $decode_json->bestviewsreviews_product_analysis->total_reviews_last_6_months;
}else{
	$total_reviews_last_6_months = '0';
}
//get positive sentiment(last 6 months)

$reviews_positive_sentiment_last_6_months = '';
if($decode_json->bestviewsreviews_product_analysis->reviews_positive_sentiment_last_6_months != '' && 
    $decode_json->bestviewsreviews_product_analysis->reviews_positive_sentiment_last_6_months!= NULL &&
    $decode_json->bestviewsreviews_product_analysis->reviews_positive_sentiment_last_6_months != 'nan'){
	$reviews_positive_sentiment_last_6_months = $decode_json->bestviewsreviews_product_analysis->reviews_positive_sentiment_last_6_months;
}else{
	$reviews_positive_sentiment_last_6_months = '0';
}

$reviews_negative_sentiment_last_6_months = '';
if($decode_json->bestviewsreviews_product_analysis->reviews_negative_sentiment_last_6_months  != ''
    && $decode_json->bestviewsreviews_product_analysis->reviews_negative_sentiment_last_6_months!= NULL
    && $decode_json->bestviewsreviews_product_analysis->reviews_negative_sentiment_last_6_months!= 'nan'){
	$reviews_negative_sentiment_last_6_months = $decode_json->bestviewsreviews_product_analysis->reviews_negative_sentiment_last_6_months;
}else{
	$reviews_negative_sentiment_last_6_months = '0';
}
$percent_reviews_positive_sentiment_last_6_months = ''; 
if($decode_json->bestviewsreviews_product_analysis->percent_reviews_positive_sentiment_last_6_months  != ''
    && $decode_json->bestviewsreviews_product_analysis->percent_reviews_positive_sentiment_last_6_months!= NULL 
    && $decode_json->bestviewsreviews_product_analysis->percent_reviews_positive_sentiment_last_6_months!='nan %'){
	$percent_reviews_positive_sentiment_last_6_months = $decode_json->bestviewsreviews_product_analysis->percent_reviews_positive_sentiment_last_6_months;
}else{
	$percent_reviews_positive_sentiment_last_6_months = '0';
}
$percent_reviews_negative_sentiment_last_6_months = '';
if($decode_json->bestviewsreviews_product_analysis->percent_reviews_negative_sentiment_last_6_months  != ''
    && $decode_json->bestviewsreviews_product_analysis->percent_reviews_negative_sentiment_last_6_months!= NULL 
    && $decode_json->bestviewsreviews_product_analysis->percent_reviews_negative_sentiment_last_6_months!= 'nan %'){
	$percent_reviews_negative_sentiment_last_6_months = $decode_json->bestviewsreviews_product_analysis->percent_reviews_negative_sentiment_last_6_months;
}else{
	$percent_reviews_negative_sentiment_last_6_months = '0';
}
$percent_neutral_sentiment_reviews_last6_months='';
if($decode_json->bestviewsreviews_product_analysis->percent_neutral_sentiment_reviews_last6_months!= ''  &&
     $decode_json->bestviewsreviews_product_analysis->percent_neutral_sentiment_reviews_last6_months!= NULL 
     && $decode_json->bestviewsreviews_product_analysis->percent_neutral_sentiment_reviews_last6_months!= 'nan %'){
	$percent_neutral_sentiment_reviews_last6_months = $decode_json->bestviewsreviews_product_analysis->percent_neutral_sentiment_reviews_last6_months;
}else{
	$percent_neutral_sentiment_reviews_last6_months = '0';
}
//wordcloud images

$wordCloudImage = $decode_json->charts->word_cloud;
$product_image_url = $product->s3_image_url;
//check reviewTrend URL
if($decode_json->charts->reviewtrend !='' && $decode_json->charts->reviewtrend!=NULL){
    $reviewTrend = @file_get_contents($decode_json->charts->reviewtrend);
}

    $content =<<<CONTENT
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-9">
       <div class="left-section">
          <div class="row first-row">
             <div class="col-md-7">
                <div class="row">
                   <div class="col-md-3 small-slide">
                      <!-- <img src="images/slider-image-2.png"/>
                      <img src="images/slider-image-1.png"/>
                      <img src="images/slider-image-2.png"/>
                      <img src="images/slider-image-2.png"/> -->
CONTENT;
            if($product_image_url){                
                $content .=<<<CONTENT
                      <img src="$product_image_url"/>
CONTENT;
            }else {
               $content .=<<<CONTENT
                    $image_content
CONTENT;
                }
            $content .=<<<CONTENT
                   </div>
                   <div class="col-md-9 big_thumbnail">
CONTENT;
            if($image_content){
                $content .=<<<CONTENT
                    $image_content
CONTENT;
            }else{
              $content .=<<<CONTENT
                <img src="$product_image_url"/>
CONTENT;
           }
            $content .=<<<CONTENT
                   </div>
                </div>
             </div>
             <div class="col-md-5">
                <div class="row">
                   <div class="col-md-12">
                      <h5 class="slider-title">Review Trend</h5>
                      $reviewTrend
                   </div>
                   <div class="col-md-12"></div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <h5 class="slider-title-2">Sentiment Analysis</h5>
                      <p class="slider-right-section-2">From $total_reviews_entire_life total reviews</p>
                   </div>
                   <div class="col-xs-4 col-sm-4 col-md-4 stats-review">
                      <div class="up">
                         <img src="http://www.bestviewsreviews.com/wp-content/themes/BVR/images/up.png"/>
                      </div>
                      <div class="count">
                         <p>$reviews_positive_sentiment_last_6_months</p>
                      </div>
                      <div class="remark">
                         <p>Positive</p>
                      </div>
                   </div>
                   <div class="col-xs-4 col-sm-4 col-md-4 stats-review-middle">
                      <div class="up" style="padding-bottom:7px;">
                         <img src="http://www.bestviewsreviews.com/wp-content/themes/BVR/images/face.png"/>
                      </div>
                      <div class="count">
                         <p>$percent_neutral_sentiment_reviews_last6_months</p>
                      </div>
                      <div class="remark">
                         <p>Neutral</p>
                      </div>
                   </div>
                   <div class="col-xs-4 col-sm-4 col-md-4 stats-review">
                      <div class="up">
                         <img src="http://www.bestviewsreviews.com/wp-content/themes/BVR/images/down.png"/>
                      </div>
                      <div class="count">
                         <p>$reviews_negative_sentiment_last_6_months</p>
                      </div>
                      <div class="remark">
                         <p>Negative</p>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="row second-row">
             <div class="col-md-5" style="text-align:center;">
                <img src="http://www.bestviewsreviews.com/wp-content/themes/BVR/images/amazon.png" style="width:40%;">
             </div>
             <div class="col-md-3" style="text-align:center;">
CONTENT;
        if($product_msrp){
            $content .=<<<CONTENT
                <p class="cost">$ $product_msrp</p>
CONTENT;
          } else {
          $content .=<<<CONTENT
              <p class="cost">Buy Here</p>
CONTENT;
          }
          $content .=<<<CONTENT
          </div>
             <div class="col-md-4" style="text-align:center;">
                <a href="$buy_link" target="_blank" class="btn partner_button">Shop now</a>
             </div>
          </div>
          <div class="row third-row" style="display:none;">
             <div class="col-md-5" style="text-align:center;">
                <img src="images/walmart.png" style="width:40%;">
             </div>
             <div class="col-md-3" style="text-align:center;">
                <p class="cost">$349.99</p>
             </div>
             <div class="col-md-4" style="text-align:center;">
                <button type="button" class="btn partner_button">Shop now</button>
             </div>
          </div>
          <div class="row fourth-row">
             <div class="col-md-12">
                <table class="table table-responsive table-striped">
                    <tbody>
                    <tr>
                        <th>Rank (out of $no_of_products)</th>
                        <td>$product_rank</td>
                    </tr>
                    <tr>
                        <th>Score (out of 10)</th>
                        <td>$product_score</td>   
                    </tr>
                    <tr>
                        <th>Total Reviews in this Category</th>
                        <td>$total_reviews_category</td>    
                    </tr>
                    <tr>
                        <th>Total Reviews</th>
                        <td>$total_reviews_entire_life</td>   
                    </tr>
                    <tr>
                        <th>Recent Reviews (Last 6 Months)</th>
                        <td>$total_reviews_last_6_months</td>   
                    </tr>
                    <tr>
                        <th>Recent Reviews with Positive Sentiment</th>
                        <td>$reviews_positive_sentiment_last_6_months</td>
                    </tr>
                    <tr>
                        <th>Recent Reviews with Negative Sentiment</th>
                        <td>$reviews_negative_sentiment_last_6_months</td>
                     </tr>
                     <tr>
                        <th>Positive Sentiment</th>
                        <td>$percent_reviews_positive_sentiment_last_6_months</td>
                     </tr>
                     <tr>
                        <th>Negative Sentiment</th>
                        <td>$percent_reviews_negative_sentiment_last_6_months</td>
                    </tr>
                    <tr>
                        <th>Neutral Sentiment</th>
                        <td>$percent_neutral_sentiment_reviews_last6_months</td>
                    </tr>
                </tbody>
                </table>
             </div>
          </div>
          <div class="row fourth-row">
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="detail-text">
                   <p>$summary_text</p>
                </div>
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="detail-text">
CONTENT;
    if($decode_json->top_positive_reviews){
            foreach($decode_json->top_positive_reviews as $positive_review){
                $review_text = '';
                $positive_review_date = '';
                if($positive_review->positive_reviews != NULL && $positive_review->positive_reviews!= ''){
                    $review_text = $positive_review->positive_reviews;
                }
                if($positive_review->review_date != NULL && $positive_review->review_date != ''){
                    $pr_date = $positive_review->review_date;
                    $positive_review_date = $pr_date;
                } 
            $min++;
            if($min == 6) break;
            $content .=<<<CONTENT
               <blockquote>  
                <p>$review_text</p>
                </blockquote>
CONTENT;
        }
    }
    if($decode_json->top_negative_reviews){
        $min1=0;
        foreach($decode_json->top_negative_reviews as $bottom_review){
            $n_review_text = '';
            $negative_review_date = '';
            if($bottom_review->negative_reviews!= NULL && $bottom_review->negative_reviews != ''){    
                $n_review_text = $bottom_review->negative_reviews;
            }
            if($bottom_review->review_date != NULL && $bottom_review->review_date != ''){
                $nr_date = $bottom_review->review_date;
                $negative_review_date = $nr_date;
            }
            $min1++;
            if ($min1 == 6) break;
        $content .=<<<CONTENT
            <blockquote>  
                <p>$n_review_text</p>
            </blockquote>
CONTENT;
        }
    }
        $content .=<<<CONTENT
                </div>
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="detail-text">
                   <img src="$wordCloudImage" alt="$product_title" title="$product_title"/>
                </div>
             </div>
          </div>
CONTENT;

//get the randomly user list 
$get_user_list = $wpdb->get_results("SELECT ID from $wpdb->users ORDER BY RAND() LIMIT 1");
$author_id =  $get_user_list[0]->ID;

// create an array of data to use, this is basic - see other examples for more complex inserts
$data = array(  'title' => $product_title,
                'slug' => $product_title,
                'content' => $content, 
                'excerpt' => $product_title,
                'categories' => $category_id,
                'author'  => $author_id,
                 'status' => 'publish' );
$data_string = json_encode($data);
// echo $data_string; exit;
//the standard end point for posts in an initialised Curl
$process = curl_init('http://dev.bestviewsreviews.com/wp-json/wp/v2/posts');
// create the options starting with basic authentication
curl_setopt($process, CURLOPT_USERPWD, 'admin'.":".'Best@xy123');
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_POST, 1);
curl_setopt($process, CURLOPT_VERBOSE, 1);
curl_setopt($process, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
// make sure we are POSTing
curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
// this is the data to insert to create the post
curl_setopt($process, CURLOPT_POSTFIELDS, $data_string);

// allow us to use the returned data from the request
curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);

// process the request
$return = curl_exec($process);

curl_close($process);


$publish_post_metadata  =  json_decode($return, true);

$post_id =  $publish_post_metadata['id'];
if($post_id){
$update_product_table = $wpdb->query($wpdb->prepare("UPDATE bestviews.products SET wp_post_id=$post_id WHERE id=%s", $product_id));
}else{
	echo "No Product to publish";
}
//insert category
//wp_set_object_terms($post_id, ucfirst($product_category), 'category');
wp_set_object_terms($post_id, ucfirst($product_subcategory), 'category');
//updating the posts meta information of yoast.
$product_keywords = "$product_title reviews, $product_title analysis of reviews, $product_title ranking, $product_title rating";
$meta_description = $product_title." Best views Reviews combines the latest views and reviews and presents you an unbiased summary.";
update_post_meta($post_id, '_yoast_wpseo_title', $product_title);
update_post_meta($post_id, '_yoast_wpseo_focuskw', $product_keywords);
update_post_meta($post_id, '_yoast_wpseo_metadesc', $meta_description);
//set up the tags for this post.
wp_set_post_tags( $post_id, $prod_tags_list); // Set tags to Post

//end of setting up the tags.

if($update_product_table == true):
    echo "Post has been published and update the product table with their post ID : $post_id \n";
else:
    echo "Unable to publish this post \n";
endif;
} //end of looop
$wpdb->close();