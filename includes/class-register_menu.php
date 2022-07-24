<?php

class register_menu
{

    public static function list_menu()
    {

        function crypto_admin_menu()
        {
            add_submenu_page(
                'edit.php?post_type=coins',
                'Currency List',
                'Currency List',
                'manage_options',
                'testsettings',
                'latest_price_list'
            );
        }
        add_action('admin_menu', 'crypto_admin_menu');

        function latest_price_list(){
            include "list.php";
    }
    }
}
