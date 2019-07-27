<?php

function sanwa_pagination($pages = '', $range = 2)
{  
    $showitems = ($range * 2)+1;  

    global $paged;

    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }   

    if(1 != $pages)
    {   ?>

    <?php

        echo "<div class='pagination'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
            echo "<a href='".get_pagenum_link(1)."'><i class='fas fa-angle-double-left'></i></a>";

        if($paged > 1 && $showitems < $pages) 
            echo "<a href='".get_pagenum_link($paged - 1)."'><i class='fas fa-angle-left'></i></a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) 
            echo "<a href='".get_pagenum_link($paged + 1)."'><i class='fas fa-angle-right'></i></a>";  

        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
            echo "<a href='".get_pagenum_link($pages)."'><i class='fas fa-angle-double-right'></i></a>";

        echo "</div>\n";
    }
}

function cs_pagination($pages = '' , $paged = 1,  $eval, $shop, $range = 2)
{  
    $showitems = ($range * 2)+1;  

    if(1 != $pages)
    {   ?>

    <style type="text/css">

        .pagination {
            display: flex;
            justify-content:center;
            clear:both;
            padding:20px 0;
            margin: 0 auto; 
            position:relative;
            line-height:13px;
        }

        .pagination span, .pagination a {
            display: block;
            float: left;
            margin: 2px 11px 2px 11px;
            padding: 8px 10px 8px 10px;
            text-decoration: none;
            width: auto;
            color: #1c5ea5;
            font-size: 14px;
            line-height: 14px;
            background: #fff;
            border: 1px solid #1c5ea5;
        }

        .pagination a:hover{
            color:#fff;
            background: #1c5ea5;
        }

        .pagination .current{
            background: #1c5ea5;
            color:#fff;
        }
    </style>



    <?php

        $get_link = get_site_url() . '/cs?';
        if ( !is_null($eval)) {
            $get_link .= 's_evaluation='.$eval;
        }
        if ($shop) {
            if ($eval) $get_link .= '&';
            $get_link .= 's_shop='.$shop;
        }
        if ( $eval || $shop ) {
            $get_link .= '&';
        }
        $get_link .= 'page_num=';

        echo "<div class='pagination'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
            echo "<a href='".$get_link.'1'."'><i class='fas fa-angle-double-left'></i></a>";

        if($paged > 1 && $showitems < $pages) 
            echo "<a href='".$get_link.($paged - 1)."'><i class='fas fa-angle-left'></i></a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i) ? 
                    "<span class='current'>".$i."</span>":
                    "<a href='". $get_link . $i ."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) 
            echo "<a href='".$get_link.($paged + 1)."'><i class='fas fa-angle-right'></i></a>";  

        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
            echo "<a href='".$get_link.($pages)."'><i class='fas fa-angle-double-right'></i></a>";

        echo "</div>\n";
    }
}


