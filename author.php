<?php get_header(); ?>
<div id="main">
	<div id="content" class="group">
			
		<div class="post-boxes group inner">
	<?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
	<div class="author_box">
	<div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></div>
									
    <h2 class="author_title">Posts by <?php echo $curauth->display_name; ?></h2>    
    <div class="author_meta" style="">
	<div class="author_meta_desc"><?php echo $curauth->user_description; ?></div>
	<div class="author_meta_site"><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></div>
	<div class="author_social"><a class="symbol" title='twitterbird' href="http://twitter.com/<?php echo $curauth->twitter; ?>" target="_blank"></a> <a class="symbol" title='facebook' href="http://facebook.com/<?php echo $curauth->facebook; ?>" target="_blank"></a></div>
	</div>
	</div>
    
    

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