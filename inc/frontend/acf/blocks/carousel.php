<?php
/**
 * Block Name: Slick Slider / Carousel
 *
 * This is a slick slider block
 * @var $block
 */

// get image field (array)
$carousel = get_field('block_carousel');
$full_width = get_field('fixed_width');

// create name attribute
$name = str_replace( 'acf/', '', $block['name'] );

// create id attribute for specific styling
$id = $name . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

$classlist = array(
	'js-slick-slider',
	'slick-slider',
	'mod'
);

if($full_width === true) {
	$classlist[] = 'fixed-width';
}

$classlist = implode(' ', $classlist);

?>
<section id="<?php echo $id; ?>" class="<?php echo $name; ?> <?php echo $align_class; ?>">

	<?php
	if(is_array($carousel)) {
		echo '<div class="'.esc_attr($classlist).'">';

		foreach($carousel as $slide) {
			echo
				'<div>
					<span class="slide-title">'.$slide['title'].'</span>
					'.wp_get_attachment_image($slide['image']['id'], 'voodookit-slider', false, ['class' => 'slide-image']).'
				</div>';
		}

		echo '</div>';
	}
	?>

</section>
