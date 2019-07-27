<?php
/*Custom Widget*/

// Register and load the widget
function wpb_load_widget() {
    //detail page widget
    register_widget( 'wpb_recent_cases_h3_widget' );
    register_widget( 'wpb_count_rank_widget' );
    register_widget( 'wpb_search_widget' );

    //search page widget
    register_widget( 'wpb_count_rank_vertiacl_widget' );
    register_widget( 'wpb_recent_cases_v5_widget' );

}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the recent horizontal 3 cases widget
class wpb_recent_cases_h3_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpb_recent_cases_h3_widget',
            // Widget name will appear in UI
            __('Sanwa Horizon Recent 3 Photo Show Widget', 'wpb_widget_domain'),
            // Widget description
            array( 'description' => __( 'Sanwa Theme Custom Widget', 'wpb_widget_domain' ), )
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {

        $args = [
            'posts_per_page' => 3,
            'post_type' => 'cases',
        ];

        $recent_post_query = new WP_Query( $args );

        ?>
                <div class="vc_row wpb_row vc_row-fluid A01 maxWidth"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            <h2 class="style02">最近追加された事例</h2>

                        </div>
                    </div>
                <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
                </div></div></div></div>
        <div class="rankingBox flex">
        <?php while ($recent_post_query -> have_posts()) : $recent_post_query -> the_post();
            $title = custom_length_excerpt_max_char(get_the_title(), 40);
            ////////////////////////////////////////////////
            $before_photos = get_post_meta( get_the_ID(), 'before_photo', true);
            $before_comments = get_post_meta( get_the_ID(), 'before_comment', true);
            $after_photos = get_post_meta( get_the_ID(), 'after_photo', true);
            $after_comments = get_post_meta( get_the_ID(), 'after_comment', true);

            if ($before_photos[0]){
              $before_photo = $before_photos[0];
              $url_info = pathinfo($before_photo);//切り分ける
              $before_photo = $url_info["dirname"];//拡張子なし
              $before_photo = $before_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $before_photo_array = get_headers($before_photo);
              if(!strpos($before_photo_array[0],'OK')){
                $before_photo = $before_photos[0];
              }
            }else{
              // $before_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $before_photo = "";
            }


            if ($after_photos[0]){
              $after_photo = $after_photos[0];
              $url_info = pathinfo($after_photo);//切り分ける
              $after_photo = $url_info["dirname"];//拡張子なし
              $after_photo = $after_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $after_photo_array = get_headers($after_photo);
              if(!strpos($after_photo_array[0],'OK')){
                $after_photo = $after_photos[0];
              }
            }else{
              // $after_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $after_photo = "";
            }
            ////////////////////////////////////////////////
            if (!empty($after_photo)) {
              $image_url = $after_photo;
            }elseif(!empty($before_photo)){
              $image_url = $before_photo;
            }else {
              $image_url = noimage_ret("thumb480360");
            }
               ?>

            <a href="<?php the_permalink() ?>">
                <div class="rankBox">
                  <!-- <p class="ellipsisText"><?=$title?></p> -->
                  <?php $vr_catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;'; ?>
                  <p class="ellipsisText"><?=$vr_catch?></p>
                  <div class="rem05" style="height:0.5rem"></div>
                    <div class="imageBox caseImage">
                      <div class="image">
                          <img src="<?=$image_url?>" alt="<?php echo $title; ?>">
                      </div><!--end image-->
                      <div class="caseInfo flex">
                        <p class="caseInfoText">本事例を見る <i class="vc_btn3-icon fa fa-chevron-right"></i></p>
                      </div>
                    </div><!--end imageBox-->
                    <!-- <p class="catchText"><?=$vr_catch?></p> -->
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
    }

    // Widget Backend
    public function form( $instance ) {
        ?><p>最近追加された事例</p><?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // Class wpb_widget ends here

// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Creating the count view rank widget
class wpb_count_rank_widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            // Base ID of your widget
            'wpb_count_rank_widget',
            // Widget name will appear in UI
            __('Sanwa Count View Rank Horizon 3 Photo Show Widget', 'wpb_widget_domain'),
            // Widget description
            array( 'description' => __( 'Sanwa Theme Custom Widget', 'wpb_widget_domain' ), )
        );

    }
    // Creating widget front-end
    public function widget( $args, $instance ) {

        $args = [
            'posts_per_page' => 3,
            'post_type'    => 'cases',
            'orderby'      => 'meta_value_num',
            'meta_key'     => 'post_views_count',
            'order'        => 'DESC',
            'post_status'  => 'publish'
        ];

        $recent_post_query = new WP_Query( $args );

        ?>



<div class="vc_row wpb_row vc_row-fluid A01 maxWidth"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
    <div class="wpb_text_column wpb_content_element ">
        <div class="wpb_wrapper">
            <h2 class="style02">よく見られている事例ランキング</h2>

        </div>
    </div>
<div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
</div></div></div></div>



        <div class="rankingBox flex ">
        <?php while ($recent_post_query -> have_posts()) : $recent_post_query -> the_post();

            $rank_no++;
            $rimage_url = content_url() . '/uploads/rank-'.$rank_no.'.png';

            $count = get_post_meta( get_the_ID(), 'post_views_count', true);
            $title = custom_length_excerpt_max_char(get_the_title(), 40);

            ////////////////////////////////////////////////
            $before_photos = get_post_meta( get_the_ID(), 'before_photo', true);
            $before_comments = get_post_meta( get_the_ID(), 'before_comment', true);
            $after_photos = get_post_meta( get_the_ID(), 'after_photo', true);
            $after_comments = get_post_meta( get_the_ID(), 'after_comment', true);

            if ($before_photos[0]){
              $before_photo = $before_photos[0];
              $url_info = pathinfo($before_photo);//切り分ける
              $before_photo = $url_info["dirname"];//拡張子なし
              $before_photo = $before_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $before_photo_array = get_headers($before_photo);
              if(!strpos($before_photo_array[0],'OK')){
                $before_photo = $before_photos[0];
              }
            }else{
              // $before_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $before_photo = "";
            }


            if ($after_photos[0]){
              $after_photo = $after_photos[0];
              $url_info = pathinfo($after_photo);//切り分ける
              $after_photo = $url_info["dirname"];//拡張子なし
              $after_photo = $after_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $after_photo_array = get_headers($after_photo);
              if(!strpos($after_photo_array[0],'OK')){
                $after_photo = $after_photos[0];
              }
            }else{
              // $after_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $after_photo = "";
            }
            ////////////////////////////////////////////////
            if (!empty($after_photo)) {
              $image_url = $after_photo;
            }elseif(!empty($before_photo)){
              $image_url = $before_photo;
            }else {
              $image_url = noimage_ret("thumb480360");
            }
            ?>


                <a href="<?php the_permalink() ?>">
                    <div class="rankBox">
                        <div class="rankTitleBox flex">
                            <div class="imageBox rankImage">
                              <div class="image">
                                  <img src="<?=$rimage_url?>" alt="<?=$rank_no?>">
                              </div><!--end image-->
                            </div><!--end imageBox-->
                            <div>
                              <p class="ellipsisText"><br></p>
                              <?php $vr_catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;'; ?>
                              <p class="ellipsisText"><?=$vr_catch?></p>
                            </div>
                        </div>
                        <div class="imageBox caseImage">
                          <div class="views"><?=$count?><span class="viewsLabel">views</span></div>
                          <div class="image">
                              <img src="<?=$image_url?>" alt="<?php echo $title; ?>">
                          </div><!--end image-->
                          <div class="caseInfo flex">
                            <p class="caseInfoText">本事例を見る <i class="vc_btn3-icon fa fa-chevron-right"></i></p>
                          </div>
                        </div><!--end imageBox-->
                    </div>
                </a>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

        <?php
    }

    // Widget Backend
    public function form( $instance ) {
        ?>  <p> よく見られている事例ンランキング    </p> <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // Class wpb_widget ends here

// Creating the search right widget
class wpb_search_widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            // Base ID of your widget
            'wpb_search_widget',
            // Widget name will appear in UI
            __('Sanwa Search Widget', 'wpb_widget_domain'),
            // Widget description
            array( 'description' => __( 'Sanwa Theme Custom Widget', 'wpb_widget_domain' ), )
        );

    }
    // Creating widget front-end
    public function widget( $args, $instance ) {

        if ( is_archive() ) :
            $w_detached = $_GET['s_detacheds'] ?:'';
            $w_housemaker = $_GET['s_housemakers'] ?:'';
            $w_other_work = array();
            for ($ow=0; $ow <= count($GLOBALS['other_works']); $ow++) :
              if ( array_key_exists( 'other_works_'.$ow, $_GET) ) :
                $w_other_work[] = $_GET['other_works_'.$ow];
              endif;
            endfor; 

            session_start();
            $_SESSION["case_search_cond"] = 
              array(
                'w_detached' => $w_detached,
                'w_housemaker' => $w_housemaker,
                'w_other_work' => $w_other_work,
                'w_get' => $_GET
              );

        endif ;

        if (is_singular('cases')) :
            session_start();
            $w_detached = $_SESSION['case_search_cond']['w_detached'] ?:'';
            $w_housemaker = $_SESSION['case_search_cond']['w_housemaker'] ?:'';
            $w_other_work = $_SESSION['case_search_cond']['w_other_work'] ?:'';
            $w_get = $_SESSION['case_search_cond']['w_get'] ?:array();
            unset($_SESSION['case_search_cond']);

        endif; ?>

        <form id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

            <input type="hidden" name="post_type" value="cases" />

            <div class="search_widget">
                <div class="accordion skn_accBtn">
                    <span class="accordionText"><i class="fas fa-caret-down"></i>再検索する</span>
                </div>
                <div class="sideBarWrap">
                    <div class="vc_row wpb_row vc_row-fluid A02-01">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <h4 class="style02">色をお選びください（複数選択可能）</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="brush flex fWrap_wrap">
                        <!-- 色を置く -->
                        <?php
                        $colorarray = array(
                          "サンタンオレンジ","アンティークブラウン","SP-376","アンバーブラウン","セピアブラウン","SP-385"
                          ,"新ブラウン","ベージュ","SP-356","SP-357","AZE-310","AZE-325","SP-176","AZE-326","AZE-312","SP-350","AZE-315"
                          ,"AZE-317","AZE-316","AZE-318","SP-367","SP-127","SP-337","AZE-314","SP-336","AZE-319","AZE-311","AZE-324","SP-120"
                          ,"AZE-322","AZE-303","SP-141","SP-147","SP-150","AZE-327","SP-112","SP-121","SP-111","SP-310","新クリーム","SP-330"
                          ,"SP-347","SP-110","SP-221","SP-131","SP-247","AZE-328","AZE-301","AZE-302","SP-80","SP-75","SP-70","シルバーホワイト","グレー","AZE-306","カーボングレー"
                          ,"SP-352","AZE-320","AZE-321","AZE-323","AZE-329","SP-170","SP-50","SP-185","セピア","ビスタブラウン","AZE-330","ネオブラック","ナスコン","ブルー"
                          ,"リリーホワイト","SP-223","SP-133","ミストグリーン","フォレストグリーン","アイビーグリーン","ネオモスグリーン","イエローオーカー","ガーネットオレンジ"
                          ,"チョコレート","ブラウン","コーヒーブラウン"
                        );
                        foreach ($colorarray as $colorarrayvalue) {
                          $outwall_stand_colors = get_colors_titles('',$colorarrayvalue);
                          foreach ($outwall_stand_colors as $oscolor) {
                            if (get_the_post_thumbnail_url($oscolor['ID'],'thumb180120')){
                              $outwall_stand_color_img_url = get_the_post_thumbnail_url($oscolor['ID'],'thumb180120');
                            }else{
                              $outwall_stand_color_img_url = noimage_ret("thumb180120");
                            }
                          ?>
                          <!-- チェックボックス -->
  <label class="container wdg-color-pick" data-colorname="<?=$oscolor['value']?>">
      <input type="checkbox" name="<?=$oscolor['terms']?><?=$oscolor['key']?>" value="<?=$oscolor['value']?>" <?php

          if (is_singular('cases') && array_key_exists($oscolor['terms'].$oscolor['key'], $w_get))
              echo 'checked';
          if (is_archive() && array_key_exists($oscolor['terms'].$oscolor['key'], $_GET))
              echo 'checked';
      ?>>
      <span class="checkmark" style="background-image: url(<?=$outwall_stand_color_img_url?>); "></span>
  </label>
                          <!-- チェックボックス -->
                          <?php
                          }

                        }/*ループ*/
                        ?>
                        <!-- 特注色 外壁標準色 -->
                        <label class="container wdg-color-pick specialcolor">
                          <input type="checkbox" name="outwall-stand-color_0" value="other" <?php
                            if (is_singular('cases') && array_key_exists('outwall-stand-color_0', $w_get))
                                echo 'checked';
                            if (is_archive() && array_key_exists('outwall-stand-color_0', $_GET))
                                echo 'checked';
                          ?>>

                        <!-- 特注色 外壁標準色 -->
                        <!-- 特注色 外壁水性ゾラコート -->
                          <input type="checkbox" name="outwall-zola-coat-color_0" value="other" <?php
                            if (is_singular('cases') && array_key_exists('outwall-zola-coat-color_0', $w_get))
                                echo 'checked';
                            if (is_archive() && array_key_exists('outwall-zola-coat-color_0', $_GET))
                                echo 'checked';
                         ?>>
                        <!-- 特注色 外壁水性ゾラコート -->
                        <!-- 特注色 外壁コーティング -->
                          <input type="checkbox" name="outwall-coat-color_0" value="other" <?php
                            if (is_singular('cases') && array_key_exists('outwall-coat-color_0', $w_get))
                                echo 'checked';
                            if (is_archive() && array_key_exists('outwall-coat-color_0', $_GET))
                                echo 'checked';
                         ?>>
                        <!-- 特注色 外壁コーティング -->
                        <!-- 特注色 屋根遮熱標準色 -->
                          <input type="checkbox" name="roof-heat-color_0" value="other" <?php
                            if (is_singular('cases') && array_key_exists('roof-heat-color_0', $w_get))
                                echo 'checked';
                            if (is_archive() && array_key_exists('roof-heat-color_0', $_GET))
                                echo 'checked';
                         ?>>
                         <span class="checkmark" style="background-image:url(<?php echo content_url();?>/uploads/2019/07/_-_-_colorTest.png)"></span>
                        </label>
                        <!-- 特注色 屋根遮熱標準色 -->


                    </div>
                    <!-- brush -->


                    <div class="handle">
                        <div class="imageBox">
                          <div class="image">
                              <img src="<?php echo content_url();?>/uploads/2019/07/brush.png" alt="">
                          </div><!--end image-->
                        </div><!--end imageBox-->
                    </div>
                    <div class="vc_row wpb_row vc_row-fluid A02">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <h3 class="style02">戸建の様式をお選びください（複数選択可能）</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- A02 -->


                    <div class="panel">
                    <?php
                        global $detacheds;
                        foreach ($detacheds as $d => $detached) {
                    ?>
                        <div class="wrapper pull-left wdg-search-check">
                            <input id="detached-<?=$d?>"  type="checkbox" name="s_detacheds[]" value="<?=$detached?>" <?php
                                if ( ( is_archive() || is_singular('cases') ) && $w_detached) {
                                    foreach ($w_detached as $w_detach) {
                                        if ($detached == $w_detach)  echo 'checked';
                                    }
                                }
                            ?>>
                            <label for="detached-<?=$d?>"><?=$detached?></label>
                        </div>
                    <?php
                        }
                    ?>
                        <div class="wrapper pull-left wdg-search-check">
                            <input id="detached-o"  type="checkbox" name="s_detacheds[]" value="その他" <?php
                                if ( ( is_archive() || is_singular('cases') ) && $w_detached) {
                                    foreach ($w_detached as $w_detach) {
                                        if ('その他' == $w_detach)  echo 'checked';
                                    }
                                }
                             ?>>
                            <label for="detached-o">その他</label>
                        </div>
                    </div>
                    <!-- panel -->


                    <div class="vc_row wpb_row vc_row-fluid A02">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <h3 class="style02">ハウスメーカーをお選びください（複数選択可能）</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                    <?php
                        global $housemakers;
                        foreach ($housemakers as $hmkey => $housemaker) {
                    ?>
                        <div class="wrapper pull-left wdg-search-check">
                            <input id="housemaker-<?=$hmkey?>" name="s_housemakers[]" type="checkbox" value="<?=$housemaker?>" <?php
                                if ( (is_archive() || is_singular('cases') ) && $w_housemaker) {
                                    foreach ($w_housemaker as $w_housemak) {
                                        if ($housemaker == $w_housemak)  echo 'checked';
                                    }
                                }
                            ?>>
                            <label for="housemaker-<?=$hmkey?>"><?=$housemaker?></label>
                        </div>
                    <?php
                        }
                    ?>
                        <div class="wrapper pull-left wdg-search-check">
                            <input id="housemaker-o" name="s_housemakers[]" type="checkbox" value="その他" <?php
                                if ( (is_archive() || is_singular('cases') ) && $w_housemaker) {
                                    foreach ($w_housemaker as $w_housemak) {
                                        if ('その他' == $w_housemak)  echo 'checked';
                                    }
                                }
                             ?>>
                            <label for="housemaker-o">その他</label>
                        </div>
                    </div>

                    <!-- panel -->

                    <div class="vc_row wpb_row vc_row-fluid A02">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <h3 class="style02">その他の工事（複数選択可能）</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                    <?php
                        global $other_works;
                        $num = 1;
                        foreach ($other_works as $other_work) {
                    ?>
                        <div class="wrapper pull-left wdg-search-check">
                            <input id="other_work-<?=$num?>" name="<?=$other_work['key']?>" type="checkbox" value="<?=$other_work['value']?>" <?php
                                // if (is_singular('cases') && $other_work['value'] == get_post_meta( get_the_ID(), 'other_works_'.$num, true)) echo 'checked';
                                if ( (is_archive() || is_singular('cases')) && $w_other_work) {
                                    foreach ($w_other_work as $w_other_work2) {
                                        if ($other_work['value'] == $w_other_work2)  echo 'checked';
                                    }
                                }
                            ?>>
                            <label for="other_work-<?=$num?>"><?=$other_work['value']?></label>
                        </div>
                    <?php
                    $num++;
                        }
                    ?>
                        <div class="wrapper pull-left wdg-search-check">
                            <input id="other_work-o" name="other_works_0" type="checkbox" value="その他" <?php
                                // if (is_singular('cases') && !empty(get_post_meta( get_the_ID(), 'other_works_0', true))) echo 'checked';
                                if ( (is_archive() || is_singular('cases')) && $w_other_work) {
                                    foreach ($w_other_work as $w_other_work2) {
                                        if ('その他' == $w_other_work2)  echo 'checked';
                                    }
                                }
                             ?>>
                            <label for="other_work-o">その他</label>
                        </div>
                    </div>

                    <div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
                      <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner">
                          <div class="wpb_wrapper">
                            <div class="wpb_text_column wpb_content_element " >
                              <div class="wpb_wrapper">
                                <h4 class="style02 border-none black-block-e">支店名</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="search-item-panel search-check-panel search-check-White">
                      <select id="branch" name="s_branch" class="">
                        <option value="" >全て選択</option>
                        <?php
                        $branchs = get_branchs_titles();
                        $m_branch = $_GET['s_branch']?:$w_get['s_branch'];
                        foreach ($branchs as $branch) {
                          if ( !empty($m_branch) && $branch == $m_branch) {
                        ?>
                        <option value="<?=$branch?>" selected ><?=$branch?></option>
                        <?php
                          }else{
                        ?>
                        <option value="<?=$branch?>" ><?=$branch?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                      <div class="clearfix"></div>
                    </div>
<!--                     <p class="text-center">
                        <button class="wdg-search-btn" type="submit">
                            <i class="fas fa-search color-white"></i>再検索
                        </button>
                    </p> -->

                    <div class="vc_btn3-container otherBtn4 btns btn8 btnWrapper vc_btn3-center">
                        <button type="submit" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-color-grey">再検索</button>
                    </div>

                </div>
                <!-- sideBarWrap -->
                <?php echo do_shortcode('[case_sidebar_banner]'); ?>
            </div>
            <!-- search_widget -->

        </form>

        <script type="text/javascript">

            jQuery(function($){
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {

                    acc[i].addEventListener("click", function() {
                        /* Toggle between adding and removing the "active" class,
                        to highlight the button that controls the panel */
                        this.classList.toggle("active");

                        /* Toggle between hiding and showing the active panel */
                        var panel = this.nextElementSibling;
                        // console.log(panel.style.display);
                        $(panel).stop(true, true).slideToggle(1000);
                        // if (panel.style.display === "none") {
                        //     $(panel).slideToggle();
                        // } else {
                        //     $(panel).slideUp();
                        // }
                    });
                }
            });
        </script>

        <?php
    }

    // Widget Backend
    public function form( $instance ) {
        ?>  <p> Sanwa Search Widget </p> <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // Class wpb_widget ends here

// Creating the count view rank widget
class wpb_count_rank_vertiacl_widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            // Base ID of your widget
            'wpb_count_rank_vertiacl_widget',
            // Widget name will appear in UI
            __('Sanwa Count View Rank Vertical 3 Photo Show Widget', 'wpb_widget_domain'),
            // Widget description
            array( 'description' => __( 'Sanwa Theme Custom Widget', 'wpb_widget_domain' ), )
        );

    }
    // Creating widget front-end
    public function widget( $args, $instance ) {

        $rank_no = 0;

        $args = [
            'posts_per_page' => 3,
            'post_type' => 'cases',
            'orderby'      => 'meta_value_num',
            'meta_key'     => 'post_views_count',
            'order'        => 'DESC',
            'post_status'  => 'publish'
        ];

        $recent_post_query = new WP_Query( $args );

        ?>

        <div class="rem2" style="height:2rem;width:100%"></div>
        <div class="vc_row wpb_row vc_row-fluid A01 maxWidth"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
            <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <h2 class="style02">よく見られている事例ランキング</h2>

                </div>
            </div>
        <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
        </div></div></div></div>


        <div class="rankingBox">
        <?php while ($recent_post_query -> have_posts()) : $recent_post_query -> the_post();

            $rank_no++;
            $rimage_url = content_url() . '/uploads/rank-'.$rank_no.'.png';

            $count = get_post_meta( get_the_ID(), 'post_views_count', true);

            $title = custom_length_excerpt_max_char(get_the_title(), 40);
            ////////////////////////////////////////////////
            $before_photos = get_post_meta( get_the_ID(), 'before_photo', true);
            $before_comments = get_post_meta( get_the_ID(), 'before_comment', true);
            $after_photos = get_post_meta( get_the_ID(), 'after_photo', true);
            $after_comments = get_post_meta( get_the_ID(), 'after_comment', true);

            if ($before_photos[0]){
              $before_photo = $before_photos[0];
              $url_info = pathinfo($before_photo);//切り分ける
              $before_photo = $url_info["dirname"];//拡張子なし
              $before_photo = $before_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $before_photo_array = get_headers($before_photo);
              if(!strpos($before_photo_array[0],'OK')){
                $before_photo = $before_photos[0];
              }
            }else{
              // $before_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $before_photo = "";
            }


            if ($after_photos[0]){
              $after_photo = $after_photos[0];
              $url_info = pathinfo($after_photo);//切り分ける
              $after_photo = $url_info["dirname"];//拡張子なし
              $after_photo = $after_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $after_photo_array = get_headers($after_photo);
              if(!strpos($after_photo_array[0],'OK')){
                $after_photo = $after_photos[0];
              }
            }else{
              // $after_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $after_photo = "";
            }
            ////////////////////////////////////////////////
            if (!empty($after_photo)) {
              $image_url = $after_photo;
            }elseif(!empty($before_photo)){
              $image_url = $before_photo;
            }else {
              $image_url = noimage_ret("thumb480360");
            }
               ?>
            <a href="<?php the_permalink() ?>">
                <div class="rankBox">
                    <div class="rankTitleBox flex">
                        <div class="imageBox rankImage">
                          <div class="image">
                              <img src="<?=$rimage_url?>" alt="<?=$rank_no?>">
                          </div><!--end image-->
                        </div><!--end imageBox-->
                        <div>
                          <p class="ellipsisText"><br></p>
                          <?php $vr_catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;'; ?>
                          <p class="ellipsisText"><?=$vr_catch?></p>
                        </div>
                    </div>
                    <div class="imageBox caseImage">
                      <div class="views"><?=$count?><span class="viewsLabel">views</span></div>
                      <div class="image">
                          <img src="<?=$image_url?>" alt="<?php echo $title; ?>">
                      </div><!--end image-->
                      <div class="caseInfo flex">
                        <p class="caseInfoText">本事例を見る <i class="vc_btn3-icon fa fa-chevron-right"></i></p>
                      </div>
                    </div><!--end imageBox-->
                </div>
            </a>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

        <?php
    }

    // Widget Backend
    public function form( $instance ) {
        ?>  <p> よく見られている事例ンランキング    </p> <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // Class wpb_widget ends here

// Creating the recent vertiacl 3 cases widget
class wpb_recent_cases_v5_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpb_recent_cases_v5_widget',
            // Widget name will appear in UI
            __('Sanwa vertial Recent 5 Photo Show Widget', 'wpb_widget_domain'),
            // Widget description
            array( 'description' => __( 'Sanwa Theme Custom Widget', 'wpb_widget_domain' ), )
        );
    }
    // Creating widget front-end
    public function widget( $args, $instance ) {

        $args = [
            'posts_per_page' => 3,
            'post_type' => 'cases',
        ];

        $recent_post_query = new WP_Query( $args );

        ?>

        <div class="rem2" style="height:2rem;width:100%"></div>



<div class="vc_row wpb_row vc_row-fluid A01 maxWidth"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
    <div class="wpb_text_column wpb_content_element ">
        <div class="wpb_wrapper">
            <h2 class="style02">最近追加された事例</h2>

        </div>
    </div>
<div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
</div></div></div></div>



        <div class="rankingBox newItems" >
            <?php while ($recent_post_query -> have_posts()) : $recent_post_query -> the_post();
              $title = custom_length_excerpt_max_char(get_the_title(), 40);
            ////////////////////////////////////////////////
            $before_photos = get_post_meta( get_the_ID(), 'before_photo', true);
            $before_comments = get_post_meta( get_the_ID(), 'before_comment', true);
            $after_photos = get_post_meta( get_the_ID(), 'after_photo', true);
            $after_comments = get_post_meta( get_the_ID(), 'after_comment', true);

            if ($before_photos[0]){
              $before_photo = $before_photos[0];
              $url_info = pathinfo($before_photo);//切り分ける
              $before_photo = $url_info["dirname"];//拡張子なし
              $before_photo = $before_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $before_photo_array = get_headers($before_photo);
              if(!strpos($before_photo_array[0],'OK')){
                $before_photo = $before_photos[0];
              }
            }else{
              // $before_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $before_photo = "";
            }


            if ($after_photos[0]){
              $after_photo = $after_photos[0];
              $url_info = pathinfo($after_photo);//切り分ける
              $after_photo = $url_info["dirname"];//拡張子なし
              $after_photo = $after_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
              $after_photo_array = get_headers($after_photo);
              if(!strpos($after_photo_array[0],'OK')){
                $after_photo = $after_photos[0];
              }
            }else{
              // $after_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
              $after_photo = "";
            }
            ////////////////////////////////////////////////
            if (!empty($after_photo)) {
              $image_url = $after_photo;
            }elseif(!empty($before_photo)){
              $image_url = $before_photo;
            }else {
              $image_url = noimage_ret("thumb480360");
            }
                       ?>


                    <a href="<?php the_permalink() ?>">
                        <div class="rankBox">
                          <!-- <p class="ellipsisText"><?=$title?></p> -->
                          <?php $vr_catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;'; ?>
                          <p class="ellipsisText"><?=$vr_catch?></p>
                          <div class="rem05" style="height:0.5rem"></div>
                            <div class="imageBox caseImage">
                              <div class="image">
                                  <img src="<?=$image_url?>" alt="<?php echo $title; ?>">
                              </div><!--end image-->
                              <div class="caseInfo flex">
                                <p class="caseInfoText">本事例を見る <i class="vc_btn3-icon fa fa-chevron-right"></i></p>
                              </div>
                            </div><!--end imageBox-->
                            <!-- <p class="catchText"><?=$vr_catch?></p> -->
                        </div>
                    </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php
    }

    // Widget Backend
    public function form( $instance ) {
        ?><p>最近追加された事例</p><?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // Class wpb_widget ends here
/*Widget Area */

function wpmu_register_widgets() {

    // single-cases.php (left bottom part for detail page) -
    register_sidebar( array(
        'name' => __( 'Three Image Widget Content', 'wpmu' ),
        'id' => 'three-image-widget-area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

    // single-cases.php (right part for detail page) -
    register_sidebar( array(
        'name' => __( 'Right Page Search Widget Area', 'wpmu' ),
        'id' => 'right-page-search-widget-area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

    // search-page.php (right part for search page) -
    register_sidebar( array(
        'name' => __( 'Search Page Ranking Widget Area', 'wpmu' ),
        'id' => 'search-page-ranking-widget-area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

}
add_action( 'widgets_init', 'wpmu_register_widgets' );
