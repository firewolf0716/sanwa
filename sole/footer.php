
<div class="moveTop">
  <a href="">TOP</a>
</div>

<footer id="colophon" class="site-footer " role="contentinfo">
  <!--footer menu-->
  <div class="footerMenuWrapper">
    <div id="footerMenu" class="flexPc fai_stretchPc">
      
      <div id="footerSidebar01" class="">
        <?php dynamic_sidebar('footerSidebar01');?>
      </div><!--/#footerSidebar01-->

      <div id="footerSidebar02" class="">
        <?php dynamic_sidebar('footerSidebar02');?>
      </div><!--/#footerSidebar02-->
      
      <div id="footerSidebar03" class="">
        <?php dynamic_sidebar('footerSidebar03');?>
      </div><!--/#footerSidebar03-->

    </div><!--/#footerMenu-->
  </div><!--/.footerMenuWrapper-->
 
  <div id="subFooter">
    <div class="subFooterWrapeer">
      <div class="subFooterInner">
       <?php echo do_shortcode('[copyright]'); ?>
     </div>
    </div>
  </div><!--/#subFooter -->
</footer><!--/#colophon -->


<?php wp_footer(); ?>


</body>

</html>