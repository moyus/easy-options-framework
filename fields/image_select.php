<?php  
/**
 * TOF Image Select Field Class
 *
 * All the logic for this field type
 *
 * @class       EOF_field_image_select
 * @extends     EOF_field
 * @package     EOF
 * @subpackages Fields
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field_image_select') ) :

class EOF_field_image_select extends EOF_field {

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
			'options'		=> null,
			/*
			array(
				'value' => array(
					'img_url' => '',
					'label' => ''
				),
			)
			*/
			'readonly'		=> false,
		) );

		// If value does not set, use the default
		if( is_null($this->value) ) {
			$this->value = $this->field['default'];
		}

		parent::__construct($this->field);
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

		$options = (array) $this->field['options'];

		foreach ($options as $key => $option) {
			$enabled = null;
			$values = (array) $this->value;
			if( in_array($key, $values) ) {
				$enabled = 1;
			}
		?>
				<label for="<?php echo esc_attr($this->option_name); ?>" style="display:inline-block;margin-right:15px;">
				<input type="radio" name="<?php echo esc_attr($this->option_name); ?>" id="<?php echo esc_attr($this->option_id); ?>" data-image="<?php echo esc_attr($option['img_url']); ?>" class="radioImageSelect" value="<?php echo esc_attr($key) ?>" <?php checked( 1, $enabled, true ); ?> >
				<p style="text-align:center;"><?php echo esc_html($option['label']); ?></p></label>
			<?php
		}
		echo  '<p class="description" style="margin-top:15px;">' . $this->field['desc'] . '</p>';
	}

	public function sanitize( $input ) {

		return $input;
	}

}

endif;

?>