<?php

function medicll_header_right() {
	ob_start();
	?>
	<div class="medicll-rightarea">
		<div class="medicll-topinfo">
			<ul class="medicll-emails">
				<li><i class="fa fa-envelope-o"></i><a href="domain@domain.com">domain@domain.com</a></li>
				<li><a href="info@domain.com">info@domain.com</a></li>
				<li><i class="fa fa-life-ring"></i><a href="#">Help Desk</a></li>
			</ul>
			<ul class="medicll-socialicons">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
			</ul>
			<div class="dropdown medicll-themedropdown">
				<a id="medicll-languages" class="medicll-btndropdown medicll-btnlanguages" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-commenting-o"></i>
					<span>Language</span>
					<i class="fa  fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu medicll-dropdownmenu" aria-labelledby="medicll-languages">
					<li><a href="#"><img src="images/icon/img-39.jpg" alt="image description">English</a></li>
					<li><a href="#"><img src="images/icon/img-40.jpg" alt="image description">Hindi</a></li>
					<li><a href="#"><img src="images/icon/img-41.jpg" alt="image description">French</a></li>
					<li><a href="#"><img src="images/icon/img-42.jpg" alt="image description">Spanish</a></li>
					<li><a href="#"><img src="images/icon/img-43.jpg" alt="image description">Russian</a></li>
				</ul>
			</div>
		</div>
		<ul class="medicll-addressbox">
			<li>
				<span class="medicll-addressicon"><i class="fa fa-clock-o"></i></span>
				<div class="medicll-addresscontent">
					<strong>Melbourne - Australia</strong>
					<span>We are Near by You</span>
				</div>
			</li>
			<li>
				<span class="medicll-addressicon"><i class="fa fa-phone"></i></span>
				<div class="medicll-addresscontent">
					<strong>(01) 98 765 432 10</strong>
					<span>We are Near by You</span>
				</div>
			</li>
			<li>
				<a class="medicll-btnappointment" href="javascript:void(0);" data-toggle="modal" data-target="#myModal">
					<i class="fa fa-bell-o"></i>
					<em>Appointment</em>
				</a>
			</li>
		</ul>
	</div>
	<?php
	$html = ob_get_clean();

	return apply_filters('medicll_header_right_area', $html);
}

function medicll_header_navigation() {
	?>
	<!-- Navigation -->
	<nav id="medicll-nav" class="medicll-nav">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#medicll-navigation" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<?php
		$args = array(
			'theme_location' => 'menu-1',
			'menu_class' => 'medicll-navbar',
			'container_class' => 'collapse navbar-collapse medicll-navigation',
			'container_id' => 'medicll-navigation',
			'container' => 'div',
			'fallback_cb' => 'medicll_nav_menu_fallback',
		);
		wp_nav_menu($args);
		?>
	</nav>
	<!-- Navigation -->
	<?php
}

function medicll_nav_menu_fallback() {
	$pages = wp_list_pages(array('title_li' => '', 'echo' => false));

	echo '
	<div id="medicll-navigation" class="collapse navbar-collapse medicll-navigation">
	<ul class="medicll-navbar">
		' . $pages . '
	</ul>
	</div>';
}

function medicll_header_main() {
	?>
	<header id="medicll-header" class="medicll-header medicll-haslayout">
		<div class="medicll-topbar">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<strong class="medicll-logo">
							<a href="index.html"><img src="images/logo.png" alt="image description"></a>
						</strong>
						<?php echo medicll_header_right() ?>
					</div>
				</div>
			</div>
		</div>
		<div class="medicll-navigationarea">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<?php medicll_header_navigation() ?>
						<div class="medicll-widgetsearch">
							<form action="index_submit" method="post">
								<fieldset>
									<input type="search" name="search" class="form-control" placeholder="Search Your Queries">
									<button type="submit"><i class="fa fa-search"></i></button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php
}

add_action('medicll_footer_sidebar_widgets', 'medicll_footer_sidebar_widgets', 10);

function medicll_footer_sidebar_widgets() {
	global $mediclf_framework_options;
	$medicll_sidebars = isset($mediclf_framework_options['mediclf-footer-sidebars']) ? $mediclf_framework_options['mediclf-footer-sidebars'] : '';
	$medicll_sidebars_switch = isset($mediclf_framework_options['mediclf-footer-sidebar-switch']) ? $mediclf_framework_options['mediclf-footer-sidebar-switch'] : '';
	
	if ($medicll_sidebars_switch == 'on' && isset($medicll_sidebars['col_width']) && is_array($medicll_sidebars['col_width']) && sizeof($medicll_sidebars['col_width']) > 0) {

		?>
		<div class="medicll-footermiddlebox medicll-sectionspace medicll-haslayout medicll-parallaximg" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/bgparallax/bgparallax-03.jpg">
			<div class="container">
				<div class="row">
					<div class="medicll-fcols">
						<?php
						$sidebar_counter = 0;
						foreach ($medicll_sidebars['col_width'] as $sidebar_col) {
							$sidebar = isset($medicll_sidebars['sidebar_name'][$sidebar_counter]) ? $medicll_sidebars['sidebar_name'][$sidebar_counter] : '';
							if ($sidebar != '') {
								$sidebar_col_arr = explode('_', $sidebar_col);
								$sidebar_col_class = isset($sidebar_col_arr[0]) && $sidebar_col_arr[0] != '' ? 'col-md-' . $sidebar_col_arr[0] : 'col-md-12';
								$sidebar_id = sanitize_title($sidebar);
								//if (is_active_sidebar($sidebar_id)) {
								?>
								<div class="<?php echo($sidebar_col_class) ?> col-sm-6 col-xs-6">
									<?php dynamic_sidebar($sidebar_id) ?>
								</div>
								<?php
								//}
							}
							$sidebar_counter++;
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

add_action('widgets_init', 'medicll_footer_dynamic_sidebars');

function medicll_footer_dynamic_sidebars() {
	global $mediclf_framework_options;

	$before_title = '<div class="medicll-borderheading"><h3>';
	$after_title = '</h3></div>';

	$medicll_sidebars = isset($mediclf_framework_options['mediclf-footer-sidebars']) ? $mediclf_framework_options['mediclf-footer-sidebars'] : '';
	if (isset($medicll_sidebars['col_width']) && is_array($medicll_sidebars['col_width']) && sizeof($medicll_sidebars['col_width']) > 0) {
		$sidebar_counter = 0;
		foreach ($medicll_sidebars['col_width'] as $sidebar_col) {
			$sidebar = isset($medicll_sidebars['sidebar_name'][$sidebar_counter]) ? $medicll_sidebars['sidebar_name'][$sidebar_counter] : '';
			if ($sidebar != '') {
				$sidebar_id = urldecode(sanitize_title($sidebar));
				register_sidebar(array(
					'name' => $sidebar,
					'id' => $sidebar_id,
					'description' => esc_html__('Add only one widget here.', 'medicll'),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => $before_title,
					'after_title' => $after_title,
				));
			}
			$sidebar_counter++;
		}
	}
}

function medicll_footer_main() {
	?>
	<footer id="medicll-footer" class="medicll-footer medicll-haslayout">
		<div class="medicll-footertopbar">
			<div class="container">
				<div class="row">
					<ul class="medicll-fservices">
						<li>
							<span class="medicll-fserviceicon"><i class="fa fa-ambulance"></i></span>
							<div class="medicll-contentbox">
								<strong>Ambulance <span>Service</span></strong>
							</div>
						</li>
						<li>
							<span class="medicll-fserviceicon"><i class="fa fa-user-md"></i></span>
							<div class="medicll-contentbox">
								<strong>Intensive <span>Care Unit</span></strong>
							</div>
						</li>
						<li>
							<span class="medicll-fserviceicon"><i class="fa fa-heartbeat"></i></span>
							<div class="medicll-contentbox">
								<strong>24/7 Emergency <span>Admissions</span></strong>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php do_action('medicll_footer_sidebar_widgets'); ?>
		<div class="medicll-footerbottombar">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<span class="medicll-copyright">&copy; Copyrights 2016. Adhividayam All Rights Reserved</span>
						<nav class="medicll-footernav">
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Projects</a></li>
								<li><a href="#">Help</a></li>
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php
}