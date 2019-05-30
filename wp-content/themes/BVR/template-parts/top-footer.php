<section>
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="stay_block">
	<h5>Stay up-to-date</h5>
	<p>Get notified about the latest Beach<br/> cruisers right in your inbox</p>
	<div class="form-group custome-form-group">
      <div class="input-group">
         <input type="email" class="form-control custome-input" placeholder="Your eamil address">
         <span class="input-group-btn">
         <button class="btn" type="submit" style="background-color: #57a3f9;color:#fff;">Subscribe now</button>
         </span>
          </div>
    </div>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="stay_block_new">
	<h5>Can’t find a product?</h5>
	<p>Submit the product’s URL on Amazon and we’ll tell you everything about the product</p>
	<span style="display:none" id="responseMsg"></span>
	<div class="form-group custome-form-group">
     <div class="input-group">
         <input type="text" class="form-control custome-input" id="amazon_product_url" placeholder="Product amazon url">
         <span class="input-group-btn">
         <button class="btn" type="button" id="getModelBox" style="background-color: #63ccac;color:#fff;" data-toggle="modal" data-target="#productModal">Submit URL</button>
         </span>
		  </div>
    </div>
	</div>
	</div>
	
	</div>
	
	</div>
	</section>

	 <!--  model dialog box start here -->
			<!-- Modal -->
			<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content stay_block_new ">
					<div class="modal-header" style="border-bottom:none;">
						<h5 class="modal-title" id="productModalLabel">Enter your Email</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-48px;">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="amazonProductForm" method="post">
					<div class="modal-body">
						<input type="hidden" name="a_product_url" id="a_product_url">
						<input type="hidden" name="action" value="prod_submit_action">
						<input type="email" class="form-control custome-input" name="user_email">
						<?php wp_nonce_field( 'prod_submit_action_nonce', 'amazon_product_submit' ); ?>
					</div>
					<div class="modal-footer" style="border-top:none;">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit your Request</button>
					</div>
					</form>
					</div>
				</div>
				</div>
		  <!-- model dialog ends here -->

		  
	<section class="related_category_new">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-12 related_category_new_title">
			<p>A cruiser bicycle, also known as a beach cruiser or (formerly) motobike, is a bicycle that usually combines balloon tires, an upright seating posture, a single-speed drivetrain, and straightforward steel construction with expressive styling. Cruisers are popular among casual bicyclists and vacationers because they are very stable and easy to ride, but their heavy weight and balloon tires tend to make them rather slow. They are designed for use primarily on paved roads, moderate speeds/distances, and are included in the non-racing/non-touring class and heavyweight or middleweight styles of the road bicycle type.</p>
			</div>
		</div>
	</section>
	
	<section class="related_category">
	<div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h4>Related Categories</h4>
	</div>
	</div>
	<?php
	$cat_args   = array(
		'orderby' => 'rand',
		'order' => 'ASC'
	);
	$categories = get_categories($cat_args);
	shuffle( $categories );
	$categories = array_slice( $categories, 0, 4 );
?>

	<div class="row">
		<?php foreach($categories as $category) : ?>
			<div class="col-xs-12 col-sm-12 col-md-3">
					<div class="related_category_item_main">
							<a href="<?php echo get_category_link($category->term_id); ?>">
							<div class="related_category_image">
							<img src="<?php bloginfo('template_url'); ?>/images/related-category-1.jpg">
							</div>
							<div class="related_category_title">
							<p><?php echo $category->name; ?></p>
							</div>
							</a>
					</div>
			</div>
		<?php endforeach; ?>
	</div>
	</div>
	</section>
