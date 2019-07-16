<?php
/*
Template Name: Submit Affiliate
*/
get_header();
require_once 'wp-config.php';
$getProductDetails = $wpdb->get_results("SELECT * FROM bestviews.products WHERE affiliate_in_process != 1  AND product_uri LIKE '%amazon%' ORDER BY rand() LIMIT 1");
$product_asin_code  = $getProductDetails[0]->asin_code;
$product_id  = $getProductDetails[0]->id;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Submit Affiliate Link for Product</h1>
            <?php if(@$_GET['result'] == 'success'){
             ?>   
            <p style="color:green;font-weight:bold">Proudct information has been updated. </p>
            <?php } if (@$_GET['result'] == 'failed'){ ?>
                <p style="color:red;font-weight:bold">Unable to Update Proudct information </p>       
            <?php } ?>
            <form action="/link-submit.php" method="post"  style="margin-top:20px;">
            <input type="hidden" value="BuyLinkAffiliate" name="buyLink"/>
            <input type="hidden" value="<?php echo $product_id; ?>" name="bvr_prod_id"/>
            <p>
            ASIN No. <input type="text" id="asin_text" readonly="readonly" value="<?php echo $product_asin_code; ?>" name="prod_asin"/>  
            <input class="btn btn-danger btn-sm" style="display:inline-block;margin-top:10px;background:red;" 
            type="button" id="asin_clipboard" value="Copy"/>
            </p>
            <p>
            Buy Link: <input type="text" name="buy_url" placeholder="Enter Amazon Buy Link" required="required"/>
            </p>

            <p>
            Enter Image Snippet: <textarea name="image_snippet" cols="20" rows="10" required="required"></textarea>
            </p>
            <p>
               <input type="submit" name="submit" value="Submit" /> 
            </p>
            </form>
        </div>
    </div>
</div>
<?php

get_footer();
?>

