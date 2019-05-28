<!-- next and previous link for the products -->
<div class="row fifth-row">
			<div class="col-md-6">
            <?php $prevPost = get_previous_post(true); 
                if($prevPost){
                        $pre_post_id = $prevPost->ID;
                        $pre_post_title = $prevPost->post_title;
                        //now get the image from product table
                        $pre_image_details = $wpdb->get_results("SELECT s3_image_url FROM dev_bestviews.products WHERE wp_post_id = $pre_post_id");
                        $pre_image_details = $pre_image_details[0];
                        $pre_image_url = $pre_image_details->s3_image_url;
                        
                        ?>
						<div class="row">
									<div class="col-xs-5 col-sm-5 col-md-5 previous-section">
												<img src="<?php  echo $pre_image_url;?>" class="img-responsive" title="<?php echo $pre_post_title; ?>">
									</div>
								<div class="col-xs-7 col-sm-7 col-md-7 previous-section-content">
										<a href="<?php echo get_permalink($pre_post_id); ?>" class="previous-link-1"><h5><?php echo $pre_post_title; ?></h5></a>
										<a href="<?php echo get_permalink($pre_post_id); ?>" class="previous-link-2">Previous</a>
								</div>
                        </div>
                        <?php  } ?>
			</div>
			<div class="col-md-6">
                <?php 
                //get the next product link
                $nextPost = get_next_post(true);
                if($nextPost){
                $next_post_id = $nextPost->ID;
                $next_post_title = $nextPost->post_title;
                $next_image_details = $wpdb->get_results("SELECT s3_image_url FROM dev_bestviews.products WHERE wp_post_id = $next_post_id");
                $next_image_details = $next_image_details[0];
                $next_image_url = $next_image_details->s3_image_url;
                ?>
					<div class="row">
							<div class="col-xs-7 col-sm-7 col-md-7 next-section-content">
								<a href="<?php echo get_permalink($next_post_id);?>" class="next-link-1"><h5><?php echo $next_post_title; ?></h5></a>
								<a href="<?php echo get_permalink($next_post_id);?>" class="next-link-2">Next</a>
								<div class="clearfix"></div>
							</div>
							<div class="col-xs-5 col-sm-5 col-md-5 next-section">
									<img src="<?php echo $next_image_url; ?>" title="<?php echo $next_post_title; ?>" class="img-responsive">
							</div>
                    </div>
                <?php } ?>
			</div>
	</div> <!-- end of fifth row -->