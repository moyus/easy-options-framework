<?php  
/**
 * EOF Rich Editor Field Class
 *
 * All the logic for this field type
 *
 * @class       EOF_field_rich_editor
 * @extends     EOF_field
 * @package     EOF
 * @subpackages Fields
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field_rich_editor') ) :

class EOF_field_rich_editor extends EOF_field {

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
			'rows'			=> 20,
			'sizes'			=> 'large',
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
		global $wp_version;
		
		$class = '';

		switch ($this->field['sizes']) {
			case "small":
				$class .= ' small-text';
				break;
			case "large":
				$class .= ' large-text';
				break;
			default:
				$class .= ' regular-text';
				break;
		}

		if( $wp_version >= 3.3 && function_exists('wp_editor') ) {
			wp_editor(stripslashes($this->value), $this->option_id, array( 'textarea_name' => $this->option_name, 'textarea_rows' => $this->field['rows'] ));
		} else {

		?>
		<textarea class="<?php echo $class; ?>" name="<?php echo $this->option_name; ?>" id="<?php echo $this->option_id; ?>" rows="<?php echo $this->field['rows'] ?>"><?php echo esc_textarea( stripslashes( $this->value ) ); ?></textarea>
		<?php
		}
	?>
		<br/>
		<p class="description"><?php echo $this->field['desc']; ?></p>
	<?php
	}

	public function sanitize( $value ) {

		$sanitize_value = $value;

		return $sanitize_value;
	}

}

endif;

?>