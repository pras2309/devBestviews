<footer class="footer">
	<div class="container">
	<?php get_template_part('template-parts/india-footer-links'); ?>
	</div>
	<div class="container-fluid custome-fluid-container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 left-footer-text"></div>
			<div class="col-xs-12 col-sm-12 col-md-9 right-footer-text">
				<div class="footer_bottom_links">
					<ul>
						<?php wp_nav_menu(array("theme_location"=>"footer-menu-india")); ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<hr/>
				<p  class="footer_info">BestViewsReviews (BVR) analyzes and summarizes millions of user views and reviews on products and simplifies the purchase decision for you.</p>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 notify_div">
						<p>Get notified about the latest reviews right in your inbox</p>
					</div>
				 </div>
				 <div class="row">
					<div class="col-xs-12 col-sm-12 col-md-5 subscription_div">
							<div class="input-group">
							<input type="email" class="subscribe_email form-control" placeholder="Enter your email">
								<span class="input-group-btn">
									<button class="btn" type="submit" style="width:112px;height:40px;border-radius:2px;background-color: #57a3f9;color:#fff;">Subscribe</button>
								</span>
							</div>
						</div>
						<div class="col-md-2">
							
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 footer_social_icon">
							<ul>
								<li>
									<a href="https://www.facebook.com/BestViewsReviews/">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/BestViewsReview">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li>
									<a href="https://www.instagram.com/best_views_reviews/">
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
						<p>Best Views Reviews. All rights reserved</p>
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
<script src="<?php bloginfo('template_url'); ?>/js/jquery.prettytag.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.desoslide.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/demo.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.awesomeCloud-0.2.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/GaugeMeter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script>

$(window).load(function(){
	$.get("http://ip-api.com/json", function(response) {
			var countryCode = response.countryCode;     // "United States"
			if(countryCode == 'US'){
				document.cookie = "region=US";
			}

			if(countryCode == 'IN'){
				document.cookie = "region=IN";
			}
			}, "jsonp");
		});
			$(document).ready(function(){
				$(".GaugeMeter").gaugeMeter();
				
				$("#wordcloud1").awesomeCloud({
					"size" : {
						"grid" : 16,
						"normalize" : false
					},
					"options" : {
						"color" : "random-dark",
						"rotationRatio" : 0.25,
						"printMultiplier" : 3,
						"sort" : "random"
					},
					"font" : "'Times New Roman', Times, serif",
					"shape" : "square"
				});
				

			
				
			});


				$("#amazon_product_url").keyup(function(){
					if($(this).val().length>1){
						$("#getModelBox").attr("disabled",false);
						$("#getModelBox").css("opacity","1.0");
					}else{
						$("#getModelBox").attr("disabled",true);
						$("#getModelBox").css("opacity","0.4");
				}
				});


			$("#getModelBox").click(function(){
				//get value of amazon URL
				var a_url = $("#amazon_product_url").val();
					//now set up this value to hidden field into model box
					$("#a_product_url").val(a_url);
				
			});


			//submit the form of amazon product URL submission.


			$("#amazonProductForm").on('submit', function(e){
				e.preventDefault();
				var $form = $(this);
				var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
				$.ajax({
					url:ajaxurl,
					type:'post',
					data:$form.serialize(),
					success:function(res){
						// alert("Your Request has been submitted sucessfully");
						$("#responseMsg").html("Your Request has been submitted sucessfully");
						$("#responseMsg").css({"color":"white","font-weight":"bold"});
						$('#productModal').modal('toggle');
						$("#amazonProductForm")[0].reset();
					},
					error:function(res){
						$("#responseMsg").html("Unable to submit Your Request now, please try later. ");
						$("#responseMsg").css({"color":"red","font-weight":"bold"});
					},

				});
				
			});
			$(document).ready(function(){


			$("#asin_clipboard").click(function(){
				try
					{
						$('#asin_text').select();
						document.execCommand('copy');
					}
					catch(e)
					{
						alert(e);
					}
			});

			


			//copy for product uri
			$("#product_clipboard").click(function(){
				try
					{
						$('#product_url_text').select();
						document.execCommand('copy');
					}
					catch(e)
					{
						alert(e);
					}
			}); 
			

			$(".cloud-tags").prettyTag();
      
			$(".tags").prettyTag({
				randomColor: true,
				tagicon: false,
			
				});

			
		


			});

			

		</script> 
<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

<?php wp_footer(); ?>
</body></html>
