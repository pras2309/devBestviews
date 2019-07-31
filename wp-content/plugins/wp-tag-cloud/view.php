<?php 
global $wpdb;
$post_id = $atts['post_id'];

// $post_id = 9010;
$getProductQry = $wpdb->get_results("SELECT id  FROM bestviews.products WHERE wp_post_id =  $post_id");
$product_id = $getProductQry[0]->id;
$getTagsQry = $wpdb->get_results("SELECT id, word_freq  FROM bestviews.products WHERE id =  $product_id");
if (isset($getTagsQry[0])):
   $prod_feature_url = trim($getTagsQry[0]->word_freq);
   $product_id = $getTagsQry[0]->id;
   $features_collection_json = @file_get_contents($prod_feature_url);
   $features_collection = json_decode($features_collection_json, true);
   unset($features_collection['total_number_of_reviews']);
   /* $feature_data = "[".$prod_feature."]";
   $feature_data = str_replace("'", '"', $feature_data);
	$feature_data = json_decode($feature_data, true);
   $feature_data = $feature_data[0];
   // print_r($feature_data);exit; */
   
?>
<ul class="cloud-tags">
   <?php 
      foreach($features_collection as $k=>$v):
   ?>
   <li>
   <a href="#" style="pointer-events: none; cursor: default;">
   <?php echo ucfirst($k);?>
   </a>
    </li>
   <?php endforeach; endif; ?>
</ul>
