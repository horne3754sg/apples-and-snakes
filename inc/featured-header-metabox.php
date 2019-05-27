<?php


class featured_header_metabox
{
	public function __construct()
	{
		
		add_action('add_meta_boxes', array($this, 'featured_header_add_metabox'));
		add_action('save_post', array($this, 'save_featured_header_metabox'));
	}
	
	/**
	 * Add Case Study background image metabox to the back end of Case Study posts
	 */
	function featured_header_add_metabox()
	{
		add_meta_box('featured_header_image', 'Featured Header Image', array(
			$this,
			'featured_header_metabox'
		), array('event', 'post', 'page', 'opportunities'), 'side', 'high');
	}
	
	/**
	 * Create Area icon image metabox
	 */
	function featured_header_metabox($post)
	{
		wp_nonce_field('featured_header_submit', 'featured_header_nonce');
		$meta = get_post_meta($post->ID);
		//		var_dump( $meta );
		?>
		<div class="featured_header_image">
			<img id="featured-header-image-preview"
			     src="<?php echo(isset ($meta['featured-header-image']) ? $meta['featured-header-image'][0] : ''); ?>"/><br/>
			<input type="text" name="featured-header-image" id="featured-header-image" class="meta_image"
			       value="<?php echo(isset ($meta['featured-header-image']) ? $meta['featured-header-image'][0] : ''); ?>"/>
			<input type="button" id="featured-header-image-button" class="button" value="Choose or Upload an Image"/>
		</div>
		<script>
			jQuery('#featured-header-image-button').click(function() {
				
				var send_attachment_bkp = wp.media.editor.send.attachment;
				
				wp.media.editor.send.attachment = function(props, attachment) {
					
					jQuery('#featured-header-image').val(attachment.url);
					jQuery('#featured-header-image-preview').attr('src', attachment.url);
					wp.media.editor.send.attachment = send_attachment_bkp;
				};
				
				wp.media.editor.open();
				
				return false;
			});
		</script>
		<style>
			.meta_option {
				display: block;
				margin-top: 10px;
				margin-bottom: 10px;
			}

			.meta_option label {
				font-weight: bold;
				display: block;
			}

			.meta_option .input_option {
				display: block;
				width: 100%;
			}
		</style>
		
		<?php
		
	}
	
	/**
	 * Save background image metabox for Case Study posts
	 */
	function save_featured_header_metabox($post_id)
	{
		$is_autosave = wp_is_post_autosave($post_id);
		$is_revision = wp_is_post_revision($post_id);
		$is_valid_nonce = (isset($_POST['featured_header_nonce']) && wp_verify_nonce($_POST['featured_header_nonce'], 'featured_header_submit')) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ($is_autosave || $is_revision || !$is_valid_nonce)
		{
			return;
		}
		
		// Checks for input and sanitizes/saves if needed
		if (isset($_POST['featured-header-image']))
		{
			update_post_meta($post_id, 'featured-header-image', $_POST['featured-header-image']);
		}
	}
}

new featured_header_metabox();
