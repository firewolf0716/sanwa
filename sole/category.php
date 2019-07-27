
<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nanairo
 */

get_header(); ?>
<!-- category -->
<div id="categoryList" class="container-fluid">

    <div id="twoColumnRightSideBar" class="category-page twoColumnRightSideBar page-template-page-2columnRightSidebar">

		<div id="primary" class="entry-content">
            <main id="main" class="site-main" role="main">
        <?php
        parse_str($query_string, $args);
        $args['posts_per_page'] = 20;
        $args['orderby'] = array( 'post_date' => 'DESC', 'ID' => 'DESC' );
        query_posts($args);
         ?>
				<?php if ( have_posts() ) : ?>

          <!--start newsWrap_section-->
          <section id="newsWrap" class="">
            <div class="secInner fixedWidth">
              <?php
                the_archive_title( '<h1 class="category_title style1">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
              ?>
              <div class="category_wrap">
                  <?php
                  /* Start the Loop */
                    while (have_posts()) : the_post();  ?>
                  <div class="news_row">
                  <span class="news_date"><?php echo get_the_date(); ?></span>
                  <h3 class="news_title">
                      <i class="fa fa-caret-right" aria-hidden="true"></i>
                      <a href="<?php the_permalink(); ?>" class="news_link">
                          <?php
                          if(mb_strlen($post->post_title, 'UTF-8')>40){
                              $title= mb_substr($post->post_title, 0, 40, 'UTF-8');
                              echo $title.'…';
                          }else{
                              echo $post->post_title;
                          }?>
                      </a>
                  </h3>
                  </div><!--/.news_row-->
                    <?php endwhile;
                         if (function_exists('wp_pagenavi')) {
                           echo '<div class="pagenation">';
                           echo wp_pagenavi();
                           echo '</div>';
                         }
                        endif; ?>
                </div><!--/.caltegory_wrap-->
            </div><!--end secInner-->
          </section><!--end newsWrap_section-->
				</main><!-- /#main -->

			</div><!--/.primary-->

			<!--sidebar-->
			<div id="sidebar">
				<?php
					dynamic_sidebar( 'news-sidebar' );
					?>
			</div><!--/.sidebar-->

    	</div><!--/#cagetory-page -->

    </div><!--/.container-fluid-->

<?php

get_footer();
