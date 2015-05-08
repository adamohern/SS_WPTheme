<?php $options = get_option( 'evd_theme_options' ); 
?></div><!-- #main -->

<div id="footer">
	<div class="inner group">
		<div class="col foot-title">
			<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ss-logo.png" width="245px" height="42px" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a></h2>
			<?php get_search_form(); ?>
		</div>
		<div class="col foot-social">
			<?php get_social(); ?>
		</div>
		<div class="col foot-nav first-foot-nav">
			<?php evd_menu_with_name( 'footer-1' ); ?>
		</div>
		<div class="col foot-nav">
			<?php evd_menu_with_name( 'footer-2' ); ?>
		</div>
		<div class="col foot-nav">
			<?php evd_menu_with_name( 'footer-3' ); ?>
		</div>

		<div class="col copy group">
			<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <?php echo get_bloginfo( 'name', 'display' ); ?>
			
			<?php if ($options['footertext'] != '') { ?>
				<span class="footertext"><?php echo $options['footertext']; ?></span>
			<?php } ?>
			
			</p>
		</div>
	</div><!-- .inner -->
</div><!-- #footer -->

<?php wp_footer(); ?>

<?php if ($options['footerscripts'] != '') {
	echo $options['footerscripts'];
} ?>

</body>
</html>
