<?php
/**
 * Template Name: Full-widht Page
 * The template for displaying full width pages
 *
 * @package medicll
 */

get_header();
?>

	<main id="medicll-main" class="medicll-main medicll-haslayout">
		<?php
		$has_sidebar = false;
		$content_class = '';
		$post_id = get_the_id();
		if (get_metadata('post', $post_id) !== false) {
			$layout = get_post_meta($post_id, 'mediclf_field_post_layout', true);
		} else {
			global $mediclf_framework_options;
			$layout = isset($mediclf_framework_options['mediclf-default-layout']) ? $mediclf_framework_options['mediclf-default-layout'] : '';
		}
		if ($layout == 'right' || $layout == 'left') {
			$has_sidebar = true;
			$content_class = $layout == 'left' ? ' pull-right' : ' pull-left';
		} else if (is_active_sidebar('sidebar-1') && $layout == '') {
			$has_sidebar = true;
		}

		if ($has_sidebar) {
			echo '<div class="row">
			<div id="medicll-twocolumns" class="medicll-twocolumns">
			<div class="col-md-9 col-sm-8 col-xs-12' . $content_class . '">';
		}
					
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

		if ($has_sidebar) {
			echo '</div>';
		}

		get_sidebar();

		if ($has_sidebar) {
			echo '</div></div>';
		}
		?>

	</main><!-- #main -->

<?php
get_footer();
