<?php
/*
Template Name: Submit Affiliate
*/
get_header();
require_once 'wp-config.php';
$getProductDetails = $wpdb->get_results("SELECT * FROM bestviews.products WHERE asin_code IS NOT NULL  AND region = 'IND' ORDER BY rand() LIMIT 1");
$product_asin_code  = $getProductDetails[0]->asin_code;
$product_id  = $getProductDetails[0]->id;
$product_url = $getProductDetails[0]->product_uri;
if(isset($product_asin_code)){
?>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Submit Affiliate Link for Product</h1>
            <?php if(@$_GET['result'] == 'success'){
             ?>   
            <p style="color:green;font-weight:bold">Proudct information has been updated. </p>
            <?php } if (@$_GET['result'] == 'failed'){ ?>
                <p style="color:red;font-weight:bold">Unable to Update Proudct information </p>       
            <?php } ?>
            <form action="/link-submit.php" method="post"  class="form-horizontal">
            <input type="hidden" value="BuyLinkAffiliate" name="buyLink"/>
            <input type="hidden" value="<?php echo $product_id; ?>" name="bvr_prod_id"/>
            <div class ="form-group">
	   <label class="control-label col-sm-2" for="ASIN No."> ASIN No.</label>
		<div class="col-sm-8">	
			 <input type="text" id="asin_text" class="form-control"  readonly="readonly" value="<?php echo $product_asin_code; ?>" name="prod_asin"/>  
		</div>
	<div class="col-sm-2">	
        <input class="form-control btn btn-danger" 
	    type="button" id="asin_clipboard" value="Copy"/>
	</div>
	</div>
    <div class="form-group">
            <label class="control-label col-sm-2" for="Buy Link:">Amazon Product URL:</label> 
        <div class="col-sm-8">
        <input type="text" class="form-control" id="product_url_text" name="product_url" placeholder="Amazon URL for Product" value="<?php echo $product_url; ?>" readonly="readonly"/>
        </div>
        <div class="col-sm-2">	
        <input class="form-control btn btn-danger" 
	    type="button" id="product_clipboard" value="Copy"/>
	</div>
    </div>

    <div class="form-group">
            <label class="control-label col-sm-2" for="Buy Link:">Buy Link:</label> 
        <div class="col-sm-10">
        <input type="text" class="form-control" name="buy_url" placeholder="Enter Amazon Buy Link" required="required"/>
        </div>
    </div>

    <div class="form-group">
            <label class="control-label col-sm-2" for="Enter Image Snippet"> Enter Large Image Snippet:</label>
            <div class="col-sm-10"> 
            <textarea name="large_image_snippet" cols="20" rows="10" required="required" class="form-control"></textarea>
            </div>
    </div>
    
    <div class="form-group">
            <label class="control-label col-sm-2" for="Enter Image Snippet"> Enter Medium Image Snippet:</label>
            <div class="col-sm-10"> 
            <textarea name="medium_image_snippet" cols="20" rows="10" required="required" class="form-control"></textarea>
            </div>
    </div>
    
    <div class="form-group">
            <label class="control-label col-sm-2" for="Enter Image Snippet"> Enter Small Image Snippet:</label>
            <div class="col-sm-10"> 
            <textarea name="small_image_snippet" cols="20" rows="10" required="required" class="form-control"></textarea>
            </div>
	</div>
    <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10"> 
            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg" /> 
            </div>
            <div class="col-sm-2"></div>
	</div>

    
            </form>
        </div>
    </div>
</div>
<?php
}else{
    wp_redirect( home_url() ); exit;
}
?>
<script>
jQuery()

</script>

<?php
// $wpdb->close();
get_footer();
?>

