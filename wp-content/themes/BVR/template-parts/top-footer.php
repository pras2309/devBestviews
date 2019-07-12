<section>
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="stay_block">
	<h5>Stay up-to-date</h5>
	<p>Get notified about the latest Beach<br/> cruisers right in your inbox</p>
	<img src="<?php bloginfo('template_url'); ?>/images/bg-inbox.png" class="stay_block_image"/>
	<div class="form-group custome-form-group">
      <div class="input-group">
         <input type="email" class="form-control custome-input" placeholder="Your email address">
         <span class="input-group-btn">
         <button class="btn stay_btn" type="submit" style="background-color: #57a3f9;color:#fff;  width: 112px;height: 40px;border-radius: 2px;">Subscribe now</button>
         </span>
          </div>
    </div>
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="stay_block_new">
	<h5>Can’t find a product?</h5>
	<?php get_template_part('template-parts/amazon-submit'); ?>
	
	</section>
		  
	<section class="related_category_new">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-12 related_category_new_title">
			<p>A cruiser bicycle, also known as a beach cruiser or (formerly) motobike, is a bicycle that usually combines balloon tires, an upright seating posture, a single-speed drivetrain, and straightforward steel construction with expressive styling. Cruisers are popular among casual bicyclists and vacationers because they are very stable and easy to ride, but their heavy weight and balloon tires tend to make them rather slow. They are designed for use primarily on paved roads, moderate speeds/distances, and are included in the non-racing/non-touring class and heavyweight or middleweight styles of the road bicycle type.</p>
			</div>
		</div>
	</section>
	<?php
	if(isset($_SESSION["recentlyViewed"]) && !empty($_SESSION["recentlyViewed"])){
	$criteria = (isset($_SESSION["recentlyViewed"])?implode(", ",$_SESSION["recentlyViewed"]):"-1");
	//get current post and store them into session.
	$getRecentViewedProduct = $wpdb->get_results("SELECT * FROM bestviews.products WHERE wp_post_id IN ($criteria)");
	?>
	<section class="related_category">
	<div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h4>Recently Viewed Products</h4>
	</div>
	</div>
	<div class="row">
	<?php  foreach($getRecentViewedProduct as $recentProduct): ?>
			<div class="col-xs-12 col-sm-12 col-md-3">
					<div class="related_category_item_main">
							<div class="related_category_image">
							<?php echo $recentProduct->image_snippet; ?>
							</div>
							<div class="related_category_title">
							<p><a href="<?php echo get_permalink($recentProduct->wp_post_id); ?>"><?php echo prepare_title($recentProduct->product_title); ?></a></p>
							</div>							
					</div>
			</div>
	<?php endforeach; ?>
	</div>
	</div>
	</section>
	<?php } ?>