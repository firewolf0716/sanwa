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
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nanairo_starter_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="thumb">
		<?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
			<a href="<?php the_permalink(); ?>" class="new-entry-title"><?php the_post_thumbnail( 'thumb75' ); ?></a>
		<?php else: // サムネイルを持っていないときの処理 ?>
			<a href="<?php the_permalink(); ?>" class="new-entry-title"><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" title="NO IMAGE" width="75px" height="75" /></a>
		<?php endif; ?>
		</div><!-- /.thumb -->

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php nanairo_starter_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<div class="entry-footer">
		<?php //nanairo_starter_theme_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-## -->
