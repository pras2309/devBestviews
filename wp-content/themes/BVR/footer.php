<footer class="footer">
	<div class="container footer_container">
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
				<p  class="footer_info">BestViewsReviews (BVR) analyzes and summarizes millions of user views and reviews on products and simplifies the purchase decision for you.</p>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 notify_div">
						<p>Get notified about the latest reviews right in your inbox</p>
					</div>
				 </div>
				 <div class="row">
					<div class="col-sm-12 col-md-5 subscription_div">
							<div class="input-group">
							<input type="email" class="subscribe_email form-control" placeholder="Your email address">
								<span class="input-group-btn" style="width:112px;height:40px;">
									<button class="btn" type="submit" style="width:112px;height:40px;border-radius:2px;background-color: #57a3f9;color:#fff;font-size:14px;font-weight:500;font-family:Rubik;line-height:1.29;text-align:center;">Subscribe</button>
								</span>
							</div>
						</div>
						<div class="col-sm-12 col-md-2">
							<select class="selectpicker" data-width="fit">
								<option data-content='<span class="flag-icon flag-icon-us"></span> USA'>USA</option>
								<option  data-content='<span class="flag-icon flag-icon-in"></span> India'>India</option>
							</select>
						</div>
						<div class="col-sm-12 col-md-5 footer_social_icon">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>

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
				
			$(function(){
				$('.selectpicker').selectpicker();
			});


			$(document).on('change', '.selectpicker', function(e){
			
				var region = $(this).val();
				if(region=='India'){
					$.cookie('region', 'India');
					window.location = '//dev.bestviewsreviews.com/in/';
					var region_cookie = $.cookie('region');
					$('.selectpicker option[value=="'+region_cookie+'"]').attr('selected','selected');
				} 
				if(region = 'USA'){
					$.cookie('region', 'USA');
					window.location = '//dev.bestviewsreviews.com/'
					var region_cookie = $.cookie('region');
					$('.selectpicker option[value="'+region_cookie+'"]').attr('selected','selected');
				}
			
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

			
			$("#compareProduct").click(function(){
				//alert("Awww You have clicked me! ");
			});

			//change text and href of region menu:
			$(".region").click(function(){
				alert("Welcome");
			});
			
		});


		$( "#product_one" ).autocomplete({
			source: function(request, response) {
					$.ajax({
				type:"GET",
				url: "/wp-json/product/product-list/",
				success: function(data) {
				response(data.map(function(val) {
				return {
					label: val.label,
					value: val.label,
					id : val.value
				}
				}));
				}
			});
			},
			change:function(event, ui){
				var product_id = ui.item.id;
				var product_name = ui.item.value;
				$.ajax({
					type:"POST",
					url: "/wp-json/product/product-info/",
					data: {"id":product_id, "product_name":product_name},
					success:function(response){
						var resp = response.responseText;
						console.log(resp);
						$("#product_one_details").html(resp);
						$("#product_one_details").css("display", "block");
					}
					
				});
			}

			
			});

			

		</script> 
<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

<!-- livezilla.net PLACE SOMEWHERE IN BODY -->
<!-- <script type="text/javascript" 
	id="lzdefsc" src="//bestviewsreviews.com/livezilla/script.php?id=lzdefsc" defer>
</script> -->
<!-- livezilla.net PLACE SOMEWHERE IN BODY -->
<?php wp_footer(); ?>
</body></html>
