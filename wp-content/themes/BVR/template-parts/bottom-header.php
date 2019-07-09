<?php global $wpdb; ?>
<div class="main-first">
	<div class="container">
	<div class="row">
	<div class="col-md-6">
	<?php $first_product = $wpdb->get_results("SELECT * FROM bestviews.products  where wp_post_id != 0 ORDER BY rand() limit 1 "); 
			$first_product = $first_product[0];
			$first_product_post_id = $first_product->wp_post_id;
			//$first_product_post_id =  273;
			//get post informatiom from wordpress 
			$wp_post_info_first = $wpdb->get_results("SELECT wp.ID, u.ID as user_id, u.user_login FROM wp_posts wp
							  LEFT JOIN wp_users u ON u.ID = wp.post_author
							  WHERE wp.ID = $first_product_post_id");
			$wp_post_info_first = $wp_post_info_first[0];
			
			

		?>
		<div class="first_image" style="background:url('<?php bloginfo('template_url'); ?>/images/middle-image.jpg');background-position: center;background-size: cover;background-repeat: no-repeat;">
				<div class="row">
					<div class="first-middle-section">
						<div class="first-middle-section-content">
							<div class="col-xs-12 col-sm-12 col-md-12 category_btn">
								<button type="button" class="btn" style="margin:0px 12px;font-weight: 500;color: #ffffff;font-family: RubikMedium;background-color: #57a3f9;font-size: 13px;"><?php echo $first_product->subcategory; ?></button>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 product_middle_title">
								<h1 class="camera_title"><a href="<?php echo get_permalink($first_product_post_id); ?>"><?php echo substr($first_product->product_title, 0, 70); ?></a></h1>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								 <span class="inner-thumnbail-new">
								 <?php echo get_avatar( $wp_post_info_first->user_id ); ?>  </span>
								<!--	<img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg"> -->
								<span class="author_name"><?php echo ucfirst($wp_post_info_first->user_login); ?> </span>
								<span class="date-new"><?php echo get_the_date("M, Y", $first_product_post_id); ?></span>
							</div>
						</div>
					</div>
				
				</div>
	
		</div>
	</div>
	<div class="col-md-6">
	<?php $second_product = $wpdb->get_results("SELECT * FROM bestviews.products  where wp_post_id != 0 and wp_post_id != $first_product_post_id ORDER BY rand() limit 1 "); 
			$second_product = $second_product[0];
			$second_product_post_id = $second_product->wp_post_id;
		//	$second_product_post_id =  264;
			//get post informatiom from wordpress 
			$wp_post_info_second = $wpdb->get_results("SELECT wp.ID, u.ID as user_id, u.user_login FROM wp_posts wp
							  LEFT JOIN wp_users u ON u.ID = wp.post_author
							  WHERE wp.ID = $second_product_post_id");
			$wp_post_info_second = $wp_post_info_second[0];
			
			

		?>
	<div class="row">
	<div class="col-md-12">
	<div class="second_image" style="background:url('<?php bloginfo('template_url'); ?>/images/middle-image-2.jpg');background-position: center;background-size: cover;background-repeat: no-repeat;">
	<div class="row">
	<div class="second-middle-section">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<button type="button" class="btn" style="margin:0px 12px;font-weight: 500;color: #ffffff;font-family: RubikMedium;background-color: #57a3f9;font-size: 13px;"><?php echo $second_product->subcategory; ?></button>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h1 class="camera_title_new"><a href="<?php echo get_permalink($second_product_post_id); ?>"><?php echo substr($second_product->product_title,0, 70); ?></a></h1>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<span class="inner-thumnbail-new">
			<?php echo get_avatar( $wp_post_info_second->user_id ); ?> 
	</span>
			<!--	<img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg"> -->
	<span class="author_name"><?php echo ucfirst($wp_post_info_second->user_login); ?></span>
	
	<span class="date-new"><?php echo get_the_date("M, Y", $second_product_post_id); ?></span>
	</div>
	</div>
	
	</div>
	
	</div>
	</div>
	<div class="col-md-12">
	<?php $third_product = $wpdb->get_results("SELECT * FROM bestviews.products  where wp_post_id != 0 and wp_post_id != $first_product_post_id and wp_post_id != $second_product_post_id ORDER BY rand() limit 1 "); 
			$third_product = $third_product[0];
			$third_product_post_id = $third_product->wp_post_id;
		//	$third_product_post_id =  131;
			//get post informatiom from wordpress 
			$wp_post_info_thrid = $wpdb->get_results("SELECT wp.ID, u.ID as user_id, u.user_login FROM wp_posts wp
							  LEFT JOIN wp_users u ON u.ID = wp.post_author
							  WHERE wp.ID = $third_product_post_id");
			$wp_post_info_thrid = $wp_post_info_thrid[0];
			
			

		?>

	<div class="third_image" style="background:url('<?php bloginfo('template_url'); ?>/images/middle-image-2.jpg');background-position: center;background-size: cover;background-repeat: no-repeat;">
	<div class="row">
	<div class="third-middle-section">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<button type="button" class="btn" style="margin:0px 12px;font-weight: 500;color: #ffffff;font-family: RubikMedium;background-color: #57a3f9;font-size: 13px;"><?php echo $third_product->subcategory; ?></button>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h1 class="camera_title_new">
		<a href="<?php  echo get_permalink($third_product_post_id);?>"><?php  echo substr($third_product->product_title,0,70); ?></a></h1>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
	<span class="inner-thumnbail-new">
			<?php echo get_avatar( $wp_post_info_thrid->user_id ); ?> 
	</span>
			<!--	<img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg"> -->
	<span class="author_name"><?php echo ucfirst($wp_post_info_thrid->user_login); ?></span>
	</span>
	<span class="date-new"><?php echo get_the_date("M, Y", $third_product_post_id); ?></span>
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