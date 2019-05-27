<footer class="footer">
	<div class="container">
	<div class="footer-list">
		<div class="row">
			<div class="col-md-12 social_icons" style="display:none;">
				<a href="#" class="fa fa-facebook"></a>
				<a href="#" class="fa fa-twitter"></a>
				<a href="#" class="fa fa-youtube"></a>
				<a href="#" class="fa fa-instagram"></a>
			</div>
		</div>
		<div class="row">
			<div class="clearfix"></div>
		</div>
		<?php 
		//get all the parent categories
		$categories = get_categories(true);
		$count = 0;
		foreach($categories as $categoryList):
			//get all the parent categories of this category
			$subcategoryList = get_categories(array("parent"=>$categoryList->term_id));
			foreach($subcategoryList as $subcategory):
				if ($count % 4 ==0 && $count==0){
					$count = $count + 1;
			?>
				<div class="row">
			<?php } ?>
					<div class="col-xs-6 col-sm-6 col-md-3 footer_link">
						<a href="<?php echo get_category_link($subcategory->term_id); ?>"><?php echo $subcategory->name; ?></a>
					</div>
				<?php if ($count % 4 ==0){ ?>
				</div> <div class="row">
				<?php } ?>
		<?php 
			endforeach;
		endforeach; 
		if ($count % 4 !=0){
			
		?>
		</div>
		<?php } ?>
	</div>
	</div>
	<div class="container-fluid custome-fluid-container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 left-footer-text"></div>
			<div class="col-xs-12 col-sm-12 col-md-9 right-footer-text">
				<div class="footer_bottom_links">
					<ul>
						<?php wp_nav_menu(array("theme_location"=>"footer-menu")); ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<hr/>
				<p>BestViewsReviews (BVR) analyzes and summarizes millions of user views and reviews on products and simplifies the purchase decision for you.</p>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 notify_div">
						<p>Get notified about the latest reviews right in your inbox</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-7 subscription_div">
						<div class="input-group">
							<input type="email" class="form-control" placeholder="Enter your email">
								<span class="input-group-btn">
									<button class="btn" type="submit" style="background-color: #57a3f9;color:#fff;">Subscribe Now</button>
								</span>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 footer_social_icon">
							<ul>
								<li>
									<a href="#">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-instagram"></i>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-youtube"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="footer-lower-text-new">
						<p>Best Views Reviews.All rights are reserved </p>
					</div>
				</div>
			</div>
		</div>
		<p style="display:none;">
			<?php  echo "POST ID is:".$post->ID; ?>
		</p>
	</footer>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php wp_footer(); ?></body></html>