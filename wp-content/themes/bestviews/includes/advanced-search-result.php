<?php
require_once 'wp-config.php';
get_header();

if(isset($_GET['s']) && !empty($_GET['s'])){
   global $wpdb; 
    $keyword = $_GET['s'];
    if(strpos($keyword, '/dp/')){
    $keyword = explode('/dp/', $keyword);
    $keyword = explode('/', $keyword[1]);
    $asin = $keyword[0];
    }
    if(strpos($keyword, '/gp/product/')){
        $keyword = explode('/gp/product/', $keyword);
        $keyword = explode('/', $keyword[1]);
        $asin = $keyword[0];
    }
    
// Start the Query
if(isset($asin)){
    $selectDataQry = "SELECT * FROM bestviews.products WHERE product_uri LIKE '%".$asin."%'";
    $productResults = $wpdb->get_results($selectDataQry);
    if($wpdb->num_rows > 0){
    if($productResults[0]->id){
        $product_id = $productResults[0]->id;
    }
    if($productResults[0]->wp_post_id){
        $post_id = $productResults[0]->wp_post_id;
    }
    
    $product_title = '';
    if($productResults[0]->model){
        $product_title = str_replace('?', ' ', $productResults[0]->product_title);
    }else{
        $product_title = 'Product Name not avilable now.';
    }
    $product_category = '';
    if($productResults[0]->category){
        $product_category = $productResults[0]->category;
    }else{
        $product_category = 'Uncategorized';
    }
    $product_subcategory = $productResults[0]->subcategory;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 post-content">
        
                <div class="post-thumbnail">
                <?php
                 $get_image = $wpdb->get_results("SELECT product_title, s3_image_url FROM bestviews.products WHERE id=$product_id");
                 if($get_image){
                    ?>
                    <img src="<?php echo $get_image[0]->s3_image_url;?>" alt="<?php echo $get_image[0]->s3_image_url;?>" title="<?php echo $get_image[0]->s3_image_url;?>" class="img img-resonsive" />
                    <?php 
                        }
                        else {
                    ?>
                <img src="<?php bloginfo('template_url'); ?>/includes/images/no_thumb.jpg" />
                <?php
                        }
                        ?>        
                </div>
                <a href="<?php echo get_post_permalink($post_id);?>" class="post-title">
                <h2 class="bvr_post_title">
                    <?php  echo $product_title; ?>
                </h2>                    
                <p class="post-content">
                    <strong>In <?php echo $product_category; ?> >> <?php echo $product_subcategory; ?>  </strong>
                </p>
                </a>
        </div>
    </div>
    <hr/>
</div>
<?php
wp_reset_postdata();  
}
else{
    //if product not found in our database;
    //extract the product name or ASIN no from the URL.
    $url_param = $_GET['s'];
    if(strpos($url_param, '/dp/') !==false){
    $get_name = explode('/dp/', $url_param);
    $get_name=  explode('/', $get_name[1]);
    $prod_asin_no = $get_name[0];
    }
    if(strpos($url_param, '/gp/product/') !==false){
        $get_name = explode('/gp/product/', $url_param);
        $get_name=  explode('/', $get_name[1]);
        $prod_asin_no = $get_name[0];
    }
    
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 post_content">
        <h1 class="bvr_post_title"><strong>Product Name: </strong><?php echo $prod_asin_no; ?></h1>
            <!-- <p>
            Sorry, Unabel to find any product from searched URL, We will notify to you in future regarding this product.
            </p> -->
            <p>
            <!-- <strong>Thanks </strong> <br/>
            <span>Best Views Reviews Team</span> -->
            <?php 
                //insert into the product table
                $insertQuery = "INSERT INTO bestviews.product_url_info(product_url) VALUES('".$url_param."')";
                $wpdb->query($insertQuery);
                $lastid = $wpdb->insert_id;
                // create post object with the form values

                $bvr_post_args = array(

                    "post_title"    => $prod_asin_no,
                    
                    "post_content"  => $prod_asin_no,
                    
                    "post_status"   => "publish",
                    
                    "post_type" => 'post'
                    
                    );
                    
                    // insert the post into the database
                    
                $bvr_post_id = wp_insert_post( $bvr_post_args);
                $post_url =  get_permalink($bvr_post_id); 
                wp_redirect( $post_url, 301 ); exit;


            ?>
            </p>
        </div>
    </div>
</div>
<?php 
}
}
}
get_footer();
?>