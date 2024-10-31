
<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://insya.com/ai-magic
 * @since      1.0.0
 *
 * @package    Ai_Magic
 * @subpackage Ai_Magic/admin
 */
class AI_Magic_Metabox {
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_metabox'));
        
        add_action('admin_init', array($this, 'metabox_setup'));
        
        add_action('save_post', array($this, 'save_metabox'));


        add_action('wp_ajax_generate_ai_magic_content', 'generate_ai_magic_content_callback');
        add_action('wp_ajax_nopriv_generate_ai_magic_content', 'generate_ai_magic_content_callback');
    }

    public function add_metabox() {
        add_meta_box('ai-magic-metabox', 'AI Magic Content', array($this, 'metabox_content'), array('post', 'page', 'category'), 'normal', 'default');
    }

    public function metabox_setup() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    }

    public function metabox_content($post) {
        echo '<label for="ai-magic-content">Enter the content title</label>';
        echo '<input type="text" id="ai-magic-content" name="ai-magic-content" placeholder="E.g, Title: Cryptocurrency" class="widefat" value="' . esc_attr(get_post_meta($post->ID, 'ai_magic_content', true)) . '">';
        echo '<p><button id="generate-ai-magic-content" class="button button-primary">Generate</button></p>';
        echo '<div id="ai-magic-message"></div>';
    }

    public function save_metabox($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
            return $post_id;

        if (isset($_POST['ai-magic-content'])) {
            update_post_meta($post_id, 'ai_magic_content', sanitize_text_field($_POST['ai-magic-content']));
        }
    }

    public function enqueue_assets() {
        wp_enqueue_style('ai-magic-metabox', plugin_dir_url(__FILE__) . 'css/ai-magic-metabox.css');
        wp_enqueue_script('ai-magic-metabox', plugin_dir_url(__FILE__) . 'js/ai-magic-metabox.js', array('jquery'), null, true);
    }
 
    public function generate_ai_magic_content_callback() {
        if (isset($_POST['ai_magic_content'])) {
            // AI Magic Content'i alın
            $ai_magic_content = sanitize_text_field($_POST['ai_magic_content']);

            // Check user permissions or nonce here if needed

            if (isset($_POST['ai_magic_try_text'])) {
                
                $ai_magic_try_text = $_POST['ai_magic_try_text'];

                if(empty($ai_magic_try_text)){
                    wp_send_json_error(['message' => 'Invalid prompt', 'text' => '', 'data' => null]);
                    wp_die();
                }

                $openai = new AI_Magic_OpenAI();
                $response = (object) $openai->generateText($ai_magic_try_text);

                if($response->type == 'error'){
                    wp_send_json_error(['message' => 'Error while generating text', 'text' => esc_html($response->message)]);
                }
                // Send a success response
                wp_send_json_success(['message' => 'Generating text successfully', 'text' => esc_html($response->message) , 'data' => $response->data]);
            } else {
                // Send an error response if needed
                wp_send_json_error('Error while generating text');
            }

            wp_die();
        }
    }
}

$ai_magic_metabox = new AI_Magic_Metabox();
