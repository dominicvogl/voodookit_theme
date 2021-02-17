<?php
/**
 * Block Name: Image Page Carousel
 * @var $block
 */

// get image field (array)
$carousel = get_field('carousel');
$headline = get_field('headline');
$bg_color = get_field('bg_color');

// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : '',
	'mod',
	(!empty($bg_color)) ? $bg_color : 'blue'
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>">

	<?php
	if(is_array($carousel)) {

		if(!empty($headline)) {
			?>
			<div class="text-center">
				<h2><?php echo $headline; ?></h2>
			</div>
			<?php
		}
		?>

		<!-- Additional required wrapper -->
		<div class="js-pageloop-carousel pageloop-carousel slick-slider">
			<!-- Slides -->
			<?php
			$count = 1;
			foreach($carousel as $item) {

				$url = wp_get_attachment_url($item['image']['id']);

				?>
				<div class="slide--teaser">
					<div class="slide--teaser-wrapper" style="background-image: url('<?php echo $url; ?>');">
						<a href="<?php echo ($item['linktype'] === 'custom') ? esc_url($item['url']) : $item['pagelink']; ?>">
							<span class="slide--counter"><?php echo $count; ?></span>
							<span class="slide--headline"><?php echo esc_html($item['descripion']); ?></span>
						</a>
					</div>
				</div>

				<?php
				$count++;
			}
			?>
		</div>

		<?php
		}
	?>
</section>
