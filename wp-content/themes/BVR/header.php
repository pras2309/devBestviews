<!DOCTYPE html>
<html 
	<?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
					<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
					<?php  // If there is a post
					if ( is_single() ):
						$title = single_post_title( '', false );
					?>
						<title>
						Summary of reviews for :  
							<?php echo $title; ?>
						</title>
					<?php elseif (is_search()): 
					$search = $_GET['s'];
					$title = sprintf( __( 'Search Results for %1$s' ), strip_tags( $search ) );	
					?>
					<title>
						Best Views Reviews ::
								<?php echo $title; ?>
							</title>
					<?php else: ?>
							<title>
								Summary of reviews for : 
								<?php single_cat_title(); ?>
							</title>
					<?php endif; ?>
					<!-- Bootstrap -->
					<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
						<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
							<link href="
								<?php bloginfo('template_url'); ?>/css/style.css" rel="stylesheet">
								<!-- <link rel="stylesheet" media="screen" href="http://fontlibrary.org/face/rubik" type="text/css"/> -->
								<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&display=swap" rel="stylesheet">
								<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
								<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
								<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
								<!--[if lt IE 9]>
								<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
								<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
								<![endif]-->
							<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css"/>
								<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css"/>	
								<?php 
									global $post;
									 if(isset($post->ID)):
										 echo do_shortcode("[get-product-info post_id = $post->ID]"); 
									endif; ?>
								<link href="<?php bloginfo('template_url'); ?>/css/thumbnail/jquery.desoslide.min.css" rel="stylesheet">
								<link href="<?php bloginfo('template_url'); ?>/css/thumbnail/animate.min.css" rel="stylesheet">
								<link href="<?php bloginfo('template_url'); ?>/css/thumbnail/magic.min.css" rel="stylesheet">
								<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>
								<style type="text/css">
								.wordcloud {
								height: 4in;
								margin: 0.5in auto;
								padding: 0;
								page-break-after: always;
								page-break-inside: avoid;
								width: 7in;
								}
								.detail-text-title > img {
									display:none;
								}
								</style>

								<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
								<?php wp_head(); ?>
										</head>
										<body 
											<?php body_class(); ?>>
											<div class="header">
												<div class="container">
													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-12 navigation">
															<nav class="navbar navbar-default">
																<div class="container-fluid">
																	<!-- Brand and toggle get grouped for better mobile display -->
																	<div class="navbar-header">
																		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
																			<span class="sr-only">Toggle navigation</span>
																			<span class="icon-bar"></span>
																			<span class="icon-bar"></span>
																			<span class="icon-bar"></span>
																		</button>
																		<a class="navbar-brand" href="
																			<?php echo esc_url( home_url( '/' ) ); ?>">
																			<img src="
																				<?php bloginfo('template_url'); ?>/images/logo-new.png" class="logo"/>
																			</a>
																		</div>
																		<!-- Collect the nav links, forms, and other content for toggling -->
																		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
																			<?php wp_nav_menu(array('theme_location'=>'primary', 'menu_class'=> 'nav navbar-nav navbar-right')); ?>

																		</div>

																		<!-- /.navbar-collapse -->
																	</div>
																	<!-- /.container-fluid -->
																</nav>
															</div>
														</div>

