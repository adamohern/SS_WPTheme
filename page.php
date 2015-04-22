<?php get_header(); ?>
<div id="main">
	<div id="content" class="group single">
			
		<div class="single-post group">
	
			<?php if ( have_posts() ) : ?>
	
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$postclasses = 'post ';
					
					$fullWidth = get_post_meta($post->ID, 'fullWidth'); 
					if($fullWidth) $postclasses .= 'fullwidth ';
 
			        $hideWpautop = get_post_meta($post->ID, 'wpautop');
			        if ($hideWpautop) remove_filter('the_content', 'wpautop');
			        ?>

					<div <?php post_class( $postclasses ); ?>>
						<div class="single-head group">
							<?php the_post_thumbnail( 'singlehead' ); ?>
							
							<div class="single-head-words"><div class="inner">
	
								<h2 class="post-title title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							
							</div></div>
	
						</div><!-- .single-head -->
						
						<div class="inner">
							<?php edit_post_link('[Edit page]'); ?>						
							<div class="post-text">
								<?php the_content(); ?>
							</div>
							
						</div><!-- .inner -->
						
					</div>
				<?php endwhile; ?>
	
			<?php endif; ?>

		</div><!-- .single-post -->

	</div><!-- #content -->

<?php get_footer(); ?>