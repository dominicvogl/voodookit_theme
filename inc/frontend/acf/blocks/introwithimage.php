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
	'content' => get_field('content'),
	'image' => get_field('image'),
	'call_to_action' => get_field('call_to_action')
];

if(! function_exists('voodookit_acf_block_get_btn_label')) {

	function voodookit_acf_block_get_btn_label($label) {

		if(empty($label)) {
			return __('get more' , 'voodookit');
		}

		return $label;

	}

}
// create name attribute
$block_classes = [
	str_replace( 'acf/', '', $block['name'] ),
	$block['align'] ? 'align' . $block['align'] : '',
	'intro-block',
	'mod-inner'
];

// create id attribute for specific styling
$block_id = $block_classes[0] . '-' . $block['id'];

$block_classes = trim(implode(' ', $block_classes), ' ');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $block_classes; ?>" style="background-image: url('<?php echo esc_url($fields['image']['url']); ?>')">

	<?php
	if(is_array($fields)) {

		echo '<div class="row"><div class="column">';
		if($fields['title']) {
			echo '<div class="intro-title">'.$fields['title'].'</div>';
		}

		if($fields['content']) {
			echo '<div class="intro-content">'.$fields['content'].'</div>';
		}

		$target = $fields['call_to_action']['target_url'];
		if($fields['call_to_action']['is_anker']) {
			$target = '#' . $fields['call_to_action']['anker_id'];
		}

		if($fields['call_to_action']) {
			echo
				'<div class="button-wrap">
					<a class="button" href="'.$target.'">'.voodookit_acf_block_get_btn_label($fields['call_to_action']['label']).'</a>
				</div>';
		}

		echo '</div></div>';
	}
	?>
</section>
