<?php
/**
 * This is Voodookit!
 *
 * @package Voodookit
 * @since 1.0.1
 * @verson 1.1
 */


/**
 * Render footer template and all the stuff
 */

if(! function_exists('voodookit_footer') ) {

	function voodookit_footer() {

		$logo = voodookit_get_logo_src();
		?>

		<footer class="mod mod-inner">
			<div class="row">

				<div class="column small-12 large-4">

					<div class="footer--logo logo">
						<a href="<?php echo get_home_url(); ?>"><img src="<?php echo esc_url($logo['logo_src']); ?>" width="<?php echo $logo['logo_sizes'][0]; ?>" height="<?php echo esc_attr($logo['logo_sizes'][1]); ?>" alt="<?php _e('Logo of: ','voodookit'); ?><?php echo esc_attr(bloginfo('name')); ?>"></a>
					</div>

					<?php // @todo make editable via backend, later ?>
					<!-- Address Block -->
					<address class="footer-address">
						<h3><?php _e('contact us', 'voodookit'); ?></h3>
						<p><strong>Catalyst-Interactive</strong><br>Sterntalerring 58<br>95447 Bayreuth, Germany</p>
						<?php voodookit_get_icon('phone-square'); ?> <a href="tel:+491718387615">+49 (0) 171 83 87 615</a><br>
						<?php voodookit_get_icon('envelope-square'); ?> <a href="mailto:hello@dominicvogl.de" target="_blank">hello@dominicvogl.de</a>
					</address>
				</div>

				<div class="column small-12 large-4">
					<h3><?php _e('business hours', 'voodookit'); ?></h3>
					Mo. - Fr. 9am - 6pm<br>
					Sa./So. from 8am - 6pm opened

					<hr>

					<h3><?php _e('social media', 'voodookit'); ?></h3>
					<ul class="footer--social-links social-links">
						<li><a href="#">FB</a></li>
						<li><a href="#">IG</a></li>
						<li><a href="#">PI</a></li>
						<li><a href="#">WA</a></li>
						<li><a href="#">TE</a></li>
					</ul>
				</div>

				<div class="column small-12 large-4">
					<h3><?php _e('navigation', 'voodookit'); ?></h3>
					<?php
					wp_nav_menu(array(
						'container' => 'nav',
						'container_class' => 'footer--nav navigation',
						'menu' => 'footer-nav',
						'menu_class' => 'menu vertical',
						'theme_location' => 'footer'
					));
					?>
				</div>

			</div>
		</footer>

		<?php
	}

}

/**
 * Render template copyright
 */

if (!function_exists('voodookit_copyright')) {

	function voodookit_copyright() {

		if (get_theme_mod('evolution_footer_hide') === true) return;
		?>

		<div class="column small-12">
			<div class="footer-copyright text-center">
				<?php // @todo make editable via backend, later ?>
				<p><?php _e('This framework was made with Wordpress, Voodookit and'); ?> <?php voodookit_get_icon('heart-full'); ?> <?php _e('by'); ?> <a href="//dominicvogl.de" target="_blank"><?php _e('Author', 'voodookit'); ?></a></p>
			</div>
		</div>
		<?php

	}

}


/**
 * prepared but currently not used function for adding something over the footer
 */

if (! function_exists('voodookit_before_footer') ) {

	function voodookit_before_footer() {
		return NULL;
	}

}


if(! function_exists('voo_scrollToTop_button')) {

	function voo_scrollToTop_button() {

		echo '<button class="js-scroll-to-top button-scroll-to-top"><span class="icon icon-keyboard_arrow_top"></span></button>';

	}

}
