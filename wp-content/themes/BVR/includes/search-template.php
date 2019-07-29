<?php
/* 
Template Name: SERP Template

*/
?>
<style>
    * {
        box-sizing: border-box;
    }

    #ajaxsearchlite1 {
        width: 400px !important;
    }
</style>
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

?>

<div class="Mask">
    <p class="We-have-found-30-res " align="center">We have found 30 results for "<?php echo  strtoupper($s); ?>"</p>
    <div align="center">
        <?php get_search_form($s) ?>
    </div>
</div>

<!-- <div class="card-columns">
    <div class="card card-categorystyle">
        <img class="card-img-top" src="<?php bloginfo('template_url'); ?>/css/images//picture09.bmp">
        <div class="card-img-overlay">
            <div class="row" style="height:37.5%"></div>
            <span class=" gradient img-text " style="position:absolute;bottom:0px;">
                Beach Cruisers
            </span>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row" style="height:56px">
                    <img src="p5656.bmp" class="mr-sm-4">
                    <span class="card-text text-truncate product-text" style="max-width:200px">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ratione facere culpa at
                        itaque saepe error sint in, qui atque cumque!
                    </span>
                </div>

                <div class="row" style="height:56px">
                    <img src="p5656.bmp" class="mr-sm-4">
                    <span class="card-text text-truncate text-wrap" style="max-width:200px">
                        Lorem ipsum dolor sit amet consectetur adipisicing.
                    </span>

                </div>

                <div class="row" style="height:56px">
                    <img src="p5656.bmp" class="mr-sm-4">
                    <span class="card-text text-truncate" style="max-width:200px">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Id ea qui beatae
                        consequatur? A, vitae.
                    </span>
                </div>
            </div>

        </div>
    </div>
</div> -->


<!-- <div align="center">
    <div style="margin-top:24px;width:92%">
        <div class="row" style="height: 320px">
            <div class="card-columns" style="margin-bottom:16px">
                <div class="card card-style">
                    <div align="center">
                        <img class="category_thumbnail" src="<?php bloginfo('template_url'); ?>/css/images//train.bmp" class="mx-auto d-block">
                    </div>
                    <div class="category_text">iPhone 6 Cases</div>
                    <div class="d-flex justify-content-center" style="height:19px;margin-top:7px">
                        <img class="star img img-responsive" height=19px width=20px src="<?php bloginfo('template_url'); ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
                <div class="card card-style">
                    <div align="center">
                        <img class="category_thumbnail img img-responsive" src="<?php bloginfo('template_url'); ?>/css/images//train.bmp" class="mx-auto d-block">
                    </div>
                    <div class="category_text">iPhone 6 Cases</div>
                    <div class="d-flex justify-content-center" style="height:19px;margin-top:7px">
                        <img class="star img img-responsive" height=19px width=20px src="<?php bloginfo('template_url'); ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
                <div class="card card-style">
                    <div align="center">
                        <img class="category_thumbnail img img-responsive" src="<?php bloginfo('template_url'); ?>/css/images//train.bmp" class="mx-auto d-block">
                    </div>
                    <div class="category_text">iPhone 6 Cases</div>
                    <div class="d-flex justify-content-center" style="height:19px;margin-top:7px">
                        <img class="star img img-responsive" height=19px width=20px src="<?php bloginfo('template_url'); ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>

                <div class="card card-style">
                    <div align="center">
                        <img class="category_thumbnail img img-responsive" src="<?php bloginfo('template_url'); ?>/css/images//train.bmp" class="mx-auto d-block">
                    </div>
                    <div class="category_text">iPhone 6 Cases</div>
                    <div class="d-flex justify-content-center" style="height:19px;margin-top:7px">
                        <img class="star img img-responsive" height=19px width=20px src="<?php bloginfo('template_url'); ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div> -->

<div class="row" align="center">
    <div class="col-4" style="width:7%"></div>
    <div class="col-4" style="width:86%">
        <div style="display:inline-block">
            <?php
            $all_category = array();
            foreach ($result as $document) :
                $dataSet = $document["_source"];
                $subcategory_name = $dataSet['subcategory'];
                array_push($all_category, $subcategory_name);
            endforeach;

            $unique_category_list = array_unique($all_category);
            // print_r($unique_category_list); exit;
            foreach ($unique_category_list as $subcategory) :
                //get subcategory information
                $subcategory_details = $wpdb->get_results(
                    $wpdb->prepare(
                        "
                            SELECT * FROM bestviews.product_category
                            WHERE subcategory_name =%s GROUP BY  subcategory_name
                            ORDER BY subcategory_name ASC ",
                        $subcategory
                    )
                );

                foreach ($subcategory_details as $subcategory_info) :
                    // Get the ID of a given category
                    $category_id = get_cat_ID($subcategory_info->subcategory_name);

                    // Get the URL of this category
                    $category_link = get_category_link($category_id);
                    echo $category_id;
                    ?>
                    <a href="<?php echo $category_link; ?>">
                        <div class=" col-sm-12 col-xs-12 col-md-3 category_content">
                            <div align="center">
                                <div class="category_thumbnail ">
                                    <img class="img img-responsive" src="<?php echo $subcategory_info->s3_category_img; ?>" />
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
            <!-- <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />

                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:8px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>

                </div>
            </a>
            <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />

                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:5px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>

                </div>
            </a>
            <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />
                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:5px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>

                </div>
            </a>
            <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />
                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:5px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />
                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:5px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />
                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:5px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="col-sm-12 col-xs-12 col-md-3 category_content">
                    <div align="center">
                        <div class="category_thumbnail ">
                            <img class="img img-responsive" src="<?php //bloginfo('template_url'); 
                                                                    ?>/css/images/iphonesquare1.png" />
                        </div>
                    </div>
                    <div class="category_text">
                        <div>iPhone 6 Cases</div>
                    </div>
                    <div class="review_box" align="center">
                        <img style="margin-top:-5px;margin-right:5px" src="<?php //bloginfo('template_url'); 
                                                                            ?>/css/images/star.png" />
                        <span class="review_text">163 Reviews</span>
                    </div>
                </div>
            </a> -->
        </div>
        <div class="col-4" style="width:7%"></div>
    </div>


    <div class="row" align="center" style="margin-top:32px">
        <img style="margin-right:16px" width=16px height=16px src="<?php bloginfo('template_url'); ?>/css/images/arrow-left.svg" />
        <a href=# class="btn btnstyle" style="margin-right:8px">
            <div class="btntext" align="center">1</div>
        </a>
        <a href=# class="btn btnstyleactive" style="margin-right:8px">
            <div class="btntextactive" align="center">2</div>
        </a>
        <a href=# class="btn btnstyle" style="margin-right:15px">
            <div class="btntext" align="center">3</div>
        </a>
        <span class="btn-text dotdotdot" style="margin-right:13px">...</span>
        <a href=# class="btn btnstyle " style="margin-right:8px">
            <div class="btntext" align="center">7</div>
        </a>
        <a href=# class="btn btnstyle" style="margin-right:16px">
            <div class="btntext " align="center">8</div>
        </a>
        <img width=16px height=16px src="<?php bloginfo('template_url'); ?>/css/images/arrow-right.svg" />

    </div>

    <?php get_template_part("template-parts/top-footer");
    ?>
    <?php get_footer(); ?>