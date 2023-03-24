<?php get_header(); ?>
    <div id="primary">
        <div id="postlist">
            <?php
                $full_content = daniot_settings( 'full-content' );

            if ( have_posts() ):while ( have_posts() ) : the_post();
                $post_thumbnail = daniot_thumbnail( 'index-thumbnail', 260, 260 );
                $post_class     = 'post';

                if ( !$full_content && $post_thumbnail["exist"] ) {
                    $post_class .= ' post-has-thumbnail';
                }
                ?>
                <div id="post-<?php the_ID(); ?>" class="<?php echo $post_class; ?>">
                    <div class="post-header">
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            <?php if ( is_sticky() ) { ?>
                                <span class="post-sticky"><?php _e( 'Stick', daniot_NAME ); ?></span>
                            <?php } ?>
                        </h2>
                    </div>
                    <div class="post-meta">
                        <ul class="inline-ul">
                            <li class="inline-li">
                                <?php echo daniot_time_since(strtotime($post->post_date_gmt)); ?>
                            </li>
                            <li class="inline-li">
                                <span class="post-span">·</span>
                            </li>
                            <li class="inline-li">
                                <?php the_category( ' , ' ); ?>
                            </li>
                            <?php daniot_views(); ?>
                            <li class="inline-li">
                                <span class="post-span">·</span>
                            </li>
                            <li class="inline-li">
                                <?php comments_popup_link( __( '0 reply', daniot_NAME ), __( '1 reply', daniot_NAME ), __( '% replies', daniot_NAME ) ); ?>
                            </li>
                            <?php daniot_likes(); ?>
                        </ul>
                    </div>
                    <div class="post-body">
                        <?php if ( $full_content ) {
                            the_content();
                        } else {
                            if ( $post_thumbnail["exist"] ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink() ?>" rel="bookmark">
                                        <img class="lazy"
                                             src="<?php echo daniot_cdn( daniot_image( 'placeholder.png' ) ); ?>"
                                             data-original="<?php echo daniot_cdn( $post_thumbnail ); ?>"
                                             alt="<?php the_title(); ?>" width="130" height="130"/>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <?php printf( '<p>%s</p>', daniot_excerpt( $post->post_content, 320 ) ); ?>
                                </div>
                            <?php else : ?>
                                <div class="post-content">
                                    <?php printf( '<p>%s</p>', daniot_excerpt( $post->post_content, 250 ) ); ?>
                                </div>
                            <?php endif;
                        } ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <div class="pagenavi">
            <?php daniot_pagenavi(); ?>
        </div>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>