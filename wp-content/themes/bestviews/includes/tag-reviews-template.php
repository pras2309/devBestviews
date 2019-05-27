<?php
/* 
Template Name: Product Tag Cloud Reviews
*/
get_header();
?>
<style>
.breadcrumbs{ display:none;} 
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <table class="table table-striped"> 
            <?php 
            //get the product id 
            $product_id = $_GET['product'];
	    $keyword = $_GET['keyword'];
            $es_code = $_GET['code'];
            $elastic_result = "http://elastic.bestviewsreviews.com/reviews/_doc/_search";
	    $queryString = '{
			  "query": { 
			    "bool": { 
			      "must": [
				{ "match": { "prod_unq_id":"'.$es_code.'"    }}, 
				{ "match_phrase": { "review": "'.$keyword.'" }}  
			      ]
			    }
			  },
			  "from":0,
			  "size":10
			}';
	
	    //curl request to get the reviews for current document
   	    	 $process = curl_init($elastic_result);
		 curl_setopt($process, CURLOPT_POST, 1);                //0 for a get request
         	   curl_setopt($process, CURLOPT_POSTFIELDS, $queryString);
		   curl_setopt($process,CURLOPT_RETURNTRANSFER, true);
		   curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
				    'Content-Type: application/json',                                                                                
				    'Content-Length: ' . strlen($queryString))                                                                       
			    ); 
		    $response = curl_exec($process);
		    $resultSet = json_decode($response, true);
		    $result = $resultSet["hits"]["hits"];
		    foreach($result as $document){
		  	 $dataSet  = $document["_source"];
	    
	    $getprodInfo = $wpdb->get_results("SELECT * FROM bestviews.products WHERE id = $product_id");
	   // print_r($getprodInfo); exit;
	    $wp_post_id = $getprodInfo[0]->wp_post_id;

            //display all the related review in a list here........
?>
		<!-- <tr>
		<td><?php //echo $reviews->review_text; ?></td>
		<td><a href="<?php //echo get_permalink($wp_post_id); ?>"><?php //echo $dataSet['model']; ?></a></td>
		<td><?php //echo $dataSet['category']; ?> >> <strong><a href="#"><?php //echo $dataSet['subcategory']; ?></a></td>
		<td><?php //echo $dataSet['review']; ?></td>
		</tr> -->

		<div class="card">
		  <div class="card-body">
		    <h4 class="card-title"><a href="<?php echo get_permalink($wp_post_id); ?>"><?php echo $dataSet['model']; ?></a></h4>
		    <p class="card-text"><?php echo $dataSet['review']; ?></p>
			    <a href="#" class="card-link"><?php echo $dataSet['category']; ?></a>
			    <a href="#" class="card-link"><?php echo $dataSet['subcategory']; ?></a>
		  </div>
		</div>
            <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
get_footer();
?>

