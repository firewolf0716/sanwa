<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
 ?>

<?php
//カテゴリ
$postname = "";
$postlink = "";
$postnames = get_the_terms(get_the_ID(), "oldvoices");
if(is_array($postnames)){
 foreach ($postnames as $postnames_value) {
  $postslug = $postnames_value->slug;
 }
}
$next_post = get_termgroup_nex_pre(get_the_ID(),$postslug,"oldvoices","oldvoice","nex");
$prev_poxt = get_termgroup_nex_pre(get_the_ID(),$postslug,"oldvoices","oldvoice","pre");
if (!empty( $next_post )){
  $nex = get_permalink( $next_post[0]->ID );
  $nextitle = get_the_title($next_post[0]->ID);
}
if (!empty( $prev_poxt )){
  $pre = get_permalink( $prev_poxt[0]->ID );
  $pretitle = get_the_title($prev_poxt[0]->ID);
}

////////////////画像/////////////////////////
$before_img_1_id = get_post_meta( get_the_ID(), 'before_img_1', true );
if ( $before_img_1_id) {
  $before_img_1 = wp_get_attachment_image_src($before_img_1_id, 'thumb480360');
  $before_img_1_path = $before_img_1[0];
}else{
  $before_img_1_path = noimage_ret("thumb480360");
}

$after_img_1_id = get_post_meta( get_the_ID(), 'after_img_1', true );
if ( $after_img_1_id) {
  $after_img_1 = wp_get_attachment_image_src($after_img_1_id, 'thumb480360');
  $after_img_1_path = $after_img_1[0];
}else{
  $after_img_1_path = noimage_ret("thumb480360");
}

$before_img_2_id = get_post_meta( get_the_ID(), 'before_img_2', true );
if ( $before_img_2_id) {
  $before_img_2 = wp_get_attachment_image_src($before_img_2_id, 'thumb480360');
  $before_img_2_path = $before_img_2[0];
}else{
  $before_img_2_path = noimage_ret("thumb480360");
}

$after_img_2_id = get_post_meta( get_the_ID(), 'after_img_2', true );
if ( $after_img_2_id) {
  $after_img_2 = wp_get_attachment_image_src($after_img_2_id, 'thumb480360');
  $after_img_2_path = $after_img_2[0];
}else{
  $after_img_2_path = noimage_ret("thumb480360");
}

$before_img_3_id = get_post_meta( get_the_ID(), 'before_img_3', true );
if ( $before_img_3_id) {
  $before_img_3 = wp_get_attachment_image_src($before_img_3_id, 'thumb480360');
  $before_img_3_path = $before_img_3[0];
}else{
  $before_img_3_path = noimage_ret("thumb480360");
}

$after_img_3_id = get_post_meta( get_the_ID(), 'after_img_3', true );
if ( $after_img_3_id) {
  $after_img_3 = wp_get_attachment_image_src($after_img_3_id, 'thumb480360');
  $after_img_3_path = $after_img_3[0];
}else{
  $after_img_3_path = noimage_ret("thumb480360");
}
////////////////画像/////////////////////////

////////////////画像コメント/////////////////////////
if(!empty(get_post_meta( get_the_ID(), 'before_comment_1', true ))){$before_comment_1 = get_post_meta( get_the_ID(), 'before_comment_1', true );}else{$before_comment_1 = "";}

if(!empty(get_post_meta( get_the_ID(), 'after_comment_1', true ))){$after_comment_1 = get_post_meta( get_the_ID(), 'after_comment_1', true );}else{$after_comment_1 = "";}

if(!empty(get_post_meta( get_the_ID(), 'before_comment_2', true ))){$before_comment_2 = get_post_meta( get_the_ID(), 'before_comment_2', true );}else{$before_comment_2 = "";}

if(!empty(get_post_meta( get_the_ID(), 'after_comment_2', true ))){$after_comment_2 = get_post_meta( get_the_ID(), 'after_comment_2', true );}else{$after_comment_2 = "";}

if(!empty(get_post_meta( get_the_ID(), 'before_comment_3', true ))){$before_comment_3 = get_post_meta( get_the_ID(), 'before_comment_3', true );}else{$before_comment_3 = "";}

if(!empty(get_post_meta( get_the_ID(), 'after_comment_3', true ))){$after_comment_3 = get_post_meta( get_the_ID(), 'after_comment_3', true );}else{$after_comment_3 = "";}
////////////////画像コメント/////////////////////////

if(!empty(get_post_meta( get_the_ID(), 'staff_comment_1', true ))){$staff_comment_1 = get_post_meta( get_the_ID(), 'staff_comment_1', true );}else{$staff_comment_1 = "";}/*営業担当者コメント１*/

if(!empty(get_post_meta( get_the_ID(), 'staff_comment_2', true ))){$staff_comment_2 = get_post_meta( get_the_ID(), 'staff_comment_2', true );}else{$staff_comment_2 = "";}/*営業担当者コメント2*/

if(!empty(get_post_meta( get_the_ID(), 'staff_comment_3', true ))){$staff_comment_3 = get_post_meta( get_the_ID(), 'staff_comment_3', true );}else{$staff_comment_3 = "";}/*営業担当者コメント3*/

if(!empty(get_post_meta( get_the_ID(), 'staff_comment_4', true ))){$staff_comment_4 = get_post_meta( get_the_ID(), 'staff_comment_4', true );}else{$staff_comment_4 = "";}/*営業担当者コメント4*/

if(!empty(get_post_meta( get_the_ID(), 'staff_comment', true ))){$staff_comment = get_post_meta( get_the_ID(), 'staff_comment', true );}else{$staff_comment = "";}/*営業担当者追加コメント（移行データ）*/

//////////////////営業担当者///////////////////////
/*CSV読み込み　配列化*/
$csvfilepath = get_stylesheet_directory().'/lib/old_staffdata.csv';
if(!file_exists($csvfilepath)){return;}
setlocale(LC_ALL, 'ja_JP.UTF-8');

$data = file_get_contents($csvfilepath);
// $data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
$temp = tmpfile();
$meta = stream_get_meta_data($temp);

fwrite($temp, $data);
rewind($temp);

$file = new SplFileObject($meta['uri']);
$file->setFlags(SplFileObject::READ_CSV);

$csv  = array();

foreach($file as $line) {
  $csv[] = $line;
}

fclose($temp);
$file = null;

$staff_id = get_field('staff',get_the_ID());
$staff_name = "";
$business_position = "";
if(!empty($staff_id)){
  foreach ($csv as $key => $value) {
    if((int)$value[1] === (int)$staff_id){
      $staff_name = $value[0];
      break;
    }
  }
}

$business_position = "";
$staffimgpath = noimage_ret("thumb480360");
if(!empty($staff_name)){
  global $wpdb;
  $query = "
  SELECT *
  FROM wp_posts
  WHERE post_type = 'staff' AND post_title = '{$staff_name}'
  LIMIT 1
  ";
  $staffposts = $wpdb->get_results($wpdb->prepare($query, null));
  foreach ($staffposts as $staffpost) {
  	setup_postdata($staffpost);
  	$business_position = get_post_meta( $staffpost->ID, 'business_position', true );
    $staff_post_id = get_post_meta($staffpost->ID, 'staff_photo', true );
    if ( $staff_post_id) {
      $staffimg = wp_get_attachment_image_src($staff_post_id, 'thumb480480');
      $staffimgpath = $staffimg[0];/*スタッフ画像*/
    }else{
      $staffimgpath = noimage_ret("thumb480360");
    }
  }
}
//////////////////営業担当者///////////////////////

if(!empty(get_post_meta( get_the_ID(), 'case_detail', true ))){$case_detail = get_post_meta( get_the_ID(), 'case_detail', true );}else{$case_detail = "";}/*施工工事詳細*/

if(!empty(get_post_meta( get_the_ID(), 'const_type', true ))){$const_type = get_post_meta( get_the_ID(), 'const_type', true );}else{$const_type = "";}/*工事種別*/

if(!empty(get_post_meta( get_the_ID(), 'age', true ))){$age = get_post_meta( get_the_ID(), 'age', true );}else{$age = "";}/*築年数*/

if(!empty(get_post_meta( get_the_ID(), 'case_point', true ))){$case_point = get_post_meta( get_the_ID(), 'case_point', true );}else{$case_point = "";}/*今回の工事のポイント*/

$post_title = get_the_title();/*タイトル*/
$post_date = get_the_date("Y.m.d");/*日付*/
$post_content = do_shortcode(get_the_content());/*本文*/
?>
<!--start oldCaseDetail_section-->
<section id="oldCaseDetail" class="pageWidth">
  <div class="sec_inner maxWidth">
    <div class="search_title_box">
        <div class="vc_row wpb_row vc_row-fluid A01 ">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner">
                    <div class="wpb_wrapper">
                        <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                                <h2 class="style02">過去の施工事例</h2>
                            </div>
                        </div>
                        <div class="wpb_wrapper">
                            <div class="notice">過去の施工事例をご覧いただけます。</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rem2" style="height:2rem"></div>

    <div class="secTitleA">
      <h2 class="titleText"><?=$post_title?></h2>
      <div class="rem1" style="height:1rem"></div>
    </div>

    <!--start oldCaseDetail_row-->
    <div class="oldCaseDetail_block">
      <div class="oldCaseDetail_row1 oldCaseDetail_row box_row">
        <!--start oldCaseDetail_wrap-->
        <div class="oldCaseDetail_wrap">
          <div class="oldCaseDetail_inner flex fWrap_wrap">
            <div class="oldCaseDetail_co1 oldCaseDetail_co box_co">
              <div class="after">
                <div class="imageBox">
                  <div class="image">
                      <img src="<?=$after_img_1_path?>" alt="after画像1">
                      <div class="rem05" style="height:0.5rem"></div>
                      <p class="afterComment">施工後:<?=$after_comment_1?></p>
                  </div><!--end image-->
                </div><!--end imageBox-->
              </div>
              <div class="rem3" style="height:3rem"></div>
              <div class="before">
                <div class="imageBox">
                  <div class="image">
                      <img src="<?=$before_img_1_path?>" alt="before画像1">
                      <div class="rem05" style="height:0.5rem"></div>
                      <p class="beforeComment">施工前:<?=$before_comment_1?></p>
                  </div><!--end image-->
                </div><!--end imageBox-->
              </div>
            </div><!--end oldCaseDetail_co-->
            <div class="oldCaseDetail_co2 oldCaseDetai2_co box_co">
              <div class="oldCaseTitle">
                <h3 class="titleText">施工工事詳細</h3>
              </div>
              <p><?=$case_detail?></p>
              <div class="rem2" style="height:2rem"></div>
              <div class="oldCaseTitle">
                <h3 class="titleText">今回の工事のポイント</h3>
              </div>
              <p><?=$case_point?></p>
            </div><!--end oldCaseDetail_co-->
          </div><!--end oldCaseDetail_inner-->
        </div><!--end oldCaseDetail_wrap-->
        <div class="rem3" style="height:3rem"></div>
      </div><!--end oldCaseDetail_row-->
      <div class="oldCaseDetail_row2 oldCaseDetail_row box_row">
        <!--start tanto_wrap-->
        <div class="staff_wrap">
          <div class="staff_inner flex fWrap_wrap">
            <div class="staff_co1 staff_co box_co">
              <!-- 担当者のコメント -->
              <?php if(empty($staff_comment_1) && empty($staff_comment_2) && empty($staff_comment_3) && empty($staff_comment_4)): ?>
              <div class="staffCommentTitle">
                <div class="oldCaseTitle">
                  <h3 class="titleText">担当者のコメント</h3>
                </div>
              </div>
              <div class="staff_comment">
                <?=$staff_comment?>
              </div>
              <?php else: ?>
                <div class="staffCommentTitle">
                  <div class="oldCaseTitle">
                    <h3 class="titleText">担当者のコメント</h3>
                  </div>
                </div>
                <div class="staff_comment_1">
                  <span>①サーチした時の、お客様宅の第一印象は？</span>
                  <p><?=$staff_comment_1?></p>
                </div>
                <div class="rem2" style="height:2rem"></div>
                <div class="staff_comment_2">
                  <span>②お客様宅の誉め所は？</span>
                  <p><?=$staff_comment_2?></p>
                </div>
                <div class="rem2" style="height:2rem"></div>
                <div class="staff_comment_3">
                  <span>③施工パートナーの拘りのポイント</span>
                  <p><?=$staff_comment_3?></p>
                </div>
                <div class="rem2" style="height:2rem"></div>
                <div class="staff_comment_4">
                  <span>④担当者より施主様へのメッセージ</span>
                  <p><?=$staff_comment_4?></p>
                </div>
              <?php endif; ?>

            </div><!--end staff_co-->
            <div class="staff_co2 staff_co box_co">
              <!-- 担当者情報 -->
              <div class="staff">
                <div class="imageBox">
                  <div class="image">
                      <img src="<?=$staffimgpath?>" alt="<?=$staff_name?>">
                      <div><span><?=$business_position?></span></div>
                      <div><span><?=$staff_name?></span></div>
                  </div><!--end image-->
                </div><!--end imageBox-->
              </div>
            </div><!--end tanto_co-->
          </div><!--end tanto_inner-->
        </div><!--end tanto_wrap-->
      </div><!--end oldCaseDetail_row-->
    </div><!--end oldCaseDetail_block-->
  </div><!--end sec_inner-->
</section><!--end oldCaseDetail_section-->
<div class="rem5" style="height:5rem"></div>
<!-- ギャラリー -->
<!--start default_section-->
<section id="default" class="pageWidth">
  <div class="sec_inner maxWidth">
    <!--start gallery_row-->
    <div class="gallery_block">
      <div class="gallery_row1 gallery_row box_row">
        <div class="oldCaseTitle">
          <h3 class="titleText">ギャラリー</h3>
        </div>
        <div class="rem1" style="height:1rem"></div>
      </div><!--end gallery_row-->
      <div class="gallery_row2 gallery_row box_row">
        <div class="gallery flex fWrap_wrap">

          <?php if(!(empty($after_img_1_id) && empty($before_img_1_id))): ?><!-- ギャラリー1 -->
          <div class="galleryItem">
            <div class="after_img_1">
            <?php if(!empty($after_img_1_path)): ?>
              <div class="imageBox">
                <div class="image">
                    <img src="<?=$after_img_1_path?>" alt="<?=$after_comment_1?>">
                </div><!--end image-->
              </div><!--end imageBox-->
            <?php endif; ?>
            </div>
            <div class="before_img_1">
            <?php if(!empty($before_img_1_path)): ?>
              <div class="imageBox">
                <div class="image">
                    <img src="<?=$before_img_1_path?>" alt="<?=$before_comment_1?>">
                </div><!--end image-->
              </div><!--end imageBox-->
            <?php endif; ?>
            </div>
          </div>
        <?php endif; ?><!-- ギャラリー1 -->

          <?php if(!(empty($after_img_2_id) && empty($before_img_2_id))): ?><!-- ギャラリー2 -->
          <div class="galleryItem">
            <div class="after_img_2">
            <?php if(!empty($after_img_2_path)): ?>
              <div class="imageBox">
                <div class="image">
                    <img src="<?=$after_img_2_path?>" alt="<?=$after_comment_2?>">
                </div><!--end image-->
              </div><!--end imageBox-->
            <?php endif; ?>
            </div>
            <div class="before_img_2">
            <?php if(!empty($before_img_2_path)): ?>
              <div class="imageBox">
                <div class="image">
                    <img src="<?=$before_img_2_path?>" alt="<?=$before_comment_2?>">
                </div><!--end image-->
              </div><!--end imageBox-->
            <?php endif; ?>
            </div>
          </div>
        <?php endif; ?><!-- ギャラリー2 -->

          <?php if(!(empty($after_img_3_id) && empty($before_img_3_id))): ?><!-- ギャラリー3 -->
          <div class="galleryItem">
            <div class="after_img_3">
            <?php if(!empty($after_img_3_path)): ?>
              <div class="imageBox">
                <div class="image">
                    <img src="<?=$after_img_3_path?>" alt="<?=$after_comment_3?>">
                </div><!--end image-->
              </div><!--end imageBox-->
            <?php endif; ?>
            </div>
            <div class="before_img_3">
            <?php if(!empty($before_img_3_path)): ?>
              <div class="imageBox">
                <div class="image">
                    <img src="<?=$before_img_3_path?>" alt="<?=$before_comment_3?>">
                </div><!--end image-->
              </div><!--end imageBox-->
            <?php endif; ?>
            </div>
          </div>
        <?php endif; ?><!-- ギャラリー3 -->

        </div>
      </div><!--end gallery_row-->
    </div><!--end gallery_block-->

    <div class="rem5" style="height:5rem"></div>

    <div class="pageLink flex">
      <div class="prevBox">
        <?php if (!empty($pre)){ ?><div class="prev"><a href="<?php echo $pre; ?>" class="leftArrow linkType1"><span><<<br></span><?php echo $pretitle; ?></a></div><?php } ?>
      </div>
      <div class="splitBox"></div>
      <div class="nextBox">
        <?php if (!empty($nex)){ ?><div class="next"><a href="<?php echo $nex; ?>" class="rightArrow linkType1"><span>>><br></span><?php echo $nextitle; ?></a></div><?php } ?>
      </div>
    </div>


    <div class="rem5" style="height:5rem"></div>
    <div class="rem1" style="height:1rem"></div>

  </div><!--end sec_inner-->
</section><!--end default_section-->
<?php get_footer();
