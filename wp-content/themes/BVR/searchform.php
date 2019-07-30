<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage BVR
 * @since BVR 1.0
 */
?>

<div class="searchbox" style="min-width:280px;">
	   <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <i class="glyphicon glyphicon-search search-icon"></i>
		   <input type="search" class="search-input d-inline" name="s" 
		   placeholder="Search for a Product"
		   value="<?php echo get_search_query(); ?>" name="s"  
		   >
		</form>
</div>
   