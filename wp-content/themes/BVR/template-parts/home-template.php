<?php
/*
Template Name: Home Page Template
*/
get_template_part('home_header');
get_template_part('template-parts/top-header');
get_template_part('template-parts/bottom-header');
?>
	<section class="main">
	<div class="container">
			<div class="row">
					<div class="col-md-12">
						<div class="category_title">
							<h4>All Categories</h4>
						</div>
					</div>
			</div>
	
	<?php
	$get_parent_cat =array(
		'parent' => 0, //get the top level category,
		'number' => 10
	);
	$all_categories = get_categories($get_parent_cat);
	$count = 0;
	foreach($all_categories as $single_category):
			//for each category their ID
			$catID = $single_category->cat_ID;   
	?>
			
	<?php
	//get the children category of this category
	$get_child_cat = array(
		"child_of" => $catID,
		'number' => 4
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
			$cate_products = $wpdb->get_results("SELECT * FROM bestviews.products WHERE subcategory='".esc_sql($childCategory->name)."' LIMIT 3");
			//get image of first product 
			$firstProdImage = $cate_products[0]->s3_image_url;
			
			
		?>
	
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="item-panel">
		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 item_panel_thumbnail">
						<?php if($firstProdImage) : ?>
							<img src="<?php echo $firstProdImage; ?>"/>
						<?php else:  ?>
						<img src="<?php bloginfo('template_url'); ?>/images/no-image.png" width="360px" height="167px"/>	
						<?php endif; ?>
					
						<div class="item_panel_thumbnail_caption"> 
							<a href="<?php echo get_category_link($childCategory->term_id); ?>"><?php echo $childCategory->name; ?></a>
						</div>
				</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<ul class="main_item_panel_detail">
					<?php
					foreach($cate_products as $productInfo):
						
					?>
					<li>
					<div class="row">
							<div class="col-xs-3 col-sm-3 col-md-3">
								<?php if ($productInfo->s3_image_url) :  ?>
									<img src="<?php echo $productInfo->s3_image_url; ?>" class="img-responsive mobile-view-image" title="<?php //echo $productInfo->product_title; ?>">
								<?php else : ?>
								<img src="<?php bloginfo('template_url'); ?>/images/no-image.png" class="img img-resposinve mobile-view-image"/>	
								<?php endif; ?>
							</div>
							<div class="col-xs-9 col-sm-9 col-md-9">
							<a href="<?php echo get_permalink($productInfo->wp_post_id); ?>" class="main_item_link"><?php echo ucfirst($productInfo->product_title); ?></a>
							</div>
					</div>
					</li>
					<?php endforeach; ?>
				</ul>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="display_all_product">
					<a href="<?php echo get_category_link($child_id); ?>">Display all Products</a>
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
	<?php } endif; endforeach; endforeach; ?>
	 <!-- end of row -->
	 
	</div> <!-- end of container -->
	</section> <!-- end of section -->
	
	<section class="best_views_middle_content" style="display:none;">
	<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 logo_image">
	<img src="<?php bloginfo('template_url') ?>/images/star-middle.png"/>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 logo_image_content">
	<h4>BestViewsReviews (BVR) analyzes and summarizes millions of user views and reviews on products and simplifies the purchase decision for you.</h4>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="row">
	<div class="col-md-6">
	<div class="middle_first_image">
	<div class="row">
	<div class="first-middle-section">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<button type="button" class="btn" style="margin:0px 12px;font-weight: 500;color: #ffffff;font-family: RubikMedium;background-color: #57a3f9;font-size: 13px;">CAMERAS</button>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h1 class="camera_title"><a>Best Mirrorless Cameras: You can't go wrong with these</a></h1>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<span class="inner-thumnbail"><img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg">Carla Wildner</span>
	<span class="date">Apr 04,2019</span>
	</div>
	</div>
	
	</div>
	
	</div>
	</div>
	<div class="col-md-6">
	<div class="row">
	<div class="col-md-12">
	<div class="middle_second_image">
	<div class="row">
	<div class="second-middle-section">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<button type="button" class="btn" style="margin:0px 12px;font-weight: 500;color: #ffffff;font-family: RubikMedium;background-color: #57a3f9;font-size: 13px;">MOBILE &amp; ACCESSORIES</button>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h1 class="camera_title_new"><a href="#">Best Instant Cameras: Relive nostalgia with today's tech</a></h1>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<span class="inner-thumnbail-new"><img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg">Carla Wildner</span>
	<span class="date-new">Apr 04,2019</span>
	</div>
	</div>
	
	</div>
	
	</div>
	</div>
	<div class="col-md-12">
	<div class="middle_third_image">
	<div class="row">
	<div class="second-middle-section">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<button type="button" class="btn" style="margin:0px 12px;font-weight: 500;color: #ffffff;font-family: RubikMedium;background-color: #57a3f9;font-size: 13px;">MOBILE &amp; ACCESSORIES</button>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h1 class="camera_title_new"><a href="#">The iWatch 3 series : Is the best wearable out in the market?</a></h1>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<span class="inner-thumnbail-new"><img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg">Carla Wildner</span>
	<span class="date-new">Apr 04,2019</span>
	</div>
	</div>
	
	</div>
	
	</div>
	</div>
	</div>
	</div>
	</div> 

	</div>
	
	</div>
	</section>
	
	<section class="other_products_main" style="display:none;">
	<div class="container">
	
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-1.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Cruiser Bikes</p>
	</div>
	</a>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-2.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Covers</p>
	</div>
	</a>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-3.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Coolers</p>
	</div>
	</a>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-4.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Chairs</p>
	</div>
	</a>
	</div>
	</div>
	
	
	</div>
	
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-1.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Cruiser Bikes</p>
	</div>
	</a>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-2.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Covers</p>
	</div>
	</a>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-3.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Coolers</p>
	</div>
	</a>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="related_category_item_main">
	<a href="#">
	<div class="related_category_image_main">
	<img src="<?php bloginfo('template_url'); ?>/images/related-category-4.jpg">
	</div>
	<div class="related_category_title_main">
	<p>Beach Chairs</p>
	</div>
	</a>
	</div>
	</div>
	</div>
	
	<?php get_template_part('template-parts/top-footer'); ?>
	<?php get_footer(); ?>
