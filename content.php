<?php
/**
 * The template used for displaying single post content in single.php
 */
global $location;
global $show_meta;
?>
<div class="article-wrap single-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->
		<?php if( $show_meta ) : ?>
			<div class="meta-wrapper">
				<?php themeblvd_blog_meta(); ?>	
			</div><!-- .meta-wrapper (end) -->
		<?php endif; ?>
		<div class="entry-content">
			<?php themeblvd_the_post_thumbnail( $location ); ?>
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php themeblvd_blog_tags(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . themeblvd_get_local('pages').': ', 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', TB_GETTEXT_DOMAIN ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .article-wrap (end) -->