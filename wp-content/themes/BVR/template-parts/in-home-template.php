<?php
/*
Template Name: India Home Page
*/
get_template_part('india_home_header');
get_template_part('template-parts/top-header');
get_template_part('template-parts/bottom-header');
?>
	<section class="main">
	<div class="container">
			<div class="row category_container">
					<div class="col-md-12">
						<div class="category_title">
							<h4>Popular Categories</h4>
						</div>
					</div>
			</div>
		
	<?php
    $count = 0;
	//get the children category of this category
	$get_child_cat = array(
		"child_of" => 24282
	);
    $child_categories = get_categories($get_child_cat);
    
	if ($count % 3 ==0 && $count==0){

		?>
		<div class="row">
		<?php
		}
	foreach($child_categories as $childCategory):
			if($childCategory->count > 0 ):
			$child_id = $childCategory->cat_ID;
			$count = $count + 1;
			//get 3 product from this subcategory
			$cate_products = $wpdb->get_results("SELECT * FROM dev_bestviews.products WHERE wp_post_id !=0 AND subcategory='".esc_sql($childCategory->name)."' AND rank <= 3 ORDER BY rank ASC");
			//get image of related category:
			$category_image_details = $wpdb->get_results("SELECT * FROM bestviews.product_category WHERE subcategory_name='".esc_sql($childCategory->name)."'");
			$firstProdImage = $category_image_details[0]->s3_category_img;
		?>
	
	<div class="col-xs-12 col-sm-12 col-md-4 product_rows">
		<div class="item-panel">
		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 item_panel_thumbnail" style="background-image:url('<?php echo $firstProdImage; ?>');">					
						<div class="item_panel_thumbnail_caption"> 
							<a href="<?php echo get_category_link($childCategory->term_id); ?>"><?php echo $childCategory->name; ?></a>
						</div>
				</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<ul class="main_item_panel_detail">
					<?php
					$i = 0;
				foreach($cate_products as $productInfo):	
					$product_id = $productInfo->id;
                                        $image_snippet_details = $wpdb->get_results("SELECT image_snippet FROM bestviews.products WHERE id=$product_id");
                                        $image_snippet = $image_snippet_details[0]->image_snippet;

						$i++;
					?>
					<li>
						<div class="row" style="height:76px;">
								<div class="col-xs-3 col-sm-3 col-md-3 home_product_image">
									<?php if ($productInfo->image_snippet &&  $productInfo->image_snippet!='.') :  ?>
										<?php echo $image_snippet; ?>
									<?php else : ?>
									<img src="<?php bloginfo('template_url'); ?>/images/no-image.png" height="56px" width="56px"/>	
									<?php endif; ?>
								</div>
								<div class="col-xs-9 col-sm-9 col-md-9">
								<a href="<?php echo get_permalink($productInfo->wp_post_id); ?>" class="main_item_link"><?php echo ucfirst($productInfo->product_title); ?></a>
								</div>
						</div>
						<?php if ($i <= 2): ?>
						<div class="divier"></div>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="display_all_product">
					<a href="<?php echo get_category_link($child_id);?>">View All <?php echo $productInfo->subcategory; ?></a>
					</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- end of item panel -->
	</div> <!-- end of col-4 -->
	<?php if ($count % 3 ==0){  ?>
		</div><div class="row">
	<?php } endif; endforeach; ?>
	 <!-- end of row -->
	 
	</div> <!-- end of container -->
	</section> <!-- end of section -->
	
	
	<section class="other_products_main">
	<div class="container">
	<?php get_template_part('template-parts/top-footer'); ?>
	<?php get_template_part('india-footer'); ?>
	
