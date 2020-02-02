<?php
/**
 * Block Name: Slick Slider / Carousel
 *
 * This is a slick slider block
 * @var $block
 */

// get image field (array)
$gallery = get_field('gallery');
if(empty($gallery)) return;

// create name attribute
$name = str_replace( 'acf/', '', $block['name'] );

// create id attribute for specific styling
$id = $name . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

$image_size = 'medium';

$categories = get_category(get_query_var('cat'));
if(is_wp_error($categories)) {
	$categories = get_category(1);
}
?>

<section id="<?php echo $id; ?>" class="<?php echo $name; ?> <?php echo $align_class; ?>">

	<div class="grid masonry">
		<div class="grid-sizer"></div>

		<?php

		foreach ($gallery as $image) {
			setup_postdata($image);

			$imageData = get_post($image['id']);
			$imageSrc = wp_get_attachment_metadata($imageData->ID);
			$itemClass = 'item-image-wrap intristic intristic-hoch';

			$gridClass = 'grid-item';
			if($imageSrc['width'] > $imageSrc['height']) {
				// $gridClass .= ' grid-item--width2';
				$itemClass = 'item-image-wrap intristic intristic-quer';
			}

			?>

			<div class="<?php echo $gridClass; ?>">

				<a href="<?php echo wp_get_attachment_image_src($imageData->ID, 'large')[0]; ?>" <?php if( !empty($imageData->post_title) ) { echo ' title="'.$imageData->post_title.'"'  ; } ?> class="swipebox" rel="gallery-<?php echo $categories->slug ?>-<?php echo $categories->term_id ?>">

					<figure class="item-image">
						<?php
						echo '<div class="'.$itemClass.'"><div class="item-overlay">'.voodookit_get_icon('zoom', false).'</div>'.wp_get_attachment_image_lazyload($imageData->ID, 'large', false, array("class" => "intristic-item lazyload")).'</div>';

						echo '<div class="item--caption">';
						if(!empty($imageData->post_title)) {
							echo '<h3>'.$imageData->post_title.'</h3>';
						}
						echo '</div>';

						?>
					</figure>

				</a>

			</div>

			<?php
		}
		?>

	</div>

</section>
