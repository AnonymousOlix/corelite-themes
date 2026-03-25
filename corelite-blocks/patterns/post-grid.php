<?php
/**
 * Title: Post Grid Intro
 * Slug: corelite-blocks/post-grid
 * Categories: corelite-blocks-sections
 * Inserter: yes
 *
 * @package CoreLiteBlocks
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"18px","padding":{"top":"24px","bottom":"24px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:24px;padding-bottom:24px">
	<!-- wp:heading {"level":2,"fontSize":"large"} -->
	<h2 class="wp-block-heading has-large-font-size"><?php echo esc_html__( 'Recent writing', 'corelite-blocks' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"displayLayout":{"type":"grid","columns":3}} -->
	<div class="wp-block-query">
		<!-- wp:post-template -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"10px","padding":{"bottom":"16px"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-bottom:16px">
				<!-- wp:post-featured-image {"isLink":true} /-->
				<!-- wp:post-title {"isLink":true,"level":3} /-->
				<!-- wp:post-excerpt {"excerptLength":18,"moreText":""} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
