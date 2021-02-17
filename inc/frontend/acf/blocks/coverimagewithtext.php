<?php
/**
 * Block Name: Image and content
 * @var $block
 */

// get image field (array)
$fields = array(
	'content' => get_field('content'),
	'image' => get_field('image'),
	'fixed_width' => get_field('fixed_width'),
);


// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : '',
	'mod',
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php esc_attr_e($block_id); ?>" class="<?php esc_attr_e($block_classes); ?>">

	<?php
	if(is_array($fields)) {

		echo '<div class="image-wrap">';
		echo wp_get_attachment_image( $fields['image']['ID'], 'large');
		echo '<div class="overlay">
			<span class="overlay--subheadline">'. esc_html($fields['content']['subheadline']) .'</span>
			<span class="overlay--headline">'. esc_html($fields['content']['headline']) .'</span>
		</div>';
		echo '</div>';
	}
	?>
</section>
