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
	$prodResult = $wpdb->get_results("SELECT * FROM dev_bestviews.products WHERE wp_post_id = $post_id");
	$prodResult = $prodResult[0];
	$product_id = $prodResult->id;
	
	?>

	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
	<div class="title">
	<h1><?php the_title(); ?></h1>
	</div>
	<div class="soundbars">
	<div class="row">
	<div class="col-sm-12 col-md-4">
		<!-- <span class="category_name"><?php //echo get_the_category($post->ID)[0]->name; ?></span> -->
		<button type="button" class="btn" style="font-weight: 500;color: #ffffff;font-family:Rubik;background-color: #57a3f9;font-size: 13px;"><?php echo get_the_category($post->ID)[0]->name;?> </button>
	</div>
	<div class="col-sm-12 col-md-8 category_thumbnail">
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
														<p><span class="rank_number">#</span> <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: Rubik;height:28px;width:10px;"><?php echo $prodResult->rank; ?></span></p>
												</div>
												<div class="winner-footer">
														<p>Winner</p>
												</div>
								
								</div>
					<?php }  if($prodResult->rank == 2){ ?>
							<div class="second_winner">
												<p><span class="rank_number">#</span> <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
												</div>
												<div class="remarkfirst-footer-product">
												<p>Best Value</p>
										</div>
					<?php 
					} if($prodResult->rank >= 3){
							?>
						<div class="second_winner">
															<div class="remarksecond-content">
															<p><span class="rank_number">#</span> <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
															</div>
													
													</div>
					<?php } ?>
				</div> <!-- end of winner_image div -->

				<div class="col-xs-6 col-sm-6 col-md-6 score_image">
						<div class="GaugeMeter" 
													data-percent="<?php echo intdiv(($prodResult->score_out_of_10  * 100), 10); ?>" 
													data-label="Popular"  data-style="Arch" data-width="20"
													data-append="%" data-size="150"
													>
						</div>

				</div>
	</div>
	</div>
	</div>
	</div>
	</div>

	<div class="main">
	<div class="container">
	<?php the_content(); ?>
	<?php 
	//get product feature and their count
	/* $feature_details = $wpdb->get_results("SELECT id, word_freq, es_id FROM bestviews.products WHERE wp_post_id = $post->ID");
	if(isset($feature_details[0])):
			$feature_details = $feature_details[0];
			$product_id = $feature_details->id;
			$es_code = $feature_details->es_id;
			$feature_data = $feature_details->word_freq;
			$feature_data = "[".$feature_data."]";
			$feature_data = str_replace("'", '"', $feature_data);
			$feature_data = json_decode($feature_data, true);
			if(isset($feature_data[0])): */
			echo do_shortcode('[multicolor-tag-cloud post_id="'.$post->ID.'"]');
	?>
		<!-- <div id="wordcloud1" class="wordcloud"  style="width:300px; height: 200px;">
		<?php			
				//$feature_data = $feature_data[0];
				//foreach($feature_data as $key => $value):
		?>
			<span data-weight="<?php // echo $value ?>"><?php //echo $key; ?></span>
		<?php
				//endforeach;
		?>
	</div> -->
		<?php	
			//endif;
	//endif;		
	?>
	<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	<hr/>
	<?php
	//setting up recently viewed products
	if(!isset($_SESSION['recentlyViewed'])){
		$_SESSION['recentlyViewed']  = array();		
	}
	#no of product want to display
	$noOfProduct = 4;
	//store the current product into session list of recently viewed.
	if(isset($post->ID) && $post->ID <> ""){
		if (in_array($post->ID, $_SESSION["recentlyViewed"])) { // if product id is already in the array
			$_SESSION["recentlyViewed"] = array_diff($_SESSION["recentlyViewed"],array($post->ID)) ; // remove it
			$_SESSION["recentlyViewed"] = array_values($_SESSION["recentlyViewed"]); //optionally, re-index the array
		}
		if(count($_SESSION['recentlyViewed']) >= $noOfProduct ){
			$_SESSION["recentlyViewed"] = array_slice($_SESSION["recentlyViewed"],1);
			array_unshift($_SESSION["recentlyViewed"],$post->ID);
		}else{
			array_unshift($_SESSION["recentlyViewed"],$post->ID);	
		}	
	}
	?>
	<?php get_template_part('template-parts/next-previous') ?>
		<div class="row sixth-row">
			<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="review_block_new">
					<h5>Would you like us to review a product?</h5>
					<?php get_template_part('template-parts/amazon-submit-product'); ?>
			</div>
		
	
		<!-- sidebar would be here -->
		<?php
		$category = get_the_category(); 
		$category_parent_id = $category[0]->category_parent;
		//palce the category id of india.
		if($category_parent_id == 24282){
			
			get_template_part('template-parts/india-sidebar');
		}else{
		get_sidebar(); 
		}
		?>
	<!-- end of the sidebar -->
	</div>
	</div>
	</div>
 <?php
		get_footer();
?>

