<?php
/**
 * Include WordPress Loop 
 *
 * @package WordPress
 * @subpackage PostPress 1.0
 * @since PostPress 1.0
 */
?>
              <!--div class="card card-block card-inverse card-primary">
                <h4 class="card-title">Featured Post / Sticky Post</h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Read More</a>
                  <a href="#" class="card-link"><i class="fa fa-facebook fa-lg"></i></a>
                  <a href="#" class="card-link"><i class="fa fa-twitter fa-lg"></i></a>
                  <a href="#" class="card-link"><i class="fa fa-google-plus fa-lg"></i></a>
                  <a href="#" class="card-link"><i class="fa fa-pinterest fa-lg"></i></a>
              </div-->

              <!-- WP Loop -->
              <?php if (have_posts()) : ?>
              <?php while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
                <?php if (has_post_thumbnail()) { ?>
                  <div class="card-img-overlay">
                    <h4 class="card-title">
                      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                          <?php the_title(); ?>
                      </a>
                    </h4>
                    <h6 class="card-subtitle text-muted"><i class="fa fa-calendar-o"></i> <?php the_time('F jS, Y') ?></h6>
                  </div>
                  <!--img src="http://placehold.it/700x150?text=featuredImg" class="img-responsive"-->
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php echo the_post_thumbnail();  ?>
                  </a>
                <?php } else { ?>
                  <div class="card-block">
                    <h4 class="card-title">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                    <h6 class="card-subtitle text-muted"><i class="fa fa-calendar-o"></i> <?php the_time('F jS, Y') ?> </h6>
                  </div>  
                <?php } ?>
                <div class="card-block">
                  <?php 
                    if (is_single() || is_page()){
                        the_content(); 
                    } else {
                        the_excerpt();
                    } ?>
<?php
              /* Check if the post is divided in several pages. 
              If so, show the pagination
               */
              global $numpages;
              if ( $numpages > 1 ) {
                  if (is_single() || is_page()){
                      $args = array(
                          'before'           => '<nav><small>' . __( 'Pages:', 'iamsocial' ),
                          'after'            => '</small></nav>',
                          'link_before'      => '',
                          'link_after'       => '',
                          'next_or_number'   => 'number',
                          'separator'        => ' ',
                          'nextpagelink'     => __( 'Next page', 'iamsocial' ),
                          'previouspagelink' => __( 'Previous page', 'iamsocial' ),
                          'pagelink'         => '%',
                          'echo'             => 1
                      );
                      echo '<div id="navLinkPages">';
                          wp_link_pages( $args );
                      echo '</div>';
                  }
              } 
              ?>

                  <small class="postmetadata"><i class="fa fa-folder-open-o"></i> <?php _e( 'Posted in', 'postpress' ); ?> <?php the_category( ', ' ); ?></small><br>
                    <?php if (has_tag()) { ?>
                        <small><i class="fa fa-tags"></i> <?php the_tags(); ?></small><br>
                    <?php } ?>
                </div>
                <div class="card-footer">
                  <a href="#" class="card-link"><i class="fa fa-facebook fa-lg"></i></a>
                  <a href="#" class="card-link"><i class="fa fa-twitter fa-lg"></i></a>
                  <a href="#" class="card-link"><i class="fa fa-google-plus fa-lg"></i></a>
                  <a href="#" class="card-link"><i class="fa fa-pinterest fa-lg"></i></a>
                  
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="card-link">
                    <?php comments_number( '', '<i class="fa fa-comment-o"></i> <small>One Comment</small>', '<i class="fa fa-comment-o"></i> <small>% Comments</small>' );?>
                  </a>
                </div>
              </article>
              <?php
              /* Check if the post is divided in several pages. 
              If so, show the pagination
               */
              global $numpages;
              if ( $numpages > 1 ) {
                  if (is_single() || is_page()){
                      $args = array(
                          'before'           => '<nav><small>' . __( 'Pages:', 'iamsocial' ),
                          'after'            => '</small></nav>',
                          'link_before'      => '',
                          'link_after'       => '',
                          'next_or_number'   => 'number',
                          'separator'        => ' ',
                          'nextpagelink'     => __( 'Next page', 'iamsocial' ),
                          'previouspagelink' => __( 'Previous page', 'iamsocial' ),
                          'pagelink'         => '%',
                          'echo'             => 1
                      );
                      echo '<article>';
                          wp_link_pages( $args );
                      echo '</article>';
                  }
              } 
              ?>
              <?php comments_template(); ?> <!-- Change this: put in single -->
            <?php endwhile; ?> 

            <!-- Navigation within category/archive/blog -->
            <?php   
            $prev_link = get_previous_posts_link();
            $next_link = get_next_posts_link();
            // checking if there is next or previous. If yes, show the nav.
            if ($prev_link || $next_link) { ?>
              <nav class="nav nav-inline" id="prev-next">
                <?php next_posts_link( '<i class="fa fa-chevron-left"></i> '.__('Previous Posts', 'postpress') ); ?>
                <?php previous_posts_link( __('Next Posts', 'postpress').' <i class="fa fa-chevron-right"></i>' ); ?>
              </nav>
            <?php } ?> 

            <!-- Navigation within single -->
            <?php  if (is_single()){  ?>
                    <nav class="nav nav-inline" id="prev-next">
                        <?php next_post_link('%link', '<i class="fa fa-chevron-left"></i> '.__('Prev', 'postpress'), TRUE); ?>
                        <?php previous_post_link('%link', __('Next', 'postpress').' <i class="fa fa-chevron-right"></i>', TRUE); ?>
                    </nav>
            <?php } ?>  

            <!-- No post found -->           
            <?php else : ?>
                    <h2 class="center"><?php _e('Not Found','postpress'); ?></h2>
                    <p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", "postpress"); ?></p>
            <?php endif; ?>
