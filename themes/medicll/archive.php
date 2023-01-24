<?php

/**
 * The template for displaying archive pages
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
				global $mediclf_framework_options;
				$layout = isset($mediclf_framework_options['mediclf-default-layout']) ? $mediclf_framework_options['mediclf-default-layout'] : '';
				if ($layout == 'right' || $layout == 'left') {
					$has_sidebar = true;
					$content_class = $layout == 'left' ? ' pull-right' : ' pull-left';
				} else if (is_active_sidebar('sidebar-1') && $layout == '') {
					$has_sidebar = true;
				}
				?>
				<div class="<?php echo ($has_sidebar ? 'col-md-9 col-sm-8' . $content_class : 'col-md-12 col-sm-12') ?> col-xs-12">

					<?php if (have_posts()) : ?>

						<header class="page-header">
							<?php
							the_archive_title('<h1 class="page-title">', '</h1>');
							the_archive_description('<div class="archive-description">', '</div>');
							?>
						</header><!-- .page-header -->

					<?php
						/* Start the Loop */
						while (have_posts()) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part('template-parts/content', get_post_type());

						endwhile;

						the_posts_navigation();

					else :

						get_template_part('template-parts/content', 'none');

					endif;
					?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
