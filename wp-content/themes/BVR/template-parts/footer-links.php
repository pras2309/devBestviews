
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
		$categories = get_categories(array("parent"=>0, "number"=>40, "order"=>"ASC"));
		$count = 0;
		foreach($categories as $categoryList):
			//get all the parent categories of this category
				if ($count % 4 ==0 && $count==0){
					$count = $count + 1;
			?>
				<div class="row">
			<?php } ?>
					<div class="col-xs-6 col-sm-6 col-md-3 footer_link">
						<a href="<?php echo get_category_link($categoryList->term_id); ?>"><?php echo $categoryList->name; ?></a>
					</div>
				<?php if ($count % 4 ==0){ ?>
				</div> <div class="row">
				<?php } ?>
		<?php 
			endforeach;
		if ($count % 4 !=0){
		?>
		</div>
		<?php } ?>
	</div>
