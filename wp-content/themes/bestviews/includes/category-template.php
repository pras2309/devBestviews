<?php
/* 
Template Name: Category Template
*/
get_header();
?>
<style>
    #ajaxsearchlite1{
    position: absolute;
    margin-top:0px;
    width:auto;
}

.bv_prod_head{
    background-color:#21779e;
    color:#ffffff;"
}
@media only screen and (max-width:1500px){
    table, thead, tbody, th, td, tr {
    display: block;
  }
  thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
    background-color:#21779e !important;
    color:#ffffff !important;
  }
  tr { border: 1px solid #ccc; }
  td {
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left:100px;
    margin-left:100px;
    text-align:center;
  }
  td:before {
    position: absolute;
    top: 12px;
    left: 6px;
    width: 200px;
    padding-right: 40px;
    white-space: nowrap;
    margin-left:-100px;

  }
  td:nth-of-type(1):before { content: "Rank"; }
  td:nth-of-type(2):before { content: ""; }
  td:nth-of-type(3):before { content: "Product Name"; }
  td:nth-of-type(4):before { content: "Score";}   
  td:nth-of-type(5):before { content: "";}  
  .bvr_description{
      font-size:12px !important;
  } 
}
.pro{
    color:#000000;
}
</style>
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
$get_product_items  = $wpdb->get_results("SELECT * FROM bestviews.products WHERE subcategory = '".esc_sql($product_category)."' AND rank <= 10 AND wp_post_id !=0 ORDER BY rank ASC LIMIT 10 ");
$no_of_rows =  $wpdb->num_rows;

?>
<div class="container" <?php echo ($category_details->parent == 0 && $no_of_rows > 0) ? "style='display:none;'":''?>>
    <div class="row">
        <div class="col-md-12">
            <h3 class="bv_post_title">Top Trending Products</h3>
        </div>
    </div>
    <div class="row" style="padding-top:20px;">
        <div class="col-md-12">
            <table>
                <thead class="bv_prod_head">
                    <tr>
                        <th>Rank</th>
                        <th></th>
                        <th>Product Name</th>
                        <th>Score </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($get_product_items) { ?>
                    <?php $i = 1; ?>
                    <?php foreach ($get_product_items as $product_item) { ?>
                    <tr>
                        <td><?php echo $product_item->rank; ?></td>
                        <td>
                            <img src="<?php echo $product_item->image_url ?>" alt="<?php echo $product_item->product_title; ?>" title="<?php echo $product_item->product_title; ?>" class="img img-responsive" width="200" height="200"/>
                        </td>
                        <td class="bvr_post_title">
                            <a class="pro" href="<?php echo get_permalink($product_item->wp_post_id);?>" title = "<?php echo $product_item->product_title; ?>" ><?php echo $product_item->product_title; ?> </a>
                        </td>
                        <td>
                            <?php echo $product_item->score_out_of_10; ?> /10
                        </td>
                        <td>
                            <a href="<?php echo get_permalink($product_item->wp_post_id);?>" class="btn btn-sm btn-primary">View Product</a>
                        </td>

                    </tr>   
                    <?php $i++; ?>
                    <?php }} else {?>
                <tr>
                    <td colspan="5" style="text-align:center;">No Products found for this category: <strong><?php echo $category_name; ?></strong> </td>
                </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div> <!-- trending product section ends here -->

<?php
$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
$cat_id = get_queried_object_id();
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'cat' => $cat_id,
    'paged'=> $paged,
    "posts_per_page"=>9
);
$arr_posts = new WP_Query( $args );
?>
<div class="container">
    <div class="row">
    <?php
    if ( $arr_posts->have_posts() ) {
        while ( $arr_posts->have_posts() ){ 
            $arr_posts->the_post();
            ?>
            
        <div class="col-md-4 post-content">
            <div class="post-thumbnail">
                <?php
                 global $wpdb;
                 $get_image = $wpdb->get_results("SELECT product_title, image_url FROM bestviews.products WHERE wp_post_id=$post->ID");
                 if($get_image){
                    
            ?>
            <img src="<?php echo $get_image[0]->image_url;?>" alt="<?php echo $get_image[0]->product_title; ?>" title="<?php echo $get_image[0]->product_title; ?>"/>
            <?php 
                }
                else {
            ?>
        <img src="<?php bloginfo('template_url'); ?>/includes/images/no_thumb.jpg" />
        <?php
                }
                ?>
            </div>
            <h2 class="bvr_post_title"><a href="<?php the_permalink();?>" title="<?php echo $get_image[0]->product_title; ?>" class="post-title"><?php  the_title(); ?></a></h2>

            <!-- <p><?php //the_excerpt();?>
              <a href="<?php //the_permalink();?>" class="read-more">Read More</a>  
            </p> -->
        </div> <!-- end of col-md-4 -->
        <?php
    }
    ?>
    </div> <!--end of row -->
    <div class="pagination">
    <?php
    
    wp_pagenavi( array( 'query' => $arr_posts) );
    
    wp_reset_query();

    flush_rewrite_rules();
}


?>
</div>
</div>
