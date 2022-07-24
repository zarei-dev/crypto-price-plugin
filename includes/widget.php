<?php

// Loading table class
if (!class_exists('WP_List_Table')) {
      require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}


// Extending class
class coins_data extends WP_List_Table
{
      private function get_coins_data()
      {
            global $wpdb;

            return $wpdb->get_results(
                  "SELECT * from {$wpdb->prefix}coin_info group by currency_name order by id",
                  ARRAY_A
            );
      }


      // Define table columns
      function get_columns()
      {
            $columns = array(
                  'currency_name' => 'Currency',
                  'usd_price'    => 'Price',
                  'market_cap' => 'Market Cap',
            );
            return $columns;
      }

      // Bind table with columns, data and all
      function prepare_items()
      {
            $columns = $this->get_columns();
            $hIDden = array();
            $sortable = array();
            $this->_column_headers = array($columns, $hIDden, $sortable);

            $this->items = $this->get_coins_data();
      }

      // bind data with column
      function column_default($item, $column_name)
      {
            switch ($column_name) {
                  case 'currency_name':
                  case 'usd_price':
                        return "$item[$column_name]";
                  case 'market_cap':
                        return ($item[$column_name]);
                  default:
                        return print_r($item, true); //Show the whole array for troubleshooting purposes
            }
      }

      function column_cb($item)
      {
            return sprintf(
                  $item['id']
            );
      }

      //...
}


// Plugin menu callback function
function coins_data_init()
{
      // Creating an instance
      $empTable = new coins_data();

      echo "<h2> Latest Prices</h2>";
      // Prepare table
      $empTable->prepare_items();
      // Display table
      $empTable->display();
      echo '</div>';
}

coins_data_init();
