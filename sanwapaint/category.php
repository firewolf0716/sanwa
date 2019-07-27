
<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nanairo
 */

get_header(); ?>

<?php
  $cat = get_the_category();
  $cat = $cat[0];
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<!-- category son -->
<div id="categoryList" class="maxWidth container-fluid cat-<?php echo $cat->category_nicename; ?>">

    <div id="twoColumnRightSideBar" class="category-page twoColumnRightSideBar page-template-page-2columnRightSidebar">

		<div id="primary" class="entry-content">
            <main id="main" class="site-main" role="main">
        <?php
        parse_str($query_string, $args);
        $args['posts_per_page'] = 20;
        $args['orderby'] = array( 'post_date' => 'DESC', 'ID' => 'DESC' );
        $args['post_status'] = 'publish';
        query_posts($args);
         ?>
				<?php if ( have_posts() ) : ?>

          <!--start newsWrap_section-->
          <section id="newsWrap" class="">
            <div class="secInner">
              <div class="vc_row wpb_row vc_row-fluid A01 maxWidth">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                      <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                          <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                              <?php
                                the_archive_title( '<h2 class="style02 style1">', '</h2>' );
                              ?>
                              <?php if($cat->name == "お知らせ"): ?>
                              <h3 class="style02" style="text-align: center;">三和ペイントからのお知らせです。</h3>
                              <?php else: ?>
                              <h3 class="style02" style="text-align: center;">三和ペイントからの<?php echo $cat->name; ?>をお知らせします。</h3>
                              <?php endif; ?>
                            </div>
                          </div>
                          <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>

              <div class="category_wrap">
                  <?php
                  /* Start the Loop */
                    while (have_posts()) : the_post();  ?>
                  <div class="news_row">
                  <span class="news_date"><?php echo get_the_date("Y.m.d"); ?></span>
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


</article><!-- #post-## -->


<?php

get_footer();
