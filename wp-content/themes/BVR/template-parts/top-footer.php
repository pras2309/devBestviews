<!-- <section> -->
	<div class="row">
<?php global $post;?>
	<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="stay_block">
	<h5>Stay up-to-date</h5>
	<p>Sign up for Best Views Reviews <br/>newsletter to receive weekly recommendations</p>
	<?php if(is_front_page() || $post->ID == 24282){ ?>
	<img src="<?php bloginfo('template_url'); ?>/images/bg-inbox.png" class="stay_block_image" style="left:382px;top:-1px;"/>
	<?php } else { ?>
		<img src="<?php bloginfo('template_url'); ?>/images/bg-inbox.png" class="stay_block_image"/>
		<?php  } ?>
	<div class="form-group custome-form-group">
      <div class="input-group">
		 <input type="email" class="form-control custome-input" placeholder="Your Email Address">  
		 <span class="input-group-btn">
         <button class="btn stay_btn" type="submit" style="background-color: #57a3f9;color:#fff;line-height:1.29;font-family:rubik;text-align:center; width: 112px;height: 40px;border-radius: 2px;font-weight:500;font-size:14px;padding-left:10px;">Subscribe</button>
         </span>
          </div>
    </div>
	</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="stay_block_new">
	<h5>Can’t find a product?</h5>
	<?php get_template_part('template-parts/amazon-submit'); ?>
	
	</section>
		  
	<section class="related_category_new">
		<div class="container">
<?php
$description_content = array("A projector or image projector is an optical device that projects an image (or moving images) onto a surface, commonly a projection screen. Most projectors create an image by shining a light through a small transparent lens, but some newer types of projectors can project the image directly, by using lasers. A virtual retinal display, or retinal projector, is a projector that projects an image directly on the retina instead of using an external projection screen.
The most common type of projector used today is called a video projector. Video projectors are digital replacements for earlier types of projectors such as slide projectors and overhead projectors. These earlier types of projectors were mostly replaced with digital video projectors throughout the 1990s and early 2000s, but old analog projectors are still used at some places. The newest types of projectors are handheld projectors that use lasers or LEDs to project images. Their projections are hard to see if there is too much ambient light.",
"A camera is an optical instrument to capture still images or to record moving images, which are stored in a physical medium such as in a digital system or on photographic film. A camera consists of a lens which focuses light from the scene, and a camera body which holds the image capture mechanism.
The still image camera is the main instrument in the art of photography and captured images may be reproduced later as a part of the process of photography, digital imaging, photographic printing. The similar artistic fields in the moving image camera domain are film, videography, and cinematography.
The word camera comes from camera obscura, which means 'dark chamber' and is the Latin name of the original device for projecting an image of external reality onto a flat surface. The modern photographic camera evolved from the camera obscura. The functioning of the camera is very similar to the functioning of the human eye. The first permanent photograph was made in 1825 by Joseph Nicéphore Niépce."
,"Air conditioning (often referred to as AC, A/C, or air con)[1] is the process of removing heat and moisture from the interior of an occupied space to improve the comfort of occupants. Air conditioning can be used in both domestic and commercial environments. This process is most commonly used to achieve a more comfortable interior environment, typically for humans and other animals; however, air conditioning is also used to cool and dehumidify rooms filled with heat-producing electronic devices, such as computer servers, power amplifiers, and to display and store some delicate products, such as artwork."
,"Air conditioners often use a fan to distribute the conditioned air to an occupied space such as a building or a car to improve thermal comfort and indoor air quality. Electric refrigerant-based AC units range from small units that can cool a small bedroom, which can be carried by a single adult, to massive units installed on the roof of office towers that can cool an entire building. The cooling is typically achieved through a refrigeration cycle, but sometimes evaporation or free cooling is used. Air conditioning systems can also be made based on desiccants (chemicals which remove moisture from the air). Some AC systems reject or store heat in subterranean pipes.",
"A tablet computer, commonly shortened to tablet, is a mobile device, typically with a mobile operating system and touchscreen display processing circuitry, and a rechargeable battery in a single thin, flat package. Tablets, being computers, do what other personal computers do, but lack some input/output (I/O) abilities that others have. Modern tablets largely resemble modern smartphones, the only differences being that tablets are relatively larger than smartphones, with screens 7 inches (18 cm) or larger, measured diagonally,and may not support access to a cellular network.
The touchscreen display is operated by gestures executed by finger or digital pen (stylus), instead of the mouse, trackpad, and keyboard of larger computers. Portable computers can be classified according to the presence and appearance of physical keyboards. Two species of tablet, the slate and booklet, do not have physical keyboards and usually accept text and other input by use of a virtual keyboard shown on their touchscreen displays. To compensate for their lack of a physical keyboard, most tablets can connect to independent physical keyboards by wireless Bluetooth or USB; 2-in-1 PCs have keyboards, distinct from tablets.");

?> 		
	<div class="col-md-1"></div>
	<div class="col-xs-12 col-sm-12 col-md-10 related_category_new_title">
		<p><?php 
		$k =  array_rand($description_content);
		echo $description_content[$k];
		 ?></p>
			</div>
			<div class="col-md-1"></div>
		</div>
		
	</section>
	<?php
		if(isset($_SESSION["recentlyViewed"]) && !empty($_SESSION["recentlyViewed"])){
			$criteria = (isset($_SESSION["recentlyViewed"])?implode(", ",$_SESSION["recentlyViewed"]):"-1"); 
	//get current post and store them into session.
	$getRecentViewedProduct = $wpdb->get_results("SELECT * FROM dev_bestviews.products WHERE wp_post_id IN ($criteria)");
	?>
	<section class="related_category">
	<div class="container">
	<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<h4>Recently Viewed Products</h4>
	</div>
	</div>
	<div class="row">
	<?php  foreach($getRecentViewedProduct as $recentProduct): ?>
			<div class="col-xs-12 col-sm-12 col-md-3">
					<div class="related_category_item_main">
							<div class="related_category_image">
							<?php echo $recentProduct->image_snippet; ?>
							</div>
							<div class="related_category_title">
							<p><a href="<?php echo get_permalink($recentProduct->wp_post_id); ?>"><?php echo prepare_title_recent_product($recentProduct->product_title); ?></a></p>
							</div>							
					</div>
			</div>
	<?php endforeach; ?>
	</div>
	</div>
	</section>
	<?php } ?>
