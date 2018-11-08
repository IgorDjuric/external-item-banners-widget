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
    add_menu_page('External Item Banners Widget', 'External item banners widget', 'administrator', 'external_item_banners_widget', 'gf_external_item_banners_widget_options_page', null, 99);

    //call register settings function
    add_action('admin_init', 'register_external_item_banners_widget_options');
}

function register_external_item_banners_widget_options()
{
    register_setting('gf-external-item-banners-widget-group', 'external-item-banners-widget-articles');
}


function gf_external_item_banners_widget_options_page()
{
    ?>
    <div class="wrap">
        <h2>External item banners widget options</h2>

        <h3>NonStopShop unos artikla</h3>

        <form action="" method="post" id="externalItemBannersWidgetForm" name="externalItemBannersWidgetForm"
              class="external-item-banners-widget-Form">

            <label for="itemId">Article ID (obavezno): </label>
            <input id="itemId" name="itemId" type="text" value="" class="regular-text"/><br>

            <label for="title">Article title (obavezno): </label>
            <input id="title" name="title" type="text" value="" class="regular-text "/><br>

            <label for="description">Article description (obavezno): </label>
            <textarea id="description" name="description" type="text" value="" class="regular-text" rows="5"></textarea><br>

            <label for="salePrice">Article sale price:</label>
            <input id="salePrice" name="salePrice" type="text" value="" class="regular-text"/><br>

            <label for="regularPrice">Article regular price (obavezno):</label>
            <input id="regularPrice" name="regularPrice" type="text" value="" class="regular-text"/><br>

            <label for="categoryUrl">Article category URL (obavezno):</label>
            <input id="categoryUrl" name="categoryUrl" type="text" value="" class="regular-text"/><br>

            <label for="itemUrl">Article URL (obavezno):</label>
            <input id="itemUrl" name="itemUrl" type="text" value="" class="regular-text"/>

            <input type="submit" name="articleSubmit" class="button button-primary" value="Kreiraj">
        </form>

        <?php
        global $wpdb;


        if (isset($_POST['articleSubmit'])) {
            if (
                isset($_POST['itemId']) && !empty($_POST['itemId']) &&
                isset($_POST['title']) && !empty($_POST['title']) &&
                isset($_POST['description']) && !empty($_POST['description']) &&
                isset($_POST['salePrice']) &&
                isset($_POST['regularPrice']) && !empty($_POST['regularPrice']) &&
                isset($_POST['categoryUrl']) && !empty($_POST['categoryUrl']) &&
                isset($_POST['itemUrl']) && !empty($_POST['itemUrl'])
            ) {
                $itemId = $_POST['itemId'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $salePrice = $_POST['salePrice'];
                $regularPrice = $_POST['regularPrice'];
                $categoryUrl = $_POST['categoryUrl'];
                $itemUrl = $_POST['itemUrl'];

                $sql_insert = "INSERT INTO wp_nss_external_banners_widget (itemId, title, description, salePrice, regularPrice, categoryUrl, itemUrl)
                        VALUES ({$itemId}, '{$title}', '{$description}', {$salePrice}, {$regularPrice}, '{$categoryUrl}', '{$itemUrl}')";
                $insert = $wpdb->query($sql_insert);
            } else {
                echo '<div class="notice notice-error is-dismissible"><p>Morate popuniti obavezna polja!</p></div>';
            }
        }

        ?>
        <?php
        $get_items_sql = "SELECT * FROM `wp_nss_external_banners_widget`";
        $items_result = $wpdb->get_results($get_items_sql);

        ?>
        <h3>Pregled proizvoda</h3>
        <table class="widefat" cellspacing="0">
            <th>Item ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Sale price</th>
            <th>Regular price</th>
            <th>Category url</th>
            <th>Item URL</th>

            <?php foreach ($items_result as $item): ?>
                <tr>
                    <td><?= $item->itemId ?></td>
                    <td><?= $item->title ?></td>
                    <td><?= $item->description ?></td>
                    <td><?= $item->salePrice ?></td>
                    <td><?= $item->regularPrice ?></td>
                    <td><?= $item->categoryUrl ?></td>
                    <td><?= $item->itemUrl ?></td>
                    <td>Edit</td>
                    <td>Delete</td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <?php
}
