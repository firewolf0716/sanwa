<?php
/*
Theme Name: Nanairo Starter Theme
Theme URI: http://www.7-16.jp/
Author: Nanairo Corp.
Author URI: http://www.7-16.co.jp/
Description: Nanairo Starter Theme Based on Underscore with Wacu.
Version: 1.1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: nanairo_starter_theme_text_domain
Tags:

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.

nanairo_starter_theme is based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc.
Underscores is distributed under the terms of the GNU GPL v2 or later.

Normalizing styles have been helped along thanks to the fine work of
Nicolas Gallagher and Jonathan Neal http://necolas.github.com/normalize.css/
*/
?>
<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nanairo_starter_theme
 */

?>
<!--content.php-->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'nanairo_starter_theme' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nanairo_starter_theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
