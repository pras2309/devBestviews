<?php
// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
add_theme_support( 'title-tag' );

/*
* Enable support for Post Thumbnails on posts and pages.
*
* @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1200, 9999 );


// This theme uses wp_nav_menu() in three locations accrodingly.
register_nav_menus(
    array(
		'primary' => __( 'Primary Menu', 'bvr' ),
		'category_menu' => __('Category Link', 'bvr'),
        'footer-menu'  => __( 'Footer Menu', 'bvr' ),
    )
);
/*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    /*
        * Enable support for Post Formats.
        *
        * See: https://codex.wordpress.org/Post_Formats
        */
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        )
    );

// Load regular editor styles into the new block-based editor.
add_theme_support( 'editor-styles' );

// Load default block styles.
add_theme_support( 'wp-block-styles' );

// Add support for responsive embeds.
add_theme_support( 'responsive-embeds' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since BVR Theme
 */
function bvr_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'bvr' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'bvr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);


	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 1', 'bvr' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'bvr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 2', 'bvr' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'bvr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);



}
add_action( 'widgets_init', 'bvr_widgets_init' );

//submitting the amazon product information form on the various pages.
function prod_submit_action(){
	global $wpdb;
	$response = array(
			"error" => false
	);

	if(trim($_POST['user_email']) == ''){
		$response['error'] = true;
		$response['error_message'] = "Email is required";
		exit(json_encode($response));

	}	
	//prevent XSS
	if(!isset($_POST['amazon_product_submit'])
	|| !wp_verify_nonce($_POST['amazon_product_submit'],'prod_submit_action_nonce')){
		exit("This submission is not valid.");
	}

	//now insert information into database.
	$product_url = $_POST['a_product_url'];
	$user_email = $_POST['user_email'];
	$result = $wpdb->query("INSERT INTO dev_bestviews.product_url_info(product_url, requested_by) VALUES('".esc_sql($product_url)."', '".esc_sql($user_email)."')");
	if($result == true){
		//send a mail to requested User.
		$to = $user_email;
		$subject = "Request about new product at Best Views Reviews";
		$message_body =<<<CONTENT
					<h4>Greetings for the day </h4>;
					<p>We have accepted your Enquiry regarding new product which is currently not listed at our
					website. You have submitted Following Amazon URL:</p>
					<p><strong>$product_url </strong></p>
					<p>We will notify you regarding this product soon.
					<strong>Thanks</strong>
					Best Views Reviews Team
					</p>
CONTENT;
		$res = wp_mail($to, $subject, $message_body);
		}	
				
	exit(json_encode($response));

}
add_action('wp_ajax_prod_submit_action', 'prod_submit_action');
add_action( 'wp_ajax_nopriv_prod_submit_action', 'prod_submit_action' );