<?php
/**
 * Displays left bottom part for search page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
$image_url = get_stylesheet_directory_uri() . '/assets/images/'; ?>



<?php if( is_active_sidebar( 'three-image-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'three-image-widget-area' ); ?>
<?php endif; ?>


