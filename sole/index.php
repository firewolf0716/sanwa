<?php
  if (function_exists('get_header')) 
  {
    get_header();
  } 
  else 
  {
    // Whatever you want to do when the file is accessed directly would go here. Maybe redirect them to your home page?
  }
?>



  <?php
    if (function_exists('get_footer')) 
    {
      get_footer();
    } 
    else 
    {
    }
  ?>