<?php
/**
 * @package WordPress
 * @subpackage TechGo
 * @since WD_Responsive
 **/
 //error_reporting("-1");
$_template_path = get_template_directory();
require_once $_template_path."/theme/theme.php";
$theme = new Theme(array(
	'theme_name'	=>	"GoMarket",
	'theme_slug'	=>	'gomarket'
));
$theme->init();

/**
 * Slightly Modified Options Framework
 */
require_once ('admin/index.php');

add_filter( 'jpeg_quality', create_function( '', 'return 99;' ) );
add_filter( 'png_quality', create_function( '', 'return 99;' ) );
?>