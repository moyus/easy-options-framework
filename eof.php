<?php  
/**
 * Easy Options Framework
 *
 * @package   EOF
 * @author    moyu <moyuboy@gmail.com>
 * @license   GPLv2 or later
 * @link      https://moyu.io
 * @copyright 2013-2020 MOYU
 *
 * @wordpress-plugin
 * Plugin Name: Easy Options Framework
 * Plugin URI:  https://moyu.io/works
 * Description: A simple framework which uses the WordPress Settings API makes it easy to create an options panel in any WordPress theme and plugin.
 * Version:     1.0.4
 * Author:      moyu
 * Author URI:   https://moyu.io
 * License:     GPLv2 or later
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
require EOF_DIR . 'core/class-eof-loader.php';
?>
