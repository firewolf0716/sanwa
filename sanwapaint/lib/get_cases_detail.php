<?php

//使用塗料 壁
$case_types = get_post_meta( get_the_ID(), 'case_types', true);
$case_type_text = '';
$case_type_text_link = '';
if (is_array($case_types) && $case_types[0] != '') {
	foreach ($case_types as $ct_key => $case_type) {
		$case_type_text .= $case_type.'、';
		$baseno++;
		$point = mb_strpos($case_type,"系（")+1;
		$trimed = mb_substr($case_type, 0, $point);
		$case_type_text_link .= "<a href='/?post_type=cases&s_case_types[]={$case_type}'>外壁{$trimed}</a>&nbsp;";
	}
	$case_type_text_link = mb_substr($case_type_text_link, 0, -6, "UTF-8");
	$case_type_text = rtrim($case_type_text, '、');
}

//使用塗料　屋根
$case_type_roofs = get_post_meta( get_the_ID(), 'case_type_roofs', true);
$case_type_roof_text = '';
$case_type_roof_link = '';
if (is_array($case_type_roofs) && $case_type_roofs[0] != '') {
	foreach ($case_type_roofs as $ctf_key => $case_type_roof) {
		$case_type_roof_text .= $case_type_roof.'、';
		$point = mb_strpos($case_type_roof,"系（")+1;
		$trimed = mb_substr($case_type_roof, 0, $point);
		$case_type_roof_link .= "<a href='/?post_type=cases&s_case_type_roofs[]={$case_type_roof}'>屋根{$trimed}</a>&nbsp;";
	}
	$case_type_roof_link = mb_substr($case_type_roof_link, 0, -6, "UTF-8");
	$case_type_roof_text = rtrim($case_type_roof_text, '、');
}

global $worry_elements;
$worry_elements_text = '';
$worry_elements_link = '';
foreach ($worry_elements as $we_key => $worry_element) {
	if ( get_post_meta( $post->ID, $worry_element['key'], true ) ){
		$worry_elements_text .= $worry_element['value'].'、';
		$worry_elements_link .= "<a href='/?post_type=cases&{$worry_element['key']}={$worry_element['value']}'>{$worry_element['value']}</a>&nbsp;";
	}
}
$worry_elements_link = mb_substr($worry_elements_link, 0, -6, "UTF-8");
$worry_elements_text = rtrim($worry_elements_text,'、');

$outwall_types = get_post_meta( get_the_ID(), 'outwall_type', true);
$outwall_types_text = '';
if (is_array($outwall_types) && $outwall_types[0] != '') {
	foreach ($outwall_types as $ot_key =>$outwall_type) {
		$outwall_types_text .= $outwall_type.'、';
	}
	$outwall_types_text = rtrim($outwall_types_text,'、');
}

global $other_works;
$other_works_text = '';
$other_works_text_link = '';
foreach ($other_works as $or_key => $other_work) {
	if ( get_post_meta( $post->ID, $other_work['key'], true ) ){
		$owtext = str_replace('（フリー）', '', $other_work['value']);
		$other_works_text .= $other_work['value'].'、';
		$other_works_text_link .= "<a href='/?post_type=cases&{$other_work['key']}={$other_work['value']}'>{$owtext}</a>&nbsp;";
	}
}
$other_works_text_link = mb_substr($other_works_text_link, 0, -6, "UTF-8");
$other_works_text = rtrim($other_works_text,'、');

/*戸建*/
$detacheds = "";
$detacheds = get_post_meta( get_the_ID(), 'detacheds', true);
if(is_array($detacheds))$detacheds = $detacheds[0];
//if($detacheds === "その他"){$detacheds = get_post_meta( get_the_ID(), 'detacheds_other', true);}

/*ハウスメーカー*/
$housemakers = "";
$housemakers = get_post_meta( get_the_ID(), 'housemakers', true);
if(is_array($housemakers))$housemakers = $housemakers[0];
// if($housemakers === "その他"){$housemakers = get_post_meta( get_the_ID(), 'housemakers_other', true);}

$branch = "";
$branch = get_post_meta( get_the_ID(), 'branch', true);


$detail_imgs = array();
$detail_imgs_full = array();
$outwall_colors = get_colors_titles('outwall-stand-color');
foreach ($outwall_colors as $outwall_color) {
    if ( get_post_meta( get_the_ID(), $outwall_color['key'], true) ) {
        $detail_imgs[] = $outwall_color['ID'];
				$detail_imgs_full[] = array($outwall_color['ID'],$outwall_color['key'],$outwall_color['value']);
    }
}

$outwall_waterzols = get_colors_titles('outwall-zola-coat-color');
foreach ($outwall_waterzols as $outwall_waterzol) {
    if ( get_post_meta( get_the_ID(), $outwall_waterzol['key'], true) ) {
        $detail_imgs[] = $outwall_waterzol['ID'];
				$detail_imgs_full[] = array($outwall_waterzol['ID'],$outwall_waterzol['key'],$outwall_waterzol['value']);
    }
}

$outwall_coatings = get_colors_titles('outwall-coat-color');
foreach ($outwall_coatings as $outwall_coating) {
    if ( get_post_meta( get_the_ID(), $outwall_coating['key'], true) ) {
        $detail_imgs[] = $outwall_coating['ID'];
				$detail_imgs_full[] = array($outwall_coating['ID'],$outwall_coating['key'],$outwall_coating['value']);
    }
}

$roof_hscolors = get_colors_titles('roof-heat-color');
foreach ($roof_hscolors as $roof_hscolor) {
    if ( get_post_meta( get_the_ID(), $roof_hscolor['key'], true) ) {
        $detail_imgs[] = $roof_hscolor['ID'];
				$detail_imgs_full[] = array($roof_hscolor['ID'],$roof_hscolor['key'],$roof_hscolor['value']);
    }
}

$roof_standcols = get_colors_titles('roof-stand-color');
foreach ($roof_standcols as $roof_standcol) {
    if ( get_post_meta( get_the_ID(), $roof_standcol['key'], true) ) {
        $detail_imgs[] = $roof_standcol['ID'];
				$detail_imgs_full[] = array($roof_standcol['ID'],$roof_standcol['key'],$roof_standcol['value']);
    }
}
