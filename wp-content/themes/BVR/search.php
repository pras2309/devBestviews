<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage BVR
 * @since BVR 1.0
 */

get_header();
?>
	</div>
</div>
<?php

	get_template_part( 'includes/search-template', 'search' );
?>
<section class="other_products">
            <div class="container" style="text-align:left;">

<?php get_template_part('template-parts/top-footer'); ?>
<?php get_footer(); ?>
