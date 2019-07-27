<?php

add_filter( 'wpcf7_autop_or_not', '__return_false' );


// WEBCSアンケート auto saying
add_action('wpcf7_mail_sent','save_webcsquestionnaire_data');
add_action('wpcf7_mail_failed','save_webcsquestionnaire_data');

function save_webcsquestionnaire_data($contact_form){
    $submission = WPCF7_Submission::get_instance();
    if (!$submission){
        return;
    }
    if($_POST['_wpcf7c'] !=='step2'){
      return;
    }

    $posted_data = $submission->get_posted_data();

    $new_post = array();

    if(isset($posted_data['my-subject']) && !empty($posted_data['my-subject'])){
        $new_post['post_title'] = $posted_data['my-subject'];
    } else {
        $new_post['post_title'] = 'WEBCSアンケート-'.current_time( 'ymdHis' );
    }

    $new_post['post_type'] = 'webcsquestionnaire'; //insert here your CPT

    // if(isset($posted_data['other_3'])){
    //     $new_post['post_content'] = $posted_data['other_3'];
    // } else {
    //     $new_post['post_content'] = ' ';
    // }

    $new_post['post_status'] = 'draft';

    if($post_id = wp_insert_post($new_post)){

	    if(isset($posted_data['username']) && !empty($posted_data['username'])){
	        update_field( 'your-name', $posted_data['username'], $post_id );
	    }

      if(isset($posted_data['contact-zip']) && !empty($posted_data['contact-zip'])){
	        update_field( 'your-addressnumber', $posted_data['contact-zip'], $post_id );
	    }

	    if(isset($posted_data['contact-address1']) && !empty($posted_data['contact-address1'])){
	        update_field( 'your-address', $posted_data['contact-address1'], $post_id );
	    }

	    if(isset($posted_data['branch']) && !empty($posted_data['branch'])){

	    	$hide_empty = array( 'hide_empty' => false );
			$shops = get_terms('csquestionnaire_shop', $hide_empty);
			foreach ($shops as $shop) {
				if ( $shop->name == $posted_data['branch'] )
					$tag_id = $shop->term_id;
			}

	    	$tag = array( $tag_id );
	    	wp_set_post_terms( $post_id, $tag, 'csquestionnaire_shop' );
	    }

	    if(isset($posted_data['tantousya']) && !empty($posted_data['tantousya'])){
	        update_field( 'staff', $posted_data['tantousya'], $post_id );
	    }

	    if(isset($posted_data['how']) && !empty($posted_data['how'])){
	        update_post_meta( $post_id, 'question-how_' . 'how',  $posted_data['how'] );
	        update_post_meta( $post_id, 'question-how_' . 'how-other-detail', $posted_data['how_other_detail'] );
	    }

	    if(isset($posted_data['why']) && !empty($posted_data['why'])){
	        update_post_meta( $post_id, 'question-why_' . 'why' ,  $posted_data['why'] );
	        update_post_meta( $post_id, 'question-why_' . 'why-other-detail', $posted_data['why_other_detail'] );
	    }

	    if(isset($posted_data['sales_1']) && !empty($posted_data['sales_1'])){
	        update_field( 'sales_1', $posted_data['sales_1'], $post_id );
	    }

	    if(isset($posted_data['sales_2']) && !empty($posted_data['sales_2'])){
	        update_field( 'sales_2', $posted_data['sales_2'], $post_id );
	    }

	    if(isset($posted_data['sales_3']) && !empty($posted_data['sales_3'])){
	        update_field( 'sales_3', $posted_data['sales_3'], $post_id );
	    }

	    if(isset($posted_data['sales_4']) && !empty($posted_data['sales_4'])){
	        update_field( 'sales_4', $posted_data['sales_4'], $post_id );
	    }

	    if(isset($posted_data['construct_1']) && !empty($posted_data['construct_1'])){
	        update_field( 'construct_1', $posted_data['construct_1'], $post_id );
	    }

	    if(isset($posted_data['construct_2']) && !empty($posted_data['construct_2'])){
	        update_field( 'construct_2', $posted_data['construct_2'], $post_id );
	    }

	    if(isset($posted_data['construct_3']) && !empty($posted_data['construct_3'])){
	        update_field( 'construct_3', $posted_data['construct_3'], $post_id );
	    }

	    if(isset($posted_data['construct_4']) && !empty($posted_data['construct_4'])){
	        update_field( 'construct_4', $posted_data['construct_4'], $post_id );
	    }

	    if(isset($posted_data['other_1']) && !empty($posted_data['other_1'])){
	        update_field( 'other_1', $posted_data['other_1'], $post_id );
	    }

	    if(isset($posted_data['other_2']) && !empty($posted_data['other_2'])){
	        update_field( 'other_2', $posted_data['other_2'], $post_id );
	    }

	    if(isset($posted_data['other_3']) && !empty($posted_data['other_3'])){
	        update_field( 'other_3', $posted_data['other_3'], $post_id );
	    }

    } else {

    }
    return;
}


/* ContactForm7 のカスタムバリデーション */
add_filter('wpcf7_validate', 'wpcf7_validate_customize', 11, 2);
function wpcf7_validate_customize($result,$tags){

  //郵便番号
 if(!empty($_POST["contact-zip"]) && !preg_match('/^([0-9]{3})(-[0-9]{4})?$/i', $_POST["contact-zip"]) && !preg_match('/^([0-9]{3})([0-9]{4})?$/i', $_POST["contact-zip"])){
  $result->invalidate( 'contact-zip','郵便番号の形式で入力してください。' );
 }

 //電話番号
 if(!empty($_POST["contact-tel"]) && !preg_match("/^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/", $_POST["contact-tel"])){
   $result->invalidate( 'contact-tel','電話番号の形式で入力してください。' );
 }

// //カタカナチェック
if(!mb_ereg("^[ア-ン゛゜ァ-ォャ-ョー「」、]+$", $_POST["contact-hurigana"]) && !mb_ereg("^[ｱ-ﾝﾞﾟｧ-ｫｬ-ｮｰ｡｢｣､]+$", $_POST["contact-hurigana"])){
  $result->invalidate( 'contact-hurigana','カタカナで正しく入力してください。' );
}

 return $result;
}
//　「radio*」を使えるようにする
// add_action( 'wpcf7_init', 'wpcf7_add_shortcode_radio_required' );
// function wpcf7_add_shortcode_radio_required() {
// wpcf7_add_shortcode( array( 'radio*' ),
// 'wpcf7_checkbox_form_tag_handler', true );
// }
// add_filter( 'wpcf7_validate_radio*', 'wpcf7_checkbox_validation_filter', 10, 2 );
