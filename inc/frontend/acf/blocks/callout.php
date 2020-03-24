<?php
/**
 * Block Name: Callout
 * @var $block
 */

// get image field (array)
$fields = get_fields(); // content, color, alignment
$callout_classes = array(
	'callout-wrapper',
	$fields['color'],
	$fields['alignment'],
	(!empty($fields['solid']) && $fields['solid']) ? 'solid' : ''
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
		?>
		<div class="<?php echo implode(' ', $callout_classes); ?>">
			<div class="callout">
				<?php echo $fields['content']; ?>
			</div>
		</div>
		<?php
	}
	?>
</section>
