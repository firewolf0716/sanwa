<?php
  $category = get_the_terms(get_the_ID(), "cocorotosous");
  if(is_array($category)){
   foreach ($category as $category_value) {
    if($category_value->slug == "all")continue;
      $cat_name = $category_value->name;
      $cat_slug = $category_value->slug;
   }
  }

  /*カテゴリごと次へ前へ　取得処理*/
  $next_post = get_termgroup_nex_pre(get_the_ID(),$cat_slug,"cocorotosous","cocorotosou","nex");
  $prev_poxt = get_termgroup_nex_pre(get_the_ID(),$cat_slug,"cocorotosous","cocorotosou","pre");

  if (!empty( $next_post )){
    $nex="";
    $neximg="";
    $nextitle="";
    $nex = get_permalink( $next_post[0]->ID );
    $neximg = get_thumbnail($next_post[0]->ID);
    $nextitle = get_the_title( $next_post[0]->ID );
  }
  if (!empty( $prev_poxt )){
    $pre="";
    $preimg="";
    $pretitle="";
    $pre = get_permalink( $prev_poxt[0]->ID );
    $preimg = get_thumbnail($prev_poxt[0]->ID);
    $pretitle = get_the_title( $prev_poxt[0]->ID );
  }


  //echo "<!--<pre>"; var_dump($next_post); echo "</pre>--><br>";
?>

<?php get_header("cocoro"); ?>


<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="mainContents" class="mainContents">


    <section class="articleDetail">
      <div class="sec_inner maxWidth">
        <div class="thisArticleBox">
          <div class="TABInner">
            <?php
            // ループ開始
            while ( have_posts() ) : the_post();
            ?>
            <div class="categoryBox flex fWrap_wrap">
              <?php
              //カテゴリ
              $catname = "";
              $catlink = "";
              $catnames = get_the_terms(get_the_ID(), "cocorotosous");
              if(is_array($catnames)){
               foreach ($catnames as $catnames_value) {
                if($catnames_value->slug == "all")continue;
                $catname = $catnames_value->name;
                $catlink = "/cocorotosous/".$catnames_value->slug;
                echo "<a href='{$catlink}'>{$catname}</a>";
               }
              }
              $nullcat = "";
              if(empty($catname))$nullcat="style='display:none;'";
               ?>
            </div>
            <div class="titleBox">
              <h2><?php echo get_the_title(); ?></h2>
              <span><?php echo get_the_date("Y.m.d H:i"); ?></span>
            </div>
            <div class="articleBox">
              <?php echo do_shortcode(get_the_content()); ?>
            </div>
            <div class="relationTitle">
              <h4>関連するタグ</h4>
            </div>
            <div class="relationBox flex fWrap_wrap">
              <?php
              //カテゴリ
              $tagname = "";
              $taglink = "";
              $tagnames = get_the_terms(get_the_ID(), "cocorotosou_tag");
              if(is_array($tagnames)){
               foreach ($tagnames as $tagnames_value) {
                $tagname = $tagnames_value->name;
                $taglink = "/cocorotosou_tag/".$tagnames_value->slug;
                echo "<a href='{$taglink}'>#{$tagname}</a>";
               }
              }
              $nulltag = "";
              if(empty($tagname))$nulltag="style='display:none;'";
               ?>
            </div>
            <?php
            echo do_shortcode('[sns]');
            // ループ終わり
            endwhile;
            ?>
          </div>
        </div>

        <div class="NextPrevBox flex">
          <?php //カテゴリごとの次へ前へ ?>
          <div class="prevArticle">
          <?php if (!empty($pre)){ ?>
            <a href="<?php echo $pre; ?>">
              <span><< 前の記事</span>
              <div class="backimage" style="background-image:url(<?php echo $preimg; ?>)"></div>
              <div class="prevArticleTitle"><?php echo $pretitle; ?></div>
            </a>
          <?php } ?>
          </div>
          <div class="nextArticle">
          <?php if (!empty($nex)){ ?>
            <a href="<?php echo $nex; ?>">
              <span>次の記事 >></span>
              <div class="backimage" style="background-image:url(<?php echo $neximg; ?>)"></div>
              <div class="prevArticleTitle"><?php echo $nextitle; ?></div>
            </a>
          <?php } ?>
          </div>
        </div>

      </div>
    </section>

    <section class="NewArticleDetail">
      <div class="sec_inner maxWidth">
        <div class="NADBox">

          <div class="vc_row wpb_row vc_row-fluid cocoro_sectionTitle">
              <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                          <div class="wpb_text_column wpb_content_element ">
                              <div class="wpb_wrapper">
                                  <h2>新しいコンテンツ</h2>
                              </div>
                          </div>
                          <div class="vc_empty_space  rem2" style="height: 2rem"><span class="vc_empty_space_inner"></span></div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="vc_row wpb_row vc_row-fluid A27">
              <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                          <div class="vc_row wpb_row vc_inner vc_row-fluid A27Inner_row">
                            <?php echo do_shortcode('[cocorotosou_detail_getnewposts]'); ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="vc_empty_space  rem4" style="height: 4rem"><span class="vc_empty_space_inner"></span></div>
          <div class="vc_row wpb_row vc_row-fluid btnWrapper">
              <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                          <div class="vc_row wpb_row vc_inner vc_row-fluid">
                              <div class="co1 wpb_column vc_column_container vc_col-sm-4">
                                  <div class="vc_column-inner">
                                      <div class="wpb_wrapper"></div>
                                  </div>
                              </div>
                              <div class="co2 wpb_column vc_column_container vc_col-sm-4">
                                  <div class="vc_column-inner">
                                      <div class="wpb_wrapper">
                                          <div class="vc_btn3-container  cocoroBtn ty_arrow vc_btn3-center">
                                              <a href="/cocorotosous/all" class="activeOpacity">記事をもっと見る</a></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="co3 wpb_column vc_column_container vc_col-sm-4">
                                  <div class="vc_column-inner">
                                      <div class="wpb_wrapper"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="vc_empty_space  rem5" style="height: 5rem"><span class="vc_empty_space_inner"></span></div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div><!--#mainContents-->
</div><!--#wholeContents-->


<?php get_footer("cocoro"); ?>
