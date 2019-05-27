	
<!--sidebar-->
<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="right-section">
		<?php
    //for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
    
    if ($tags) {
        $first_tag = $tags[0]->term_id;
        $args=array(
        'tag__in' => array($first_tag),
        'post__not__in' => array($post->ID),
        'posts_per_page'=>5,
       // 'caller_get_posts'=>1
        );
        $my_query = new WP_Query($args);
        
        if( $my_query->have_posts() ) {
        ?>
		<h4 class="related_post_title">Related Post</h4>
		<ul class="related_post">
			<?php
        while ($my_query->have_posts()) : $my_query->the_post(); 
        //get post images from product table
        $getImageDetails = $wpdb->get_results("SELECT * FROM bestviews.products WHERE wp_post_id = $post->ID");
        $getImageDetails = $getImageDetails[0];
        $post_image_url = $getImageDetails->s3_image_url;
        $product_title = $getImageDetails->product_title;

        
        ?>
			<li>
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4">
						<img src="
							<?php echo $post_image_url; ?>" title="
							<?php echo $product_title; ?>" class="img-responsive mobile-view-image" height="100" width="100">
						</div>
						<div class="col-md-8">
							<a href="
								<?php the_permalink() ?>" rel="bookmark"  style="text-decoration:none;cursor:pointer;">
								<h5 class="related_post_link_title">
									<?php the_title(); ?>
								</h5>
							</a>
						</div>
					</div>
				</li>
				<?php
            endwhile;
            }
            wp_reset_query();
            }
            ?>
				<!-- <li><div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><img src="
				<?php //bloginfo('template_url'); ?>/images/related-post-image-2.png" class="img-responsive mobile-view-image"></div><div class="col-md-8"><a href="#" style="text-decoration:none;cursor:pointer;"><h5 class="related_post_link_title">Nakamichi Shockwafe Pro 7.1ch DTSX600W Sound Bar</h5></a></div></div></li><li><div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><img src="
				<?php //bloginfo('template_url'); ?>/images/related-post-image-3.png" class="img-responsive mobile-view-image"></div><div class="col-md-8"><a href="#" style="text-decoration:none;cursor:pointer;"><h5 class="related_post_link_title">Nakamichi Shockwafe Pro 7.1ch DTSX600W Sound Bar</h5></a></div></div></li><li><div class="row"><div class="col-xs-4 col-sm-4 col-md-4"><img src="
				<?php //bloginfo('template_url'); ?>/images/related-post-image-4.png" class="img-responsive mobile-view-image"></div><div class="col-md-8"><a href="#" style="text-decoration:none;cursor:pointer;"><h5 class="related_post_link_title">Nakamichi Shockwafe Pro 7.1ch DTSX600W Sound Bar</h5></a></div></div></li> -->
			</ul>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 related_tag_sidebar">
				<h4>Related Categories</h4>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="related_category_item">
					<a href="#">
						<div class="related_category_image">
							<img src="
								<?php bloginfo('template_url'); ?>/images/related-category-1.jpg"/>
							</div>
							<div class="related_category_title">
								<p>Beach Cruiser Bikes</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="related_category_item">
						<a href="#">
							<div class="related_category_image">
								<img src="
									<?php bloginfo('template_url'); ?>/images/related-category-2.jpg"/>
								</div>
								<div class="related_category_title">
									<p>Beach Covers</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>