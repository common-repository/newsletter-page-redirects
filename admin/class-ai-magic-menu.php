<?php
 
function ai_magic_add_menu() {
    add_menu_page(
        'AI Magic',
        'AI Magic',
        'manage_options',
        'ai-magic-menu',
        'ai_magic_menu_page',
        plugin_dir_url(__FILE__) .'icon/magic.png'

    );

    add_submenu_page(
        'ai-magic-menu',
        'Settings',
        'Settings',
        'manage_options',
        'ai-magic-settings',
        'ai_magic_settings_page'
    );

    add_submenu_page(
        'ai-magic-menu',
        'Subscription',
        'Subscription',
        'manage_options',
        'ai-magic-subscription',
        'ai_magic_subscription_page'
    );

    // add_submenu_page(
    //     'ai-magic-menu',
    //     'About',
    //     'About',
    //     'manage_options',
    //     'ai-magic-about',
    //     'ai_magic_about_page'
    // );
}

add_action('admin_menu', 'ai_magic_add_menu');

add_action('wp_ajax_save_plugin_settings', 'save_ai_magic_settings');
add_action('wp_ajax_nopriv_save_plugin_settings', 'save_ai_magic_settings');

function save_ai_magic_settings() {
    // Check user permissions or nonce here if needed

    if (isset($_POST['settings'])) {
        // Process and save the settings
        parse_str($_POST['settings'], $settings);

        // Save settings to the database or any other storage
        foreach ($settings as $settin_key => $settin_value) {
            update_option($settin_key, $settin_value);
        }

        // Send a success response
        wp_send_json_success('Settings saved successfully');
    } else {
        // Send an error response if needed
        wp_send_json_error('Error while saving settings');
    }

    wp_die();
}


add_action('wp_ajax_save_generate_text', 'save_ai_magic_generate_text');
add_action('wp_ajax_nopriv_save_generate_text', 'save_ai_magic_generate_text');

function save_ai_magic_generate_text() {
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

function ai_magic_menu_page() {
    ai_magic_about_page();
}

function ai_magic_settings_page() {
    include(plugin_dir_path(__FILE__) . 'partials/ai-magic-settings-page.php');
}

function ai_magic_subscription_page() {
    ?>
    
    <div class="wrap">
        <h2>Premium Features</h2>
        <div class="subscription-info">
            <h3>Subscription Advantages</h3>
            <p>Our subscription plans offer a range of benefits to meet your content creation needs. Whether you choose our Free, Pro, or Premium plan, you'll enjoy the following advantages:</p>
            <ul>
                <li>Access to advanced content creation features.</li>
                <li>Priority support for quick assistance.</li>
                <li>Integration with third-party applications through API access.</li>
                <li>Personalized training to help you get the most out of our AI-powered content generation tool.</li>
            </ul>
        </div>

        <div class="pricing-table">
            <div class="pricing-column">
                <h3>Free</h3>
                <div class="price">0$</div>
                <ul>
                    <li>Basic Features</li>
                    <li>Limited Support</li>
                </ul>
                <a href="#" class="button">Get Started</a>
            </div>
            <div class="pricing-column">
                <h3>Pro</h3>
                <div class="price">$9.99/month</div>
                <ul>
                    <li>All Free Features</li>
                    <li>Premium Support</li>
                </ul>
                <a href="#" class="button">Get Started</a>
            </div>
            <div class="pricing-column">
                <h3>Premium</h3>
                <div class="price">$19.99/month</div>
                <ul>
                    <li>All Pro Features</li>
                    <li>Priority Support</li>
                </ul>
                <a href="#" class="button">Get Started</a>
            </div>
        </div>

        <div class="subscription-about">
            <h3>About Subscriptions</h3>
            <p>Our premium subscription plans empower you to create high-quality content effortlessly using AI technology. With a focus on user-friendly features and SEO optimization, our tool is designed to save you time and enhance your website's content.</p>
            <p>Unlock the full potential of AI content creation with our subscription plans and take your content to the next level.</p>
        </div>
    </div>

    <style>
        .pricing-table {
            display: flex;
            justify-content: center;
        }
        .pricing-column {
            text-align: center;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .price {
            font-size: 24px;
            margin: 10px 0;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #0073e6;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>

    <?php
}

function ai_magic_about_page() {
    ?>
    <div class="wrap">
        <h2>About AI Magic Plugin</h2>
        <p>Welcome to the AI Magic Plugin for WordPress, your AI-powered article and content generator.</p>
        <p>AI Magic is based on the ChatGPT technology and can assist you in generating high-quality articles and content for your website.</p>
        <p>Feel the magic of AI as it creates content that meets your requirements and saves you time.</p>

        <p>Welcome to the AI Magic Plugin for WordPress, your AI-powered article and content generator.</p>
        <p>AI Magic is a cutting-edge content creation tool based on ChatGPT, one of the most advanced AI language models. It empowers you to effortlessly produce high-quality articles and web content with the click of a button.</p>
        <p>Key Features:
        - Instantly generate SEO-friendly articles.
        - Customize content for your specific needs.
        - Save time and effort on content creation.
        - Enhance your website's quality with AI-generated content.
        </p>
        <p>Experience the magic of AI with AI Magic and unlock a new level of productivity for your WordPress website.</p>

        <style>
            .wrap {
                background-color: #f5f5f5;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            h2 {
                color: #333;
            }

            p {
                color: #666;
            }
        </style>
    </div>
    <?php
}