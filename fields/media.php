<?php  
/**
 * EOF Media Uploader Field Class
 *
 * All the logic for this field type
 *
 * @class       EOF_field_media
 * @extends     EOF_field
 * @package     EOF
 * @subpackages Fields
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field_media') ) :

class EOF_field_media extends EOF_field {

	/**
	 * __construct
	 *
	 * This function will setup the field type data
	 * 
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct( $field, $value, $parent ) {
		//vars
		$this->parent = $parent;
		$this->option_name = $field['option_name'];
		$this->option_id   = parent::beautifyid($field['option_name']);

		$this->value = $value;
		$this->field = wp_parse_args( $field, array(
			'id'			=> '',
			'title'			=> '',
			'desc'			=> '',
			'default' 		=> '',
			'sizes'			=> 'regular',
			'preview'		=> false
		) );

		// If value does not set, use the default
		if( is_null($this->value) ) {
			$this->value = $this->field['default'];
		}

		parent::__construct($this->field);
	}

	/**
	 * Enqueue scripts
	 *
	 * Enqueue scripts and styles that field needed
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function admin_enqueue_scripts() {
		if( is_admin() ) {
			wp_enqueue_media();
		}
	}
	
	/**
	 * Render field
	 *
	 * Create the HTML interface for your field
	 *
	 * @param $field - an array holding all the field's data
	 *
	 * @since 1.0
	 * @return void
	 */
	public function render_field() {

		$preview = $this->field['preview'];

		$class = '';
		switch ($this->field['sizes']) {
			case "small":
				$class .= ' small-text';
				break;
			case "large":
				$class .= ' small-text';
				break;
			default:
				$class .= ' regular-text';
				break;
		}
	?>
		<input type="text" class="<?php echo esc_attr($class); ?>" id="<?php echo esc_attr($this->option_id); ?>" name="<?php echo esc_attr($this->option_name); ?>" value="<?php echo esc_attr($this->value); ?>" /> 
    	<input class="button eof-media-button" type="button" data-input-id="<?php echo esc_attr($this->option_id); ?>" value="<?php _e('Upload', 'eof'); ?>" />
    	<?php  if(isset($this->value) && !empty($this->value)) : ?>
    	<input class="button eof-media-delete-button" type="button" data-input-id="<?php echo esc_attr($this->option_id); ?>" value="<?php _e('Delete', 'eof'); ?>" />
    	<br>
    		<?php if($preview) : ?>
    		<p class="image-preview"><img src="<?php echo esc_attr($this->value); ?>" alt="" style="max-width:100%;"></p>
    		<?php endif; ?>
    	<?php endif; ?>
		<span class="description"><?php echo $this->field['desc']; ?></span>
	<?php
	}

	public function sanitize( $value ) {

		$sanitize_value = strip_tags($value);

		return $sanitize_value;
	}

}

endif;

?>