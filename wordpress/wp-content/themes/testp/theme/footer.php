<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package testp
 */

?>

<?php if (get_page_template_slug() != "page-blank.php") {
	get_template_part('template-parts/layout/footer', 'content');
} ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>