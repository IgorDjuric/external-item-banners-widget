<?php
/**
 * Plugin Name
 *
 * @package     PluginPackage
 * @author      Green Friends
 * @copyright   2018 Green Friends
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: External Item Banners Widget
 * Plugin URI:  https://example.com/plugin-name
 * Description: External Item Banners Widget
 * Version:     1.0.0
 * Author:      Green Friends
 * Author URI:  https://example.com
 * Text Domain: gf-externalItemBannersWidget
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

load_plugin_textdomain('gf-externalItemBannersWidget', '', plugins_url() . '/gf-externalItemBannersWidget/languages');


add_action('admin_menu', 'gf_external_item_banners_widget_options_create_menu');
function gf_external_item_banners_widget_options_create_menu()
{
    //create new top-level menu
    add_menu_page('External Item Banners Widget', 'External item banners widget', 'administrator', 'external_item_banners_widget', 'gf_product_stickers_options_page', null, 99);

//    //call register settings function
//    add_action('admin_init', 'register_gf_product_stickers_options');
}

