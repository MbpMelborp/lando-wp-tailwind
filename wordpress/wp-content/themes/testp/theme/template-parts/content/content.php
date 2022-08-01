<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package testp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div>
				<?php
				testp_posted_on();
				testp_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<?php testp_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span> "%s"</span>', 'testp' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div>' . esc_html__( 'Pages:', 'testp' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer>
		<?php testp_entry_footer(); ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
