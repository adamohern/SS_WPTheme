<?php get_header(); ?>
<div id="main">
	<div id="content" class="group">
	
		<div class="filter-social group inner">
			<?php get_search_form(); ?>
			<div class="filter">Filter: <?php wp_nav_menu( array( 'theme_location' => 'filter', 'menu_class' => 'filter-menu', 'container' => false ) ); ?></div>
			<?php get_social(); ?>
		</div><!--.filter-social-->
							
		<div class="post-boxes group inner">
			
			<h2 class="title-flag">Latest Hotness</h2>
			
			<?php if ( have_posts() ) : ?>
				<?php $p = 0; ?>
	
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post();
					$p ++;
					if ( $p == 1 ) { ?>
							<?php post_box_loop( 'full', 'big-post' ); ?>
							<div class="sidebar">
								<div class="ad-300x250"><div class="ad primary"><?php dynamic_sidebar( 'ad-2' ); ?></div></div>
								<?php evd_reading_list(); ?>
								<div class="ad-300x250"><div class="ad secondary"><?php dynamic_sidebar( 'ad-3' ); ?></div></div>
							</div><!--.sidebar-->
					<?php
					} else if ( $p == 3 ) { ?>
						<div class="post emptyringer"></div>
						<?php post_box_loop( 'postthumb' );
					} else {
						post_box_loop( 'postthumb' );
					}
				endwhile; ?>
	
			<?php endif; ?>
			
		</div><!-- .post-boxes -->
		
		<div class="call-to-action group inner"> 
			<div class="call-to-action-inside"><?php dynamic_sidebar( 'cta-area' ); ?></div>
		</div><!-- .call-to-action -->
		
		<div class="post-boxes group inner">
			
			<?php $args = array( 'posts_per_page' => 1, 'tag' => 'solidsmack-radio' );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				<?php post_box_loop( 'radiothumb', 'horizontal' ); ?>
			<?php endforeach; 
			wp_reset_postdata(); ?>
			
			<div class="page-nav"><?php posts_nav_link(); ?></div>
			
			<a class="seemore group" href="#" data-nonce="<?php echo wp_create_nonce( 'ajax_more_posts_nonce' ); ?>" style="display: none;">See More</a>

		</div><!-- .post-boxes -->

	</div><!-- #content -->

<?php get_footer(); ?>
