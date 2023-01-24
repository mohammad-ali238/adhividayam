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
						<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

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
