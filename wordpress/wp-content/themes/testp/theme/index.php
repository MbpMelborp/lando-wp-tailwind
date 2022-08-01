<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package testp
 */

get_header();
?>

<main id="primary">
	<div class="py-8 px-8 max-w-sm mx-auto bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
		<img class="block mx-auto h-24 rounded-full sm:mx-0 sm:shrink-0" src="/img/erin-lindford.jpg" alt="Woman's Face">
		<div class="text-center space-y-2 sm:text-left">
			<div class="space-y-0.5">
				<p class="text-lg text-black font-semibold">
					Erin Lindford a
				</p>
				<p class="text-slate-500 font-medium">
					Product Engineer since 2018
				</p>
			</div>
			<button class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Message</button>
		</div>
	</div>

	<?php
	if (have_posts()) :

		if (is_home() && !is_front_page()) :
	?>
			<header>
				<h1><?php single_post_title(); ?></h1>
			</header>
	<?php
		endif;

		/* Start the Loop */
		while (have_posts()) :
			the_post();

			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			get_template_part('template-parts/content/content', get_post_type());

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
