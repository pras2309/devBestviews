<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage BVR
 * @since BVR 1.0
 */
get_header(); ?>

		<?php if ( have_posts() ) : ?>
			<?php
				get_template_part( 'template-parts/product', 'bvr');

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/product', 'none' );

		endif;
		?>
<?php get_footer(); ?>
