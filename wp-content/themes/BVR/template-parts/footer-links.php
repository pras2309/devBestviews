
<div class="footer-list">
		<div class="row">
			<div class="col-md-12 social_icons" style="display:none;">
				<a href="#" class="fa fa-facebook"></a>
				<a href="#" class="fa fa-twitter"></a>
				<a href="#" class="fa fa-youtube"></a>
				<a href="#" class="fa fa-instagram"></a>
			</div>
		</div>
		<div class="row">
			<div class="clearfix"></div>
		</div>
		<?php 
		//get all the parent categories
		$categories = get_categories(true);
		$count = 0;
		foreach($categories as $categoryList):
			//get all the parent categories of this category
			$subcategoryList = get_categories(array("parent"=>$categoryList->term_id));
			foreach($subcategoryList as $subcategory):
				if ($count % 4 ==0 && $count==0){
					$count = $count + 1;
			?>
				<div class="row">
			<?php } ?>
					<div class="col-xs-6 col-sm-6 col-md-3 footer_link">
						<a href="<?php echo get_category_link($subcategory->term_id); ?>"><?php echo $subcategory->name; ?></a>
					</div>
				<?php if ($count % 4 ==0){ ?>
				</div> <div class="row">
				<?php } ?>
		<?php 
			endforeach;
		endforeach; 
		if ($count % 4 !=0){
		?>
		</div>
		<?php } ?>
	</div>