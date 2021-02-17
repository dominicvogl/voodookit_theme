<?php
/**
 * Block Name: Image gallery
 *
 * image gallery with lazy load
 * @var $block
 */

// get image field (array)
$fields = [
	'gallery' => get_field('lazy_gallery')
];

// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : ''
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];

// get block classes
$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if(is_array($fields)) {

		echo '<ul class="row js-lightgallery ">';

		foreach($fields['gallery'] as $image) {

			$size = 'voodookit-image-teaser';

			$image_alt = get_image_caption( $image['ID'] );
			?>

			<li data-src="<?php esc_attr_e($image['url']); ?>" class="column small-6 large-4">
				<div class="swipebox">
					<?php echo wp_get_attachment_image($image['ID'], $size, false, array('alt' => $image_alt) ); ?>

					<div class="image--overlay">
						<span><?php esc_html_e($image['title']); ?></span>
					</div>
				</div>
			</li>

			<?php
		}

		echo '</ul>';
	}
	?>

</section>
