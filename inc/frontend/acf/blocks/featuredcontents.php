<?php
/**
 * Block Name: Carousel
 *
 * This is a slick slider block
 * @var $block
 */

// get image field (array)
$features = get_field('featuredcontents');

// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : '',
	'feature-list',
	'row'
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];

$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if(is_array($features)) {
		foreach($features as $feature) {
			echo
				'<div class="column small-6 large-3">
					<div class="feature-item">
						<span class="feature-content">'.$feature['content'].'</span>
						<span class="feature-title">'.$feature['label'].'</span>
						<span class="feature-icon">'.$feature['icon'].'</span>
					</div>
				</div>';
		}
	}
	?>

</section>
