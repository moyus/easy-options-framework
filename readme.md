## Easy Options Framework
Contributors: mr.moyus  
Donate link: http://www.20theme.com  
Tags: settings, options, api, framework  
Requires at least: 3.8  
Tested up to: 4.1  
Stable tag: 1.0.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

A simple framework which use WordPress Settings API for building WordPress theme and plugin options.

## Description

Easy options framework which uses the WordPress Settings API makes it easy to create an options panel in any WordPress theme and plugin. It is very extensible, and very easy to integrate with by other developers instead of creating an options panel from scratch. For the most important, it is free to use in both commercial and personal projects!

## Include Fields

- text input
- email input
- number input
- password input
- date input
- textarea
- rich editor
- select
- post select (create a select field where the choices are pages + posts + your custom post types)
- image select (use images instead of radio buttons)
- checkbox (also include multicheck)
- radio
- repeater (create a set of sub fields)
- heading
- color picker
- html
- media upload

(Besides the include fields above, you also can set section tab content as custom html content or set section tab as a url link)

## Installation

### Use this plugin as standalone

1. Upload `Easy-Options-Framework` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Include `sample-config.php` file in your theme `functions.php` or create your own option configures file.

### Distributing Easy Options Framework in a plugin / theme

1. Copy the plugin to your theme / plugin
2. Customize the directory and path settings

```
define('EOF_DIR', get_template_directory() . '/eof');
define('EOF_URL', get_template_directory_uri() . ‘/eof’);

include_once ( EOF_DIR . '/eof.php');
include_once ( get_template_directory() . '/sample-config.php');
```

## Change log

#### 1.0.0 
	•	Initial release
