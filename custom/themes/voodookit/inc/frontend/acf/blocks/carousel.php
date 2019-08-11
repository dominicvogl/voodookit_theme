<?php
/**
 * Block Name: Testimonial
 *
 * This is the template that displays the testimonial block.
 * @var $block
 */

// get image field (array)
$carousel = get_field('block_carousel');

// create name attribute
$name = str_replace( 'acf/', '', $block['name'] );

// create id attribute for specific styling
$id = $name . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<section id="<?php echo $id; ?>" class="<?php echo $name; ?> <?php echo $align_class; ?>">

	<?php
	if(is_array($carousel)) {
		echo '<div class="slick-slider">';
		foreach($carousel as $slide) {
			echo '<div>';
			echo '<span>'.$slide['title'].'</span>';
			echo wp_get_attachment_image($slide['image']['id'], 'large');
			echo '</div>';
		}
		echo '</div>';
	}
	?>

</section>
