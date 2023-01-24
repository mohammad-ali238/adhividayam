<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package medicll
 */

get_header();
?>

	<main id="medicll-main" class="medicll-main medicll-haslayout">
		<div class="container">
			<div class="row">
				<div id="medicll-twocolumns" class="medicll-twocolumns">
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
					?>
					<div class="<?php echo ($has_sidebar ? 'col-md-9 col-sm-8' . $content_class : 'col-md-12 col-sm-12') ?> col-xs-12">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
