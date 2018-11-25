<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://oshka.000webhostapp.com/
 * @since             1.0.0
 * @package           wp_text
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Text Add To Footer
 * Plugin URI:        https://oshka.000webhostapp.com/
 * Description:       Adding New Text to Wordpress Footer And Editing It In Admin
 * Version:           1.0.0
 * Author:            Olha Babchenko
 * Author URI:        https://oshka.000webhostapp.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
add_action( 'wp_footer', 'my_function' );
function my_function() {
  $textvar = get_option('test_plugin_variable', 'hello world');
  echo $textvar;
}

add_action('admin_menu', 'my_admin_menu');
function my_admin_menu () {
  add_management_page('Footer Text', 'Footer Text', 'manage_options', __FILE__, 'footer_text_admin_page');
}

function footer_text_admin_page () {
  $textvar = get_option('test_plugin_variable', 'hello world');
  if (isset($_POST['change-clicked'])) {
    update_option( 'test_plugin_variable', $_POST['footertext'] );
    $textvar = get_option('test_plugin_variable', 'hello world');
  }
echo "
<div class=\"wrap\">
  <h1>Footer Text</h1>
  <p>This simple plugin will output some text to the footer of your template. Change the text below:</p>
  <form action=\"". str_replace('%7E', '~', $_SERVER['REQUEST_URI']) ."\" method=\"post\">
  Footer Text:<input type=\"text\" value=\"". $textvar."\" name=\"footertext\" placeholder=\"hello world\"><br />
  <input name=\"change-clicked\" type=\"hidden\" value=\"1\" />
  <input type=\"submit\" value=\"Change Text\" />
  </form>
</div>";

}

?>