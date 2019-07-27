<?php

function wtnerd_global_vars() {
    global $provinces, $cons_years, $outwall_types,
        $roof_types, $case_types, $case_type_roofs, $prices,
        $worry_elements, $detacheds,
        $housemakers, $other_works, $guarantee_walls, $guarantee_roofs;

    $provinces = array(
        '北海道',
        '青森県',
        '岩手県',
        '宮城県',
        '秋田県',
        '山形県',
        '福島県',
        '茨城県',
        '栃木県',
        '群馬県',
        '埼玉県',
        '千葉県',
        '東京都',
        '神奈川県',
        '新潟県',
        '富山県',
        '石川県',
        '福井県',
        '山梨県',
        '長野県',
        '岐阜県',
        '静岡県',
        '愛知県',
        '三重県',
        '滋賀県',
        '京都府',
        '大阪府',
        '兵庫県',
        '奈良県',
        '和歌山県',
        '鳥取県',
        '島根県',
        '岡山県',
        '広島県',
        '山口県',
        '徳島県',
        '香川県',
        '愛媛県',
        '高知県',
        '福岡県',
        '佐賀県',
        '長崎県',
        '熊本県',
        '大分県',
        '宮崎県',
        '鹿児島県',
        '沖縄県'
    );

    $cons_years = array(5, 10, 15, 20, 25, 30, 35, 36);

    $outwall_types = array('モルタル', 'サイディング', 'ALC', 'RC', '金属壁', 'パネルボード');

    $roof_types = array('新生瓦', 'セメント瓦', '屋根防水', '金属瓦', 'モニエル瓦');

    $case_types = array(
     'フッソ系（MUKIフッソ, セラフッソ, クリアー（フッソ））',
     'シリコン系（ラジカル制御シリコン, セラシリコン, 艶消しシリコン, シリコン, クリアー（シリコン））',
     'ウレタン系（ウレタン）',
     'コーティング系（ガラスコート）'
    );

    $case_type_roofs = array(
     'フッソ系（遮熱フッソ, フッソ）',
     'シリコン系（遮熱シリコン, シリコン, 艶消しシリコン, 強化スラリー, ダイレクト）',
    );

    $prices = array(50, 75, 100, 125, 150, 175, 200, 225, 250, 275, 300, 301);

    $worry_elements = array(
                        array( 'key' => 'worry_elements_1', 'value' => '色アセ' ),
                        array( 'key' => 'worry_elements_2', 'value' => 'カビ・コケ' ),
                        array( 'key' => 'worry_elements_3', 'value' => 'ひび割れ' ),
                        array( 'key' => 'worry_elements_4', 'value' => '手に粉が付く' ),
                        array( 'key' => 'worry_elements_5', 'value' => '天災被害' ));

    $detacheds = array('和風', '洋風', '和モダン');

    $housemakers = array('住友林業', '一条工務店', 'ミサワホーム', '積水ハウス', 'セキスイハイム', 'パナホーム', 'ダイワハウス', '大成建設ハウジング', 'へーベルハウス', '三井ホーム');

    $other_works = array(
                    array( 'key' => 'other_works_1', 'value' => 'ベランダ床塗装' ),
                    array( 'key' => 'other_works_2', 'value' => '防水工事' ),
                    array( 'key' => 'other_works_3', 'value' => '付帯塗装' ),
                    array( 'key' => 'other_works_4', 'value' => '木・鉄部塗装' ),
                    array( 'key' => 'other_works_5', 'value' => '補修（フリー）' ),
                    array( 'key' => 'other_works_6', 'value' => '交換（フリー）' ), );

    $guarantee_walls = array('5年', '10年', '15年');
    $guarantee_roofs = array('3年', '5年', '7年');

}
add_action( 'parse_query', 'wtnerd_global_vars' );

 // $GLOBALS['other_works']
