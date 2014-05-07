<?php
/**
 * The template used for displaying content in attachment.php
 */
?>
<div class="article-wrap single-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php if ( wp_attachment_is_image( $post->ID ) ) : $att_image = wp_get_attachment_image_src( $post->ID, 'full' ); ?>
				<p class="attachment">
					<a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php the_title(); ?>" rel="attachment">
						<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" />
					</a>
				</p>
			<?php endif; ?>
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . themeblvd_get_local('pages').': ', 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', TB_GETTEXT_DOMAIN ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .article-wrap (end) -->