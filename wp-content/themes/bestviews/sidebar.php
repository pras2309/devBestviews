<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
	<section id="related_posts" class="widget">
<h2 class="widget-title">Related Posts</h2>
<?php
global $post;
$related = get_posts( 
	array( 'category__in' => wp_get_post_categories($post->ID), 
			'numberposts' => 5, 
			'post__not_in' => array($post->ID) 
		)
	);
if( $related ) foreach( $related as $post ) {
setup_postdata($post); ?>
 <ul> 
        <li>
        <a class="related_post_link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </li>
    </ul> 
<?php }
wp_reset_postdata(); ?>
</section>
</aside><!-- .sidebar .widget-area -->
<?php if(shortcode_exists('multicolor-tag-cloud')): ?>
<aside id="secondary" class="sidebar widget-area" role="complementary" >
	<section id="related_tags" class="widget">
		<h2 class="widget-title">Related Tags</h2>
		<?php echo do_shortcode('[multicolor-tag-cloud post_id="'.$post->ID.'"]'); ?>
	</section>
</aside>
<?php endif; ?>



