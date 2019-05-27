<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
global $post;
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="clearfix"></div>
			<div class="container" style="padding-top:20px;">
				<div class="row">
					<div class="col-md-12">
					<p class="bvr_description">
					BestViewsReviews (BVR) analyzes and summarizes millions of user views and reviews on products and simplifies the purchase decision for you. 
					BVR accounts for all user reviews/ ratings, filters out the fake content, and summarizes this information. 
					The AI-powered natural language engine at BVR also analyzes millions of lines of raw user-generated content in the form of text, comments, views, forums, and blogs. 
					To save your time of having to sift through this clutter of information and missing important data points, BVR combines the latest views and reviews and presents you an unbiased summary.
					</p>
					<p>
					<strong>Disclaimer:</strong> "As an Amazon Associate we earn from qualifying purchases."
					</p>
					</div>
				</div>
			</div>
			<!-- end of disclaimer -->
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
							)
						);
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							)
						);
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>



			<div class="site-info">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'twentysixteen_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'http://www.bestviewsreviews.com/', 'bestviews' ) ); ?>" class="imprint">
					<?php printf( __( 'Managed By %s', 'bestviews' ), 'Best Views Reviews (BVR)' ); ?>
				</a>
			</div><!-- .site-info -->		
			<p style="display:none;">
				<?php echo "The Post id is: ".$post->ID; ?>
			</p>				

		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php wp_footer(); ?>
</body>
</html>
