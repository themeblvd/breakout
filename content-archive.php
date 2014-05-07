<?php
/**
 * The default template for displaying content in an archive.
 */
global $location;
global $content;
?>
<div class="article-wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<?php if( 'show' == themeblvd_get_option( 'archive_meta', null, 'show' ) ) : ?>
				<?php themeblvd_blog_meta(); ?>
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php themeblvd_the_post_thumbnail( $location ); ?>
			<?php themeblvd_blog_content( $content ); ?>
			<?php if( 'show' == themeblvd_get_option( 'archive_tags', null, 'show' ) ) : ?>
				<?php themeblvd_blog_tags(); ?>
			<?php endif; ?>
			<div class="clear"></div>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .article-wrap (end) -->