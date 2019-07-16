<?php
/*
Template Name: Home Page Template
*/
get_template_part('home_header');
get_template_part('template-parts/top-header');
get_template_part('template-parts/bottom-header');
?>
	<section class="main">
	<div class="container">
			<div class="row">
					<div class="col-md-12">
						<div class="category_title">
							<h4>Popular Categories</h4>
						</div>
					</div>
			</div>
	
	<?php
	$get_parent_cat =array(
		'parent' => 0, //get the top level category,
		'number' => 9
	);
	$all_categories = get_categories($get_parent_cat);
	$count = 0;
	$colorCounter = 0;
	foreach($all_categories as $single_category):
		if($single_category->count > 0 ):
			//for each category their ID
			$catID = $single_category->cat_ID;
			$colorArray = array("#E74C3C","#E67E22","#F1C40F","#2ECC71","#16A085","#3498DB","#9B59B6","#34495E","#7F8C8D");

	?>
			
	<?php
	if ($count % 3 ==0 && $count==0){
		?>
		<div class="row">
		<?php
		}
			$count = $count + 1;
			
			//get 3 product from this subcategory
			$category_products = $wpdb->get_results("SELECT * FROM bestviews.products WHERE wp_post_id !=0  AND subcategory='".esc_sql($single_category->name)."' AND rank <=3 ORDER BY rank ASC");
			// print_r($category_products); exit;
			//get image of related category:
			$category_image_details = $wpdb->get_results("SELECT * FROM bestviews.product_category WHERE subcategory_name='".esc_sql($single_category->name)."'");
			$firstProdImage = $category_image_details[0]->s3_category_img;
		?>
	
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="item-panel">
		<div class="row">
			<?php
			for($x=0;$x<=3;$x++){
				$backgroundColor = $colorArray[$colorCounter+$x];
				if($colorCounter <= 3):
					$colorCounter = $colorCounter+1;
				else:
					$colorCounter = 0;
				endif;
			}
			
			?>
			<div class="col-xs-12 col-sm-12 col-md-12 item_panel_thumbnail" style="background-image:url('<?php echo $firstProdImage; ?>');">
							<div class="item_panel_thumbnail_caption"> 
									<a href="<?php echo get_category_link($single_category->term_id); ?>"><?php echo $single_category->name; ?></a>
							</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<ul class="main_item_panel_detail">
					<?php
					if(isset($category_products)):
						$firstProdImage = $category_products[0]->image_snippet;
					endif;
					$i = 0;
					
					foreach($category_products as $productInfo):	
						$i++;
						$title = $productInfo->product_title;
						$ex_title = explode(" ", $title);
						$character_counter = 0;
						$space_counter = 0;
						$product_title = '';
						foreach($ex_title as $k=>$v){
							if($character_counter + $space_counter + strlen($v) <= 64){
								$product_title .= $v." ";
								$a = strlen($v);
								$character_counter += $a;
								$space_counter +=1;

							}
						}
						// echo $product_title."<--- string ----> <br>";
						// echo $title;
						$tmp = $title." ";
						if (strcmp($product_title, $tmp) !== 0){
							$product_title = $product_title." ...";
						}

						// if(count($ex_title) > 6){
						// foreach($ex_title  as $k=>$v){
						// if($k <= 6){
						// 		$product_title .= $v." ";
						// 	}
						// }
						// $product_title =  $product_title."...";
						// }else{
						// 	$product_title = $title;
						// }
						
						// echo $product_title;
					?>
					<li class="product_row">
						<div class="row">
								<div class="col-xs-3 col-sm-3 col-md-3 home_product_image">
									<?php if ($productInfo->image_snippet && $productInfo->image_snippet != '.') :  ?>
									<?php echo $productInfo->image_snippet; ?>
									<?php else : ?>
									<img src="<?php bloginfo('template_url'); ?>/images/no-image.png" height="85px" width="80px"/>	
									<?php endif; ?>
								</div>
								<div class="col-xs-9 col-sm-9 col-md-9">
								<a title="<?php echo $title;  ?>" href="<?php echo get_permalink($productInfo->wp_post_id); ?>" class="main_item_link"><?php echo ucfirst($product_title); ?></a>
								</div>
						</div>
						<?php if ($i <= 2): ?>
						<div class="divier"></div>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="display_all_product">
					<a href="<?php echo get_category_link($catID);?>">View All <?php echo $productInfo->subcategory; ?></a>
					</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- end of item panel -->
	</div> <!-- end of col-4 -->
	<?php if ($count % 3 ==0){  ?>
		</div><div class="row home_product_row">
	<?php } endif; endforeach; ?>
	 <!-- end of row -->
	 
	</div> <!-- end of container -->
	</section> <!-- end of section -->
	
	
	<section class="other_products_main">
	<div class="container">	
	<?php get_template_part('template-parts/top-footer'); ?>
	<?php get_footer(); ?>
