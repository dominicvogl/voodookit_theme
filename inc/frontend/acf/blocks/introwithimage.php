<?php
/**
 * Block Name: Intro with image
 *
 * This is a intro element
 * @var $block
 */

// get image field (array)
$fields = [
	'title' => get_field('title'),
	'subtitle' => get_field('subtitle'),
	'content' => get_field('content'),
	'image' => get_field('image'),
	'call_to_action' => get_field('call_to_action'),
	'bg_icon' => get_field('bg_icon'),
	'bg_color' => get_field('bg_color'),
	'intro_style' => get_field('intro_style')
];

$image = $fields['image'];

// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : '',
	$fields['intro_style'],
	'intro-block'
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];

$block_classes = trim(implode(' ', $block_classes), ' ');

$blockstyles = [];
if($fields['bg_color']) {
	$blockstyles[] = 'background-color: '.$fields['bg_color'].';';
}

$blockstyles = esc_attr( implode( ' ', $blockstyles ) );

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>" style="<?php echo $blockstyles; ?>">

	<?php

	if ( $fields['bg_icon'] ) {
		echo
			'<div class="intro-block-icon">
			' . wp_get_attachment_image( $fields['bg_icon']['id'] ) . '
		</div>';
	}

	if(is_array($fields)) {

		if($image) {
			echo wp_get_attachment_image($image['id'], 'voodookit-slider', false, $args = array('class' => 'intro-image'));
		}

		echo '<div class="intro-overlay"><div class="row"><div class="intro-overlay--content">';

		echo ($fields['subtitle']) ? '<h2 class="intro-subtitle">'.esc_html($fields['subtitle']).'</h2>' : '';
		echo ($fields['title']) ? '<h1 class="intro-title">'.esc_html($fields['title']).'</h1>' : '';

		if($fields['content']) {
			echo '<div class="intro-content">'.$fields['content'].'</div>';
		}

		$target = $fields['call_to_action']['target_url'];
		if($fields['call_to_action']['is_anker']) {
			$target = '#' . $fields['call_to_action']['anker_id'];
		}

		if($fields['call_to_action']) {
			voodookit_get_button($target, $fields['call_to_action']['label'], 'button icon-keyboard_arrow_right-after');
		}

		echo '</div></div></div>';
	}
	?>
</section>

<?php

voodookit_nav_breadcrumb();

?>
