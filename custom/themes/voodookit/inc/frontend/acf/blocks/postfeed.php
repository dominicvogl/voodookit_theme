<?php
/**
 * Block Name: Postloop / Pageloop
 *
 * This is the template that display a Postloop
 * @var $block
 */

// get fields from block
$post_type = get_field('post_type');
$post_num = get_field('post_num');

$posts = get_posts([
	'posts_per_page' => $post_num,
	'post_type' => $post_type,
	'orderby' => 'DESC'
]);

// create name attribute
$name = str_replace( 'acf/', '', $block['name'] );

// create id attribute for specific styling
$id = $name . '-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<section id="<?php echo $id; ?>" class="<?php echo $name; ?> <?php echo $align_class; ?>">

	<?php
	if(is_array($posts)) {

		echo '<div class="mod">';
		echo '<div class="js-postloop-carousel card-loop">';
		foreach($posts as $post) {
			setup_postdata($post);
			?>

			<div id="post-<?php echo $post->ID; ?>" class="card">
				<div class="card-divider">
					<h3><?php echo get_the_title($post->ID); ?></h3>
				</div>
				<?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
				<div class="card-section">
					<?php echo get_the_excerpt(); ?>
				</div>
			</div>

			<?php
		}
		echo '</div>';
		echo '</div>';

		wp_reset_postdata();
	}
	?>

</section>
