<?php get_header(); ?>
<div id="main">
	<div id="content" class="group">
			
		<div class="post-boxes group inner">
		
			<h2 class="archive-title">
				<?php
				if ( is_day() ) {
					echo 'Daily Archives: ' . get_the_date();
				} else if ( is_month() ) {
					echo 'Monthly Archives: ' . get_the_date( 'F Y' );
				} else if ( is_year() ) {
					echo 'Yearly Archives: ' . get_the_date( 'Y' );
				} else if ( is_category() ) {
					echo 'Category Archives: ' . single_cat_title( '', false );
				} else if ( is_tag() ) {
					echo 'Tag Archives: ' . single_tag_title( '', false );
				} else if ( is_search() ) {
					echo 'Search Results for: ' . get_search_query();
				} else if ( is_post_type_archive() ) {
					echo post_type_archive_title();
				} else {
					echo 'Archives';
				} ?>
			</h2>
			
			<div class="filter-social group inner">
			<?php get_search_form(); ?>
			<?php get_social(); ?>
		</div><!--.archive-social-->

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php post_box_loop( 'radiothumb', 'horizontal post' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>
			
			<div class="page-nav">
				<div class="alignleft"><?php next_posts_link( '&laquo; Older Posts' ); ?></div>
				<div class="alignright"><?php previous_posts_link( 'Newer Posts &raquo;' ); ?></div>
			</div>

			<div class="ad-970x90 group">
				<div class="ad"><?php dynamic_sidebar( 'ad-5' ); ?></div>
			</div><!-- .ad -->

		</div><!-- .post-boxes -->

	</div><!-- #content -->

<?php get_footer(); ?>