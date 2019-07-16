	
<!--sidebar-->
<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="right-section">
		<?php
		global $post;
    //for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
    
    if ($tags) {
        $first_tag = $tags[0]->term_id;
        $args=array(
			'category__in' => wp_get_post_categories( $post->ID ), 
			'posts_per_page'  => 5, 
			'post__not_in' => array( $post->ID ) 
        );
        $my_query = new WP_Query($args);
        
        if( $my_query->have_posts() ) {
        ?>
		<h4 class="related_post_title">Related Post India</h4>
		<ul class="related_post">
			<?php
        while ($my_query->have_posts()) : $my_query->the_post(); 
        //get post images from product table
		$getImageDetails = $wpdb->get_results("SELECT * FROM bestviews.products WHERE wp_post_id = $post->ID and region = 'IND' ");
		if(isset($getImageDetails[0])){
        $getImageDetails = $getImageDetails[0];
        $post_image_url = $getImageDetails->image_snippet;
        $product_title = $getImageDetails->product_title;
        ?>
			<li>
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4 related_post_image">
							<?php echo $post_image_url; ?>
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
				}
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
				<h4>Other Categories</h4>
			</div>
			<?php
				$cat_args   = array(
					'orderby' => 'rand',
					'order' => 'ASC',
					'parent' => 24282
				);
				$related_categories = get_categories($cat_args);
				shuffle( $related_categories );
				$rel_categories = array_slice( $related_categories, 0, 2 );
			?>

			<div class="col-xs-12 col-sm-12 col-md-12">
			<?php foreach($rel_categories as $re_category) :
			//get the category images from the product_category table.
			$re_category_name = trim($re_category->name);
			$getCatQry = $wpdb->get_results("SELECT * FROM bestviews.product_category WHERE subcategory_name = '".esc_sql($re_category_name)."'");
			if(isset($getCatQry[0])) :
			$getCatImageUrl = $getCatQry[0]->transparent_image_url;
			?>
				<div class="related_category_item">
					<a href="<?php echo get_category_link($re_category->term_id); ?>">
						<div class="related_category_image">
						<?php if(isset($getCatImageUrl)) : ?>
							<img src="
								<?php echo $getCatImageUrl?>" alt="<?php echo $re_category_name ?>" title="<?php echo $re_category_name ?>" class="img img-responsive" heigh="183px" width="183px"/>
			 			<?php else: ?>
								<img src="<?php bloginfo('template_url'); ?>/images/no-image.jpg"/>
						<?php endif; ?>

							</div>
							<div class="related_category_title">
								<p><?php echo $re_category->name; ?></p>
							</div>
						</a>
					</div>
			<?php  endif; endforeach; ?>
				</div>
			</div> 
