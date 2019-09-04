<?php
/**
 * Block Name: Image and content
 * @var $block
 */

// get image field (array)
$fields = array(
	'content' => get_field('content'),
	'image' => get_field('image'),
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
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if(is_array($fields)) {

		echo '<div class="row align-middle">';

		echo '<div class="column">';
		echo '<div class="image-wrap">';
		echo wp_get_attachment_image( $fields['image']['ID'], 'large');
		echo '</div>';
		echo '</div>';

		echo '<div class="column">';
		echo '<div class="content-wrap">'.$fields['content'].'</div>';
		echo '</div>';

		echo '</div>';
	}
	?>
</section>
