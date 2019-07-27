<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package nanairo
 */


get_header(); ?>

<!--secondLayer-->
<div id="wholeContents" class="wholeContents four-o-four-php" role="main">
	<div id="four-o-four" class="four-o-four">

		<div id="mainContents" class="mainContents">


			<div id="contentsWrapper" class="contentsWrapper">
				<div id="main" class="main-content">
					<div id="four-o-fourWrapper" class="oneColumn-content-area maxWidth">
							<div class="entry-content flex fai_center fjc_center">
								<section class="error-404 not-found">
										<h1 class="page-title"><?php esc_html_e( 'お探しのページは存在しません', 'nanairo' ); ?></h1>

										<p><?php esc_html_e( '正しいページアドレスをご入力ください', 'nanairo' ); ?></p>
								</section><!-- .error-404 -->
							</div>
					</div><!-- #four-o-fourWrapper -->
				</div>
			</div><!--contentsWrapper-->


		</div><!--#mainContents-->
	</div><!-- #secondLayer -->
</div><!--#wholeContents-->



<?php

global $pattern_file;
get_footer();
