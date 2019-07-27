
<div class="moveTop">
  <a href=""><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>


<section class="footerLink">
  <div class="vc_empty_space  rem5" style="height: 5rem"><span class="vc_empty_space_inner"></span></div>
  <a href="/" class=""><img src="/wp-content/uploads/2019/07/footerLinkImage.png" alt="" ></a>
  <div class="vc_empty_space  rem5" style="height: 5rem"><span class="vc_empty_space_inner"></span></div>
</section>

<footer id="footer" class="site-footer " role="contentinfo">

  <div class="footerLogo maxWidth">
    <h1 class="site-title">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php
          $get_the_logo_img_url = get_the_logo_img_url();

          if(empty($get_the_logo_img_url)){//ロゴ未設定時
            bloginfo( 'name' );
            }
          else{//ロゴ設定時
            echo '<img src="'. get_the_logo_img_url() . '" alt="' . $description . '" />';
            }
        ?>
        </a>
    </h1>
  </div>


  <div class="footerMenu maxWidth">
    <?php wp_nav_menu( array(
            'theme_location'=>'kokorotosou_footer',
            'container'     =>'',
            'menu_class'    =>'',
            'items_wrap'    =>'<ul class="footer_menu">%3$s</ul>'));
    ?>
  </div>
  
  <div class="borderDiv"></div>

  <div class="copyrightArea maxWidth">
    <div class="copyrightAreaWrapeer">
      <div class="copyrightAreaInner">
        <span><a href="/">&copy SANWAPAINT CORP.</a></span>
       <?php wp_nav_menu( array(
               'theme_location'=>'footer_menu5',
               'container'     =>'',
               'menu_class'    =>'',
               'items_wrap'    =>'<ul class="copyright_menu">%3$s</ul>'));
       ?>
     </div>
    </div>
  </div><!--/#subFooter -->

</footer><!--/#colophon -->


<?php wp_footer(); ?>

</div>
</div>

<script> Splitting(); </script>
</body>

</html>