<?php
/* 
Template Name: Category List Page
*/
get_template_part('home_header');
get_template_part('template-parts/top-header');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h3>All Popular Category</h3>
    <?php 
    $get_parent_cat =array(
        'parent' => 0 //get the top level category,
    );
    $count = 0;
    $all_categories = get_categories($get_parent_cat);
    foreach($all_categories as $single_category):
        //for each category their ID
        $catID = $single_category->cat_ID; 
        //get the children category of this category
        $get_child_cat = array(
            "child_of" => $catID
        );
        $child_categories = get_categories($get_child_cat);  
        foreach($child_categories as $subcategory):
            if ($count % 10 ==0 && $count==0){
                $count = $count + 1;
        ?>
            <div class="row">
            <?php } ?>
					<div class="col-xs-6 col-sm-6 col-md-3">
						<a href="<?php echo get_category_link($subcategory->term_id); ?>"><?php echo $subcategory->name; ?></a>
					</div>
                <?php if ($count % 10 ==0){ ?>
				</div> <div class="row">
				<?php } ?>
            <?php endforeach; ?>
            <?php endforeach; 
            if ($count % 10 !=0){
                ?>
                </div>
                <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>

