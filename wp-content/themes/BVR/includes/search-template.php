<?php
/* 
Template Name: SERP Template

*/
?>
<style>
.other_products img {width:70%;}
.stay_block_image{ left:263px;}
</style>

<!-- section for other products of the category -->
<?php
global $wpdb;
$s = get_search_query();

$elastic_result = "http://elastic.bestviewsreviews.com/bvr/_doc/_search";
$queryString = '{
        "query": {
          "multi_match" : {
            "query":    "' . $s . '",
            "fields": [ "model", "subcategory","review" ]
          }
        },
        "_source":["subcategory"],
        "from":0,
        "size":30
        }';
//curl request to get the reviews for current document
$process = curl_init($elastic_result);
curl_setopt($process, CURLOPT_POST, 1);                //0 for a get request
curl_setopt($process, CURLOPT_POSTFIELDS, $queryString);
curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
curl_setopt(
    $process,
    CURLOPT_HTTPHEADER,
    array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($queryString)
    )
);
$response = curl_exec($process);
$resultSet = json_decode($response, true);
$result = $resultSet["hits"]["hits"];
$all_category = array();
foreach ($result as $document) :
    $dataSet = $document["_source"];
    $subcategory_name = $dataSet['subcategory'];
    array_push($all_category, $subcategory_name);
endforeach;

$unique_category_list = array_unique($all_category);
// $page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
$total = count( $unique_category_list ); //total items in array    
if($total == 0):
?>

<div class="Mask">
    <p class="We-have-found-30-res " align="center">Sorry. We couldn’t find any product for "<?php echo  strtoupper($s); ?>"</p>
    <div class="row" align="center">
        <?php get_search_form($s) ?>
    </div>
</div>

<div class="row" align="center">
   <img src="<?php bloginfo('template_url'); ?>/css/images/empty-search.svg" class=" empty-search">
</div>
<?php else: ?>

<div class="Mask">
    <p class="We-have-found-30-res " align="center">We have found <?php echo $total;?> results for "<?php echo  strtoupper($s); ?>"</p>
    <div class="row" align="center">
        <?php get_search_form($s) ?>
    </div>
</div>

<div class="row" align="center">
    <div class="col-4" style="width:7%"></div>
    <div class="col-4" style="width:86%">
        <div style="display:inline-block">
            <?php
            // print_r($unique_category_list); exit;
            $limit = 8;
            $noOfPages = ceil($total /  $limit);
            //get current page no.
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            if(@$_GET['page'] >= $noOfPages){
                $page = $noOfPages;
            }
            $start_page = $page * $limit - $limit;
            $array_read = array_chunk($unique_category_list, $limit);
           //  print_r($array_read);exit;
            foreach ($array_read[$page -1] as $subcategory) :
                //get subcategory information
                $subcategory_details = $wpdb->get_results(
                    $wpdb->prepare(
                        "
                            SELECT * FROM bestviews.product_category
                            WHERE subcategory_name =%s
                            ORDER BY subcategory_name ASC LIMIT $limit",
                        $subcategory
                    )
                );

                foreach ($subcategory_details as $subcategory_info) :
                    // Get the ID of a given category
                    $category_id = get_cat_ID($subcategory_info->subcategory_name);

                    // Get the URL of this category
                    $category_link = get_category_link($category_id); 
                    // echo $category_id;                   ?>
                    <a href="<?php echo $category_link; ?>">
                        <div class=" col-sm-12 col-xs-12 col-md-3 category_content">
                            <div align="center">
                                <div class="category_thumbnail ">
                                    <img class="img img-responsive" src="<?php echo $subcategory_info->transparent_image_url; ?>" />
                                </div>
                            </div>
                            <div class="category_text">
                                <div><?php echo $subcategory_info->subcategory_name;  ?></div>
                            </div>
                            <div class="review_box" align="center">
                                <img style="margin-top:-5px;margin-right:5px" src="<?php bloginfo('template_url'); ?>/css/images/star.png" />
                                <span class="review_text"><?php echo $subcategory_info->total_no_of_reviews; ?> Reviews</span>
                            </div>

                        </div>
                    </a>
                <?php endforeach;
            endforeach; ?>
           
        </div>
        <div class="col-4" style="width:7%"></div>
    </div>


    <div class="row" align="center" style="margin-top:32px">
    <?php if($noOfPages > 1 && $page != 1): ?>
       <a href="?s=<?php echo $s;?>&page=<?php echo $page -1; ?>"> <img style="margin-right:16px" width=16px height=16px src="<?php bloginfo('template_url'); ?>/css/images/arrow-left.svg" />
        </a>
       <?php
       endif; 
       for($i = 1; $i<=$noOfPages; $i++):
        if($i==$page):
       ?>
        <a href="?s=<?php echo $s; ?>&page=<?php echo $i; ?>" class="btn btnstyleactive" style="margin-right:8px">
            <div class="btntextactive" align="center"><?php echo $i; ?></div>
        </a>
        <?php else: ?>
        <a href="?s=<?php echo $s; ?>&page=<?php echo $i; ?>" class="btn btnstyle" style="margin-right:8px">
            <div class="btntext" align="center"><?php echo $i; ?></div>
        </a>
        <?php endif; endfor; ?>
        <?php if($noOfPages > $page ): ?>
        <a href="?s=<?php echo $s;?>&page=<?php echo $page + 1; ?>"><img width=16px height=16px src="<?php bloginfo('template_url'); ?>/css/images/arrow-right.svg" />
        </a> 
        <?php endif; ?>
    </div>
<?php endif; ?>
