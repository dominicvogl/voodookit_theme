<?php
/**
 * Block Name: Slick Slider / Carousel
 *
 * This is a slick slider block
 * @var $block
 */

// get image field (array)
$carousel = get_field('block_carousel');
$fixed_width = get_field('fixed_width');

// create name attribute
$name = str_replace( 'acf/', '', $block['name'] );

// create id attribute for specific styling
$id = $name . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

$classlist = array(
	'js-slick-slider',
	'slick-slider'
);

$classlist = implode(' ', $classlist);

?>
<section id="<?php echo $id; ?>" class="<?php echo esc_attr($name); ?> <?php echo esc_attr($align_class); ?>">

	<div class="row <?php echo voodookit_check_fixed_width(); ?>">
		<div class="column small-12">

			<?php
			if(is_array($carousel)) {
				echo '<div class="'.esc_attr($classlist).'">';

				foreach($carousel as $slide) {
					echo
						'<div>
							<div class="slide-title">
								<span>'.esc_html($slide['title']).'</span>
							</div>
							'.wp_get_attachment_image($slide['image']['id'], 'voodookit-slider', false, ['class' => 'slide-image']).'
						</div>';
				}

				echo '</div>';
			}
			?>

		</div>
	</div>

</section>
