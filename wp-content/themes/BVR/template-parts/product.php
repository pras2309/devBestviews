<?php get_header(); ?>
	</div>
	</div>

	<div class="header-new">
    <div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 breadcrumb">
	<?php if(function_exists('bcn_display') && !is_home() && !is_front_page())
		{
			bcn_display();
		}?>
	<!-- <ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li><a href="#">Home Audio</a></li>
	  <li><a href="#">Soundbars</a></li>
	  <li class="active">Samsung HW-J355 2.1 Channnel 120 Watt Wired Audio Soundbar</li>
	</ol> -->
	</div>
	</div>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php
	//now get the product information from the product table.
	$post_id = $post->ID;
	$prodResult = $wpdb->get_results("SELECT * FROM bestviews.products WHERE wp_post_id = $post_id");
	$prodResult = $prodResult[0];
	
	?>

	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
	<div class="title">
	<h1><?php the_title(); ?></h1>
	</div>
	<div class="soundbars">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">
	<?php the_category( ', ' ); ?>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-10">
	<span class="inner-thumnbail">
	<?php $author_id=$post->post_author; ?>
		<!-- <img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg"/>Samuil Sadovsky -->
		<img src="<?php echo the_author_meta( 'avatar' , $author_id ); ?> " class="avatar" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" />
		<?php ucfirst(the_author_meta( 'user_nicename' , $author_id )); ?>
	</span>
	<span class="date"><?php echo get_the_date('F j, Y');?></span>
	</div>
	</div>
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 winner_image">
					<?php if($prodResult->rank == 1){ ?>
								<img src="<?php bloginfo('template_url'); ?>/images/winner-new.png"/>
								<div class="winner">
												<div class="winner-content">
														<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
												</div>
												<div class="winner-footer">
														<p>Winner</p>
												</div>
								
								</div>
					<?php }  if($prodResult->rank == 2){ ?>
							<div class="second_winner">
												<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
												</div>
												<div class="remarkfirst-footer">
												<p>Best Value</p>
										</div>
					<?php 
					} if($prodResult->rank >= 3){
							?>
						<div class="second_winner">
															<div class="remarksecond-content">
															<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
															</div>
													
													</div>
					<?php } ?>
				</div> <!-- end of winner_image div -->

				<div class="col-xs-6 col-sm-6 col-md-6 score_image">
						<strong>Score</strong>
						<?php echo $prodResult->score_out_of_10; ?>
				</div>
	</div>
	</div>
	</div>
	</div>
	</div>

	<div class="main">
	<div class="container">
	<?php the_content(); ?>
	<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	<?php get_template_part('template-parts/next-previous') ?>
		<div class="row sixth-row">
			<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="review_block_new">
					<h5>Would you like us to review a product?</h5>
					<p>Submit the product’s URL on Amazon and we’ll tell you everything about the product</p>
								<div class="form-group custome-form-group">
										<div class="input-group">
											<input type="email" class="form-control custome-input" placeholder="Product amazon url">
											<span class="input-group-btn">
											<button class="btn" type="submit" style="background-color: #63ccac;color:#fff;">Submit URL</button>
											</span>
										</div>
								</div>
					</div>
			</div>
		</div>
	</div>
</div>
		<!-- sidebar would be here -->
		<?php get_sidebar(); ?>
	<!-- end of the sidebar -->
	</div>
	</div>
	</div>
 <?php get_footer(); ?>