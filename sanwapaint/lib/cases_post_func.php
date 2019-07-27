<?php
/**
 * [change_title_text_all description]
 * @param  [type] $title [description]
 * @return [type]        [description]
 * 施工事例のタイトルのプレースホルダ変更
 */
function change_title_text_all( $title ){
 global $post;
  if(!isset( $post ) || 'cases' != $post->post_type){
   //cases以外
   return $title;
  }else{
   //casesの時
   return $title = '記入例）T.O邸';
  }
}
add_filter( 'enter_title_here', 'change_title_text_all' );


// Cases Custom Post Type
function cases_init() {
    // set up cases labels
    $labels = array(
        'name' => '施工事例',
        'singular_name' => 'Cases',
        'parent_item_colon' => '',
        'menu_name' => '施工事例',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'cases'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'publicly_queryable' => true,
        'supports' => array(
            'title',
            'thumbnail',
        ),
        'yarpp_support' => true
    );
    register_post_type( 'cases', $args );

    register_taxonomy(
    	'tag',
    	'cases',
    	array(
		    'hierarchical' => false,
		    'rewrite' => true,
		    'query_var' => true
		    )
	);

}
add_action( 'init', 'cases_init' );

/**
 * Adds a meta box to the post editing screen
 */
function add_cases_meta_box() {
    add_meta_box(
        'cases_meta_box', // $id
        '事例', // $title
        'show_your_fields_meta_box', // $callback
        'cases', // $screen
        'normal', // $context
        'high' // $priority
    );
    remove_meta_box( 'slugdiv', 'cases', 'normal' );
}
add_action( 'add_meta_boxes', 'add_cases_meta_box' );

function show_your_fields_meta_box() {
    global $post, $provinces, $cons_years, $outwall_types, $roof_types, $case_types, $case_type_roofs, $prices, $worry_elements,
            $detacheds, $housemakers, $other_works, $guarantee_walls, $guarantee_roofs; ?>

    <input type="hidden" name="cases_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <style>
        .cpt-container,
        .cpt-container *{box-sizing: border-box !important;}
        .bg-color-ddd{ background-color: #f4f4f4 !important;}
        .bg-color-pbtn{ background-color: #808488 !important;}
        .red{color: red !important;}
        .white{color: #fff !important;}
        .w100{ width: 100% !important;}
        .w5{ width: 4% !important;}
        .w10{ width: 10% !important;}
        .w15{ width: 16% !important;}
        .w20{ width: 20% !important;}
        .w30{ width: 30% !important;}
        .w70{ width: 70% !important;}
        .w80{ width: 80% !important;}
        .w15{ width: 16% !important;}
        .w25{ width: 25% !important;}
        .w45{ width: 45% !important;}
        .w50{ width: 50% !important;}
        .w75{ width: 75% !important;}
        .w95{ width: 94% !important;}
        .w-left{ width: 220px;      }
        .w-right{ width: 70%;}
        .ws-left{ width: 60px;}
        .ws-right{ width: 159px;}
        .pull-left{float: left;}
        .clearfix { clear: both;}
        .border-left{border-left: 1px solid #999;}
        .border-right{border-right: 1px solid #999;}
        .border-bottom{border-bottom: 1px solid #999;}
        .check-item{width: 25%; line-height: 35px;}
        .check-item-w33{width: 33%; line-height: 35px;}
        .check-item-other{width: 60%;   line-height: 35px;}
        .cpt-container{
            border: 1px solid #999;
            color: #444;
            box-sizing: border-box;
        }
        .cpt-container p{
            margin: 0  !important;
            line-height: 24px !important;
        }
        .padding-tb8-l20{padding: 8px 0px 8px 20px;}
        .padding-tb8{   padding: 8px 0px 8px 8px;}
        .padding-tb5{padding: 0 5px;}
        .padding-t10{padding-top: 10px;}
        .margin-t10{margin-top: 10px;}
        .margin-t20{margin-top: 20px;}
        .text-lalign{text-align: left;}
        .text-calign{text-align: center;}
        .bold{
            font-weight: 600;
            vertical-align: middle;
        }
        .font-14{
            line-height: 28px;
            font-size: 14px;
        }
        .parent {
            display: flex;
            flex-wrap: wrap; /* to wrap the divs on smaller devices (mobile) */
        }
        label.error {
            display: block;
            background: #ffd2d2;
            padding: 0 5px;
            width: fit-content;
            font-size: 13px;
        }
    </style>

    <div class="cpt-container">

        <!-- エリア -->
        <div class="w100 border-bottom parent">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="area">お住いの都道府県</label><br><label class="red">&nbsp;(必須)</label>
                </div>
            </div>
            <?php $m_area = get_post_meta( $post->ID, 'area', true ); ?>
            <div class="pull-left border-left w80 padding-tb8-l20">
                <select name="area" id="area" class="w50">
                    <option value=""  >都道府県を選択</option>
                    <?php
                        foreach ($provinces as $key => $province) {
                            if ( !empty($m_area) && $province == $m_area) {
                    ?>
                    <option value="<?=$province?>" selected ><?=$province?></option>
                    <?php
                            }else{
                    ?>
                    <option value="<?=$province?>" ><?=$province?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <?php $m_local_area = get_post_meta( $post->ID, 'local_area', true ); ?>
                <div class="">
                    <input type="text" name="local_area" class="w30" id="local_area" value="<?php if (isset($m_local_area)) {   echo $m_local_area; } ?>" placeholder="市区町村">
                </div>
            </div>
        </div><!-- エリア -->

        <!-- 築年数 -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="construction_years">築年数</label>
                </div>
            </div>
            <?php $m_construction_years = get_post_meta( $post->ID, 'construction_years', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <?php
                    foreach ($cons_years as $cons_key => $cons_year) {
                        if ( !is_null($m_construction_years) && is_array( $m_construction_years ) && in_array( $cons_year, $m_construction_years ) ) {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }
                ?>
                    <div class="check-item pull-left">
                        <input type="radio" name="construction_years[]" value="<?=$cons_year?>" <?=$checked?> >
                <?php
                        if ($cons_year == '36') echo '35年以上～';
                        else echo '～' . $cons_year . '年未満';
                ?>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="clearfix"></div>
        </div><!-- 築年数 -->

        <!-- 外壁の種類 -->
        <div class="w100  parent">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>種類</label>
                </div>
                <div class="pull-left border-bottom border-left w70 padding-tb8-l20">
                    <label for="outwall_type">外壁</label>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php $m_outwall_types = get_post_meta( $post->ID, 'outwall_type', true ); ?>
            <div class="pull-left border-bottom  border-left w80 padding-tb8-l20">
                <?php
                    foreach ($outwall_types as $outwall_key => $outwall_type) {
                        if ( !empty($m_outwall_types) &&
                            is_array( $m_outwall_types ) &&
                            in_array( $outwall_type, $m_outwall_types ) )
                        {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }
                ?>
                    <div class="check-item pull-left">
                        <input type="checkbox" name="outwall_type[]" value="<?=$outwall_type?>" <?=$checked?> >
                        <?=$outwall_type?>
                    </div>
                <?php
                    }
                ?>
                    <div class="clearfix"></div>
                    <div class="check-item pull-left w100">
                        <div class="pull-left">
                            <input type="checkbox" name="outwall_type_0" value="その他" <?php
                            	if ( get_post_meta( $post->ID, 'outwall_type_0', true ) )
                                    echo "checked";
                            ?>>その他
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="outwall_type_other" placeholder="その他の場合入力" value="<?php
                                if ( get_post_meta( $post->ID, 'outwall_type_0', true ) )
                                    echo get_post_meta( $post->ID, 'outwall_type_other', true );
                            ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- 外壁の種類 -->

        <!-- 屋根の種類 -->
        <div class="w100  parent">
            <div class="pull-left w20 parent bold border-bottom">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>&nbsp;</label>
                </div>
                <div class="pull-left border-left w70 padding-tb8-l20">
                    <label for="roof_type">屋根</label>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php $m_roof_types = get_post_meta( $post->ID, 'roof_type', true ); ?>
            <div class="pull-left border-bottom border-left w80 padding-tb8-l20">
                <?php
                    foreach ($roof_types as $outwall_key => $roof_type) {
                        if ( !empty($m_roof_types) &&
                            is_array( $m_roof_types ) &&
                            in_array( $roof_type, $m_roof_types ) )
                        {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }
                ?>
                    <div class="check-item pull-left">
                        <input type="checkbox" name="roof_type[]" value="<?=$roof_type?>" <?=$checked?> >
                        <?=$roof_type?>
                    </div>
                <?php
                    }
                ?>
                    <div class="clearfix"></div>
                    <div class="check-item pull-left w100">
                        <div class="pull-left">
                            <input type="checkbox" name="roof_type_0" value="その他" <?php
                                if ( get_post_meta( $post->ID, 'roof_type_0', true ) )
                                    echo "checked";
                             ?>>その他
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="roof_type_other" placeholder="その他の場合入力" value="<?php
                             	if ( get_post_meta( $post->ID, 'roof_type_0', true ) )
                                    echo get_post_meta( $post->ID, 'roof_type_other', true );
                            ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- 屋根の種類 -->

        <!-- 使用塗料タイプ -->
        <!-- 外壁の種類 -->
        <div class="w100  parent ">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20 bg-color-ddd">
                    <label>使用塗料タイプ</label>
                </div>
                <div class="pull-left border-bottom border-left w70 padding-tb8-l20 bg-color-ddd">
                    <label for="outwall_type">壁</label>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php $m_case_types = get_post_meta( $post->ID, 'case_types', true ); ?>

            <div class=" border-bottom  border-left w80 padding-tb8-l20 bg-color-ddd">
              <?php $i=1; ?>
             <?php foreach ($case_types as $case_type_key => $case_type): ?>
<div class="kabe<?php echo $i;?> ">
               <?php
               if ( isset($m_case_types) && is_array( $m_case_types ) && in_array( $case_type, $m_case_types ) ) {
                   $checked = 'checked="checked"';
               } else {
                   $checked = null;
               }
               ?>
               <div class="pull-left">
                   <input type="checkbox" name="case_types[]" value="<?=$case_type?>" <?=$checked?> >
                   <?=$case_type?>
               </div>
              <div class="clearfix"></div>
</div>

             <?php $i++; endforeach; ?>
             <div class="clearfix"></div>
<div class="kabeOther">
             <div class="check-item pull-left w100">
                 <div class="pull-left">
                     <input type="checkbox" name="case_types_0" value="その他" <?php
                         if ( get_post_meta( $post->ID, 'case_types_0', true ) )
                             echo "checked";
                      ?>>その他（ゾラガラスコート, ゾラコート, キシラデ）
                 </div>
                 <div class="pull-left other">
                     <input type="text" name="case_types_other" placeholder="その他の場合入力" value="<?php
                         if ( get_post_meta( $post->ID, 'case_types_0', true ) )
                             echo get_post_meta( $post->ID, 'case_types_other', true );
                     ?>">
                 </div>
</div>
                 <div class="clearfix"></div>
             </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- 外壁の種類 -->

        <!-- 屋根の種類 -->
        <div class="w100  parent">
            <div class=" w20 parent bold border-bottom">
                <div class="pull-left w30 padding-tb8-l20 bg-color-ddd">
                    <label>&nbsp;</label>
                </div>
                <div class="pull-left border-left w70 padding-tb8-l20 bg-color-ddd">
                    <label for="roof_type">屋根</label>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php $m_case_type_roofs = get_post_meta( $post->ID, 'case_type_roofs', true ); ?>
            <?php $i=1 ?>
            <div class="pull-left border-bottom  border-left w80 padding-tb8-l20 bg-color-ddd">
             <?php foreach ($case_type_roofs as $case_type_roof_key => $case_type_roof): ?>
                <div class="tenjo<?php echo$i; ?>">

                   <?php
                   if ( isset($m_case_type_roofs) && is_array( $m_case_type_roofs ) && in_array( $case_type_roof, $m_case_type_roofs ) ) {
                       $checked = 'checked="checked"';
                   } else {
                       $checked = null;
                   }
                   ?>
                   <div class="pull-left">
                       <input type="checkbox" name="case_type_roofs[]" value="<?=$case_type_roof?>" <?=$checked?> >
                       <?=$case_type_roof?>
                   </div>

              </div>
              <?php $i++; ?>
             <?php endforeach; ?>

             <div class="clearfix"></div>
             <div class="check-item pull-left w100">
                <div class="tenjoOther">
                 <div class="pull-left">
                     <input type="checkbox" name="case_type_roofs_0" value="その他" <?php
                         if ( get_post_meta( $post->ID, 'case_type_roofs_0', true ) )
                             echo "checked";
                      ?>>その他
                 </div>
                 <div class="pull-left other">
                     <input type="text" name="case_type_roofs_other" placeholder="その他の場合入力" value="<?php
                         if ( get_post_meta( $post->ID, 'case_type_roofs_0', true ) )
                             echo get_post_meta( $post->ID, 'case_type_roofs_other', true );
                     ?>">
                 </div>
             </div>
                 <div class="clearfix"></div>
             </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- 屋根の種類 -->
        <!-- 使用塗料タイプ -->

        <!-- 外壁（平米数㎡） -->
        <div class="w100 border-bottom parent">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="out_square">外壁（平米数㎡）</label>
                </div>
            </div>
            <?php $m_out_square = get_post_meta( $post->ID, 'out_square', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="out_square" class="w30" id="out_square" value="<?php if (isset($m_out_square)) {   echo $m_out_square; } ?>"> ㎡
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 屋根（平米数㎡） -->
        <div class="w100 border-bottom bg-color-ddd parent">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="roof_square">屋根（平米数㎡）</label>
                </div>
            </div>
            <?php $m_roof_square = get_post_meta( $post->ID, 'roof_square', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="roof_square" class="w30" id="roof_square" value="<?php if (isset($m_roof_square)) {    echo $m_roof_square; } ?>"> ㎡
            </div>
            <div class="clearfix"></div>
        </div>


<!-- 保証外壁 -->
<div class="w100  parent">
    <div class="pull-left w20 bold parent">
        <div class="pull-left w30 padding-tb8-l20">
            <label>保証</label>
        </div>
        <div class="pull-left border-bottom border-left w70 padding-tb8-l20">
            <label for="guarantee_wall">外壁</label>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php $m_guarantee_walls = get_post_meta( $post->ID, 'guarantee_wall', true ); ?>
    <div class="pull-left border-bottom  border-left w80 padding-tb8-l20">
        <?php
            foreach ($guarantee_walls as $guarantee_wall_key => $guarantee_wall) {
                if ( !empty($m_guarantee_walls) &&
                    is_array( $m_guarantee_walls ) &&
                    in_array( $guarantee_wall, $m_guarantee_walls ) )
                {
                    $checked = 'checked="checked"';
                } else {
                    $checked = null;
                }
        ?>
            <div class="check-item pull-left">
                <input type="radio" name="guarantee_wall[]" value="<?=$guarantee_wall?>" <?=$checked?> >
                <?=$guarantee_wall?>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="clearfix"></div>
</div><!-- 保証外壁 -->

<!-- 保証屋根 -->
<div class="w100  parent">
    <div class="pull-left w20 parent bold border-bottom">
        <div class="pull-left w30 padding-tb8-l20">
            <label>&nbsp;</label>
        </div>
        <div class="pull-left border-left w70 padding-tb8-l20">
            <label for="guarantee_roof">屋根</label>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php $m_guarantee_roofs = get_post_meta( $post->ID, 'guarantee_roof', true ); ?>
    <div class="pull-left border-bottom border-left w80 padding-tb8-l20">
        <?php
            foreach ($guarantee_roofs as $guarantee_roof_key => $guarantee_roof) {
                if ( !empty($m_guarantee_roofs) &&
                    is_array( $m_guarantee_roofs ) &&
                    in_array( $guarantee_roof, $m_guarantee_roofs ) )
                {
                    $checked = 'checked="checked"';
                } else {
                    $checked = null;
                }
        ?>
            <div class="check-item pull-left">
                <input type="radio" name="guarantee_roof[]" value="<?=$guarantee_roof?>" <?=$checked?> >
                <?=$guarantee_roof?>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="clearfix"></div>
</div><!-- 保証屋根 -->


        <!-- 価格 -->
        <div class="w100 border-bottom">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="price">総額（税込）</label>
                </div>
            </div>
            <?php $m_price = get_post_meta( $post->ID, 'price', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <?php
                    foreach ($prices as $pri_key => $price) {

                        if ( isset($m_price) && is_array( $m_price ) && in_array( $price, $m_price ) ) {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }
                ?>
                    <div class="check-item pull-left">
                    <input type="radio" name="price[]" value="<?=$price?>" <?=$checked?> >

                <?php

                        if ($price == '301') echo '300万円以上～';
                        else echo '～' . $price . '万円未満';
                ?>
                    </div>
                <?php

                    }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 悩みの要素 -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="worry_elements">悩みの要素</label>
                </div>
            </div>
            <div class="pull-left w80 border-left padding-tb8-l20">
            <?php
                foreach ($worry_elements as $we_key => $worry_element) {

                    if ( get_post_meta( $post->ID, $worry_element['key'], true ) ) {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }

            ?>
                <div class="check-item pull-left">
                    <input type="checkbox" name="<?=$worry_element['key']?>" value="<?=$worry_element['value']?>" <?=$checked?> >
                    <?=$worry_element['value']?>
                </div>
            <?php
                }
            ?>
                <div class="clearfix"></div>
                <div class="check-item pull-left w100">
                    <div class="pull-left">
                        <input type="checkbox" name="worry_elements_0" value="other" <?php
                            if ( get_post_meta( $post->ID, 'worry_elements_0', true ) )
                                    echo "checked";
                         ?>>その他
                    </div>
                    <div class="pull-left other">
                        <input type="text" name="worry_elements_other" placeholder="その他の場合入力" value="<?php
                            if ( get_post_meta( $post->ID, 'worry_elements_0', true ) )
                                    echo get_post_meta( $post->ID, 'worry_elements_other', true );
                            ?>">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 戸建の様式 -->
        <div class="w100 border-bottom">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label>戸建の様式</label>
                </div>
            </div>
            <?php $m_detacheds = get_post_meta( $post->ID, 'detacheds', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <?php
                    foreach ($detacheds as $pt_key => $detached) {

                        if ( isset($m_detacheds) && $m_detacheds == $detached ) {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }

                ?>
                    <div class="check-item pull-left">
                        <input type="radio" name="detacheds" value="<?=$detached?>" <?=$checked?> >
                        <?=$detached?>
                    </div>
                <?php
                    }
                ?>
                    <div class="clearfix"></div>
                    <div class="check-item pull-left w100">
                        <div class="pull-left">
                            <input type="radio" name="detacheds" value="その他" <?php
                                if ( isset($m_detacheds) && $m_detacheds == 'その他')
                                    echo 'checked' ;
                             ?>>その他
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="detacheds_other" placeholder="その他の場合入力" value="<?php
                                if ( isset($m_detacheds) && $m_detacheds == 'その他')
                                    echo get_post_meta( $post->ID, 'detacheds_other', true ) ;
                             ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- ハウスメーカー -->
        <div class="w100 border-bottom bg-color-ddd houseMaker">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label>ハウスメーカー</label>
                </div>
            </div>
            <?php $m_housemakers = get_post_meta( $post->ID, 'housemakers', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <?php
                    foreach ($housemakers as $housemaker) {

                        if ( isset($m_housemakers) && $m_housemakers == $housemaker ) {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }

                ?>
                    <div class="check-item pull-left">
                        <input type="radio" name="housemakers" value="<?=$housemaker?>" <?=$checked?> >
                        <?=$housemaker?>
                    </div>
                <?php

                    }
                ?>
                    <div class="clearfix"></div>
                    <div class="check-item pull-left w100">
                        <div class="pull-left">
                            <input type="radio" name="housemakers" value="その他" <?php

                                if ( isset($m_housemakers) && $m_housemakers == 'その他' ) {
                                    echo 'checked="checked"';
                                }

                             ?>>その他
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="housemakers_other" placeholder="その他の場合入力" value="<?php
                            if ( isset($m_housemakers) && $m_housemakers == 'その他' )
                                echo get_post_meta( $post->ID, 'housemakers_other', true ) ; ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 色 -->
        <div class="w100 parent">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>色</label>
                </div>
                <div class="pull-left border-bottom border-left w70 padding-tb8-l20">
                    <p>外壁</p>
                    <p>標準色</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="pull-left border-bottom  border-left w80 padding-tb8-l20">
                <?php
                    $outwall_colors = get_colors_titles('outwall-stand-color');
                    foreach ($outwall_colors as $outwall_color) {
                        if ( get_post_meta( $post->ID, $outwall_color['key'], true ) )
                            $checked = 'checked="checked"';
                        else
                            $checked = null;
                ?>
                    <div class="check-item pull-left">
                        <input type="checkbox" name="<?=$outwall_color['key']?>" value="<?=$outwall_color['value']?>" <?=$checked?> >
                        <?=$outwall_color['value']?>
                    </div>
                <?php
                    }
                ?>
                        <div class="clearfix"></div>
                    <div class="check-item-other pull-left">
                        <div class="pull-left">
                            <input type="checkbox" name="outwall-stand-color_0" value="other" <?php
                                if ( get_post_meta( $post->ID, 'outwall-stand-color_0', true ) )
                                    echo "checked";
                             ?>>特注色
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="outwall-stand-color_other" placeholder="特注色の場合入力" value="<?php
                                if ( get_post_meta( $post->ID, 'outwall-stand-color_0', true ) )
                                    echo get_post_meta( $post->ID, 'outwall-stand-color_other', true );
                             ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w100  parent">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>&nbsp;</label>
                </div>
                <div class="pull-left border-bottom  border-left w70 padding-tb8-l20">
                    <p>外壁</p>
                    <p>水性ゾラコート</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="pull-left border-bottom  border-left w80 padding-tb8-l20">
                <?php
                    $outwall_waterzols = get_colors_titles('outwall-zola-coat-color');
                    foreach ($outwall_waterzols as $outwall_waterzol) {
                        if ( get_post_meta( $post->ID, $outwall_waterzol['key'], true ) )
                            $checked = 'checked="checked"';
                        else
                            $checked = null;
                ?>
                    <div class="check-item pull-left">
                        <input type="checkbox" name="<?=$outwall_waterzol['key']?>" value="<?=$outwall_waterzol['value']?>" <?=$checked?> >
                        <?=$outwall_waterzol['value']?>
                    </div>
                <?php
                    }
                ?>
                        <div class="clearfix"></div>
                <div class="check-item-other pull-left">
                    <div class="pull-left">
                        <input type="checkbox" name="outwall-zola-coat-color_0" value="other" <?php
                            if (get_post_meta( $post->ID, 'outwall-zola-coat-color_0', true ) )
                                echo 'checked="checked"';
                         ?>>特注色
                    </div>
                    <div class="pull-left other">
                        <input type="text" name="outwall-zola-coat-color_other" placeholder="特注色の場合入力" value="<?php
                            if (get_post_meta( $post->ID, 'outwall-zola-coat-color_0', true ) )
                                echo get_post_meta( $post->ID, 'outwall-zola-coat-color_other', true );
                        ?>">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w100 parent">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>&nbsp;</label>
                </div>
                <div class="pull-left border-bottom border-left w70 padding-tb8-l20">
                    <p>外壁</p>
                    <p>コーティング</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="pull-left border-bottom  border-left w80 padding-tb8-l20">
                <?php
                    $outwall_coatings = get_colors_titles('outwall-coat-color');
                    foreach ($outwall_coatings as $outwall_coating) {
                        if ( get_post_meta( $post->ID, $outwall_coating['key'], true ) )
                            $checked = 'checked="checked"';
                        else
                            $checked = null;
                ?>
                    <div class="check-item-w33 pull-left">
                        <input type="checkbox" name="<?=$outwall_coating['key']?>" value="<?=$outwall_coating['value']?>" <?=$checked?> >
                        <?=$outwall_coating['value']?>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w100 parent">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>&nbsp;</label>
                </div>
                <div class="pull-left border-bottom border-left w70 padding-tb8-l20">
                    <p>屋根遮熱</p>
                    <p>標準色</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="pull-left border-bottom  border-left w80 padding-tb8-l20">
                <?php
                    $roof_hscolors = get_colors_titles('roof-heat-color');
                    foreach ($roof_hscolors as $roof_hscolor) {
                        if ( get_post_meta( $post->ID, $roof_hscolor['key'], true ) )
                            $checked = 'checked="checked"';
                        else
                            $checked = null;
                ?>
                    <div class="check-item-w33 pull-left">
                        <input type="checkbox" name="<?=$roof_hscolor['key']?>" value="<?=$roof_hscolor['value']?>" <?=$checked?> >
                        <?=$roof_hscolor['value']?>
                    </div>
                <?php
                    }
                ?>
                        <div class="clearfix"></div>

                    <div class="check-item-other pull-left ">
                        <div class="pull-left">
                            <input type="checkbox" name="roof-heat-color_0" value="other" <?php
                                if (get_post_meta( $post->ID, 'roof-heat-color_0', true ) )
                                echo 'checked="checked"';
                             ?>>特注色
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="roof-heat-color_other" placeholder="特注色の場合入力" value="<?php
                                if (get_post_meta( $post->ID, 'roof-heat-color_0', true ) )
                                echo get_post_meta( $post->ID, 'roof-heat-color_other', true );
                            ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w100 border-bottom parent">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <label>&nbsp;</label>
                </div>
                <div class="pull-left border-left w70 padding-tb8-l20">
                    <p>屋根</p>
                    <p>標準色</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="pull-left  border-left w80 padding-tb8-l20 yane-hyojun">
                <?php
                    $roof_standcols = get_colors_titles('roof-stand-color');
                    foreach ($roof_standcols as $roof_standcol) {
                        if ( get_post_meta( $post->ID, $roof_standcol['key'], true ) )
                            $checked = 'checked="checked"';
                        else
                            $checked = null;
                ?>
                    <div class="check-item-w33 pull-left">
                        <input type="checkbox" name="<?=$roof_standcol['key']?>" value="<?=$roof_standcol['value']?>" <?=$checked?> >
                        <?=$roof_standcol['value']?>
                    </div>
                <?php
                    }
                ?>
                         <div class="clearfix"></div>
                   <div class="check-item-other pull-left">
                        <div class="pull-left">
                            <input type="checkbox" name="roof-stand-color_0" value="other" <?php
                                if (get_post_meta( $post->ID, 'roof-stand-color_0', true ) )
                                echo 'checked="checked"';
                             ?>>特注色
                        </div>

                        <div class="pull-left other">
                            <input type="text" name="roof-stand-color_other" placeholder="特注色の場合入力" value="<?php
                                if (get_post_meta( $post->ID, 'roof-stand-color_0', true ) )
                                echo get_post_meta( $post->ID, 'roof-stand-color_other', true );
                            ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- その他の工事 -->
        <div class="w100 border-bottom bg-color-ddd otherConstruction">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label>その他の工事</label>
                </div>
            </div>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <?php
                    foreach ($other_works as $other_work) {
                        if ( get_post_meta( $post->ID, $other_work['key'], true ) ) {
                            $checked = 'checked="checked"';
                        } else {
                            $checked = null;
                        }

                        if($other_work['key'] == "other_works_5"){
                         ?>
                         <div class="clearfix"></div>
                         <div class="check-item pull-left w100">
                             <div class="pull-left">
                                 <input type="checkbox" name="other_works_5" value="other" <?php

                                     if ( get_post_meta( $post->ID, 'other_works_5', true ) )
                                         echo "checked";

                                  ?>>補修&emsp;
                             </div>
                             <div class="pull-left other">
                                 <input type="text" name="other_works_hoshu" placeholder="補修の内容入力" size="65" value="<?php

                                     if ( get_post_meta( $post->ID, 'other_works_5', true ) )
                                         echo get_post_meta( $post->ID, 'other_works_hoshu', true ) ;

                                  ?>">
                             </div>
                             <div class="clearfix"></div>
                         </div>
                         <?php
                         continue;
                        }elseif ($other_work['key'] == "other_works_6") {
                         ?>
                         <div class="clearfix"></div>
                         <div class="check-item pull-left w100">
                             <div class="pull-left">
                                 <input type="checkbox" name="other_works_6" value="other" <?php

                                     if ( get_post_meta( $post->ID, 'other_works_6', true ) )
                                         echo "checked";

                                  ?>>交換&emsp;
                             </div>
                             <div class="pull-left other">
                                 <input type="text" name="other_works_koukan" placeholder="交換の内容入力" size="65" value="<?php

                                     if ( get_post_meta( $post->ID, 'other_works_6', true ) )
                                         echo get_post_meta( $post->ID, 'other_works_koukan', true ) ;

                                  ?>">
                             </div>
                             <div class="clearfix"></div>
                         </div>
                         <?php
                         continue;
                        }
                ?>
                    <div class="check-item pull-left">
                        <input type="checkbox" name="<?=$other_work['key']?>" value="<?=$other_work['value']?>" <?=$checked?> >
                        <?=$other_work['value']?>
                    </div>
                <?php
                    }
                ?>

                    <div class="clearfix"></div>
                    <div class="check-item pull-left w100">
                        <div class="pull-left">
                            <input type="checkbox" name="other_works_0" value="other" <?php

                                if ( get_post_meta( $post->ID, 'other_works_0', true ) )
                                    echo "checked";

                             ?>>その他
                        </div>
                        <div class="pull-left other">
                            <input type="text" name="other_works_other" placeholder="その他の内容入力" size="65" value="<?php

                                if ( get_post_meta( $post->ID, 'other_works_0', true ) )
                                    echo get_post_meta( $post->ID, 'other_works_other', true ) ;

                             ?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- お客様の声 -->
        <div class="w100 border-bottom parent">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="customer_voice">お客様の声</label>
                </div>
            </div>
            <?php $m_customer_voice = get_post_meta( $post->ID, 'customer_voice', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <textarea name="customer_voice" id="customer_voice" rows="5" placeholder="記入例）自社を充分に信頼し、自信をもって提案いただいた姿を見て安心しました。工事の前後に近隣への心配りや、工事の工程管理も丁寧にしていただきお任せしてよかったと感じています。※CSアンケート参照（要約）" class="w50"><?php if (isset($m_customer_voice)) {   echo $m_customer_voice; } ?></textarea>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- CSアンケートリンク -->
        <div class="w100 parent border-bottom">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="cs_questionnaire_link">CSアンケートリンク</label>
                </div>
            </div>
            <?php $m_cs_questionnaire_link = get_post_meta( $post->ID, 'cs_questionnaire_link', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="cs_questionnaire_link" class="w30" id="cs_questionnaire_link" value="<?php if (isset($m_cs_questionnaire_link)) {   echo $m_cs_questionnaire_link; } ?>">
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 支店名 -->
        <div class="w100 parent border-bottom bg-color-ddd ">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="branch">支店名</label><br><label class="red">&nbsp;(必須)</label>
                </div>
            </div>
            <?php $m_branch = get_post_meta( $post->ID, 'branch', true ); ?>
            <div class="pull-left border-left w80 padding-tb8-l20">
                <select name="branch" id="branch" class="w50">
                    <!-- <option value=""  ></option> -->
                    <?php
                        $branchs = get_branchs_titles();
                        foreach ($branchs as $branch) {
                          $usershop = user_shop();
                          if(in_array($branch, $usershop)){
                            if ( !empty($m_branch) && $branch == $m_branch) {
                    ?>
                    <option value="<?=$branch?>" selected ><?=$branch?></option>
                    <?php
                            }else{
                    ?>
                    <option value="<?=$branch?>" ><?=$branch?></option>
                    <?php
                            }
                          }elseif($usershop[0] == "all"){
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
                        }
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- キャッチ -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="catch">キャッチ</label><label class="red">&nbsp;(必須)</label>
                </div>
            </div>
            <?php $m_catch = get_post_meta( $post->ID, 'catch', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="catch" class="w50" id="catch" placeholder="記入例）フッ素塗料で機能性UP！" value="<?php if (isset($m_catch)) {  echo $m_catch; } ?>">
                <span class="red">30文字以内で入カ</span>
            </div>
            <div class="clearfix"></div>
        </div>


        <!-- 写真 -->
        <div class="w100 parent pic">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <p>&nbsp;写真</p>
                    <p class="red">(必須)</p>
                </div>
                <div class="pull-left border-bottom border-left w70 padding-tb8-l20">
                    <p>Before</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            $m_before_photo = get_post_meta( $post->ID, 'before_photo', true );
            $m_before_comment = get_post_meta( $post->ID, 'before_comment', true );
            ?>
            <div class="pull-left border-bottom  border-left w80 padding-t10">
             <div class="margin-t20">
                 <div class="pull-left w10">&nbsp;</div>
                 <div class="pull-left w30 text-calign">Before</div>
                 <div class="pull-left w15 text-calign">　　</div>
                 <div class="pull-left w40 text-calign"  style="width:40%">コメント</div>
                 <div class="clearfix"></div>
             </div>
                <?php
                for ($i=0; $i < 6; $i++) {
                ?>
                <div>
                    <div class="pull-left w10 padding-tb8-l20 border-box">
                        <label>写真<?=($i+1)?></label>
                    </div>
                    <div class="pull-left w30 border-box padding-tb5">
                        <input type="text" name="before_photo[<?=$i?>]" id="bphoto_<?=$i?>" class="meta-image regular-text w100" value="<?php if(isset($m_before_photo[$i]))  echo $m_before_photo[$i]; ?>">
                    </div>
                    <div class="pull-left w15 border-box padding-tb5">
                        <input type="button" class="button image-upload bg-color-pbtn white" photo-id="bphoto_<?=$i?>" value="面像を選択">
                    </div>
                    <div class="pull-left w40 border-box padding-tb5"  style="width:40%">
                        <input type="text" name="before_comment[<?=$i?>]" class="w100" id="bcomment_<?=$i?>" value="<?php if ( isset($m_before_comment)) {  echo $m_before_comment[$i]; } ?>">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
                }
                ?>
                <div class="red margin-t10 padding-tb8-l20">写真は1MB以内をアップロードしてください。</div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="w100 border-bottom parent pic">
            <div class="pull-left w20 bold parent">
                <div class="pull-left w30 padding-tb8-l20">
                    <p>&nbsp;</p>
                </div>
                <div class="pull-left border-left w70 padding-tb8-l20">
                    <p>After</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
            $m_after_photo = get_post_meta( $post->ID, 'after_photo', true );
            $m_after_comment = get_post_meta( $post->ID, 'after_comment', true );
             ?>
            <div class="pull-left  border-left w80  padding-t10">
             <div class="margin-t20">
                 <div class="pull-left w10">&nbsp;</div>
                 <div class="pull-left w30 text-calign">After</div>
                 <div class="pull-left w15 text-calign">　　 </div>
                 <div class="pull-left w40 text-calign" style="width:40%">コメント</div>
                     <div class="clearfix"></div>
            </div>
                <?php
                for ($i=0; $i < 6; $i++) {
                ?>
                <div>
                    <div class="pull-left w10 padding-tb8-l20 border-box">
                        <label>写真<?=($i+1)?></label>
                    </div>
                    <div class="pull-left w30 border-box padding-tb5">
                        <input type="text" name="after_photo[<?=$i?>]" class="w100" id="aphoto_<?=$i?>" class="meta-image regular-text" value="<?php if(isset($m_after_photo[$i]))  echo $m_after_photo[$i]; ?>">
                    </div>
                    <div class="pull-left w15 border-box padding-tb5">
                        <input type="button" class="button image-upload  bg-color-pbtn white" photo-id="aphoto_<?=$i?>" value="面像を選択">
                    </div>
                    <div class="pull-left w40 border-box padding-tb5" style="width:40%">
                        <input type="text" name="after_comment[<?=$i?>]" class="w100" id="acomment_<?=$i?>" value="<?php if ( isset($m_after_comment)) {    echo $m_after_comment[$i]; } ?>">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
                }
                ?>
                <div class="red margin-t10 padding-tb8-l20">写真は1MB以内をアップロードしてください。</div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 担当者 -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="Person_in_charge">担当者</label>
                </div>
            </div>
            <?php $m_Person_in_charge = get_post_meta( $post->ID, 'Person_in_charge', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="Person_in_charge" class="w50" id="Person_in_charge" value="<?php if (isset($m_Person_in_charge)) {  echo $m_Person_in_charge; } ?>">
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- クローザー -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="Closer">クローザー</label>
                </div>
            </div>
            <?php $m_Closer = get_post_meta( $post->ID, 'Closer', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="Closer" class="w50" id="Closer" value="<?php if (isset($m_Closer)) {  echo $m_Closer; } ?>">
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 現場担当者 -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="On_site_charge">現場担当者</label>
                </div>
            </div>
            <?php $m_On_site_charge = get_post_meta( $post->ID, 'On_site_charge', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="On_site_charge" class="w50" id="On_site_charge" value="<?php if (isset($m_On_site_charge)) {  echo $m_On_site_charge; } ?>">
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- 施工パートナー（会社名/氏名） -->
        <div class="w100 border-bottom bg-color-ddd">
            <div class="pull-left w20 text-lalign bold font-14">
                <div class="padding-tb8-l20 ">
                    <label for="Construction_partner">施工パートナー（会社名/氏名）</label>
                </div>
            </div>
            <?php $m_Construction_partner = get_post_meta( $post->ID, 'Construction_partner', true ); ?>
            <div class="pull-left w80 border-left padding-tb8-l20">
                <input type="text" name="Construction_partner" class="w50" id="Construction_partner" value="<?php if (isset($m_Construction_partner)) {  echo $m_Construction_partner; } ?>">
            </div>
            <div class="clearfix"></div>
        </div>


    </div>

    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() . '/assets/page/jquery.validate.min.js'; ?>"></script>

    <script>
	    jQuery(document).ready(function($) {

	        $('#post').validate({
	            rules: {
	                area: {
	                    required: true
	                },

	                branch: {
	                    required: true
	                },

	                catch: {
	                    required: true,
	                    maxlength: 30,
	                },
	            },

	            messages: {
	                area: "「お住いの都道府県」を選択ください。",
	                branch: "「支店名」を選択ください。",
	                catch: {
	                    required: "「キャッチ」を入力ください。",
	                    maxlength: "30文字以内で入カ"
	                }
	            }
	        });

	        $('[name^="before_photo"]').each(function() {
	            $(this).rules('add', {
	                //required: true,
	                url: true,
	                messages: {
	                    //required: "「Beforeの写真」を設定ください。",
	                    url: "URLが無効です。",
	                }
	            })
	        });

	        $('[name^="after_photo"]').each(function() {
	            $(this).rules('add', {
	                //required: true,
	                url: true,
	                messages: {
	                    //required: "「Afterの写真」を設定ください。",
	                    url: "URLが無効です。",
	                }
	            })
	        });

	        // $('[name^="before_comment"]').each(function() {
	        //     $(this).rules('add', {
	        //         required: true,
	        //         messages: {
	        //             required: "「Beforeの写真のコメント」を入力ください。",
	        //         }
	        //     })
	        // });

	        // $('[name^="after_comment"]').each(function() {
	        //     $(this).rules('add', {
	        //         required: true,
	        //         messages: {
	        //             required: "「Afterの写真のコメント」を入力ください。",
	        //         }
	        //     })
	        // });
	    });

	    jQuery(document).ready(function ($) {
	        // Instantiates the variable that holds the media library frame.
	        var meta_image_frame;
	        var meta_image;
	        var meta_image_id ;
	        // Runs when the image button is clicked.
	        $('.image-upload').click(function (e) {
	        // Prevents the default action from occuring.
	            e.preventDefault();
	            meta_image_id = $(this).attr('photo-id');
	            meta_image = $(this).parent().parent().find('#' + meta_image_id);
	            // If the frame already exists, re-open it.
	            if (meta_image_frame) {
	                meta_image_frame.open();
	                return;
	            }
	            // Sets up the media library frame
	            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
	                title: 'Select or Upload Media Of Your Chosen Persuasion',
	                button: {
	                text: 'Use this media'
	                },
	                multiple: false  // Set to true to allow multiple files to be selected
	            });
	            // Runs when an image is selected.
	            meta_image_frame.on('select', function () {
	                // Grabs the attachment selection and creates a JSON representation of the model.
	                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
	                // Sends the attachment URL to our custom image input field.
	                meta_image.val(media_attachment.url);
	            });
	            // Opens the media library frame.
	            meta_image_frame.open();
	        });
	    });
    </script>

    <?php
}

// Save custom post
function save_cases_fields_meta( $post_id ) {
    // verify nonce
    if ( isset($_POST['cases_meta_box_nonce'])
            && !wp_verify_nonce( $_POST['cases_meta_box_nonce'], basename(__FILE__) ) ) {
            return $post_id;
        }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // check permissions
    if (isset($_POST['post_type'])) { //Fix 2
        if ( 'page' === $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
    }
    if ( isset($_POST['post_type'])) {
        update_cases_all_meta($post_id, $_POST);
    }
}
add_action( 'save_post', 'save_cases_fields_meta' );

function update_cases_all_meta($post_id, $news)
{

    $area = $news['area'];
    update_post_meta( $post_id, 'area', $area );

    $construction_years = $news['construction_years'];
    update_post_meta( $post_id, 'construction_years', $construction_years );

    $outwall_type = $news['outwall_type'];
    update_post_meta( $post_id, 'outwall_type', $outwall_type );

    if ( array_key_exists( 'outwall_type_0', $news) ) {
    	update_post_meta( $post_id, 'outwall_type_0', $news['outwall_type_0'] );
    	update_post_meta( $post_id, 'outwall_type_other', $news['outwall_type_other'] );
    }else{
    	update_post_meta( $post_id, 'outwall_type_0', '' );
    	update_post_meta( $post_id, 'outwall_type_other', '' );
    }

    $guarantee_walls = $news['guarantee_wall'];
    update_post_meta( $post_id, 'guarantee_wall', $guarantee_walls );

    $guarantee_roofs = $news['guarantee_roof'];
    update_post_meta( $post_id, 'guarantee_roof', $guarantee_roofs );

    $roof_type = $news['roof_type'];
    update_post_meta( $post_id, 'roof_type', $roof_type );

    if ( array_key_exists( 'roof_type_0', $news) ) {
    	update_post_meta( $post_id, 'roof_type_0', $news['roof_type_0'] );
    	update_post_meta( $post_id, 'roof_type_other', $news['roof_type_other'] );
    }else{
    	update_post_meta( $post_id, 'roof_type_0', '' );
    	update_post_meta( $post_id, 'roof_type_other', '' );
    }

    $case_types = $news['case_types'];

    update_post_meta( $post_id, 'case_types', $case_types );

    if ( array_key_exists( 'case_types_0', $news) ) {
    	update_post_meta( $post_id, 'case_types_0', $news['case_types_0'] );
    	update_post_meta( $post_id, 'case_types_other', $news['case_types_other'] );
    }else{
    	update_post_meta( $post_id, 'case_types_0', '' );
    	update_post_meta( $post_id, 'case_types_other', '' );
    }

    $case_type_roofs = $news['case_type_roofs'];
    update_post_meta( $post_id, 'case_type_roofs', $case_type_roofs );

    if ( array_key_exists( 'case_type_roofs_0', $news) ) {
    	update_post_meta( $post_id, 'case_type_roofs_0', $news['case_type_roofs_0'] );
    	update_post_meta( $post_id, 'case_type_roofs_other', $news['case_type_roofs_other'] );
    }else{
    	update_post_meta( $post_id, 'case_type_roofs_0', '' );
    	update_post_meta( $post_id, 'case_type_roofs_other', '' );
    }

    $out_square = $news['out_square'];
    update_post_meta( $post_id, 'out_square', $out_square );

    $roof_square = $news['roof_square'];
    update_post_meta( $post_id, 'roof_square', $roof_square );

    $price = $news['price'];
    update_post_meta( $post_id, 'price', $price );

    for ($we=0; $we <= count($GLOBALS['worry_elements']); $we++) {
        if ( array_key_exists( 'worry_elements_'.$we, $news) ) {
            update_post_meta( $post_id, 'worry_elements_'.$we, $news['worry_elements_'.$we] );
            if ($we==0)
                update_post_meta( $post_id, 'worry_elements_other', $news['worry_elements_other'] );
        }else{
            update_post_meta( $post_id, 'worry_elements_'.$we, '' );
            if ($we==0)
                update_post_meta( $post_id, 'worry_elements_other', '' );
        }
    }

    $detacheds = $news['detacheds'];
    update_post_meta( $post_id, 'detacheds', $detacheds );

    $detacheds_other = $news['detacheds_other'];
    update_post_meta( $post_id, 'detacheds_other', $detacheds_other );

    $housemakers = $news['housemakers'];
    update_post_meta( $post_id, 'housemakers', $housemakers );

    $housemakers_other = $news['housemakers_other'];
    update_post_meta( $post_id, 'housemakers_other', $housemakers_other );

    $catch = $news['catch'];
    update_post_meta( $post_id, 'catch', $catch );

    $before_photo = $news['before_photo'];
    update_post_meta( $post_id, 'before_photo', $before_photo );

    $after_photo = $news['after_photo'];
    update_post_meta( $post_id, 'after_photo', $after_photo );

    for ($ow=0; $ow <= count($GLOBALS['other_works']); $ow++) {
        if ( array_key_exists( 'other_works_'.$ow, $news) ) {
            update_post_meta( $post_id, 'other_works_'.$ow, $news['other_works_'.$ow] );
            if ($ow==0)
                update_post_meta( $post_id, 'other_works_other', $news['other_works_other'] );
            if ($ow==5)
                update_post_meta( $post_id, 'other_works_hoshu', $news['other_works_hoshu'] );
            if ($ow==6)
                update_post_meta( $post_id, 'other_works_koukan', $news['other_works_koukan'] );
        }else{
            update_post_meta( $post_id, 'other_works_'.$ow, '' );
            if ($ow==0)
                update_post_meta( $post_id, 'other_works_other', '' );
            if ($ow==5)
                update_post_meta( $post_id, 'other_works_hoshu', '' );
            if ($ow==6)
                update_post_meta( $post_id, 'other_works_koukan', '' );
        }
    }

    $before_comment = $news['before_comment'];
    update_post_meta( $post_id, 'before_comment', $before_comment );

    $after_comment = $news['after_comment'];
    update_post_meta( $post_id, 'after_comment', $after_comment );

    $customer_voice = $news['customer_voice'];
    update_post_meta( $post_id, 'customer_voice', $customer_voice );

    $branch = $news['branch'];
    update_post_meta( $post_id, 'branch', $branch );

    $local_area = $news['local_area'];
    update_post_meta( $post_id, 'local_area', $local_area );

    $cs_questionnaire_link = $news['cs_questionnaire_link'];
    update_post_meta( $post_id, 'cs_questionnaire_link', $cs_questionnaire_link );

    $Person_in_charge = $news['Person_in_charge'];
    update_post_meta( $post_id, 'Person_in_charge', $Person_in_charge );

    $Closer = $news['Closer'];
    update_post_meta( $post_id, 'Closer', $Closer );

    $On_site_charge = $news['On_site_charge'];
    update_post_meta( $post_id, 'On_site_charge', $On_site_charge );

    $Construction_partner = $news['Construction_partner'];
    update_post_meta( $post_id, 'Construction_partner', $Construction_partner );



    $outwall_colors = get_colors_titles('outwall-stand-color');
    foreach ($outwall_colors as $outwall_color) {
        if ( array_key_exists( $outwall_color['key'], $news) )
            update_post_meta( $post_id, $outwall_color['key'], $news[$outwall_color['key']] );
        else
            update_post_meta( $post_id, $outwall_color['key'], '' );
    }
    if ( array_key_exists( 'outwall-stand-color_0', $news) ) {
        update_post_meta( $post_id, 'outwall-stand-color_0', $news['outwall-stand-color_0'] );
        update_post_meta( $post_id, 'outwall-stand-color_other', $news['outwall-stand-color_other'] );
    }else{
        update_post_meta( $post_id, 'outwall-stand-color_0', '' );
        update_post_meta( $post_id, 'outwall-stand-color_other', '' );
    }

    $outwall_waterzols = get_colors_titles('outwall-zola-coat-color');
    foreach ($outwall_waterzols as $outwall_waterzol) {
        if ( array_key_exists( $outwall_waterzol['key'], $news) )
            update_post_meta( $post_id, $outwall_waterzol['key'], $news[$outwall_waterzol['key']] );
        else
            update_post_meta( $post_id, $outwall_waterzol['key'], '' );
    }
    if ( array_key_exists( 'outwall-zola-coat-color_0', $news) ) {
        update_post_meta( $post_id, 'outwall-zola-coat-color_0', $news['outwall-zola-coat-color_0'] );
        update_post_meta( $post_id, 'outwall-zola-coat-color_other', $news['outwall-zola-coat-color_other'] );
    }else{
        update_post_meta( $post_id, 'outwall-zola-coat-color_0', '' );
        update_post_meta( $post_id, 'outwall-zola-coat-color_other', '' );
    }

    $outwall_coatings = get_colors_titles('outwall-coat-color');
    foreach ($outwall_coatings as $outwall_coating) {
        if ( array_key_exists( $outwall_coating['key'], $news) )
            update_post_meta( $post_id, $outwall_coating['key'], $news[$outwall_coating['key']] );
        else
            update_post_meta( $post_id, $outwall_coating['key'], '' );
    }

    $roof_hscolors = get_colors_titles('roof-heat-color');
    foreach ($roof_hscolors as $roof_hscolor) {
        if ( array_key_exists( $roof_hscolor['key'], $news) )
            update_post_meta( $post_id, $roof_hscolor['key'], $news[$roof_hscolor['key']] );
        else
            update_post_meta( $post_id, $roof_hscolor['key'], '' );
    }
    if ( array_key_exists( 'roof-heat-color_0', $news) ) {
        update_post_meta( $post_id, 'roof-heat-color_0', $news['roof-heat-color_0'] );
        update_post_meta( $post_id, 'roof-heat-color_other', $news['roof-heat-color_other'] );
    }else{
        update_post_meta( $post_id, 'roof-heat-color_0', '' );
        update_post_meta( $post_id, 'roof-heat-color_other', '' );
    }

    $roof_standcols = get_colors_titles('roof-stand-color');
    foreach ($roof_standcols as $roof_standcol) {
        if ( array_key_exists( $roof_standcol['key'], $news) )
            update_post_meta( $post_id, $roof_standcol['key'], $news[$roof_standcol['key']] );
        else
            update_post_meta( $post_id, $roof_standcol['key'], '' );
    }
    if ( array_key_exists( 'roof-stand-color_0', $news) ) {
        update_post_meta( $post_id, 'roof-stand-color_0', $news['roof-stand-color_0'] );
        update_post_meta( $post_id, 'roof-stand-color_other', $news['roof-stand-color_other'] );
    }else{
        update_post_meta( $post_id, 'roof-stand-color_0', '' );
        update_post_meta( $post_id, 'roof-stand-color_other', '' );
    }

}

function custom_length_excerpt_max_char($content, $max_chars_limit) {

    $string = strlen($content) > $max_chars_limit ? substr($content,0,$max_chars_limit)."..." : $content;

    return $string;
}
