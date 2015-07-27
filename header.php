<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Arvo|Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<?php $options = get_option( 'evd_theme_options' ); 
if ( $options['headerscripts'] != '') {
	echo $options['headerscripts'];
} ?>
</head>
<body <?php body_class(); ?>>
	<div id="header">
		<div class="inner group">
			<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ss-logo@2X.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="200" height="34" /></a></h1>

			<div class="mobile mobile-nav">
				<a href="#menu" class="menu-toggle">MENU<span class="menu-icon"> &#9776;</span></a>
				<div class="mobile-drop-down">
					<?php wp_nav_menu( array( 'theme_location' => 'global', 'menu_class' => 'mobile-menu', 'container' => false ) ); ?>
					<?php get_search_form(); ?>
				</div>
			</div>
		
			<div class="ad-970x90">
				<div class="ad"><?php dynamic_sidebar( 'ad-1' ); ?></div>
			</div><!-- .ad -->

		</div><!-- .inner -->
	</div><!-- #header -->