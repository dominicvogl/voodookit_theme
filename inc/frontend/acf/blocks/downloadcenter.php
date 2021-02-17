<?php
/**
 * Block Name: Download Center
 * 
 * This is primarely a download center for pdf files
 * @var $block
 */


// get image field (array)
$downloads = get_field('downloads');

if(empty($downloads)) {
	return;
}

// get block name, split string
$block_name = str_replace( 'acf/', '', $block['name'] );

// set temporary informations for block
$block_data = array(
	'name' => $block_name,
	'block_slug' => $block_name . '-' . $block['id'],
	'image_size' => 'voodookit-carousel',
);

// unset temporary variable
unset($block_name);

?>

<section id="<?php echo $block_data['block_slug']; ?>" class="<?php echo $block_data['name']; ?>">

	<?php
	foreach($downloads as $download) {
		$file = $download['file'];
		?>
		<div class="card dl--card">
			<div class="dl--image">
				<?php
				if(!empty(wp_get_attachment_image( $file['ID']))) {
					echo wp_get_attachment_image( $file['ID'] , $block_data['image_size']);
				}
				?>
			</div>
			<div class="dl--content">
				<h3 class="dl--title"><?php echo $file['title']; ?></h3>
				<span class="dl--description"><?php echo esc_html($file['description']); ?></span>
				<span class="dl--caption"><?php echo esc_html($file['caption']); ?></span>
				<div class="dl--button-wrapper">
					<?php voodookit_get_button( $file['url'], __('download file now', 'voodookit'), 'button icon-cloud-download-after'); ?>
					<span class="dl--filesize"><?php echo __('filesize ', 'voodookit'); ?><b><?php echo (ceil($file['filesize'] / 1024)) . ' ' . __('kb', 'voodookit'); ?></b></span>
				</div>
			</div>
		</div>
		<?php
	}
	?>

</section>
