<?php  
/**
 * Easy Options Framework
 *
 * @package   EOF
 * @author    moyu <moyuboy@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.20theme.com
 * @copyright 2013-2015 20Theme
 *
 * @wordpress-plugin
 * Plugin Name: Easy Options Framework
 * Plugin URI:  http://www.20theme.com/plugins/easy-options-framework
 * Description: A framework for building WordPress theme and plugin options.
 * Version:     1.0.0
 * Author:      moyu
 * Author URI:  http://www.20theme.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: eof
 * Domain Path: /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( !defined('EOF_DIR') ) {
	define('EOF_DIR', plugin_dir_path( __FILE__ ));
}
if( !defined('EOF_URL') ) {
	define('EOF_URL', plugin_dir_url( __FILE__ ));
}
/**
 * The core plugin class files
 */
require EOF_DIR . '/core/class-eof-loader.php';
require EOF_DIR . '/core/class-eof.php';

?>