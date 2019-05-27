<?php
/*
Template Name: URL Lists
*/

global $wpdb;
$query = "SELECT p.id as `post_id`, p.post_title as `post_title`, 
        t.name as `article_category`
        FROM wp_posts p, 
        wp_terms t, 
        wp_term_relationships tr, 
        wp_term_taxonomy tx
        WHERE p.post_type = 'post'
        AND p.post_status = 'publish'
        AND tx.taxonomy = 'category'
        AND p.ID = tr.object_id
        AND tr.term_taxonomy_id = t.term_id
        AND tx.term_id = t.term_id";
$results = $wpdb->get_results($query);
$rowcount = $wpdb->num_rows;

/*
*
* 
*/
get_header(); 
?>

<div class="container">
    <div class="row">
            <table class="table table-responsive  table-hover">
                <thead>
                <tr>
                    <th>Article Title</th>
                    <th> Article Category </th>
                    <th>URL</th>
                </tr>
                </thead>
                <?php
                foreach($results as $result ){
                ?>
                    <tr>
                        <td><?php echo $result->post_title; ?></td>
                        <td><?php echo $result->article_category; ?></td>
                        <td><?php echo get_permalink( $result->post_id ); ?></td>
                    </tr>
                <?php } ?>      
                <tbody>

                </tbody>
            </table>
    </div>
</div>



<?php
get_footer();
?>
