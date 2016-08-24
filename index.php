<?php get_header(); ?>
<!-- CONTENT -->

    <?php if(rehub_option('rehub_featured_toggle') && is_front_page() && !is_paged()) : ?>
        <?php get_template_part('inc/parts/featured'); ?>
    <?php endif; ?>
	<div class="content">
    <?php if(rehub_option('rehub_homecarousel_toggle') && is_front_page() && !is_paged()) : ?>
        <?php get_template_part('inc/parts/home_carousel'); ?>
    <?php endif; ?>
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix<?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?> full_width<?php endif ;?>">
            <!-- <div class="wpsm-title under-title-line middle-size-title"><h5><?php _e('Latest Posts', 'rehub_framework'); ?></h5></div> -->
            <?php
                $module_exclude = rehub_option('rehub_exclude_posts');
                if(($module_exclude) == 1) {
                        $exclude_posts = rehub_exclude_feature_posts();
                }
                else $exclude_posts ='';
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                  'paged' => $paged,
                  'post__not_in' => $exclude_posts
                );
            ?>
            <?php $query = new WP_Query( $args ); ?>
            <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid') : ?>
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
                <div class="masonry_grid_fullwidth two-col-gridhub">
            <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?>
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
                <div class="masonry_grid_fullwidth three-col-gridhub">
            <?php endif ;?>

            <?php
            if ($query->have_posts()) {
              $i = 0;
              while ($query->have_posts()) {
                if ($i == 2) { ?>
                  <article class="small_post" style="position: absolute; left: 767px; top: 0px;">
                    <div class="top">
                        <div class="cats_def">
                            <a href="http://solidsmack.wpstagecoach.com/category/radio/" class="cat-4738">SPONSORED</a>
                          </div>
                        </div>
                    <h2><a href="http://solidsmack.wpstagecoach.com/radio/solidsmack-radio-fillet-funkdown-lost-my-edge-2/">Brought to you by Ketchup</a></h2>
                    <div class="post-meta">
                      <span class="admin_meta"><a class="admin" href="http://solidsmack.wpstagecoach.com/author/solidsmack/">Ketchup</a></span>
                	 </div>

                    <figure>
                         <div class="social_icon  social_icon_inimage small_social_inimage"><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsolidsmack.wpstagecoach.com%2Fradio%2Fsolidsmack-radio-fillet-funkdown-lost-my-edge-2%2F" class="fb share-link-image" data-service="facebook"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/share?url=http%3A%2F%2Fsolidsmack.wpstagecoach.com%2Fradio%2Fsolidsmack-radio-fillet-funkdown-lost-my-edge-2%2F&amp;text=SolidSmack+Radio+%7C+VR+Technicolor+Daydream" class="tw share-link-image" data-service="twitter"><i class="fa fa-twitter"></i></a><a href="https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fsolidsmack.wpstagecoach.com%2Fradio%2Fsolidsmack-radio-fillet-funkdown-lost-my-edge-2%2F&amp;media=http://solidsmack.wpstagecoach.com/wp-content/uploads/2016/02/FEATURE.jpg&amp;description=SolidSmack+Radio+%7C+VR+Technicolor+Daydream" class="pn share-link-image" data-service="pinterest"><i class="fa fa-pinterest-p"></i></a></div>                         <div class="pattern"></div>
                         <a href="http://solidsmack.wpstagecoach.com/radio/solidsmack-radio-fillet-funkdown-lost-my-edge-2/"><img src="http://solidsmack.wpstagecoach.com/wp-content/uploads/2016/02/FEATURE.jpg" width="336" height="220" alt="SolidSmack Radio | VR Technicolor Daydream"></a>
                    </figure>

                    <p>Do you like ketchup? So do we. Here's why.</p>
                  	<a href="http://solidsmack.wpstagecoach.com/radio/solidsmack-radio-fillet-funkdown-lost-my-edge-2/" class="btn_more">READ MORE  +</a>

                  </article>
                <?php
                } else {
                  $query->the_post();
                  if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_blog') :
                      get_template_part('inc/parts/query_type2');
                  elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_list') :
                      get_template_part('inc/parts/query_type1');
                  elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid' || rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') :
                      get_template_part('inc/parts/query_type3');
                  else :
                      get_template_part('inc/parts/query_type1');
                  endif;
                }

                $i++;
              }
            }
            ?>

            <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid' || rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?></div><?php endif ;?>
            <div class="clearfix"></div>
            <?php rehub_pagination(); ?>
            <?php wp_reset_query(); ?>
        </div>
        <!-- /Main Side -->
        <?php if (rehub_option('rehub_framework_archive_layout') != 'rehub_framework_archive_gridfull') : ?>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- /Sidebar -->
        <?php endif ;?>
    </div>
</div>
<!-- /CONTENT -->
<!-- FOOTER -->
<?php get_footer(); ?>
