<?php
/*
Template Name: ココロトソウサンプル
*/
?>
<?php get_header("cocoro"); ?>

<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="mainContents" class="mainContents">


    <section class="articleDetail">
      <div class="sec_inner maxWidth">
        <div class="thisArticleBox">
          <div class="TABInner">
            <div class="categoryBox flex fWrap_wrap">
              
              <a href="{カテゴリURL}">{カテゴリ名}</a>
              ・
              ・ループ
              ・

            </div>
            <div class="titleBox">
              <h2>{記事タイトル}</h2>
              <span>{日付}</span>
            </div>
            <div class="articleBox">
              {本文}
            </div>
            <div class="relationBox flex fWrap_wrap">
              
              <a href="{タグURL}">{タグ名}</a>
              ・
              ・ループ
              ・

            </div>
            <?php echo do_shortcode('[sns]'); ?>
          </div>
        </div>

        <div class="NextPrevBox flex">
          <div class="prevArticle">
            <a href="{前記事URL}">
              <span><< 前の記事</span>
              <div class="backImage" style="background-image:url({前サムネイルURL})"></div>
              <div class="prevArticleTitle">{前記事のタイトル}</div>
            </a>
          </div>
          <div class="nextArticle">
            <a href="{次記事URL}">
              <span>次の記事 >></span>
              <div class="backImage" style="background-image:url({次サムネイルURL})"></div>
              <div class="prevArticleTitle">{次記事のタイトル}</div>
            </a>
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
                          <div class="vc_empty_space  rem3" style="height: 3rem"><span class="vc_empty_space_inner"></span></div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="vc_row wpb_row vc_row-fluid A27">
              <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                          <div class="vc_row wpb_row vc_inner vc_row-fluid A27Inner_row">

                              
                              <div class="co1 wpb_column vc_column_container vc_col-sm-4">
                                  <div class="vc_column-inner">
                                      <div class="wpb_wrapper">
                                          <div class="wpb_text_column wpb_content_element  image">
                                              <div class="wpb_wrapper">
                                                  <a href="{記事URL}" class="linkCover"></a>
                                                  <div class="backimage" style="background-image:url({サムネイルURL});"></div>
                                              </div>
                                          </div>
                                          <div class="vc_empty_space  rem2" style="height: 2rem"><span class="vc_empty_space_inner"></span></div>
                                          <div class="wpb_text_column wpb_content_element  text">
                                              <div class="wpb_wrapper">
                                                  <h4 class="style02">{記事タイトル}</h4>
                                              </div>
                                              <span class="newsDate">{日付}</span>
                                          </div>
                                          <div class="vc_empty_space  rem2" style="height: 2rem"><span class="vc_empty_space_inner"></span></div>
                                      </div>
                                  </div>
                              </div>
                              ・
                              ・ループ
                              ・


                          </div>
                      </div>
                  </div>
              </div>
          </div>
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
                                              <a href="{記事一覧URL}" class="activeOpacity">記事をもっと見る</a></div>
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

