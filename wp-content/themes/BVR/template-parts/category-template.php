<?php 
/* 
Template Name: Category Landing Page
*/
get_header();
?>
</div>
</div>
<?php 
global $wpdb;
//get top trending product of this category
$category_details = get_queried_object();

$category_name = $category_details->name;

// echo "SELECT * FROM bestviews.products WHERE subcategory = '".$category_name."' AND rank <= 10 ORDER BY rank DESC LIMIT 10 ";
// exit;
//$product_category = str_replace('&amp;','&',$category_name);
//$product_category = str_replace("s'","'s",  $category_name);
$product_category = trim($category_name);

$get_product_items  = $wpdb->get_results("SELECT * FROM dev_bestviews.products WHERE subcategory = '".esc_sql($product_category)."' AND rank <= 10 AND wp_post_id !=0 ORDER BY rank ASC LIMIT 10 ");
$no_of_rows =  $wpdb->num_rows;
//get image of the first product in the list.
if(isset($get_product_items[0])){
	$image_url  = $get_product_items[0]->s3_image_url;
}
?>

	<section class="header-new">
    <div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 breadcrumb">
	<?php if(function_exists('bcn_display') && !is_home() && !is_front_page())
							{
								bcn_display(false);
							}?>
	<!-- <ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li><a href="#">All Categories</a></li>
	  <li><a href="#">Sports</a></li>
	  <li class="active">Cycles</li>
	</ol> -->
	</div>
	</div>
	 
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
	<div class="title">
	<h1>Top 10 <?php echo $product_category; ?></h1>
	</div>
	<div class="review_div_section" style="display:none;">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="review_scanned_div">
	<p class="review_scanned_div_title">Reviews Scanned</p>
	<p class="review_scanned_count"></p>
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="updated_div">
	<p class="updated_div_title">Updated on</p>
	<p class="updated_div_date"></p>
	</div>
	</div>
	</div>
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3" >
			<div class="row">
							<img src="<?php echo $image_url; ?>" class="img img-responsive category-image" />
					<!-- <div class="col-xs-6 col-sm-6 col-md-6 winner_image">
							<img src="<?php //bloginfo('template_url'); ?>/images/winner-new.png"/>
							<div class="winner">
								<div class="winner-content">
								<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;">1</span></p>
								</div>
								<div class="winner-footer">
								<p>Winner</p>
								</div>
							
							</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 score_image">
							<img src="<?php //bloginfo('template_url'); ?>/images/score.png"/>
					</div> -->
			</div>
	</div>
	</div>
	</div>
	</section>

	<article class="main-container">
	<div class="container">
	<?php if($get_product_items) { 
		$i  = 1; ?>	
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="product_score">
				<!-- category description -->
					<p></p>

			<div class="row" style="margin:0px;">
				<!-- product list start -->
			<?php foreach ($get_product_items as $product_item) {
				$prod_summary_url = $product_item->summary_url;
				$summary_text = @file_get_contents($prod_summary_url);
				?>
				<div class="product_list_row">
								<div class="col-xs-12 col-sm-12 col-md-1 rank_score">
									<?php if($i == 1) { ?>
													<div class="remark_image_winner">
																<img src="<?php bloginfo('template_url');?>/images/winner-new.png">
																
																<div class="remarkwinner">
																			<div class="remarkwinner-content">
																					<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $product_item->rank; ?></span></p>
																			</div>
																		<div class="remarkwinner-footer">
																				<p>Winner</p>
																		</div>
																
																</div>
													</div>
									<?php } if($i == 2 ) {?>
										<div class="remark_image_first">
											<div class="remarkfirst">
																<div class="remarkfirst-content">
																<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $product_item->rank; ?></span></p>
																</div>
																<div class="remarkfirst-footer">
																<p>Best Value</p>
																</div>
											
											</div>
									</div>
									<?php } if($i >= 3) {?>

										<div class="remark_image_second">
													<div class="remarksecond">
															<div class="remarksecond-content">
															<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $product_item->rank; ?></span></p>
															</div>
													
													</div>
										</div>
								
									<?php } ?>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-2 product_image">
								<?php echo $product_item->image_snippet; ?>
								</div>
								<div class="col-xs-10 col-sm-10 col-md-7 product_detail">
												<h4><a href="<?php echo get_permalink($product_item->wp_post_id);?>" title = "<?php echo $product_item->product_title; ?>" ><?php echo $product_item->product_title; ?></a></h4>
												<p><?php //echo substr($summary_text, 0, 300); ?></p>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2 product_detail_score">
											<div class="GaugeMeter" 
													data-percent="<?php echo intdiv(($product_item->score_out_of_10  * 100), 10); ?>" 
													data-label="Popular"  data-style="Arch" data-width="20"
													data-append="%" data-size="150"
													>
											</div>
										
								</div>
				</div> <!-- end of product list -->
				<hr/>
				<?php $i++; ?>
				<?php }} ?> 
				
				</div> <!-- end of row --> 
				</div> <!-- end of product score class -->
	
			</div>
		</div>
	
	</div>
    
	<!-- section for other products of the category -->
	<section class="other_products">
					<div class="container">
						<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
									<h4>Other Products</h4>
									</div>
						</div>
				<?php
				$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
				$cat_id = get_queried_object_id();
				$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'cat' => $cat_id,
						'paged'=> $paged,
						"posts_per_page"=>8
				);
				// print_r($args); exit;
				$arr_posts = new WP_Query( $args );
				?>


	<?php
    if ( $arr_posts->have_posts() ) {
		$count = 0;
        while ( $arr_posts->have_posts() ){ 
			$arr_posts->the_post();
			if($count %4 == 0 && $count ==0){
	?>		
	<div class="row">
	<?php } 
			$count = $count +1;
			?>
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="other_products_detail">
			<a href="<?php the_permalink();?>" title="<?php //echo $get_image[0]->product_title; ?>" class="post-title">
							<div class="row">
								<div class="col-xs-4 col-sm-4 col-md-4 other_products_image">
								<?php
	$get_image = $wpdb->get_results("SELECT product_title, s3_image_url, image_snippet FROM bestviews.products WHERE wp_post_id=$post->ID");
					if(isset($get_image[0])){
								$get_image = $get_image[0];
								 ?>
								<?php echo $get_image->image_snippet; ?>
									<?php } else{ ?>
								<img src="<?php bloginfo('template_url'); ?>/images/no-image.jpg" alt="no-image"/>
								<?php } ?>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-8">
									<h5 class="other_products_detail_title"><?php  the_title(); ?></h5>
								</div>
							</div>
			</a>
			</div>  <!-- end of other product details div -->
		</div> <!-- end of col-3 -->
		<?php if($count %4 == 0){ ?>
				   </div><div class="row">
					   
				<?php }}  } ?>
	 <?php
    
				// wp_pagenavi( array( 'query' => $arr_posts) );
				
				wp_reset_query();

				flush_rewrite_rules();
		?>
		<div class="pagination">
			<?php wp_pagenavi( array( 'query' => $arr_posts) ); ?>
		</div>`
		<!-- </div> -->
	</div>
	
	<?php get_template_part('template-parts/top-footer'); ?>
	<?php get_footer(); ?>
