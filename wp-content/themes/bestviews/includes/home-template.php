<?php
/* 
Template Name: Home Page Template
*/
get_header();
?>
<!-- over-lay container -->
<section class="container_overlay">
					<section class="section bvr_overlay">
                    </section>
                    <section class="section bvr_header">
                    <h1 class="site_description"><?php echo bloginfo('description'); ?></h1>
                    </section>
					<section class="bvr_inner_overlay">
							<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
					</section>

</section>

<div class="container">
    <div class="row">
            <?php
                $get_parent_cat =array(
                    'parent' => 0 //get the top level category
                );
                $all_categories = get_categories($get_parent_cat);
                foreach($all_categories as $single_category):
                     //for each category their ID
                     $catID = $single_category->cat_ID;   
                ?>
            <div class="category_box">
            <h4 class="text-center category_heading">
                <?php echo $single_category->name; ?>
            </h4>
            <div class="clearfix"></div>
            <ul class="list-group category_list">
            <?php
            //get the children category of this category
            $get_child_cat = array(
                "child_of" => $catID
            );
            $child_categories = get_categories($get_child_cat);
                foreach($child_categories as $childCategory):
                    $child_id = $childCategory->cat_ID;
                ?>
                <li class="list-group-item justify-content-between align-items-center subcategory">
                    <a href="<?php echo get_category_link($child_id); ?>" class="blocks-item-link"><?php echo $childCategory->name; ?></a>
                    <span class="badge badge-primary badge-pill post_count"><?php echo $childCategory->count; ?></span>
                </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
          
        </div>
</div>
<div class="clearfix"></div>
<?php
get_footer();
?>

