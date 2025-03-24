<?php if (!defined('EASY_MEDIA_UPLOAD')) {
    header('HTTP/1.0 403 Forbidden');
    exit; // Prevent direct access
}
function EasyMedia($mediaName) { ?>
	<?php $image_id = get_option($mediaName); ?>
	<?php if( $image = wp_get_attachment_image_url( $image_id, 'medium' ) ) : ?>
		<div class="p-abs">
	<a href="#" class="easy-upload">
		<img src="<?php echo esc_url( $image ) ?>" width="200px" />
	</a>
	<a href="#" class="easy-remove">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
			<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
		</svg>
	</a>
	<input type="hidden" name="<?php echo $mediaName ?>" value="<?php echo absint( $image_id ) ?>">
	<div>
<?php else : ?>
	<div class="p-abs">
	<a href="#" class="button easy-upload">Upload image</a>
	<a href="#" class="easy-remove" style="display:none">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
			<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
		</svg>
	</a>
	<input type="hidden" name="<?php echo $mediaName ?>" value="">
	<div>
<?php endif; ?>
<?php
}
