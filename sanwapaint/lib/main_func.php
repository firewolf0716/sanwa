<?php
//拡張子の直前に文字列を追加
/**
 * $fn = 'sample.txt';
*  rename($fn,add_filename($fn,'_old'));
 */
function add_filename($filename,$addtext){
	//拡張子の前に文字列を追加
	$pos  = strrpos($filename, '.'); // .が最後に現れる位置
	if ($pos){
		return(substr($filename, 0, $pos).$addtext.substr($filename, $pos));
	}else{
		return($filename.$addtext);
	}
}



// NEWを表示する日数を指定
define("NEWEST_POST_DAYS", 7);
/**
 * 記事にNEWを付けるか判定する処理
 */
function is_newest_post($the_post) {

    // NEWを付加する日数
    $days = NEWEST_POST_DAYS;

    // 記事投稿後の経過日数
	$today = date_i18n('U');
	$posted = get_the_time('U',$the_post->ID);
	$elapsed = date('U',($today - $posted)) / (60*60*24) ;

    // NEWを付加する日数よりも経過日が小さければtrueを返す
	if( $days > $elapsed ){
		return true;
	} else {
        return false;
    }
}


//★投稿画面のカテゴリー階層を正常表示
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
 $args['checked_ontop'] = false;
 return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );


//カスタムフィールド
function custam_imgFunc($attr){
  $image = get_field($attr[0]);
  $result = NULL;
  if(!empty($image)){
    $result = '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
  }
  return $result;
  // if( !empty($image) ){
  //   // vars
  //   $url = $image['url'];
  //   $title = $image['title'];
  //   $alt = $image['alt'];
  //   $caption = $image['caption'];
  //   // thumbnail
  //   $size = 'thumbnail';
  //   $thumb = $image['sizes'][ $size ];
  //   $width = $image['sizes'][ $size . '-width' ];
  //   $height = $image['sizes'][ $size . '-height' ];
  // }
}
add_shortcode('custam_img', 'custam_imgFunc');


//Workのカテゴリ自動付加　全件一覧用
function auto_set_category ( $post_id ) {
  global $post;
  $new_post = get_post( $post_id );
  $content = $new_post->post_content;

/* ループ開始　全てのカテゴリーを１つ１つ調べる */
// $cat_all = get_terms( "works_cat", "fields=all&get=all" );
// foreach($cat_all as $value):
  wp_remove_object_terms( $post_id, 1, 'cocorotosous' );
  wp_add_object_terms( $post_id, 'all', 'cocorotosous' );

	wp_remove_object_terms( $post_id, 1, 'oldvoices' );
	wp_add_object_terms( $post_id, 'all', 'oldvoices' );

	wp_remove_object_terms( $post_id, 1, 'oldsurveys' );
	wp_add_object_terms( $post_id, 'all', 'oldsurveys' );

// endforeach;
/* ループ終了　全てのカテゴリーを１つ１つ調べる */

/* もしカテゴリーが１つも無かったらエラーになるからデフォのカテゴリーを付ける */
// $catcheck = get_the_category($post_id);
// if ( is_array($catcheck) && is_null($catcheck[0]) ) {
//   wp_add_object_terms( $post_id, 1, 'category' );
//       }
}
add_action( 'save_post', 'auto_set_category' );



//固定ページページ送り出来るように　パーマリンクは/%category%/%postname%
add_filter('rewrite_rules_array','wp_insertMyRewriteRules');
add_filter('query_vars','wp_insertMyRewriteQueryVars');
add_filter('init','flushRules');

function flushRules(){
	global $wp_rewrite;
   	$wp_rewrite->flush_rules();	// リライトルールを再生成
}
function wp_insertMyRewriteRules($rules)
{
	$newrules = array();
	$newrules['(news_all)/page/?([0-9]{1,})/?$'] = 'index.php?pagename=$matches[1]&paged=$matches[2]';
	return $newrules + $rules;	// 新しいルールを追加
}
function wp_insertMyRewriteQueryVars($vars)
{
    array_push($vars, 'id');	// 変数idを追加
    return $vars;
}


//customショートコード
/**
 * カテゴリで指定しない時↓
 * [reference_slider]
 * do_shortcode('[reference_slider]')
 *
 * カテゴリで指定する時↓
 *[reference_slider 指定するカテゴリスラッグ名]
 *do_shortcode('[reference_slider 指定するカテゴリスラッグ名]')
 *
 */
function reference_slider_Func($attr){
  if(!empty($attr[0])){//カテゴリで絞るかどうか
    $customPostArg = array(
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'post_type'      => 'topslider',  // カスタム投稿タイプ名
      'order'      => 'DESC',
      'orderby'    => 'date',
      'tax_query' => array(
      'relation' => 'AND',
        array(
          'taxonomy' => 'topslider_cat',
          'field' => 'slug',
          'terms' => $attr[0], /* カテゴリ名 */
        )
      )
    );
  }else{
    $customPostArg = array(
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'post_type'      => 'topslider',  // カスタム投稿タイプ名
      'order'      => 'DESC',
      'orderby'    => 'date',
    );
  }

  global $post;
  $myposts = get_posts($customPostArg);
  $num = 0;
  foreach($myposts as $post) :
    setup_postdata($post);
    $image = NULL;
    $pcpath = NULL;
    $pcalt = NULL;
    $sppath = NULL;
    $spalt = NULL;
    $btn_link = NULL;
    $btn_text = NULL;
    $catchphrase = NULL;
    $btn_link_text = NULL;

    $image = get_field('pc_img');
    $pcpath = $image['url'];
    $pcalt = $image['alt'];

    $image = get_field('sp_img');
    $sppath = $image['url'];
    $spalt = $image['alt'];

    //スライダー上ボタン(リンク)
    $btn_link = get_field('btn_link');

    //スライダー上ボタン(テキスト)
    $btn_text = get_field('btn_text');

    //リンクとテキストあるときボタン生成
    if(!empty($btn_text) && !empty($btn_link)) $btn_link_text = '<div class="sliderbutton"><a href="'.$btn_link.'"><span>'.$btn_text.'</span></a></div>';

    //キャッチフレーズ
    $catchphrase = get_field('catchphrase');
    $catchphrase = '<div class="catchphrase"><p>'.$catchphrase.'</p></div>';

    $num += 1;



    $block .= '
    <div class="swiper-slide ss_'.$num.'">

        <div class="image onlyPc" style="background-image:url(' .$pcpath . ')"></div><!--/.image-->
        <div class="image onlySp" style="background-image:url(' .$sppath . ')"></div><!--/.image-->
        <div>'.$btn_link_text.$catchphrase.'</div>
    </div>';
  endforeach;
  wp_reset_postdata();

  $result = '
  <div class="commonSlide swiper-container ">
      <div class="swiper-wrapper">
        '.$block.'
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
  </div><!--end commonSlide-->
  <script>
  var commonSlide = new Swiper (".commonSlide", {
    effect:"fade", //"fade" "flip"//エフェクト指定
    autoplay:{
        delay: 4000,//自動再生待ち時間
        disableOnInteraction: false,//ユーザーが操作したあと自動再生を止めるか
    },
    speed: 1000,//スライド速度
    loop: true,//ループ
    slidesPerView:"auto",//同時表示枚数
    loopedSlides:2,//ループするときに途切れないように余分に出しておくスライド数
    preventClicks: true,//クリック出来なくなる場合はfalse
    preventClicksPropagation: true,//クリック出来なくなる場合はfalse
    allowTouchMove:true,//スライド操作できるか
    pagination: {//ページネーション
      el: ".swiper-pagination",
      type: "bullets", //"fraction" "progress" "custom",//ページネーションスタイル
    },
    // clickable:true,//ページネーションクリックできるか
    });
    setTimeout(function(){commonSlide.update();},100)
</script>';


  return $result;
}
add_shortcode('reference_slider', 'reference_slider_Func');



/**
  * [jirei_shinchaku]
 * do_shortcode('[jirei_shinchaku]')
 *
 */
function jirei_shinchaku_Func($attr){
  $args = [
    'posts_per_page' => 4,
    'post_type' => 'cases',
  ];

  $recent_post_query = new WP_Query( $args );

  ?>

  <div class="vc_row wpb_row vc_row-fluid A21">
      <div class="wpb_column vc_column_container vc_col-sm-12">
          <div class="vc_column-inner">
              <div class="wpb_wrapper">
                  <div class="vc_row wpb_row vc_inner vc_row-fluid A21Inner_row">

                  <?php while ($recent_post_query -> have_posts()) : $recent_post_query -> the_post();

									$after_image = get_post_meta( get_the_ID(), 'after_photo', true);
						      $before_image = get_post_meta( get_the_ID(), 'before_photo', true);
									if ($after_image[0]){
										$image_url = $after_image[0];//画像URL
							      $url_info = pathinfo($image_url);//切り分ける
							      $image_url = $url_info["dirname"];//拡張子なし
							      $image_url = $image_url."/".$url_info["filename"]."-480x360.".$url_info["extension"];
							      $image_url_array = get_headers($image_url);
							      if(!strpos($image_url_array[0],'OK')){
							        $image_url = $image_url[0];
							      }
									}elseif($before_image[0]){
						        $image_url = $before_image[0];//画像URL
						        $url_info = pathinfo($image_url);//切り分ける
						        $image_url = $url_info["dirname"];//拡張子なし
						        $image_url = $image_url."/".$url_info["filename"]."-480x360.".$url_info["extension"];
						        $image_url_array = get_headers($image_url);
						        if(!strpos($image_url_array[0],'OK')){
						          $image_url = $image_url[0];
						        }
						      }else{
											$image_url = noimage_ret("thumb480360");
									}
													   ?>

                      <div class="co1 wpb_column vc_column_container vc_col-sm-3">
                          <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                  <div  class="wpb_single_image wpb_content_element vc_align_center">
                                      <figure class="wpb_wrapper vc_figure w100">
                                          <div class="vc_single_image-wrapper vc_box_border_grey widget3_height w100">
                                              <a href="<?php the_permalink() ?>">
                                                  <img class="vc_img-placeholder vc_single_image-img h100" src="<?=$image_url?>" />
                                              </a>
                                          </div>
                                      </figure>

                                  </div>
                                  <div class="vc_empty_space  rem05"   style="height: 0.5rem" >
                                      <span class="vc_empty_space_inner"></span>
                                  </div>
                                  <div class="wpb_text_column wpb_content_element " >
                                      <div class="wpb_wrapper text-left">
                                          <a href="<?php the_permalink() ?>">
                                              <h4 class="style02"><?php echo custom_length_excerpt_max_char(get_the_title(), 34); ?></h4>
                                          </a>
                                      </div>
                                  </div>
                                  <div class="vc_empty_space  rem1"   style="height: 1rem" >
                                      <span class="vc_empty_space_inner"></span>
                                  </div>
                              </div>
                          </div>
                      </div>

                  <?php endwhile; wp_reset_postdata(); ?>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <?php
  return $result;
}
add_shortcode('jirei_shinchaku', 'jirei_shinchaku_Func');


/**
  * [news]
 * do_shortcode('[news]')
 *
 */
function news_Func($attr){
  $args = array(
    'post_type' => 'post',
    'category_name' => 'news',
    'posts_per_page' => 5,
  );

  $arr_posts = new WP_Query( $args );

      if ( $arr_posts->have_posts() ) : ?>
    <div class="news-post post-field">
      <div class="post-field-title"><i class="fa fa-file-text" aria-hidden="true"></i>お知らせ</div>
      <div class="post-triangle"></div>
      <div class="post-field-cont">
        <ul>
          <?php
              while ( $arr_posts->have_posts() ) :
                  $arr_posts->the_post();

									//カテゴリ
									$catname = "";
									$catlink = "";
									$catnames = get_the_terms(get_the_ID(), "category");
									if(is_array($catnames)){
									 foreach ($catnames as $catnames_value) {
										if($catnames_value->slug == "all")continue;
										$catname = $catnames_value->name;//カテゴリ名
										$catlink = "/".$catnames_value->slug;//リンクパス
									 }
									}
									$nullcat = "";
									if(empty($catname))$nullcat="style='display:none;'";
                  ?>
                  <li>
										<a href="<?=$catlink?>" class="cat_name_link"><p><?=$catname?></p></a>
                    <p class="post-date"><?php echo get_the_date( 'Y.m.d' ); ?></p>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </li>
                  <?php
              endwhile;
          endif;
          ?>
        </ul>

        <div class="post-more-btn"><a href="/news">続きを読む</a></div>
      </div>
    </div>
    <?php
  return;
}
add_shortcode('news', 'news_Func');

/**
  * [media]
 * do_shortcode('[media]')
 *
 */
function media_Func($attr){
  $args = array(
    'post_type' => 'post',
    'category_name' => 'media',
    'posts_per_page' => 5,
  );

  $arr_posts = new WP_Query( $args ); ?>

  <div class="media-post post-field">
    <div class="post-field-title"><i class="fa fa-desktop" aria-hidden="true"></i>メディア情報</div>
    <div class="post-triangle"></div>
    <div class="post-field-cont">
      <ul>

        <?php
        if ( $arr_posts->have_posts() ) :

            while ( $arr_posts->have_posts() ) :
                $arr_posts->the_post();

								//カテゴリ
								$catname = "";
								$catlink = "";
								$catnames = get_the_terms(get_the_ID(), "category");
								if(is_array($catnames)){
								 foreach ($catnames as $catnames_value) {
									if($catnames_value->slug == "all")continue;
									$catname = $catnames_value->name;//カテゴリ名
									$catlink = "/".$catnames_value->slug;//リンクパス
								 }
								}
								$nullcat = "";
								if(empty($catname))$nullcat="style='display:none;'";
                ?>
                <li>
									<a href="<?=$catlink?>" class="cat_name_link"><p><?=$catname?></p></a>
                  <p class="post-date"><?php echo get_the_date( 'Y.m.d' ); ?></p>
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
                <?php
            endwhile;
        endif;
        ?>
      </ul>

      <div class="post-more-btn"><a href="/media">続きを読む</a></div>
      </div>
  </div>
  <?php
  return;
}
add_shortcode('media', 'media_Func');



/**
 * アイキャッチ判別
 * [eyecatching_check slug="スラッグ名" id=対象のID]
 */
 function eyecatchShowFunc($attr){
   extract(shortcode_atts(array(
    "slug" => '',
    "id" => ''
   ), $attr));
   $result = NULL;

   if(empty($id) && empty($slug)){
    return $result;
   }
	 if(is_post_type_archive( "cases" )){ return; }
	 if(is_singular( "cases" )){ return; }
	 if(is_category()){ return; }
	 if(is_singular("post")){return;}

   if(empty($id) && !empty($slug)){
    if(is_page($slug)){
     $id = get_page_by_path($slug);
     $id = $id->ID;
    }else{
     $id = get_posts("name=".$slug);
     $id = $id[0]->ID;
    }
   }

	 $subtitle = get_field('secondlayer-subtitle');
	 $maintitle = get_the_title();
   if (has_post_thumbnail($id)) { //指定した投稿がアイキャッチ画像を持たない場合、falseを返す
    $thumb_id = get_post_thumbnail_id($id);
    $topEyecatchTB = wp_get_attachment_image_src($thumb_id, 'topEyecatchTB');
    $topEyecatchSP = wp_get_attachment_image_src($thumb_id, 'topEyecatchSP');
    $topEyecatch = wp_get_attachment_image_src($thumb_id, '');
    $file_name = $topEyecatch[0];
    $SP_file_name = str_replace(".jpg", "SP.jpg", $file_name );
    $TB_file_name = str_replace(".jpg", "TB.jpg", $file_name );
  }

	/*旧施工事例*/
	if(is_singular("oldvoice") || is_tax("oldvoices")){
		$topEyecatchTB = wp_get_attachment_image_src(29734, '');
		$TB_file_name = $topEyecatchTB[0];
		$topEyecatch = wp_get_attachment_image_src(29735, '');
		$topEyecatchSP = wp_get_attachment_image_src(29736, '');
		$SP_file_name = $topEyecatchSP[0];
		$subtitle = "";
		$maintitle = "過去の施工事例";
	}

	/*旧アンケート*/
	if(is_singular("oldsurvey") || is_tax("oldsurveys")){
		$topEyecatchTB = wp_get_attachment_image_src(4283, '');
		$TB_file_name = $topEyecatchTB[0];
		$topEyecatch = wp_get_attachment_image_src(4285, '');
		$topEyecatchSP = wp_get_attachment_image_src(4284, '');
		$SP_file_name = $topEyecatchSP[0];
		$subtitle = "";
		$maintitle = "過去のお客様アンケート";
	}

   $tag="withNoEyecatch";

   if(!empty($topEyecatch)){
      $tag="withEyecatch";
     if ( !is_home() && !is_front_page() ){

   $result = '
  <div class="eycatch">
    <div class="imageBox">
    <div class="image hideSp hideTb" style="background-image:url(' .$topEyecatch[0] . ')"></div><!--/.image-->
    <div class="image hideTb hidePc" style="background-image:url(' .$SP_file_name . ')"></div><!--/.image-->
    <div class="image hideSp hidePc" style="background-image:url(' .$TB_file_name . ')"></div><!--/.image-->
    </div><!--/.imageBox-->
  </div><!--/.eyecatch-->';
          }
       }
      if ( !is_home() && !is_front_page() ){
        $result .='
        <div class="h1 ' . $tag . '">
          <div class="h1Wrapper">
            <h1>'.$maintitle.'</h1>
          </div>
        </div>';
      }
   return '<div class="eyecatchWrapper">'.
   $result.
   '</div>';
 }
 add_shortcode('eyecatchShow', 'eyecatchShowFunc');


 /*個人情報HEAD*/
 function privacy_pre_Func(){
  $result = '';

  $result = <<< EOM
  <p>**************（以下、「当社」といいます）は本ウェブサイト上で提供するサービス（以下、「本サービス」といいます）におけるプライバシー情報の取扱について、以下のとおりプライバシーポリシー（以下、「本ポリシー」といいます）を定めます。</p>
EOM;

  return $result;
 }
 add_shortcode('privacy_pre', 'privacy_pre_Func');


 function contactform_pre_privacy_func() {
   $obj = WPCF7_ShortcodeManager::get_instance();
   $test = do_shortcode('[privacy_pre]');
   return $test;
 }
 wpcf7_add_shortcode('contactform_pre_privacy', 'contactform_pre_privacy_func');


 /**
  * 個人情報HTML
  */
 function privacy_html_Func(){
  $result = '';

  $result = <<< EOM
  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第1条（プライバシー情報）</h3>
   </div>
   <p>
     プライバシー情報のうち「個人情報」とは、個人情報保護法にいう「個人情報」を指すものとし、生存する個人に関する情報であって、当該情報に含まれる氏名、生年月日、住所、電話番号、連絡先その他の記述等により特定の個人を識別できる情報を指します。<br>
     プライバシー情報のうち「履歴情報および特性情報」とは、上記に定める「個人情報」以外のものをいい、ご利用いただいたサービスやご購入いただいた商品、ご覧になったページや広告の履歴、ユーザーが検索された検索キーワード、ご利用日時、ご利用の方法、ご利用環境、郵便番号や性別、職業、年齢、ユーザーのIPアドレス、クッキー情報、位置情報、端末の個体識別情報などを指します。
   </p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第２条（プライバシー情報の収集方法）</h3>
   </div>
   <p>
     当社は、ユーザーが利用登録をする際に氏名、生年月日、住所、電話番号、メールアドレス、銀行口座番号、クレジットカード番号、運転免許証番号などの個人情報をお尋ねすることがあります。また、ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や、決済に関する情報を当社の提携先（情報提供元、広告主、広告配信先などを含みます。以下、｢提携先｣といいます）などから収集することがあります。<br>
     当社は、ユーザーについて、利用したサービスやソフトウエア、購入した商品、閲覧したページや広告の履歴、検索した検索キーワード、利用日時、利用方法、利用環境（携帯端末を通じてご利用の場合の当該端末の通信状態、利用に際しての各種設定情報なども含みます）、IPアドレス、クッキー情報、位置情報、端末の個体識別情報などの履歴情報および特性情報を、ユーザーが当社や提携先のサービスを利用しまたはページを閲覧する際に収集します。
   </p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第３条（個人情報を収集・利用する目的）</h3>
   </div>
   <p>
     当社が個人情報を収集・利用する目的は、以下のとおりです。
   </p>
   <p class="countNum">ユーザーに自分の登録情報の閲覧や修正、利用状況の閲覧を行っていただくために、氏名、住所、連絡先、支払方法などの登録情報、利用されたサービスや購入された商品、およびそれらの代金などに関する情報を表示する目的</p>
   <p class="countNum">ユーザーにお知らせや連絡をするためにメールアドレスを利用する場合やユーザーに商品を送付したり必要に応じて連絡したりするため、氏名や住所などの連絡先情報を利用する目的</p>
   <p class="countNum">ユーザーの本人確認を行うために、氏名、生年月日、住所、電話番号、銀行口座番号、クレジットカード番号、運転免許証番号、配達証明付き郵便の到達結果などの情報を利用する目的</p>
   <p class="countNum">ユーザーに代金を請求するために、購入された商品名や数量、利用されたサービスの種類や期間、回数、請求金額、氏名、住所、銀行口座番号やクレジットカード番号などの支払に関する情報などを利用する目的</p>
   <p class="countNum">ユーザーが簡便にデータを入力できるようにするために、当社に登録されている情報を入力画面に表示させたり、ユーザーのご指示に基づいて他のサービスなど（提携先が提供するものも含みます）に転送したりする目的</p>
   <p class="countNum">代金の支払を遅滞したり第三者に損害を発生させたりするなど、本サービスの利用規約に違反したユーザーや、不正・不当な目的でサービスを利用しようとするユーザーの利用をお断りするために、利用態様、氏名や住所など個人を特定するための情報を利用する目的</p>
   <p class="countNum">ユーザーからのお問い合わせに対応するために、お問い合わせ内容や代金の請求に関する情報など当社がユーザーに対してサービスを提供するにあたって必要となる情報や、ユーザーのサービス利用状況、連絡先情報などを利用する目的</p>
   <p class="countNum">上記の利用目的に付随する目的</p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第４条（個人情報の第三者提供）</h3>
   </div>
   <p>
     当社は、次に掲げる場合を除いて、あらかじめユーザーの同意を得ることなく、第三者に個人情報を提供することはありません。ただし、個人情報保護法その他の法令で認められる場合を除きます。
   </p>
   <p class="countNum">法令に基づく場合</p>
   <p class="countNum">人の生命、身体または財産の保護のために必要がある場合であって、本人の同意を得ることが困難であるとき</p>
   <p class="countNum">公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって、本人の同意を得ることが困難であるとき</p>
   <p class="countNum">国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</p>
   <p class="countNum">予め次の事項を告知あるいは公表をしている場合<br>
       利用目的に第三者への提供を含むこと<br>
       第三者に提供されるデータの項目<br>
       第三者への提供の手段または方法<br>
       本人の求めに応じて個人情報の第三者への提供を停止すること<br>
       前項の定めにかかわらず、次に掲げる場合は第三者には該当しないものとします。
   </p>
   <p class="countNum">当社が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</p>
   <p class="countNum">合併その他の事由による事業の承継に伴って個人情報が提供される場合</p>
   <p class="countNum">個人情報を特定の者との間で共同して利用する場合であって、その旨並びに共同して利用される個人情報の項目、共同して利用する者の範囲、利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について、あらかじめ本人に通知し、または本人が容易に知り得る状態に置いているとき</p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第６条（個人情報の訂正および削除）</h3>
   </div>
   <p>
     ユーザーは、当社の保有する自己の個人情報が誤った情報である場合には、当社が定める手続きにより、当社に対して個人情報の訂正または削除を請求することができます。<br>
     当社は、ユーザーから前項の請求を受けてその請求に応じる必要があると判断した場合には、遅滞なく、当該個人情報の訂正または削除を行い、これをユーザーに通知します。
   </p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第７条（個人情報の利用停止等）</h3>
   </div>
   <p>
     当社は、本人から、個人情報が、利用目的の範囲を超えて取り扱われているという理由、または不正の手段により取得されたものであるという理由により、その利用の停止または消去（以下、「利用停止等」といいます）を求められた場合には、遅滞なく必要な調査を行い、その結果に基づき、個人情報の利用停止等を行い、その旨本人に通知します。ただし、個人情報の利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって、本人の権利利益を保護するために必要なこれに代わるべき措置をとれる場合は、この代替策を講じます。
   </p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第８条（プライバシーポリシーの変更）</h3>
   </div>
   <p>
     本ポリシーの内容は、ユーザーに通知することなく、変更することができるものとします。<br>
     当社が別途定める場合を除いて、変更後のプライバシーポリシーは、本ウェブサイトに掲載したときから効力を生じるものとします。
   </p>
  </div>

  <div class="privacy_text">
   <div class="blockTitleA">
     <h3 class="titleText skn-blockTitleA">第９条（お問い合わせ窓口）</h3>
   </div>
   <p>
     本ポリシーに関するお問い合わせは、下記の窓口までお願いいたします。
   </p>
   <div class="companyInfo">
     社名：*********<br>
     住所：*****************************<br>
     Eメールアドレス：*****************
   </div>
  </div>
EOM;

  return $result;
 }
 add_shortcode('privacy_html', 'privacy_html_Func');


 function contactform_privacy_func() {
   $obj = WPCF7_ShortcodeManager::get_instance();
   $test = do_shortcode('[privacy_html]');
   return $test;
 }
 wpcf7_add_shortcode('contactform_privacy', 'contactform_privacy_func');








//フッターエリア読み込み
function get_page_shortcode( $atts )
{
    $param = shortcode_atts
        (
          array
          (
          'slug' => ''
        ),
        $atts
      );
  ob_start();

  $page_info = get_page_by_path( $param['slug'] );
  $page = get_post($page_info);
  ob_end_clean();

  return do_shortcode( $page->post_content );
  //return $page->post_content;
}
add_shortcode( 'ins_get_page', 'get_page_shortcode' );


/**
* 固定ページparts取得
* [myparts_page_get]
* 例[myparts_page_get getslug="secondlayer/cta"]
*/
function myparts_page_getFunc($attr){
  extract(shortcode_atts(array(
   "getslug" => '',
  ), $attr));

  $result = '';
  if(empty($getslug))return $result;

 //今見てるページ
 $get_page = get_page_by_path($getslug);
 $result = do_shortcode($get_page -> post_content);

 return $result;
}
add_shortcode('myparts_page_get', 'myparts_page_getFunc');






    function cocorotoso_simpleestimationFunc()
{


    return '

';
}
add_shortcode('cocorotoso_simpleestimation', 'cocorotoso_simpleestimationFunc');





// ファイル名をファイル名+ランダム文字にする
// function rename_upload_file($fileName)
// {
//  // ファイル名が大文字の場合もあるので、ファイル名全てを小文字に変換する
//  // $fileName = strtolower($fileName);
//  // 「.」の位置を取得
//  $index = strrpos($fileName, '.');
//  // 拡張子を取得
//  $exts = $index ? '.' . substr($fileName, $index + 1) : '';

//  // 画像ファイルか拡張子でチェックする
//  if (in_array($exts, array('.jpg','.jpeg','.gif','.png'))) {
//  // ファイル名をmd5で生成する
//  $fileName = "_-_-_" . $fileName ;
//  }

//  return $fileName;
// }
// add_filter('sanitize_file_name', 'rename_upload_file', 10);


//wp_footerに追加
function adds_footer() {
  if(is_page("webcs-answer")){
    $hide_empty = array( 'hide_empty' => false );
    $shops = get_terms('csquestionnaire_shop', $hide_empty);
    echo "
    <script >
    jQuery(function(){
    ";
    foreach ($shops as $shop) {
			if($shop->name == "本社")continue;
      echo "
        jQuery('#select-title').append(jQuery('<option>').attr({ value: '".$shop->name."' }).text('".$shop->name."'));
      ";
    }
    echo "
    jQuery('#select-title').val('大阪支社');
    });
    </script>
    ";
  }
}
add_action('wp_footer', 'adds_footer');


//NOIMG取得
function noimage_ret($size){
  $noimage = "";
  $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image'));
  if(!empty($attachments)){
    foreach($attachments as $attachment){
      if($attachment->post_title == 'noimage') {
        $noimage = wp_get_attachment_image_src( $attachment->ID, $size);
        // $imgid = $attachment->ID;
      }
    }
  }
  return $noimage[0];
}


/**施工事例　サイドバー　バナー*/
function case_sidebar_bannerFunc(){
	$result = "
	<div class='sideBanner'>
			<div class='imageBox'>
				<div class='image'>
					<a href='tel:0120224838'>
						<img src='".content_url()."/uploads/sidebar01.png' alt=''>
            </a>
				</div><!--end image-->
			</div><!--end imageBox-->

			<div class='imageBox'>
				<div class='image'>
					<a href='/contact'>
						<img src='".content_url()."/uploads/sidebar02.png' alt=''>
					</a>
				</div><!--end image-->
			</div><!--end imageBox-->
	</div>
	";
	return $result;
}
add_shortcode('case_sidebar_banner', 'case_sidebar_bannerFunc');





function simulation_text_Func(){
  $result ='

                              <div class="toryoryokin">
                              <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
                              <div class="toryoryokinInner">
                                <div class="vc_row wpb_row vc_row-fluid A02">
                                  <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner">
                                      <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element ">
                                          <div class="wpb_wrapper">
                                            <h3 class="label">■ 面積について</h3>
                                          </div>
                                        </div>
                                        <!-- <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div> -->
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <h4>[参考値]</h4>
                                <p class="gaiheki2">外壁（延べ床面積坪数からの係数値1.1が想定値）</p>
                                <div class="image">
                                  <div class="imageWrapper">
                                    <img src="/wp-content/uploads/gaihekiSP.png" class="onlySp" alt="外壁塗装 坪数参考値">
                                  </div>
                                  <div class="imageWrapper">
                                    <img src="/wp-content/uploads/gaiheki.png" class="hideSp" alt="外壁塗装 坪数参考値">
                                  </div>

                                </div>

                                <p class="yane2">屋根（延べ床面積坪数からの係数値0.9が想定値）</p>
                                <div class="image">
                                  <div class="imageWrapper">
                                    <img src="/wp-content/uploads/yaneSP.png" class="onlySp" alt="屋根塗装 坪数参考値">
                                  </div>
                                  <div class="imageWrapper">
                                    <img src="/wp-content/uploads/yane.png" class="hideSp" alt="屋根塗装 坪数参考値">
                                  </div>

                                </div>
                                <p>※詳細の実測値をお知りになりたい方は現地調査を依頼ください。<br>
                                  ※『延べ床面積(のべゆかめんせき)』とは、建物の外壁の中心線(壁芯)※で囲まれた『各階の床面積を合計したもの』です。試算では各フロアの床面積を合計した値をご使用ください。
                                </p>
                              </div>
                            </div>
                            <!-- toryoryokin -->

                            <div class="toryorank">
                              <div class="toryorankInner">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                  <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                      <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                          <h3 class="label">■ 塗料について</h3>
                                        </div>
                                      </div>
                                      <!-- <div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div> -->
                                    </div>
                                  </div>
                                </div>

                                <div class="note">
                                  <p>フッソ系：非粘着性や耐摩耗性、難燃性が高く、寿命がとても長い機能性塗料です。</p>
                                  <p>シリコン系：塗膜が固く撥水性が高い。また紫外線に強いのが特徴的な塗料です。</p>
                                  <p>ウレタン系：木製や塩ビ製素材、鉄部に適しDIYなどでも手軽に使われる塗料です。</p>
                                </div>
                              </div>
                            </div>
                            <!-- toryorank -->';
  return $result;
}


add_shortcode('simulation_text', 'simulation_text_Func');




/**
 * [simpleestimation_Func]
 * @return [type]       [description]
 *
 */
function simpleestimation_Func($attr){
  extract(shortcode_atts(array(
   "idname" => "",
  ), $attr));

  $result = NULL;
  $wall_dimens = get_estimation_dimens('est-cat-01');
  $roof_dimens = get_estimation_dimens('est-cat-02');
  $materials = get_estimation_materials();

  /*外壁の大きさ*/
  foreach ($wall_dimens as $wall_dimen) {
    $wall_item .= "<option value='{$wall_dimen}' >{$wall_dimen}</option>";
  }
  /*屋根の大きさ*/
  foreach ($roof_dimens as $roof_dimen) {
    $roof_item .= "<option value='{$roof_dimen}' >{$roof_dimen}</option>";
  }
  /*塗料*/
  foreach ($materials as $material) {
    $material_item .= "<option value='{$material['field']}'>{$material['label']}</option>";
  }
  $simpleurl = esc_url( home_url( '/simple-estimation-result' ) );
  $result = "<div id='block' class='block'>
    <form id='estimation_form2' action='{$simpleurl}' method='post'>
        <div class='esti_main_form'>
            <div class='esti_form_title'>
                <p><strong>外壁</strong>と<strong>屋根</strong>の料金シミュレーションが行えます</p>
                <p>お客様の<strong>外壁</strong>と<strong>屋根</strong>の面積をご入力ください。</p>
                <div class='link'>面積の目安は<a href='/wp-content/uploads/2019/07/meyasu.png' data-lightbox='light'>こちら</a>
                </div>
                <div class='esti_form_body'>
                    <h3 class='label'>外壁</h3>
                    <div class='esti_form_item left gaiheki'>
                        <div class='step'>
                            <p>Step1.お客様の家の外壁の大きさをお教えください。</p>
                        </div>
                        <div class='esti_form_label'>
                            <label>外壁の大きさ（おおよそ）</label>
                        </div>
                        <div class='esti_form_input'>
                            <select class='' name='wall_dimen' id='wall_dimen'>
                                <option value=''>選択ください</option>
                                {$wall_item}
                            </select>
                        </div>
                        <div class='clearfix'></div>
                    </div>
                    <div class='esti_form_item right gaihekiToryo'>
                        <div class='step'>
                            <p>Step2.外壁に使う塗料のグレードをお選びください。</p>
                        </div>
                        <div class='esti_form_label'>
                            <label>塗料ランク</label>
                        </div>
                        <div class='esti_form_input'>
                            <select class='' name='wall_material' id='wall_material'>
                                <option value=''>選択ください</option>
                                {$material_item}
                            </select>
                        </div>
                        <div class='clearfix'></div>
                    </div>
                    <h3 class='label'>屋根</h3>
                    <div class='esti_form_item left yane'>
                        <div class='step'>
                            <p>Step3.お客様の家の屋根の大きさをお教えください。</p>
                        </div>
                        <div class='esti_form_label'>
                            <label>屋根の大きさ（おおよそ）</label>
                        </div>
                        <div class='esti_form_input'>
                            <select class='' name='roof_dimen' id='roof_dimen'>
                                <option value=''>選択ください</option>
                                {$roof_item}
                            </select>
                        </div>
                        <div class='clearfix'></div>
                    </div>
                    <div class='esti_form_item right yaneToryo'>
                        <div class='step'>
                            <p>Step4.屋根に使う塗料のグレードをお選びください。</p>
                        </div>
                        <div class='esti_form_label'>
                            <label>塗料ランク</label>
                        </div>
                        <div class='esti_form_input'>
                            <select class='' name='roof_material' id='roof_material'>
                                <option value=''>選択ください</option>
                                {$material_item}
                            </select>
                        </div>
                        <div class='clearfix'></div>
                    </div>
                    <div class='rem5' style='height:5rem;'></div>
                    <!--button-->
                    <div class='vc_row wpb_row vc_inner vc_row-fluid btn'>
                        <div class='co2 wpb_column vc_column_container vc_col-sm-8'>
                            <div class='vc_column-inner'>
                                <div class='wpb_wrapper'>
                                    <div class='vc_btn3-container  submitBtn btnWrapper btns btn2 vc_btn3-center'>
                                        <button class='ga_cta_start vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-sky' id='esti-search-btn2' type='submit' onClick='return empty2()'>シミュレーション開始</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>";

  return $result;

}
add_shortcode('simpleestimation', 'simpleestimation_Func');



/**
 * 三和ペイント　top　お客様声
 */
function top_user_voiceFunc(){
	$result = "";
	$args = array(
		'post_type' => array('csquestionnaire','webcsquestionnaire'),
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	$the_query = new WP_Query( $args );

	$linknum = 0;

	if ( $the_query->have_posts() ) :
   while ( $the_query->have_posts() ) : $the_query->the_post();
   //ここにループするテンプレート
   ////////////////////////////画像ゾーン///////////////////////////////////
	 $t_scanimage = get_field('scanimage');

	 if ( $t_scanimage )
	 	$main_image = $t_scanimage['url'];
	 else
	 	$main_image = noimage_ret("thumb480360");
   ////////////////////////////画像ゾーン///////////////////////////////////

   //本文
   // $text = do_shortcode(get_the_content()); // 元になる文字列
   $text = do_shortcode(get_the_content()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $text = html_entity_decode( $text );
   // 指定の文字数で切り出す
   $text = wp_trim_words( $text, 30, "..." );
   // HTMLエンティティを元に戻す
   $text = htmlentities( $text );

   $link = get_permalink();//リンク
   $date = get_the_date('Y.m.d');//日付

   //タイトル
   $title = do_shortcode(get_the_title()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $title = html_entity_decode( $title );
   // 指定の文字数で切り出す
   $title = wp_trim_words( $title, 21, "..." );
   // HTMLエンティティを元に戻す
   $title = htmlentities( $title );

	 $linknum++;

	 /*返り値　記述*/
	 $result .= "
   <div class='co1 wpb_column vc_column_container vc_col-sm-3'>
       <div class='vc_column-inner'>
           <div class='wpb_wrapper'>
               <div class='wpb_single_image wpb_content_element vc_align_center'>
                   <figure class='wpb_wrapper vc_figure w100'>
                       <div class='vc_single_image-wrapper vc_box_border_grey widget3_height w100'>
                           <a href='/cs?item={$linknum}'>
                               <img class='vc_img-placeholder vc_single_image-img h100' src='{$main_image}' alt='csアンケート'>
                           </a>
                       </div>
                   </figure>
               </div>
               <div class='vc_empty_space  rem05' style='height: 0.5rem'>
                   <span class='vc_empty_space_inner'></span>
               </div>
               <div class='wpb_text_column wpb_content_element '>
                   <div class='wpb_wrapper text-left'>
                       <a href='{$link}'>
                           <h4 class='style02'>{$text}</h4>
                       </a>
                   </div>
               </div>
               <div class='vc_empty_space  rem1' style='height: 1rem'>
                   <span class='vc_empty_space_inner'></span>
               </div>
           </div>
       </div>
   </div>

	 ";

  endwhile;

  $result = "
    <div class='vc_row wpb_row vc_row-fluid A21'>
          <div class='wpb_column vc_column_container vc_col-sm-12'>
              <div class='vc_column-inner'>
                  <div class='wpb_wrapper'>
                      <div class='vc_row wpb_row vc_inner vc_row-fluid A21Inner_row'>
                      {$result}
                    </div>
                </div>
            </div>
        </div>
    </div>
  ";
  endif;
  wp_reset_postdata();

	return $result;
}
add_shortcode('top_user_voice', 'top_user_voiceFunc');



/**
 * [CustomRewriteRules description]
 * @param [type] $rules [description]
 * スラッグが数字４桁だと日付別アーカイブに飛ぶので
 * 日付別アーカイブを削除
 */
function CustomRewriteRules($rules) {  //パラメーター：他のリライトルール全部の配列
  //  $rules の中は配列で
  //  $rules['当てはまる正規表現'] = index.php?year=$matches[1]（表示したいページの本当の姿)
  //  の形になっているので、該当の配列を削除
  unset($rules['cases/([0-9]{4})/?$']);
  return $rules;
}
add_filter('rewrite_rules_array','CustomRewriteRules');  //リライトルールが作成された時にCustomRewriteRules関数を呼び出し
