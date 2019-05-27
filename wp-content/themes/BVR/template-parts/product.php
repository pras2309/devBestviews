<?php get_header(); ?>
	</div>
	</div>

	<div class="header-new">
    <div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 breadcrumb">
	<?php if(function_exists('bcn_display') && !is_home() && !is_front_page())
		{
			bcn_display();
		}?>
	<!-- <ol class="breadcrumb">
	  <li><a href="#">Home</a></li>
	  <li><a href="#">Home Audio</a></li>
	  <li><a href="#">Soundbars</a></li>
	  <li class="active">Samsung HW-J355 2.1 Channnel 120 Watt Wired Audio Soundbar</li>
	</ol> -->
	</div>
	</div>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php
	//now get the product information from the product table.
	$post_id = $post->ID;
	$prodResult = $wpdb->get_results("SELECT * FROM bestviews.products WHERE wp_post_id = $post_id");
	$prodResult = $prodResult[0];
	
	?>

	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
	<div class="title">
	<h1><?php the_title(); ?></h1>
	</div>
	<div class="soundbars">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2">
	<?php the_category( ', ' ); ?>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-10">
	<span class="inner-thumnbail">
	<?php $author_id=$post->post_author; ?>
		<!-- <img src="https://keenthemes.com/metronic/preview/demo12/assets/media/users/300_25.jpg"/>Samuil Sadovsky -->
		<img src="<?php echo the_author_meta( 'avatar' , $author_id ); ?> " class="avatar" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" />
		<?php ucfirst(the_author_meta( 'user_nicename' , $author_id )); ?>
	</span>
	<span class="date"><?php echo get_the_date('F j, Y');?></span>
	</div>
	</div>
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3">
	<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 winner_image">
					<?php if($prodResult->rank == 1){ ?>
								<img src="<?php bloginfo('template_url'); ?>/images/winner-new.png"/>
								<div class="winner">
												<div class="winner-content">
														<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
												</div>
												<div class="winner-footer">
														<p>Winner</p>
												</div>
								
								</div>
					<?php }  if($prodResult->rank == 2){ ?>
							<div class="second_winner">
												<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
												</div>
												<div class="remarkfirst-footer">
												<p>Best Value</p>
										</div>
					<?php 
					} if($prodResult->rank >= 3){
							?>
						<div class="second_winner">
															<div class="remarksecond-content">
															<p># <span style="font-size: 24px;font-weight: 300;text-align: center;color: #292c32;font-family: RubikLight;"><?php echo $prodResult->rank; ?></span></p>
															</div>
													
													</div>
					<?php } ?>
				</div> <!-- end of winner_image div -->

				<div class="col-xs-6 col-sm-6 col-md-6 score_image">
						<strong>Score</strong>
						<?php echo $prodResult->score_out_of_10; ?>
				</div>
	</div>
	</div>
	</div>
	</div>
	</div>

	<div class="main">
	<div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9">
	
	<div class="left-section">
	<div class="row first-row">
	<div class="col-md-8">
	<div class="row">
							<div class="col-xs-3 col-sm-3 col-md-3 small-slide">
                            <div id="slideshow_1_thumbs_1">
                                <ul class="slideshow1_thumbs desoslide-thumbs-vertical list-inline text-center">
                                    <li>
                                        <a href="<?php bloginfo('template_url'); ?>/images/slider-image-2.png">
                                            <img src="<?php bloginfo('template_url'); ?>/images/slider-image-2.png"
                                                 alt="Bick Buck Bunny">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php bloginfo('template_url'); ?>/images/slider-image-1.png">
                                            <img src="<?php bloginfo('template_url'); ?>/images/slider-image-1.png"
                                                 alt="Rinky">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php bloginfo('template_url'); ?>/images/slider-image-2.png">
                                            <img src="<?php bloginfo('template_url'); ?>/images/slider-image-2.png"
                                                 alt="It's a trap!">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php bloginfo('template_url'); ?>/images/slider-image-2.png">
                                            <img src="<?php bloginfo('template_url'); ?>/images/slider-image-2.png"
                                                 alt="Evil Frank">
                                        </a>
                                    </li>
                                </ul>
                            </div>
							</div>
							
							<div class="col-xs-9 col-sm-9 col-md-9 big_thumbnail">
                            <div id="slideshow1"></div>
							</div>
                            
                        </div>
	</div>
	<div class="col-md-4">
	<div class="row">
	<div class="col-md-12">
	<h5 class="slider-title">Review Trend</h5>
	<p class="slider-right-section">Sep'18 - Jan'19</p>
	<div id="7979e646-13e6-4f44-8d32-d8effc3816df" class="plotly-graph-div" style="height: 250px;"> </div>
	<script type = "text/javascript" >
    window.PLOTLYENV = window.PLOTLYENV || {};
window.PLOTLYENV.BASE_URL = "https://plot.ly";
Plotly.newPlot("7979e646-13e6-4f44-8d32-d8effc3816df",
        [{
            "type": "bar",
            "x": ['Oct 18', 'Nov 18', 'Dec 18', 'Jan 19', 'Feb 19'],
            "y": [1, 3, 1, 1, 1],
            "marker": {
                "color": "orange",
                "symbol": "-x"
            }
        }], {
            "xaxis": {
                "title": {
                    "text": "Month"
                }
            },
            "yaxis": {
                "title": {
                    "text": "Number of reviews"
                }
            },
            "automargin": false,
            "margin": {
                "l": "50",
                "r": "0.5"
            }
        }, {
            "displaylogo": false,
            "responsive": true,
            "displayModeBar": false,
            "scrollZoom": true
        }) 
  </script>
	</div>
	<div class="col-md-12"></div>
	
	</div>
	<div class="row">
	<div class="col-md-12">
	<h5 class="slider-title-2">Sentiment Analysis</h5>
	<p class="slider-right-section-2">From 968 total reviews</p>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 stats-review">
	<div class="up">
	<img src="<?php bloginfo('template_url'); ?>/images/up.png"/>
	</div>
	<div class="count">
	<p>12</p>
	</div>
	<div class="remark">
	<p>Positive</p>
	</div>
	</div>
	
	<div class="col-xs-4 col-sm-4 col-md-4 stats-review-middle">
	<div class="up" style="padding-bottom:7px;">
	<img src="<?php bloginfo('template_url'); ?>/images/face.png"/>
	</div>
	<div class="count">
	<p>4</p>
	</div>
	<div class="remark">
	<p>Neutral</p>
	</div>
	</div>
	
	<div class="col-xs-4 col-sm-4 col-md-4 stats-review">
	<div class="up">
	<img src="<?php bloginfo('template_url'); ?>/images/down.png"/>
	</div>
	<div class="count">
	<p>2</p>
	</div>
	<div class="remark">
	<p>Negative</p>
	</div>
	</div>
	
	</div>
	
	</div>
	
	</div>
	
	
	<div class="row second-row">
		<div class="col-md-5" style="text-align:center;">
	<img src="<?php bloginfo('template_url'); ?>/images/amazon.png" style="width:40%;">
	</div>
	<div class="col-md-3" style="text-align:center;">
	<p class="cost">$349.99</p>
	</div>
	<div class="col-md-4" style="text-align:center;">
	<button type="button" class="btn partner_button">Shop now</button>
	</div>
	
	</div>
	
	<div class="row third-row">
		<div class="col-md-5" style="text-align:center;">
	<img src="<?php bloginfo('template_url'); ?>/images/walmart.png" style="width:40%;">
	</div>
	<div class="col-md-3" style="text-align:center;">
	<p class="cost">$349.99</p>
	</div>
	<div class="col-md-4" style="text-align:center;">
	<button type="button" class="btn partner_button">Shop now</button>
	</div>
	
	</div>
	
	<div class="row fourth-row" style="display:none;">
	<div class="col-md-6">
	<h5 class="positive-title">Top Positive Reviews</h5>
	<ul class="positive_points">
	<li>Bass</li>
	<li>Volume</li>
	<li>Setup Time</li>
	<li>Price</li>
	<li>Customer Care</li>
	</ul>
	<div class="clearfix"></div>
	<div class="positive_review">
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</p>
	</div>
	<p class="positive-review-date">On Feb 2019</p>
	
	<div class="positive_review">
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</p>
	</div>
	<p class="positive-review-date">On Feb 2019</p>
	
	<div class="positive_review">
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</p>
	</div>
	<p class="positive-review-date">On Feb 2019</p>
	
	</div>
	<div class="col-md-6">
	<h5 class="negative-title">Top Negative Reviews</h5>
	<ul class="negative_points">
	<li>Wifi Connectivity</li>
	<li>Loose cable</li>
	<li>Price</li>
	<li>Customer Care</li>
	</ul>
	<div class="clearfix"></div>
	<div class="negative_review">
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</p>
	</div>
	<p class="negative-review-date">On Feb 2019</p>
	
	<div class="negative_review">
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</p>
	</div>
	<p class="negative-review-date">On Feb 2019</p>
	
	<div class="negative_review">
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when ...</p>
	</div>
	<p class="negative-review-date">On Feb 2019</p>
	
	</div>
	
	</div>
	
	<div class="row fourth-row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="detail-text">
	<p>As the first soundbar to come out of Samsung’s Californian audio lab, the HW-K950 Dolby Atmos soundbar was a real gamble. In fact, with its dual wireless surround speakers, 15 drivers (including four fired at the ceiling), and a $1,500 price tag, the K950 might be better described as an all-in, pink-slips-on-the-table bet on Atmos. Luckily for Samsung, going big paid off. The K950 was a success, helping to usher in a new era of powerful and convenient Dolby Atmos soundbars.</p>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-4">
	<div class="detail-text-title">
	<img src="<?php bloginfo('template_url'); ?>/images/left-quotes.jpg"/>
	<p>By far the easiest way to land spectacular Dolby Atmos surround sound.</p>
	<img src="<?php bloginfo('template_url'); ?>/images/right-quotes.jpg"/>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-8">
	<div class="detail-text">
	<p>As the first soundbar to come out of Samsung’s Californian audio lab, the HW-K950 Dolby Atmos soundbar was a real gamble. In fact, with its dual wireless surround speakers, 15 drivers (including four fired at the ceiling), and a $1,500 price tag, the K950 might be better described as an all-in, pink-slips-on-the-table bet on Atmos. Luckily for Samsung, going big paid off. The K950 was a success, helping to usher in a new era of powerful and convenient Dolby Atmos soundbars.</p>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="detail-text">
	<p>As the first soundbar to come out of Samsung’s Californian audio lab, the HW-K950 Dolby Atmos soundbar was a real gamble. In fact, with its dual wireless surround speakers, 15 drivers (including four fired at the ceiling), and a $1,500 price tag, the K950 might be better described as an all-in, pink-slips-on-the-table bet on Atmos. Luckily for Samsung, going big paid off. The K950 was a success, helping to usher in a new era of powerful and convenient Dolby Atmos soundbars.</p>
	</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="detail-text">
	<img src="<?php bloginfo('template_url'); ?>/images/speaker-image.jpg"/>
	</div>
	</div>
	
	
	<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	</div>
	
	<?php get_template_part('template-parts/next-previous') ?>
	</div>
	<div class="row sixth-row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="review_block_new">
	<h5>Would you like us to review a product?</h5>
	<p>Submit the product’s URL on Amazon and we’ll tell you everything about the product</p>
	<div class="form-group custome-form-group">
      <div class="input-group">
         <input type="email" class="form-control custome-input" placeholder="Product amazon url">
         <span class="input-group-btn">
         <button class="btn" type="submit" style="background-color: #63ccac;color:#fff;">Submit URL</button>
         </span>
          </div>
   </div>
	</div>
	</div>
	</div>
	</div>
		<!-- sidebar would be here -->
		<?php get_sidebar(); ?>
	<!-- end of the sidebar -->
	</div>
	</div>
	</div>
 <?php get_footer(); ?>