<?php
/* Template Name: No sidebar */
get_header();
?>
<div id="page-wrap">
	<main id="primary" class="content-area">

		<?php
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content/content', 'page');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

</div>
<?php
get_footer();
