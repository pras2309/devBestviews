<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage BVR
 * @since BVR 1.0
 */

get_template_part('home_header');
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
		<?php if ( $the_query->have_posts() ) : ?>
		<?php _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>"); ?>
			<?php
			// Start the loop.
			while ( $the_query->have_posts() ) :
				the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'includes/search-result');

				// End the loop.
			 
			endwhile;
			wp_reset_postdata();
				
			wp_reset_query();

			flush_rewrite_rules();

			// Previous/next page navigation.
			wp_pagenavi(
				array( 'query' => $the_query) 
			);

			// If no content, include the "No posts found" template.
		else :
?>

			<h2 style='font-weight:bold;color:#000'>Nothing Found</h2>
			<div class="alert alert-info">
			  <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
			</div>
<?php
		endif;
		?>
   		   </div>
		 </div>
	</div>
</div>
<?php get_footer(); ?>
