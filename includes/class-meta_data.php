<?php
function call_coinmetaboxClass()
{
    new coinmetaboxClass();
}

if (is_admin()) {
    add_action('load-post.php',     'call_coinmetaboxClass');
    add_action('load-post-new.php', 'call_coinmetaboxClass');
}

/**
 * The Class.
 */
class coinmetaboxClass
{

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post',      array($this, 'save'));
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box($post_type)
    {
        // Limit meta box to certain post types.
        $post_types = array('coins');

        if (in_array($post_type, $post_types)) {
            add_meta_box(
                'Post_Options',
                'Post Options',
                array($this, 'render_meta_box_content'),
                $post_type,
                'advanced',
                'high'
            );
        }
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save($post_id)
    {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['coin_inner_custom_box_nonce'])) {
            return $post_id;
        }

        $nonce = $_POST['coin_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'coin_inner_custom_box')) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check the user's permissions.
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        // Sanitize the user input.
        $coin = sanitize_text_field($_POST['coin']);

        // Update the meta field.
        update_post_meta($post_id, 'coin', $coin);

        $ID = get_the_ID();
        global $wpdb;
        $table_name = $wpdb->prefix . 'coin_info';
        $wpdb->query("INSERT INTO $table_name(`post_id`,`currency_name`) VALUES ('$ID','$coin')");
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content($post)
    {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('coin_inner_custom_box', 'coin_inner_custom_box_nonce');

        // Use get_post_meta to retrieve an existing value from the database.
        $coin = get_post_meta(get_the_ID(), 'coin', true);


        // Display the form, using the current value.
?>
        <label for="coin">
            <?php echo 'Coin Name';  ?>
        </label>

        <input type="text" id="coin" name="coin" style="text-transform:uppercase;" value="<?php echo $coin; ?>" size="25" />

<?php
    }
}
