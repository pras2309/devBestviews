<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage BVR
 * @since BVR 1.0
 */

get_template_part('home_header');
get_template_part('template-parts/top-header');
?>
	</div>
</div>
<?php
	$s = get_search_query();
	$args = array( "s" => $s, 'posts_per_page' => -1 );
	$the_query = new WP_Query($args);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'BVR' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'BVR' ); ?></h1>
		<?php endif; ?>
		<hr/>
		<?php 
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'includes/search-result', 'search' );
		endwhile; // End of the loop.

		 the_posts_pagination( array(
			 'screen_reader_text' => ' ',
			'prev_text' => __( 'Previous', 'BVR' ),
			'next_text' => __( 'Next', 'BVR' ),
		) );

		else :
			?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'BVR' ); ?></p>

			<?php
				get_search_form();
		endif;
		?>
		 </div>
	</div>
</div>
<?php get_footer(); ?>
