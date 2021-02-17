<?php
/**
 * Block Name: Small Teaser
 *
 * Small Teaser Block for Content Crosslinking
 * @var $block
 */

// get image field (array)
$small_teaser = get_field('small_teaser');
$fixed_width = get_field('fixed_width');

// create name attribute
$name = str_replace( 'acf/', '', $block['name'] );

// create id attribute for specific styling
$id = $name . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

$classlist = array(
	$name,
	'small_teaser',
	'mod'
);

$classlist = implode(' ', $classlist);

?>
<section id="<?php echo $id; ?>" class="<?php echo esc_attr(trim($classlist)); ?> <?php echo esc_attr($align_class); ?>">

	<div class="<?php echo esc_attr(trim('row' . voodookit_check_fixed_width()) ); ?>">

		<?php

		// check if there is an array with conents
		if(is_array($small_teaser)) {

			$teaser_num = count($small_teaser);

			$column_classes = array('column', 'small-12');

			if($teaser_num === 2) {
				$column_classes[] = 'medium-6';
			}
			else if($teaser_num === 4) {
				$column_classes[] = 'medium-6 large-3 ';
			}
			else {
				$column_classes[] = 'medium-6 large-4';
			}

			$column_classes = implode(' ', $column_classes);

			// loop through
			foreach($small_teaser as $teaser) {

				// define some variables
				$image = $teaser['image'];
				$link_url = ($teaser['linktype'] === 'external') ? $teaser['externer_link__anker'] : $teaser['pagelink'];

				?>
				<!-- Small Teaser Block -->
				<div class="<?php esc_attr_e($column_classes); ?>">
					<div class="small_teaser--wrapper">

						<?php
						if (empty($link_url) ) { ?>
							<div>
								<?php echo wp_get_attachment_image($image['ID'], 'voodookit-small-teaser'); ?>
								<span class="small_teaser--title"><?php echo $teaser['label']; ?></span>
							</div>
						<?php
						}
						else { ?>
						<a href="<?php echo $link_url; ?>" title="<?php echo $teaser['label']; ?>">
							<?php echo wp_get_attachment_image($image['ID'], 'voodookit-small-teaser'); ?>
							<span class="small_teaser--title"><?php echo $teaser['label']; ?></span>
						</a>

						<?php } ?>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>

</section>
