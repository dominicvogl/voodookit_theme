<?php
/**
 * Block Name: Image and content
 * @var $block
 */

// get image field (array)
$fields = get_fields();

// create name attribute
$block_classes = [
	str_replace('acf/', '', $block['name']),
	$block['align'] ? 'align' . $block['align'] : '',
	'mod',
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>"
		 class="<?php echo $block_classes; ?> image-direction--<?php echo $fields['image_direction']['value']; ?>">

	<?php
	if (is_array($fields)) {

		$cta = $fields['call_to_action'];
		$image = $fields['image'];
		$target = voodookit_build_target_url($cta);

		?>

		<div class="row medium-collapse align-stretch">
			<div class="column small-12 medium-5 column--image">
				<div class="image-wrapper">
					<?php
					if (!empty($image['ID'])) {
						echo wp_get_attachment_image($image['ID'], 'large');
					}
					?>
				</div>
			</div>

			<div class="column small-12 medium-7 column--content">
				<div class="content--wrapper-inner">
					<header>
						<h4><?php echo esc_html($fields['subtitle']); ?></h4>
						<h3><?php echo esc_html($fields['title']); ?></h3>
					</header>
					<div class="content--wrapper">
						<?php
						if(key_exists('is_wysiwyg', $fields) && $fields['is_wysiwyg']) {
							echo $fields['content_wysiwyg'];
						}
						else {
							echo esc_html($fields['content']);
						}
						?>
					</div>
					<?php voodookit_get_button($target, $cta['label'], 'button icon-keyboard_arrow_right-after'); ?>
				</div>
			</div>
		</div>

		<?php
	}
	?>
</section>
