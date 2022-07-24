<?php

class dashboard_widget
{

    public static function latest_price()
    {

        add_action('wp_dashboard_setup', 'Coins_dashboard_widget');

        function Coins_dashboard_widget()
        {
            global $wp_meta_boxes;

            wp_add_dashboard_widget('custom_help_widget', 'Coin Widget', 'custom_dashboard_help');
        }

        function custom_dashboard_help()
        {
            include plugin_dir_path( __FILE__ ) . '/widget.php';
        }
    }
}
