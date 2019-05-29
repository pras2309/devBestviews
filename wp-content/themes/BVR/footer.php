<footer class="footer">
	<div class="container">
	<?php get_template_part('template-parts/footer-links'); ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.desoslide.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/demo.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.awesomeCloud-0.2.js"></script>
<script>
			$(document).ready(function(){
				$("#wordcloud1").awesomeCloud({
					"size" : {
						"grid" : 16,
						"normalize" : false
					},
					"options" : {
						"color" : "random-dark",
						"rotationRatio" : 0.35,
						"printMultiplier" : 3,
						"sort" : "random"
					},
					"font" : "'Times New Roman', Times, serif",
					"shape" : "square"
				});
				
			});
		</script> 
<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->


<?php wp_footer(); ?></body></html>