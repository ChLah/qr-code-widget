<?php

/** 
 * Plugin Name: QR code generator
 * Description: Widget to generate a dynamic QR code
 * Plugin URI: https://seenland-solutions.de
 * Version: 0.0.1
 * Author: Christoph Lahner 
 * Author URI: https://seenland-solutions.de
 * Text Domain: qr-code-gen
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function register_custom_widgets($widgets_manager)
{
    require_once(__DIR__ . '/util/qrcode.php');
    require_once(__DIR__ . '/widgets/qr-code-widget.php');
    $widgets_manager->register(new \Qr_Code_Widget());
}

add_action('elementor/widgets/register', 'register_custom_widgets');
