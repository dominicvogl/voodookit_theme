<?php
/**
 * Block Name: Google Maps
 *
 * This is google maps api block
 * @var $block
 */

// get google maps api key
$maps = get_field('google_maps_api');
$google_maps_api_key = get_field('google_maps_api_key', 'option');

// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : '',
	'google_maps'
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if( $google_maps_api_key ) { ?>
		<div class="acf-map" data-zoom="12">
			<div class="marker" data-lat="<?php echo esc_attr($maps['lat']); ?>" data-lng="<?php echo esc_attr($maps['lng']); ?>"></div>
		</div>
	<?php } ?>

</section>
