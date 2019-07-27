<?php
// https://wordpress.stackexchange.com/questions/76621/filter-custom-post-types-in-admin-not-working
// // Adding a Taxonomy Filter to Admin List for a Custom Post Type
// add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
// function my_restrict_manage_posts() {
//
//     // only display these taxonomy filters on desired custom post_type listings
//     global $typenow;
//     if ($typenow == 'voice') {
//
//         // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
//         $filters = array('branch');
//
//         foreach ($filters as $tax_slug) {
//             // retrieve the taxonomy object
//             $tax_obj = get_taxonomy($tax_slug);
//             $tax_name = $tax_obj->labels->name;
//
//             // output html for taxonomy dropdown filter
//             echo "<select name='".strtolower($tax_slug)."' id='".strtolower($tax_slug)."' class='postform'>";
//             echo "<option value=''>Show All $tax_name</option>";
//             generate_taxonomy_options($tax_slug,0,0,(isset($_GET[strtolower($tax_slug)])? $_GET[strtolower($tax_slug)] : null));
//             echo "</select>";
//         }
//     }
// }
//
// function generate_taxonomy_options($tax_slug, $parent = '', $level = 0,$selected = null) {
//     $args = array('show_empty' => 1);
//     if(!is_null($parent)) {
//         $args = array('parent' => $parent);
//     }
//     $terms = get_terms($tax_slug,$args);
//     $tab='';
//     for($i=0;$i<$level;$i++){
//         $tab.='--';
//     }
//     foreach ($terms as $term) {
//         // output each select option line, check against the last $_GET to show the current option selected
//         echo '<option value='. $term->slug, $selected == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
//         generate_taxonomy_options($tax_slug, $term->term_id, $level+1,$selected);
//     }
//
// }



function user_shop(){
  //$userにユーザー情報が配列で格納されます
  $user = wp_get_current_user();
  $user_name = $user->display_name;
  switch ($user_name) {
    case 'osaka@sanwa-paint.jp':
      return array("大阪支社");
      break;
    case 'gifu@sanwa-paint.jp':
      return array("岐阜支社");
      break;
    case 'kumamoto@sanwa-paint.jp':
      return array("熊本支店");
      break;
    case 'matuyama@sanwa-paint.jp':
      return array("松山支店");
      break;
    case 'okayama@sanwa-paint.jp':
      return array("岡山支店");
      break;
    case 'kobe@sanwa-paint.jp':
      return array("神戸支店");
      break;
    case 'sakai@sanwa-paint.jp':
      return array("堺支店");
      break;
    case 'nagoya@sanwa-paint.jp':
      return array("名古屋支店");
      break;
    case 'kanazawa@sanwa-paint.jp':
      return array("金沢支店");
      break;
    case 'hamamatsu@sanwa-paint.jp':
      return array("浜松支店");
      break;
    case 'shizuoka@sanwa-paint.jp':
      return array("静岡支店");
      break;
    case 'kanagawa@sanwa-paint.jp':
      return array("神奈川支店","横浜支店");
      break;
    case 'yokohama@sanwa-paint.jp':
      return array("神奈川支店","横浜支店");
      break;
    case 'takasaki@sanwa-paint.jp':
      return array("高崎支店");
      break;
    case 'chiba@sanwa-paint.jp':
      return array("千葉支店");
      break;
    case 'nigata@sanwa-paint.jp':
      return array("新潟支店");
      break;
    case 'mito@sanwa-paint.jp':
      return array("水戸支店");
      break;
    case 'iwaki@sanwa-paint.jp':
      return array("いわき支店");
      break;
    case 'hakodate@sanwa-paint.jp':
      return array("函館支店");
      break;
    case 'sapporo@sanwa-paint.jp':
      return array("札幌第一支店","札幌第二支店");
      break;
    case 'sapporo2@sanwa-paint.jp':
      return array("札幌第二支店","札幌第一支店");
      break;
    default:
     return array("all");
     break;
    }
}


/**
 * ユーザーごとに施工事例　非表示・表示　処理
 */
 /*管理画面投稿をカテゴリで絞る
 https://hacknote.jp/archives/19040/
 */
 add_filter('pre_get_posts', 'set_post_order_in_customName');
 function set_post_order_in_customName($wp_query)
 {
   global $current_user, $pagenow;
   if (is_admin() && 'edit.php' == $pagenow && $wp_query->query_vars['post_type'] == 'cases') {

     $shopname = "";
     //$userにユーザー情報が配列で格納されます
     $user = wp_get_current_user();
     $user_name = $user->display_name;
     switch ($user_name) {
       case 'osaka@sanwa-paint.jp':
       $meta_query[] = array(
         'key' => "branch",
         'value' => "大阪支社"
       );
       $wp_query->set( 'meta_query', $meta_query );
       break;
       case 'gifu@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "岐阜支社"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'kumamoto@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "熊本支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'matuyama@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "松山支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'okayama@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "岡山支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'kobe@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "神戸支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'sakai@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "堺支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'nagoya@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "名古屋支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'kanazawa@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "金沢支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'hamamatsu@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "浜松支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'shizuoka@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "静岡支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'kanagawa@sanwa-paint.jp':
         $meta_query = array('relation' => 'OR',
           array(
             'key' => "branch",
             'value' => "神奈川支店"
           ),
           array(
             'key' => "branch",
             'value' => "横浜支店"
           )
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'yokohama@sanwa-paint.jp':
         $meta_query = array('relation' => 'OR',
           array(
             'key' => "branch",
             'value' => "神奈川支店"
           ),
           array(
             'key' => "branch",
             'value' => "横浜支店"
           )
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'takasaki@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "高崎支店",
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'chiba@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "千葉支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'nigata@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "新潟支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'mito@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "水戸支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'iwaki@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "いわき支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'hakodate@sanwa-paint.jp':
         $meta_query[] = array(
           'key' => "branch",
           'value' => "函館支店"
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'sapporo@sanwa-paint.jp':
         $meta_query = array('relation' => 'OR',
           array(
             'key' => "branch",
             'value' => "札幌第二支店"
           ),
           array(
             'key' => "branch",
             'value' => "札幌第一支店"
           )
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       case 'sapporo2@sanwa-paint.jp':
         $meta_query = array('relation' => 'OR',
           array(
             'key' => "branch",
             'value' => "札幌第二支店"
           ),
           array(
             'key' => "branch",
             'value' => "札幌第一支店"
           )
         );
         $wp_query->set( 'meta_query', $meta_query );
         break;
       default:
        return;
        break;
       }


     $screen = get_current_screen();
     add_filter('views_'.$screen->id, 'fix_post_counts');
   }elseif(is_admin() && 'edit.php' == $pagenow && $wp_query->query_vars['post_type'] == 'voice'){

          $shopname = "";
          //$userにユーザー情報が配列で格納されます
          $user = wp_get_current_user();
          $user_name = $user->display_name;
          switch ($user_name) {
            case 'osaka@sanwa-paint.jp':
              $wp_query->set('branch', '大阪支社');
            break;
            case 'gifu@sanwa-paint.jp':
              $wp_query->set('branch', '岐阜支社');
              break;
            case 'kumamoto@sanwa-paint.jp':
              $wp_query->set('branch', '熊本支店');
              break;
            case 'matuyama@sanwa-paint.jp':
              $wp_query->set('branch', '松山支店');
              break;
            case 'okayama@sanwa-paint.jp':
              $wp_query->set('branch', '岡山支店');
              break;
            case 'kobe@sanwa-paint.jp':

              $wp_query->set('branch', '神戸支店');
              break;
            case 'sakai@sanwa-paint.jp':
              $wp_query->set('branch', '堺支店');
              break;
            case 'nagoya@sanwa-paint.jp':
              $wp_query->set('branch', '名古屋支店');
              break;
            case 'kanazawa@sanwa-paint.jp':
              $wp_query->set('branch', '金沢支店');
              break;
            case 'hamamatsu@sanwa-paint.jp':
              $wp_query->set('branch', '浜松支店');
              break;
            case 'shizuoka@sanwa-paint.jp':
              $wp_query->set('branch', '静岡支店');
              break;
            case 'kanagawa@sanwa-paint.jp':
              $tax_query = array('relation' => 'OR',
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "神奈川支店",
                ),
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "横浜支店",
                )
              );
              $wp_query->set( 'tax_query', $tax_query );
              break;
            case 'yokohama@sanwa-paint.jp':
              $tax_query = array('relation' => 'OR',
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "神奈川支店",
                ),
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "横浜支店",
                )
              );
              $wp_query->set( 'tax_query', $tax_query );
              break;
            case 'takasaki@sanwa-paint.jp':
              $wp_query->set('branch', '高崎支店');
              break;
            case 'chiba@sanwa-paint.jp':
              $wp_query->set('branch', '千葉支店');
              break;
            case 'nigata@sanwa-paint.jp':
              $wp_query->set('branch', '新潟支店');
              break;
            case 'mito@sanwa-paint.jp':
              $wp_query->set('branch', '水戸支店');
              break;
            case 'iwaki@sanwa-paint.jp':
              $wp_query->set('branch', 'いわき支店');
              break;
            case 'hakodate@sanwa-paint.jp':
              $wp_query->set('branch', '函館支店');
              break;
            case 'sapporo@sanwa-paint.jp':
              $tax_query = array('relation' => 'OR',
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "札幌第二支店",
                ),
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "札幌第一支店",
                )
              );
              $wp_query->set( 'tax_query', $tax_query );
              break;
            case 'sapporo2@sanwa-paint.jp':
              $tax_query = array('relation' => 'OR',
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "札幌第二支店",
                ),
                array(
                  'taxonomy' => 'branch',
                  'field' => 'name',
                  'terms' => "札幌第一支店",
                )
              );
              $wp_query->set( 'tax_query', $tax_query );
              break;
            default:
             return;
             break;
            }


          $screen = get_current_screen();
          add_filter('views_'.$screen->id, 'fix_post_counts');
   }
 }
 // 一覧の投稿数を修正
 function fix_post_counts($views) {
   global $current_user, $wp_query;
   unset($views['mine']);
   $set_posttype = $wp_query->query_vars['post_type'];

   $types = array(
     array('status' =>  NULL),
     array('status' => 'publish'),
     array('status' => 'draft'),
     array('status' => 'trash')
   );


   foreach($types as $type) {
     $query = array(
       'post_type'   => $set_posttype,
       'post_status' => $type['status']
     );
     $result = new WP_Query($query);
     if($type['status'] == NULL):
       $class = ($wp_query->query_vars['post_status'] == NULL)  ? ' class="current"' : '';
       $views['all'] = sprintf(__('<a href="%s"'. $class  .'>' . __('All') . ' <span class="count">(%d)</span></a>', 'all'),
         admin_url('edit.php?post_type='."$set_posttype"),
         $result->found_posts);
     elseif($type['status'] == 'publish'):
       $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
       $views['publish'] = sprintf(__('<a href="%s"'. $class .'>' . __('Published') . ' <span class="count">(%d)</span></a>', 'publish'),
         admin_url('edit.php? post_status=publish&post_type='."$set_posttype"),
         $result->found_posts);
     elseif($type['status'] == 'draft'):
       $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
       $views['draft'] = sprintf(__('<a href="%s"'. $class .'>'. __('Draft') . ((sizeof($result->posts) > 1) ? "s" : "") .' <span class="count">(%d)</span></a>', 'draft'),
         admin_url('edit.php?post_status=draft&post_type='."$set_posttype"),
         $result->found_posts);
     elseif($type['status'] == 'mine'):
       $class = ($wp_query->query_vars['post_status'] == 'mine') ? ' class="current"' : '';
       $views['mine'] = sprintf(__('<a href="%s"'. $class .'>'. __('Mine') .' <span class="count">(%d)</span></a>', 'mine'),
         admin_url('edit.php?post_status=mine&post_type='."$set_posttype"),
         $result->found_posts);
     elseif($type['status'] == 'trash'):
       $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
       $views['trash'] = sprintf(__('<a href="%s"'. $class .'>'. __('ゴミ箱') .' <span class="count">(%d)</span></a>', 'trash'),
         admin_url('edit.php?post_status=trash&post_type='."$set_posttype"),
         $result->found_posts);
     endif;
   }
   return $views;
 }


 /**
    * 管理画面の追加列に値を表示
  * @param $column
  * @param $post_id
  */
  function add_custom_staffs_columns_name($columns) {
      // $columns['branch'] = '支店';
      return array_merge(
        array_slice($columns, 0, 2),
        array('staff_photo' => ''),
        array_slice($columns, 2)
      );
      return $columns;
  }
  function add_custom_staffs_columns($column, $post_id) {
    if ($column == 'staff_photo'){
      $staff_post_id = get_post_meta( $post_id, 'staff_photo', true );
      if ( $staff_post_id) {
        $staffimg = wp_get_attachment_image_src($staff_post_id, 'thumbnail');
        echo '<img src="'.$staffimg[0].'" class="">';
      }
    }
  }
  add_filter('manage_edit-staff_columns', 'add_custom_staffs_columns_name');
  add_action('manage_posts_custom_column', 'add_custom_staffs_columns', 10, 2);


/**
 *
 */
 function add_custom_casess_columns_name($columns) {
     // $columns['branch'] = '支店';
     return array_merge(
       array_slice($columns, 0, 2),
       array('branch' => '支店'),
       array_slice($columns, 2)
     );
     return $columns;
 }
 function add_custom_casess_columns($column, $post_id) {
     if ($column == 'branch') echo get_post_meta($post_id, 'branch', true);
 }
 add_filter('manage_edit-cases_columns', 'add_custom_casess_columns_name');
 add_action('manage_posts_custom_column', 'add_custom_casess_columns', 10, 2);

 function custom_orderby_columns($vars) {
   if(empty($vars["s"])){
     unset($vars["s"]);
   }
   if (isset($vars['orderby']) && 'branch' == $vars['orderby']) {
     $vars = array_merge($vars, array(
       'meta_key' => 'branch',
       'orderby' => 'meta_value'
     ));
   }
   return $vars;
 }
 function custom_sortable_columns($sortable_column) {
     $sortable_column['branch'] = 'branch';
     return $sortable_column;
 }
 add_filter('request', 'custom_orderby_columns');
 add_filter('manage_edit-cases_sortable_columns', 'custom_sortable_columns');



 /**
  * 管理画面の投稿一覧にカスタムフィールドの絞り込み選択機能を追加します。
  */
  function restrict_manage_posts_custom_field() {
   // 投稿タイプが投稿の場合 (カスタム投稿タイプのみに適用したい場合は 'cases' をカスタム投稿タイプの内部名に変更してください)
   global $post_type;
   if ( 'cases' == get_current_screen()->post_type ) {
     // カスタムフィールドのキー(名称例)
     $meta_key = 'branch';

     // カスタムフィールドの値の一覧(例。「=>」の左側が保存されている値、右側がプルダウンに表示する名称です。)
     $items = array("" => "すべての支店");

     $args = array(
         'post_type' => 'branchs',
         'post_status' => 'publish',
         'posts_per_page' => -1,
         'orderby'   => 'menu_order',
         'order' => 'ASC',
         'post__not_in' => array(1546),/*本社除外*/
     );
     $branchs = new WP_Query( $args );
     foreach ($branchs->posts as $branch_value) {
         $items = array_merge($items,array($branch_value->post_title => $branch_value->post_title));
     }
     //$items = array( '' => 'すべての色', 'red' => '赤', 'yellow' => '黄色', 'blue' => '青' );

     // Advanced Custom Fields を導入してフィールドタイプをセレクトボックスなど
     // 選択肢のあるタイプにしている場合は下記のような形でも可です。
     // $field = get_field_object($meta_key);
     // $items = array_merge( array( '' => 'すべての' ), $field['choices'] );

     // 選択されている値
     // ( query_vars フィルタでカスタムフィールドのキーを登録している場合は get_query_var( $meta_key ) でも可です )
     $selected_value = filter_input( INPUT_GET, "s" );
     // プルダウンのHTML
     $output = '';
     // $output .= '<select name="' . esc_attr($meta_key) . '">';
     $output .= '<select name="s">';
     if(!empty($items)){
       foreach ( $items as $value => $text ) {
         $selected= '';
         if($selected_value == $value) {
          $selected = ' selected="selected"';
         }
         $output .= '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($text) . '</option>';
       }
     }else{
       $output .= '<option value=""' . $selected . '>すべての支店</option>';
     }
     $output .= '</select>';

     echo $output;
   }elseif ( $post_type == 'voice' ) {
     $taxonomy = 'branch';
     $args = array(
       'orderby'       => 'term_order',
       'order'         => 'ASC',
       'hide_empty'    => false,
       'parent'        => '0'
     );
     $myterms = get_terms( "branch", $args );
     $parent_id = "";
     $length = count($myterms);
     $no = 0;
     foreach ($myterms as $myterms_key => $myterms_value) {
       $no++;
       if($no !== $length){
         $parent_id .= $myterms_value->term_id.",";
       }else{
         $parent_id .= $myterms_value->term_id;
       }
     }
     wp_dropdown_categories( array(
       'show_option_all' => 'すべての店舗',
       'orderby' => 'term_order',
       'order' => 'ASC',
       'selected' => get_query_var( $taxonomy ),
       'hide_empty' => 0,
       'name' => $taxonomy,
       'taxonomy' => $taxonomy,
       'value_field' => 'name',
       'exclude' => $parent_id
     ) );
   }else if($post_type == 'staff'){
     $term_slug = get_query_var( 'branch' );
     wp_dropdown_categories( array(
       'show_option_all'    => '全ての支社・支店',
       'selected'           => $term_slug,
       'name'               => 'branch',
       'taxonomy'           => 'branch',
       'value_field'        => 'slug',
       'orderby'            => 'term_order'
     ));
   }
  }
  add_action( 'restrict_manage_posts', 'restrict_manage_posts_custom_field' );

  function custom_sortable_columns_voice($sortable_column) {
      $sortable_column['taxonomy-branch'] = 'taxonomy-branch';
      return $sortable_column;
  }
  add_filter('manage_edit-voice_sortable_columns', 'custom_sortable_columns_voice');


/**
 * 旧施工事例　スタッフ名　ID＝＞名前　変換
 */
function staff_ID_change($post){
  if(is_admin() && 'edit' == $_GET["action"] && $post->post_type == 'voice'){
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

    $staff_id = get_field('staff',$post->ID);
    $staff_name = "";
    foreach ($csv as $key => $value) {
      if((int)$value[1] === (int)$staff_id){
        $staff_name = $value[0];
        break;
      }
    }
    echo "
    <script type='text/javascript'>
    jQuery(function($){
      $('#acf-staff').append('<div><strong>{$staff_name}</strong></div>');
    });
    </script>
    ";
  }
}
add_action( 'edit_form_advanced', 'staff_ID_change' );

function custom_admin_style() {
  global $post;
  if(is_admin() && 'edit' == $_GET["action"] && $post->post_type == 'voice'){
    echo "
    <style>
      #acf-staff input {
        display: none;
      }
    </style>
    ";
  }
}
add_action( 'admin_head', 'custom_admin_style' );
