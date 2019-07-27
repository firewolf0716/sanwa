<?php
  $category = get_the_category();
  $cat_id   = $category[0]->cat_ID;
  $cat_name = $category[0]->cat_name;
  $cat_slug = $category[0]->category_nicename;
?>

<?php get_header(); ?>


<div id="wholeContents" class="wholeContents page-php" role="main">
    <div id="mainContents" class="mainContents">


      <?php
        //カテゴリ処理
        //echo do_shortcode('[shop_image_html  '.$cat_name.']');
      ?>
        <div id="newsDetails" class="maxWidth">
          <div class="products_main">
              <div class="secInner">
                <div class="DetailsWrap">
                    <div class="title titleText">
                        <h2 class="text title"><?php echo get_the_title() ?></h2>
                    </div>
                    <div class="date">
                        <?php echo get_the_date('Y.m.d'); ?>
                    </div>
                    <div class="main_news">
                        <?php
                        // $this_content= wpautop($post->post_content);
                        // echo $this_content;
                        ?>
                      <?php
                      // ループ開始
                      while ( have_posts() ) : the_post();

                        // content-single.phpをロード
                        get_template_part( 'template-parts/content', 'page' );//

                        // コメント表示がオンになっていて、1つ以上のコメントがついている場合表示する
                        if ( comments_open() || get_comments_number() ) :
                          comments_template();
                        endif;
                      // ループ終わり
                      endwhile;
                      ?>
                    </div>
                  </div>
                  <div class="page_link">
                      <div class="paging">
                          <?php if (get_previous_post()):?>
                          <div class="prev"><?php previous_post_link('%link','<<前へ',TRUE); ?></div>
                          <?php endif; ?>
                          <?php if (get_next_post()): ?>
                          <div class="next"><?php next_post_link('%link','次へ>>',TRUE); ?></div>
                          <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
          <?php
          // サイドバースタイルのときはコメントアウトを解除
          // echo'<div id="sidebar" class="side">';
          // echo' <div class="secInner">';
          // echo'   <div id="mypageSidebar" class="">';
          // echo'     <div class="sidebarTitle">';
          // echo'      <p></p>';
          // echo'     </div><!-- sidebarTitle -->';

          // dynamic_sidebar('mypage_news-sidebar');
          // echo'   </div><!--/#mypageSidebar -->';
          // echo'  </div><!-- /.secInner -->';
          // echo'</div><!-- /#sidebar -->';
            ?>

        </div>
    </div><!--#mainContents-->
</div><!--#wholeContents-->


<?php get_footer(); ?>
