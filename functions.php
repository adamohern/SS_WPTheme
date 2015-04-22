<?php

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// header navigation
	register_nav_menu( 'global', 'Global Nav (for mobile)' );
	
	// header navigation
	register_nav_menu( 'filter', 'Filter Nav' );
	
	// footer col 1
	register_nav_menu( 'footer-1', 'Footer Column 1' );
	
	// footer col 2
	register_nav_menu( 'footer-2', 'Footer Column 2' );
	
	// footer col 3
	register_nav_menu( 'footer-3', 'Footer Column 3' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	register_sidebar( array(
		'name' => 'Call to Action Area',
		'id' => "cta-area",
		'description' => 'Widgets in this area will be shown in the Call to Action area on the home page. Text Widget works well here.',
		'before_widget' => '',
		'after_widget'  => ''
	) );

	register_sidebar( array(
		'name' => 'Ad - home - top',
		'id' => "ad-1",
		'description' => 'This appears in the header bar. Text Widget works well here. 970x90.',
		'before_widget' => '',
		'after_widget'  => ''
	) );

	register_sidebar( array(
		'name' => 'Ad - home - side - top',
		'id' => "ad-2",
		'description' => 'This appears to the right of the big post. Text Widget works well here. 300 width.',
		'before_widget' => '',
		'after_widget'  => ''
	) );
	
	register_sidebar( array(
		'name' => 'Ad - home - side - bottom',
		'id' => "ad-3",
		'description' => 'This appears below the reading list. Text Widget works well here. 300 width.',
		'before_widget' => '',
		'after_widget'  => ''
	) );
	
	register_sidebar( array(
		'name' => 'Ad - archive - bottom',
		'id' => "ad-5",
		'description' => 'This appears at the bottom of archive pages. Text Widget works well here. 970x90.',
		'before_widget' => '',
		'after_widget'  => ''
	) );
	
	register_sidebar( array(
		'name' => 'Social Area',
		'id' => "social-area",
		'description' => 'Widgets in this area will be shown in the Social area on the home page. Text Widget works well here.',
		'before_widget' => '',
		'after_widget'  => ''
	) );
	
	// add post types to home page
	function my_cpt_posts( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'projects' ) );
	return $query;
	}	
	add_filter( 'pre_get_posts', 'my_cpt_posts' );
	
	// Add custom post types to main RSS feed
	function my_cpt_feed( $query ) {
	if ( $query->is_feed() )
		$query->set( 'post_type', array( 'post', 'projects', 'reading-list' ) ); 
	return $query;
	}
	add_filter( 'pre_get_posts', 'my_cpt_feed' );
	
	if ( ! isset( $content_width ) ) $content_width = 800;

	add_image_size( 'postthumb', 336, 185, true ); // width, height, crop
	add_image_size( 'radiothumb', 336, 240, true ); // width, height, crop
	add_image_size( 'singlehead', 1920, 1920, false ); // width, eight, crop
	function custom_excerpt_length( $length ) {
		return 30;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	function custom_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'custom_excerpt_more' );

	// register theme scripts
	function register_theme_scripts_method() {
	    wp_enqueue_script( 'jquery' );
	    wp_enqueue_script( 'custom', get_template_directory_uri() . '/scripts/jquery.custom.js', array( 'jquery' ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'register_theme_scripts_method' );



	function title_truncate( $string, $char_lim, $append='&hellip;' ) {
		if (strlen($string) <= $char_lim) return $string;
	    
	    $last_space = strrpos(substr($string, 0, $char_lim), ' ');
     	$trimmed_text = substr($string, 0, $last_space);
     	$trimmed_text .= $append;
    	return $trimmed_text;
	}



	//various post / feature loops	
	
	function post_box_loop( $thumb_size = 'postthumb', $post_classes = '' ) {
	
		$permalink = get_permalink(); ?>
		<div <?php post_class( $post_classes ); ?>>
			<div class="post-visual">
				<?php if ( ! has_post_video() ) { ?>
					<a href="<?php echo $permalink; ?>"><?php the_post_thumbnail( $thumb_size ); ?><div class="overlay"></div>	</a>
				<?php } else {
					$size = apply_filters( 'post_thumbnail_size', $thumb_size );
					the_post_video( $size );
				} ?>
				<div class="category"><?php echo get_the_category_list( ' ' ); ?></div>	
			</div><!-- .postvisual -->
			<div class="post-text">
				<h2 class="post-title"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h2>
				<div class="date"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></div>
				<div class="post-excerpt"><?php the_excerpt(); ?></div>
				<div class="post-meta">
					<div class="author avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 30 );
						the_author_posts_link(); ?>
					</div>
					<div class="interactions">
						<span><?php echo_views( get_the_ID() ); ?> <span class="favorite-icon"></span></span><?php //echo getPostLikeLink( get_the_ID() ); ?>
						<?php comments_popup_link( '<span class="none">0 <span class="comment-icon"></span></span>', '1 <span class="comment-icon"></span>', '% <span class="comment-icon"></span>' ); ?>
					</div><!-- .interactions -->
				</div><!-- .post-meta -->
			</div><!-- .posttext -->
		</div><!-- .post -->
	<?php
	} // post_box_loop()

	
	function return_7200( $seconds ) { // change the default feed cache recreation period to 2 hours
	  return 7200;
	}
		
	
	function get_social() {
		$theme = get_stylesheet_directory_uri();
		?><?php dynamic_sidebar( 'social-area' ); ?><?php
	}
	
	
	function evd_menu_with_name( $menu_location = '' ) {
		$menu_locations = get_nav_menu_locations();
		$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
		$menu_name = (isset($menu_object->name) ? $menu_object->name : '');
		wp_nav_menu( array( 'theme_location' => $menu_location, 'items_wrap' => '<h3>'. esc_html($menu_name) . '</h3><ul id="%1$s" class="%2$s">%3$s</ul>' ) );
	}
	
	
	
	
	function evd_reading_list() {
		?><div class="reading-list-widget" style="padding-top:10px;">
<h4><a class="twitter-timeline" width="100%" data-dnt="true" href="https://twitter.com/SolidSmack" data-widget-id="564791627802087426">SolidSmack on Twitter</a></h4>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div><!--.reading-list-widget--><?php
	}
	
	
	include 'includes/post-like.php';
	include 'includes/evd_shortcodes.php';
	include 'includes/evd_postsList.php';
	include 'includes/evd_postmeta.php';
	include 'includes/evd_custom.php';

	
	function secondsToHMS($duration){ // pulled from evd_utilities in evd_wpStarter
	    $seconds = sprintf("%02d",$duration % 60);
	    $duration = ($duration - $seconds) / 60;
	    $minutes = sprintf("%02d",$duration % 60);
	    $hours = sprintf("%02d",($duration - $minutes) / 60);
	    $duration = "$hours:$minutes:$seconds";
	    
	    return $duration;
	}
	
	function enqueue_ace() {
		wp_register_script( 'ace', 'http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js' );
		wp_enqueue_script( 'ace' );
	}



	function my_new_contactmethods( $contactmethods ) {
		// Add Twitter
		$contactmethods['twitter'] = 'Twitter';
		//add Facebook
		$contactmethods['facebook'] = 'Facebook';
		 
		return $contactmethods;
	}
	add_filter('user_contactmethods','my_new_contactmethods',10,1);


	// theme options

	add_action( 'admin_init', 'theme_options_init' );
	add_action( 'admin_menu', 'theme_options_add_page' ); 

	function theme_options_init(){
	 register_setting( 'evd_options', 'evd_theme_options');
	}

	function theme_options_add_page() {
	 add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
	}

	function theme_options_do_page() {
	
		//must check that the user has the required capability 
	    if (!current_user_can('manage_options'))
	    {
	      wp_die( __('You do not have sufficient permissions to access this page.') );
	    }
		
		if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false; ?>

	<div class="wrap">
		<h2>Theme Options</h2>
		
		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div id="setting-error-settings_updated" class="updated settings-error">
				<p><strong>Settings saved.</strong></p>
			</div>
		<?php endif; ?> 	
		
		<form method="post" action="options.php">
			<?php settings_fields( 'evd_options' ); ?>  
			
			<?php $options = get_option( 'evd_theme_options' ); ?>
			
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="evd_theme_options[headerscripts]">Scripts to go in the head tag</label></th>
						<td>
							<textarea id="evd_theme_options[headerscripts]" type="text" name="evd_theme_options[headerscripts]" class="large-text code" rows="10"><?php esc_attr_e( $options['headerscripts'] ); ?></textarea>
							<p class="description">This will go at the very end of the head tag of all pages.</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="evd_theme_options[footerscripts]">Scripts to go in the footer</label></th>
						<td>
							<textarea id="evd_theme_options[footerscripts]" type="text" name="evd_theme_options[footerscripts]" class="large-text code" rows="10"><?php esc_attr_e( $options['footerscripts'] ); ?></textarea>
							<p class="description">This will go in the footer of all pages.</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="evd_theme_options[footertext]">Footer link text</label></th>
						<td>
							<textarea id="evd_theme_options[footertext]" type="text" name="evd_theme_options[footertext]" class="large-text code" ><?php esc_attr_e( $options['footertext'] ); ?></textarea>
							<p class="description">Will show up to the right of copyright in footer</p>
						</td>
					</tr>
				</tbody>
			</table>

			<p class="submit">
				<input type="submit" value="Save Options" class="button button-primary" />
			</p>
		</form>
	</div>
	<?php }


?>