<?php
/**
 * Block Name: Table of Contents
 * @var $block
 */

// create name attribute
$block_name = str_replace( 'acf/', '', $block['name'] );
$block_classes = [
	'mod'
];

$additional_links = get_field('additional_links');

// create id attribute for specific styling
$block_id = $block_name . '-' . $block['id'];
$block_classes = trim(implode(' ', $block_classes), ' ');

?>

<section id="<?php esc_attr_e($block_id); ?>" class="<?php esc_attr_e($block_classes); ?>">

	<div class="table-of-contents--wrapper row column">
		<p class="h3">Inhaltsverzeichnis</p>
		<ul class="js--table_of_contents">
			<li class="back">Inhaltsverzeichnis wird geladen ... </li>
		</ul>

		<?php
		if(is_array($additional_links)) {

			echo '<ul>';

			foreach($additional_links as $anker) {
				$post = $anker['target_page'][0];
				setup_postdata($post);

				$target_url = get_permalink($post->ID) . '#' . $anker['anker'];
				echo '<li><a href="'.$target_url.'" target="_self">'.$post->post_title.' <span class="icon icon-external-after">&nbsp;</span></a></li>';
			}

			wp_reset_postdata();

			echo '</ul>';
		}
		?>
	</div>
</section>
