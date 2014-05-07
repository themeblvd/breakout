<?php
/**
 * The template used for displaying page content in page.php
 */
?>
<div class="article-wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if( 'hide' != get_post_meta( get_the_id(), '_tb_title', true ) ) : ?>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . themeblvd_get_local('pages').': ', 'after' => '</div>' ) ); ?>
			<?php edit_post_link( themeblvd_get_local( 'edit_page' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .article-wrap (end) -->