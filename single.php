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
			        
			        $source = get_post_meta($post->ID, 'source', true );
			        $sourcelink = get_post_meta($post->ID, 'sourcelink', true );
			        $via = get_post_meta($post->ID, 'via', true );
			        $vialink = get_post_meta($post->ID, 'vialink', true );
			        ?>


					<div <?php post_class( $postclasses ); ?>>
						<div class="single-head group">
                        <!-- start .single-thumb -->
                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                        $image = $image[0]; ?>
                        <?php else :
                        $image = get_bloginfo( 'stylesheet_directory') . '/images/ss-thumb.jpg'; ?>
                        <?php endif; ?>
                            <div class="single-thumb FlexEmbed FlexEmbed--16by9" style="background-image: url('<?php echo $image; ?>')" >
                                <div class="single-title">
                                    <div class="inner">
                                        <div class="vcard author"><span class="fn">
                                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 );
                                            the_author_posts_link(); ?></span>
                                        </div>
                                        <h2 class="post-title title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="post_date date updated"><?php the_time( 'F jS, Y' ); ?></div>
                                    </div>
                                </div><!-- end .single-title -->
	                       </div><!-- end .single-thumb -->
						</div><!-- end .single-head -->
						
						<div class="inner"><div class="entry-content">
						
							<div class="interactions">
								<span><?php echo_views( get_the_ID() ); ?> <span class="favorite-icon"></span></span><?php // echo getPostLikeLink( get_the_ID() ); ?>
								<?php comments_popup_link( '<span class="none">0 <span class="comment-icon"></span></span>', '1 <span class="comment-icon"></span>', '% <span class="comment-icon"></span>' ); ?>
							</div><!-- .interactions -->						
							<?php edit_post_link('[Edit post]'); ?>
							<div class="post-text">
								<?php the_content(); ?>
							</div>
							<div class="post-refs">
								<?php if ( $source || $vialink ) { ?><p><?php } ?>
								<?php if ( $source ) { ?>
									<span class="label">Source:</span> <?php if ( $sourcelink ) { ?><a href="<?php echo $sourcelink; ?>" target="_blank"><?php } echo $source; ?><?php if ( $sourcelink ) { ?></a><?php }
								}
								if ( $via ) { ?> <span class="label">Via:</span> <?php if ( $vialink ) { ?><a href="<?php echo $vialink; ?>" target="_blank"><?php } echo $via; ?><?php if ( $vialink ) { ?></a><?php } ?>
								<?php } ?>
								<?php if ( $source || $vialink ) { ?></p><?php } ?>
								
								<p><span class="label">Filed under:</span> <?php the_category(' '); ?> <?php the_tags( '', ' ' ); ?></p>
							
							</div></div>
													
							<?php wp_related_posts()?>
							
							<a name="comments"></a><a name="respond"></a>
							<?php
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
							?>
							
						</div><!-- .inner -->
						
					</div>
				<?php endwhile; ?>
	
			<?php endif; ?>

		</div><!-- .single-post -->

	</div><!-- #content -->

<?php get_footer(); ?>
