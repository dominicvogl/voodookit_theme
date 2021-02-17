<?php
/**
 * Block Name: Two Teaser
 * @var $block
 */

// get image field (array)
$teaser = get_field('teaser');
$secondteaser = get_field('second_teaser');

$field_groups = array(
	$teaser,
	$secondteaser['teaser']
);


// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : ''
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes) );

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if(is_array($field_groups)) {

		?>
		<div class="row full-width small-collapse">
		<?php

		foreach($field_groups as $group) {

			$cta = $group['call_to_action'];
			$image = $group['image'];
			$target = ($cta['is_anker']) ? $cta['anker_id'] : $cta['target_url'];
			$is_inverted_class = ($group['is_inverted']) ? 'inverted' :  ''

			?>

			<div class="column small-12 medium-6 teaser_group <?php echo $is_inverted_class; ?>">
				<div class="teaser_image">
					<?php echo wp_get_attachment_image($image['ID'], 'large'); ?>
					<div class="teaser_group--overlay">
						<h3 class="teaser_group--headline"><?php echo esc_html($group['headline']); ?></h3>
					</div>
				</div>
				<div class="teaser_content">
					<div class="teaser_group--content">
						<h3><?php echo esc_html($group['headline']); ?></h3>
						<?php echo $group['content']; ?>
					</div>
					<div class="teaser_group--cta">
						<?php voodookit_get_button($target, $cta['label'], 'button icon-keyboard_arrow_right-after'); ?>
					</div>
				</div>

			</div>

		<?php
		}

		?>
		</div>
		<?php
	}
	?>
</section>
