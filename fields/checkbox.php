<?php  
/**
 * TOF Checkbox Field Class
 *
 * All the logic for this field type
 *
 * @class       EOF_field_checkbox
 * @extends     EOF_field
 * @package     EOF
 * @subpackages Fields
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('EOF_field_checkbox') ) :

class EOF_field_checkbox extends EOF_field {

	/**
	 * __construct
	 *
	 * This function will setup the field type data
	 * 
	 * @since 1.0
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
			'default' 		=> null,
			'readonly'		=> false,
			'style'			=> 1,
			'options'		=> null,
		) );

		// If value does not set, use the default
		/* @todo
		if( is_null($this->value) ) {
			$this->value = $this->field['default'];
		}
		*/

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

		// multicheck
		if( isset($this->field['options']) && $this->field['options'] != null) {

			$values = (array) $this->value;

			foreach ($this->field['options'] as $key => $label) {
				$enabled = null;
				
				if( in_array($key, $values) ) {
					$enabled = 1;
				}
				if( isset($this->field['style']) && $this->field['style'] == 2 ) {
			?>
				<label for="<?php echo "{$this->option_name}[]"; ?>" style="display:inline-block;margin-right:10px;">
				<input type="checkbox" name="<?php echo "{$this->option_name}[]"; ?>" id="<?php echo $this->option_id; ?>" value="<?php echo $key ?>" <?php checked( 1, $enabled, true ); ?> >
				<?php echo $label; ?></label>
			<?php
				} else {
			?>
				<input type="checkbox" name="<?php echo "{$this->option_name}[]"; ?>" id="<?php echo $this->option_id; ?>" value="<?php echo $key ?>" <?php checked( 1, $enabled, true ); ?> >
				<label for="<?php echo "{$this->option_name}[]"; ?>"><?php echo $label; ?></label>
				<br>
			<?php
				}
			}
			echo  '<p class="description" style="margin-top:15px;">' . $this->field['desc'] . '</p>';
		} else {
	?>	
		<input type="checkbox" name="<?php echo $this->option_name; ?>" id="<?php echo $this->option_id; ?>" value="1" <?php checked( 1, $this->value, true ); ?> >
		<span class="description"><?php echo $this->field['desc']; ?></span>
	<?php
		}
	}

	public function sanitize( $value ) {
		$sanitize_value = null;

		if( is_array($value) ) {
			$sanitize_value = $value;
		} else {
			$sanitize_value = ($value) ? '1' : '0';
		}
		
		return $sanitize_value;
	}

}

endif;

?>