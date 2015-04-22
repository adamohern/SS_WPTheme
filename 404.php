<?php get_header(); ?>
<div id="main">
	<div id="content" class="group">

		<div class="group inner">
			<h2 class="archive-title" style="float:none;">Whoops! That's not here! Try another search or check out these recent posts.</h2>
<div class="wide-search"><?php get_search_form(); ?></div>
		</div>
			
		<div class="post-boxes group inner">

			<?php $args = array( 'posts_per_page' => 6 );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				<?php post_box_loop( 'postthumb' ); ?>
			<?php endforeach; 
			wp_reset_postdata(); ?>

		</div><!-- .post-boxes -->

	</div><!-- #content -->

<?php get_footer(); ?>