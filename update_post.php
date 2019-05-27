<?php 
require_once 'wp-config.php';
global $wpdb;
$get_product = $wpdb->get_results("SELECT * FROM bestviews.products 
                    WHERE  subcategory_processed = 1 
                    AND (s3_output_url IS NOT NULL AND s3_output_url !='') 
                    AND s3_input_url IS NOT NULL  AND wp_post_id !=0
                    AND s3_input_url != 'www.abc.com'
                    AND post_update_flag !=1 ");

//read product information::::
  foreach($get_product  as $product){
	  //   echo $product->model;
      $content = '';
      $wp_post_id = $product->wp_post_id;
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
        if($product->s3_image_url != '' && $product->s3_image_url!= NULL){
        $prduct_image_url = $product->s3_image_url;
        }
        if($product->id){
        $product_id = $product->id;
        }
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
         $summary_text = '';
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
	//echo $category_id; exit;
//get product information from the product json file.
$json_data = @file_get_contents($json_file_url);
$decode_json = json_decode($json_data, false);
// print_r($decode_json); exit;
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
    $reviewTrend = str_replace('<html>', '', $reviewTrend);
    $reviewTrend = str_replace('<head>', '', $reviewTrend);
    $reviewTrend = str_replace('</head>', '', $reviewTrend);
    $reviewTrend = str_replace('<body>', '', $reviewTrend);
    $reviewTrend = str_replace('</body></html>', '', $reviewTrend);
}

if($summary_text) {
    $content =<<<CONTENT
            <p> $summary_text</p>
CONTENT;
}
    if($image_content){
        $content .=<<<CONTENT
            $image_content
           <a href="$buy_link" target="_blank">Buy Now!</a>
CONTENT;
}
    $content .=<<<CONTENT
            <h3>BVR Product Analysis:</h3>
            <table class="product_table1" width="1057">
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
            <p>
CONTENT;
if($wordCloudImage!= ''){
$content .=<<<CONTENT
        <img src="$wordCloudImage"  alt="$product_title" title="$product_title" class="img img-responsive" height="543" width="100%" alt="image not found"/>
CONTENT;
}
      if($reviewTrend){  
$content .=<<<CONTENT
        <br/> 
        $reviewTrend
        </p>
CONTENT;
}
    if($youtube_url){
    $content .=<<<CONTENT
        <p>
        <figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
            <div class="wp-block-embed__wrapper">
            $youtube_url
            </div>
        </figure>
        </p>
CONTENT;
}

if($decode_json->top_positive_reviews){
        //get all positive review of the product
        $min=0;
        $content .=<<<CONTENT
        <br/>
        <h4>Top Positive Reviews:</h4>
CONTENT;
	foreach($decode_json->top_positive_reviews as $positive_review){
		$review_text = '';
		$positive_review_date = '';
		if($positive_review->positive_reviews != NULL && $positive_review->positive_reviews!= ''){
			$review_text = $positive_review->positive_reviews;
		}
		if($positive_review->review_date != NULL && $positive_review->review_date != ''){
			$pr_date = strtotime($positive_review->review_date);
			$positive_review_date = date('M d, Y', $pr_date);
		}
                $min++;
                if($min == 6) break;
$content .=<<<CONTENT
            <blockquote>
            <strong>On: $positive_review_date</strong>
            <p style="font-style: italic;">$review_text</p>
            </blockquote>
CONTENT;

    }  //end of foreach for top reviews
} //end of if at positive review.
    //get all Negative review of the product
$content .=<<<CONTENT
<h4>Negative Reviews:</h4>
CONTENT;
if($decode_json->top_negative_reviews){
    $min1=0;
    foreach($decode_json->top_negative_reviews as $bottom_review){
	    $n_review_text = '';
	    $negative_review_date = '';
		if($bottom_review->negative_reviews!= NULL && $bottom_review->negative_reviews != ''){    
			$n_review_text = $bottom_review->negative_reviews;
		}
		if($bottom_review->review_date != NULL && $bottom_review->review_date != ''){
		    $nr_date = strtotime($bottom_review->review_date);
		    $negative_review_date = date('M d, Y', $nr_date);
		}
    $min1++;
    if ($min1 == 6) break;
    $content .=<<<CONTENT
        <blockquote>
        <strong>On: $negative_review_date</strong>
           <p style="font-style: italic;">$n_review_text</p>
           </blockquote>
    
CONTENT;

} //end of foreach for bottom reviews
} //end of if at negative review

// echo $content; exit;
//get the randomly user list 
$get_user_list = $wpdb->get_results("SELECT ID from $wpdb->users ORDER BY RAND() LIMIT 1");
$author_id =  $get_user_list[0]->ID;
// create an array of data to use, this is basic - see other examples for more complex inserts
$data = array(  
                'id'  => $wp_post_id,
                'title' => $product_title, 
                'slug' => $product_title,
                'content' => $content,
                'categories' => $category_id,
                'author'  => $author_id,
                 'status' => 'publish' );
                 
$data_string = json_encode($data);

// the standard end point for posts in an initialised Curl

$process = curl_init("http://bestviewsreviews.com/wp-json/wp/v2/posts/$wp_post_id");

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
//update the post_update_flag for product.

$results = $wpdb->query($wpdb->prepare("UPDATE bestviews.products SET post_update_flag=1 WHERE id=%d", $product_id));


//insert category
if($product_category == '' || $product_subcategory == ''){
wp_set_object_terms($wp_post_id, ucfirst($product_category), 'category');
wp_set_object_terms($wp_post_id, ucfirst($product_subcategory), 'category');
}
//updating the posts meta information of yoast.
$product_keywords = "$product_title reviews, $product_title analysis of reviews, $product_title ranking, $product_title rating";
$meta_description = $product_title." Best views Reviews combines the latest views and reviews and presents you an unbiased summary.";
update_post_meta($wp_post_id, '_yoast_wpseo_title', $product_title);
update_post_meta($wp_post_id, '_yoast_wpseo_focuskw', $product_keywords);
update_post_meta($wp_post_id, '_yoast_wpseo_metadesc', $meta_description);
//end of updating meta information.

//set up the tags for this post.
wp_set_post_tags( $wp_post_id, $prod_tags_list); // Set tags to Post

//end of setting up the tags.

//print_r(json_decode($return));
echo "POST ID ====> ".$wp_post_id." has been updated \n";
echo "*****************END***************************\n";
}
$wpdb->close();