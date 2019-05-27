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
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>
	<div id="primary" class="content-area" style="width:100% !important;">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="post_title  page-title">', '</h1>' );
					//the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
				get_template_part( 'includes/category-template');

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'includes/category-template', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
