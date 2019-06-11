<?php 
global $wpdb;
$post_id = $atts['post_id'];
//$post_id = 9010;
$getTagsQry = $wpdb->get_results("SELECT id, es_id, product_feature FROM dev_bestviews.products WHERE wp_post_id =  $post_id");
$prod_feature = $getTagsQry[0]->product_feature;
$product_id = $getTagsQry[0]->id;
$prod_es_id = $getTagsQry[0]->es_id;
$feature_list = explode(',', $prod_feature);
?>
<ul class="cloud-tags">
   <?php 
      foreach($feature_list as $feature ) : 
      $feature = str_replace('{', '', $feature);
      $feature = str_replace('}', '', $feature);
      $feature = str_replace("'", '', $feature);
   ?>
      <li><a href="/tag-template?product=<?php echo $product_id;?>&keyword=<?php echo $feature;?>&code=<?php echo $prod_es_id; ?>" target="_blank"><?php echo ucfirst($feature);?></a> </li>
   <?php endforeach; ?>
</ul>
