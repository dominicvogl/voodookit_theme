<?php
/**
 * Block Name: Accordion
 * @var $block
 */

// get image field (array)
$accordion = get_field('accordion');

// create name attribute
$block_name = str_replace( 'acf/', '', $block['name'] );
$block_classes = [
	$block['align'] ? 'align' . $block['align'] : '',
	'mod',
];


// create id attribute for specific styling
$block_id = $block_name . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if(is_array($accordion)) {
		?>

		<div class="row">
			<div class="column small-12 medium-10 medium-offset-1">

				<div class="js--accordion accordion">

					<?php
					foreach($accordion as $item) {
						?>
						<div class="accordion-item">
							<h3 class="accordion-headline"><?php echo esc_html($item['headline']); ?><span class="accordion-show-details icon-keyboard_arrow_right-after"><?php _e('show details', 'voodookit'); ?></span></h3>
							<div class="accordion-content"><?php echo $item['content']; ?></div>
						</div>
						<?php
					}
					?>

				</div>

			</div>
		</div>

		<?php
	}
	?>
</section>
