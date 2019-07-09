<?php 
/* 
Template Name: Compare Product
*/
get_header();
//get default product information:
    $prod_id = $_GET['item'];
    
    $prodDetails = $wpdb->get_results("SELECT image_snippet,s3_gsm_input_uri FROM bestviews.products where id = $prod_id");
    if(isset($prodDetails[0])):
        $prodDetailsJson = @file_get_contents($prodDetails[0]->s3_gsm_input_uri);
        $product_image = $prodDetails[0]->image_snippet;
    else:
        return false;
    endif;
    $product_one = json_decode($prodDetailsJson, true);
    
?>
</div>
</div>
<div class="container" style="margin-top:40px;">
    <div class="row">
        <div class="col-md-12">
            <h1>Compare the product</h1>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
    <table class="table table-hover">
            <tr>
                <td></td>
                <td></td>
                <td>
                  <p>Search Product: <input type='text' id='product_one'  class="form-control"></p>
                </td>
                <td>
                  <p>Search Product: <input type='text' id='product_two' class="form-control"></p>
                </td>
                <td>
                   <p>Search Product: <input type='text' id='product_three' class="form-control" ></p>
                </td>
            </tr>
            <!-- list product information. -->
            <!-- product title -->
            <tr class="product_info">
                <td></td>
                <td></td>
                <td>
                    <h3 class="product_title"><?php echo $product_one[0]['general']['model']; ?></h3>
                </td>

                <td>
                    <h3 class="product_title"><?php echo $product_one[0]['general']['model']; ?></h3>
                </td>

                <td>
                    <h3 class="product_title"><?php echo $product_one[0]['general']['model']; ?></h3>
                </td>
            </tr>
            <!-- product image -->
            <tr class="product_image_details">
                <td></td>
                <td></td>
                <td>
                <?php echo $product_image;?>
                </td>
                <td>
                <?php echo $product_image;?>
                </td>
                <td>
                <?php echo $product_image;?>
                </td>
            </tr>
            <!-- product specification -->
            <?php 
            
                foreach($product_one[0]['other'] as $product_specification): 
                        //get no of nodes in other
                        $type = $product_specification['type'];


                    ?>
            <tr>
                <td><?php echo $type; ?></td>
                <td><?php echo $product_specification['label'];?></td>
                <td><?php echo $product_specification['value']; ?></td>
                <td><?php echo $product_specification['value']; ?></td>
                <td><?php echo $product_specification['value']; ?></td>
            </tr>
            <?php endforeach; ?>

            <!-- end of product information. -->
    </table>
    </div>
    <!-- <div class="col-md-12">
        <div class="col-md-4">
            <div id="product_one_details">
            </div>
        </div>

        <div class="col-md-4">
            <div id="product_two_details" style="display:none;"> </div>
        </div>

        <div class="col-md-4">
            <div id="product_three_details" style="display:none;"> </div>
        </div>
    </div> -->

</div>
</div>

<?php get_footer(); ?>