<?php
/**
 * Displays right part for search page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<div class="page_right_pane">

	<?php if( is_active_sidebar( 'right-page-search-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'right-page-search-widget-area' ); ?>
	<?php endif; ?>

</div>


