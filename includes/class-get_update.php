<?php
class get_update{

    public static function update_price()
    {

        global $wpdb;
        //select currncies from database
        $table_name = $wpdb->prefix . 'coin_info';
        $post_ids = $wpdb->get_results("SELECT currency_name FROM $table_name");
        //var_dump($post_id);
        $arr_list = array();
        foreach ($post_ids as $post_id) {
            $post_id->{'currency_name'};
            $str_list .= $post_id->{'currency_name'} . ",";
            array_push($arr_list, $post_id->{'currency_name'});
        }


        //echo "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=$str_list&tsyms=USD";
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=$str_list&tsyms=USD",
            CURLOPT_RETURNTRANSFER => true
        );
        // apply those options
        curl_setopt_array($ch, $optArray);

        // execute request and get response
        $result = json_decode(curl_exec($ch));


        foreach ($arr_list as $currency) {
            $table_name = $wpdb->prefix . 'coin_info';
            $price = $result->{'DISPLAY'}->{$currency}->{'USD'}->{'PRICE'};
            $market_cap = $result->{'DISPLAY'}->{$currency}->{'USD'}->{'MKTCAP'};
            $date = date('Y-m-d H:i:s');
            $wpdb->query("UPDATE $table_name SET `usd_price`='$price',`market_cap`='$market_cap',`last_update`='$date' WHERE `currency_name` = '$currency'");
        }
    }

}