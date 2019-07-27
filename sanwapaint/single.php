<?php
  $category = get_the_category();
  $cat_id   = $category[0]->cat_ID;
  $cat_name = $category[0]->cat_name;
  $cat_slug = $category[0]->category_nicename;

  /*カテゴリごと次へ前へ　取得処理*/
  $next_post = get_termgroup_nex_pre(get_the_ID(),$cat_slug,"category","post","nex");
  $prev_poxt = get_termgroup_nex_pre(get_the_ID(),$cat_slug,"category","post","pre");

  if (!empty( $next_post )){
    $nex = get_permalink( $next_post[0]->ID );
  }
  if (!empty( $prev_poxt )){
    $pre = get_permalink( $prev_poxt[0]->ID );
  }
?>

<?php get_header(); ?>

<?php
  $cat = get_the_category();
  $cat = $cat[0];
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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


            <div class="secInner">
              <div class="vc_row wpb_row vc_row-fluid A01 ">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                      <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                          <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">

                              <h2 class="style02 style1"><?php echo $cat->name; ?></h2>
                              <?php if($cat->name == "お知らせ"): ?>
                              <h3 class="style02" style="text-align: center;">三和ペイントのお知らせです。</h3>
                              <?php else: ?>
                              <h3 class="style02" style="text-align: center;">三和ペイントの<?php echo $cat->name; ?>をお知らせします。</h3>
                              <?php endif; ?>
                            </div>
                          </div>
                          <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>





                  <div class="vc_row wpb_row vc_row-fluid A02 ">

                    <div class="title titleText">
                        <h3 class="text title style02"><?php echo get_the_title() ?></h3>
                    </div>
                  </div>

                  <div class="contentWrapper">

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

                      // ループ終わり
                      endwhile;
                      ?>
                    </div>

                  </div>
                  </div>
                  <div class="page_link">
                      <div class="paging">
                          <?php //カテゴリごとの次へ前へ ?>
                          <?php if (!empty($pre)){ ?><div class="prev"><a href="<?php echo $pre; ?>" class="leftArrow linkType1"><<前へ</a></div><?php } ?>
                          <?php if (!empty($nex)){ ?><div class="next"><a href="<?php echo $nex; ?>" class="rightArrow linkType1">次へ>></a></div><?php } ?>
<!--
                          <?php //ノーマルの次へ前へ ?>
                          <?php if (get_previous_post()):?>
                          <div class="prev"><?php previous_post_link('%link','<<前へ',TRUE); ?></div>
                          <?php endif; ?>
                          <?php if (get_next_post()): ?>
                          <div class="next"><?php next_post_link('%link','次へ>>',TRUE); ?></div>
                          <?php endif; ?>
                           -->
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


</article>

<?php get_footer(); ?>
