<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wp, $wpdb;

// general
$ai_magic_provider = get_option('ai_magic_provider', 'OpenAI ChatGPT'); 
$ai_magic_model = get_option('ai_magic_model','gpt-3.5-turbo-16k');
$ai_magic_api_key = get_option('ai_magic_api_key', 'sk..1111111111111');
$ai_magic_writing_language = get_option('ai_magic_writing_language', 'en');
$ai_magic_writing_style = get_option('ai_magic_writing_style', 'infor');
$ai_magic_writing_tone = get_option('ai_magic_writing_tone', 'formal');

// advanced
$ai_magic_api_key = get_option('ai_magic_api_key', 'sk..1111111111111');
$ai_magic_rate_limit = get_option('ai_magic_rate_limit', 1);
$ai_magic_temperature = get_option('ai_magic_temperature', 0.9);
$ai_magic_max_tokens = get_option('ai_magic_max_tokens', 2200);
$ai_magic_top_p = get_option('ai_magic_top_p', 0.1);
$ai_magic_best_of = get_option('ai_magic_best_of', 1);
$ai_magic_frequency_penalty = get_option('ai_magic_frequency_penalty', 0.1);
$ai_magic_presence_penalty = get_option('ai_magic_presence_penalty', 0.1);
$ai_magic_stop = get_option('ai_magic_stop', '--stop--');

// content 
$ai_magic_min_content_length = get_option('ai_magic_min_content_length', 500);
$ai_magic_max_keyword = get_option('ai_magic_max_keyword', 3);

include plugin_dir_path( dirname( __FILE__ ) ) . '../includes/class-ai-magic-vars.php';

?>

<div class="wrap">
        <h2><?php echo esc_html('Settings'); ?></h2>
        <?php settings_errors(); ?>
        <div id="message"></div>
        <h2 class="nav-tab-wrapper">
            <a href="#general" class="nav-tab nav-tab-active"><?php echo esc_html('General'); ?></a>
            <a href="#advanced" class="nav-tab"><?php echo esc_html('Advanced'); ?></a>
            <a href="#content" class="nav-tab"><?php echo esc_html('Content'); ?></a>
            <a href="#try" class="nav-tab"><?php echo esc_html('Try'); ?></a>
        </h2>

        <?php settings_fields('ai_magic_settings'); ?>

        <form id="settings-form">
        <div id="general" class="tab-content">
            <h3><?php echo esc_html('General Settings'); ?></h3>
            <table class="wp-list-table widefat  striped table-view-list">

                <tr>
                    <th scope="row"><?php echo esc_html('Provider'); ?></th>
                    <td>
                        <select name="ai_magic_provider">
                            <option value="OpenAI" <?php selected($ai_magic_provider, 'OpenAI'); ?>>OpenAI</option>
                        </select>
                        <br>
                        <small><?php echo esc_html('Select the AI provider for the AI Magic plugin. Currently, "OpenAI" is the supported provider.'); ?></small>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php echo esc_html('API Key'); ?></th>
                    <td>
                        <textarea type="text" name="ai_magic_api_key" placeholder="sk..1111111111111"><?= $ai_magic_api_key; ?></textarea>
                        <br>
                        <small><?php echo esc_html('Enter your API key for the selected AI provider. This key authorizes your access to the AI services.'); ?>  <a href="https://beta.openai.com/account/api-keys" target="_blank">https://beta.openai.com/account/api-keys</a></small>
                        <p><a href="https://platform.openai.com/playground">https://platform.openai.com/playground</a></p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><?php echo esc_html('Model'); ?></th>
                    <td>
                        <select name="ai_magic_model">
                            <?php foreach ($modelOptions as $groupLabel => $groupOptions) : ?>
                                <optgroup label="<?php echo esc_html($groupLabel); ?>">
                                    <?php foreach ($groupOptions as $item) : ?>
                                        <option value="<?php echo esc_attr($item['name']); ?>" <?php selected($ai_magic_model, $item['name']); ?>><?php echo esc_html($item['name']); ?><br>
                                        (<?php echo esc_html($item['description']); ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Choose the AI model for generating text. "gpt-3.5-turbo-16k" is a high-performing model suitable for most use cases. More detail: '); ?> <a href="https://openai.com/pricing">https://openai.com/pricing</a></small>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php echo esc_html('Writing Language'); ?></th>
                    <td>
                        <select name="ai_magic_writing_language">
                            <?php foreach ($languageOptions as $value => $label) : ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php selected($ai_magic_writing_language, $value); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Select the language you want the AI to write in.'); ?></small>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php echo esc_html('Writing Style'); ?></th>
                    <td>
                        <select name="ai_magic_writing_style">
                            <?php foreach ($writingStyleOptions as $value => $label) : ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php selected($ai_magic_writing_style, $value); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Choose the writing style best suited for your content.'); ?></small>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php echo esc_html('Writing Tone'); ?></th>
                    <td>
                        <select name="ai_magic_writing_tone">
                            <?php foreach ($writingToneOptions as $value => $label) : ?>
                                <option value="<?php echo esc_attr($value); ?>" <?php selected($ai_magic_writing_tone, $value); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Select the tone you want to set for your written content.'); ?></small>
                    </td>
                </tr>

            </table>
            
            <p><?php submit_button(esc_html('Save Settings'), 'primary', 'save-settings-button', false, array('class' => 'save-settings-button')); ?></p>
        </div>

        <div id="advanced" class="tab-content" style="display: none;">
            <h3><?php echo esc_html('Advanced Settings'); ?></h3>
            <table class="wp-list-table widefat  striped table-view-list">
                <tr>
                    <th scope="row"><?php echo esc_html('Rate Limit Buffer'); ?></th>
                    <td>
                        <input type="number" name="ai_magic_rate_limit" value="<?php echo $ai_magic_rate_limit; ?>">
                        <br>
                        <small><?php echo esc_html('Set the rate limit buffer in seconds. This defines the time interval for rate limiting AI requests.'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Maximum length'); ?></th>
                    <td>
                        <input type="number" name="ai_magic_max_tokens" value="<?php echo $ai_magic_max_tokens; ?>">
                        <br>
                        <small><?php echo esc_html('Set the maximum number of tokens in the generated text. This affects the length of the output.'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Temperature'); ?></th>
                    <td>
                        <select name="ai_magic_temperature">
                            <?php for ($i = 0; $i <= 10; $i++) { 
                                $temperature = ($i == 10) ? 1 : ($i / 10);
                                $selected = ($temperature == $ai_magic_temperature) ? 'selected' : ''; 
                        
                                echo "<option value='{$temperature}' {$selected}>{$temperature}</option>";
                            } ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Adjust the temperature for generating AI responses. Higher values make the output more random, a value between 0 and 1 (ex: 0.9)'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Top P'); ?></th>
                    <td>
                        <select name="ai_magic_top_p">
                            <?php for ($i = 0; $i <= 10; $i++) { 
                                $temperature = ($i == 10) ? 1 : ($i / 10);
                                $selected = ($temperature == $ai_magic_top_p) ? 'selected' : ''; 
                        
                                echo "<option value='{$temperature}' {$selected}>{$temperature}</option>";
                            } ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Specify the top-p value for nucleus sampling. This controls the diversity of generated content. a value between 0 and 1 (ex: 1)'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Best Of'); ?></th>
                    <td>
                        <select name="ai_magic_best_of">
                            <?php for ($i = 0; $i <= 10; $i++) { 
                                $temperature = ($i == 10) ? 1 : ($i / 10);
                                $selected = ($temperature == $ai_magic_best_of) ? 'selected' : ''; 
                        
                                echo "<option value='{$temperature}' {$selected}>{$temperature}</option>";
                            } ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Determine the number of alternative completions to generate and return the best one.'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Frequency Penalty'); ?></th>
                    <td>
                        <select name="ai_magic_frequency_penalty">
                            <?php for ($i = 0; $i <= 20; $i++) { 
                                $temperature = ($i == 10) ? 1 : ($i / 10);
                                $selected = ($temperature == $ai_magic_frequency_penalty) ? 'selected' : ''; 
                        
                                echo "<option value='{$temperature}' {$selected}>{$temperature}</option>";
                            } ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('Apply a frequency penalty to promote variety in the generated text. Reduced values enhance the textual diversity within a range of -2 to 2 (e.g., 0.0 for minimal penalty).'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Presence Penalty'); ?></th>
                    <td>
                        <select name="ai_magic_presence_penalty">
                            <?php for ($i = 0; $i <= 20; $i++) { 
                                $temperature = ($i == 10) ? 1 : ($i / 10);
                                $selected = ($temperature == $ai_magic_presence_penalty) ? 'selected' : ''; 
                        
                                echo "<option value='{$temperature}' {$selected}>{$temperature}</option>";
                            } ?>
                        </select>
                        <br>
                        <small><?php echo esc_html('To mitigate the recurrence of particular phrases or entities in the generated content, you can assign a presence penalty within the range of -2 to 2 (e.g., 0.0 for no penalty).'); ?></small>
                    </td>
                </tr>
                <!-- <tr>
                    <th scope="row"><?php echo esc_html('Stop Word(s)'); ?></th>
                    <td>
                        <input type="text" name="ai_magic_stop" value="<?php echo $ai_magic_stop; ?>">
                        <br>
                        <small><?php echo esc_html('Specify a stopping point for the generated text. You can set a word, phrase, or condition that tells the text generator when to stop producing content. (e.g., --stop--)'); ?></small>
                    </td>
                </tr> -->
            </table>
            <p><?php echo esc_html('Don\'t forget to save your changes after configuring these settings.'); ?></p>
            <?php submit_button(esc_html('Save Settings'), 'primary', 'save-settings-button', false, array('class' => 'save-settings-button')); ?>
        </div>

        <div id="content" class="tab-content" style="display: none;">
            <h3><?php echo esc_html('Content Generating Settings'); ?></h3>
            <table class="wp-list-table widefat  striped table-view-list">
                <tr>
                    <th scope="row"><?php echo esc_html('Minimum content word length'); ?></th>
                    <td>
                        <input type="number" name="ai_magic_min_content_length" value="<?php echo $ai_magic_min_content_length; ?>">
                        <br>
                        <small><?php echo esc_html('Set the minimum number of words that the generated content should contain.'); ?></small>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html('Maximum keyword(s) count'); ?></th>
                    <td>
                        <input type="number" name="ai_magic_max_keyword" value="<?php echo $ai_magic_max_keyword; ?>">
                        <br>
                        <small><?php echo esc_html('Specify the maximum number of keywords to be included in or extracted from the content.'); ?></small>
                    </td>
                </tr>
            </table>
            <p><?php echo esc_html('Don\'t forget to save your changes after configuring these settings.'); ?></p>
            <?php submit_button(esc_html('Save Settings'), 'primary', 'save-settings-button', false, array('class' => 'save-settings-button')); ?>
        </div>
        </form>

        <div id="try" class="tab-content" style="display: none;">

            <h2><?php echo esc_html('Try AI Magic'); ?></h2>
            <p><?php echo esc_html('Use the form below to try AI Magic.'); ?></p>

            <form method="post" id="try-form">
                <label for="ai_magic_try_text"><?php echo esc_html('Enter a title:'); ?></label><br>
                <textarea name="ai_magic_try_text" id="ai_magic_try_text" rows="2" cols="50" placeholder="E.g, Title: Cryptocurrency" value="Cryptocurrency"></textarea><br>

                <label for="ai_magic_try_output"><?php echo esc_html('Generated Text:'); ?></label>
                <?php
                    $content = '';
                    $editor_id = 'ai_magic_editor';

                    wp_editor($content, $editor_id, array(
                        'media_buttons' => false,
                        'teeny' => true, 
                        'textarea_name' => 'ai_magic_try_output', 
                        'textarea_rows' => 20,
                    ));
                ?>
                <?php submit_button(esc_html('Generate Text'), 'primary', 'generate-text-button'); ?>
            </form>

        </div>

        <p><?php echo esc_html('These are your AI Magic settings. Customize them to suit your needs.'); ?></p>
</div>

<style>
   
</style>

<script>
    jQuery(document).ready(function ($) {

        var setting_button = $("[name='save-settings-button']");
        var generate_button = $("#generate-text-button");

        // Check for hash in URL and open the respective tab
        var hash = window.location.hash;
        if (hash) {
            $(".nav-tab").removeClass("nav-tab-active");
            $(`.nav-tab[href="${hash}"]`).addClass("nav-tab-active");
            $(".tab-content").hide();
            $(hash).show();
        } else {
            // Activate the first tab if no hash is present
            $(".nav-tab:first").addClass("nav-tab-active");
            $(".tab-content:first").show();
        }

        // Update the hash in the URL when a tab is clicked
        $(".nav-tab").click(function (event) {
            event.preventDefault();
            
            $(".nav-tab").removeClass("nav-tab-active");
            $(this).addClass("nav-tab-active");
            
            $(".tab-content").hide();
            var tabContent = $(this).attr("href");
            $(tabContent).show();

            generate_button.prop('disabled', false);

            // Update URL hash
            window.location.hash = tabContent;
        });
        
        setting_button.click(function (e) {
            e.preventDefault();
            
            $(this).prop('disabled', true);
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

            var settingsData = $("#settings-form").serialize();
            $('#message').html('');

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'save_plugin_settings', // Define the action
                    settings: settingsData, // Send the form data
                },
                success: function (response) {
                    $('#message').html('<div id="message" class="updated notice is-dismissible"><p>Settings have been saved successfully!</p></div>');
                        
                    setting_button.prop('disabled', false);
                    setting_button.html('Save Settings');
                },
                error: function (xhr, status, error) {
                    setting_button.prop('disabled', false);
                    setting_button.html('Save Settings');
                }
            });
        });

        function set_editor_content(new_content){
            var editor = tinyMCE.get('ai_magic_editor');
            if(editor) {
                editor.setContent(new_content);
            } else {
                $('#ai_magic_editor').val(new_content);
            }
        }
 
        generate_button.click(function (e) {
            e.preventDefault();
            
            $('#message').html('');
            set_editor_content('');

            generate_button.prop('disabled', true);
            generate_button.html('<div class="spinner"></div> Generating...');

            var postData = $("#ai_magic_try_text").val();

            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'save_generate_text', // Define the action
                    ai_magic_try_text: postData, // Send the form data
                },
                success: function (response) {

                    if(response.error){
                        $('#message').html('<div id="message" class="updated error is-dismissible"><p>'+ response.message +'</p></div>');
                  
                        generate_button.prop('disabled', false);
                        generate_button.html('Generate Text .');
                        return;
                    }

                    if(response.success){
                        $('#message').html('<div id="message" class="updated notice is-dismissible"><p>'+ response.data.message +'</p></div>');

                        set_editor_content(response.data.data.post_content);

                    }else{
                        $('#message').html('<div id="message" class="updated error is-dismissible"><p>'+ response.data.message +'</p><p>'+ response.data.text +'</p></div>');
                    }
                        
                    generate_button.prop('disabled', false);
                    generate_button.html('Generate Text .');
                },
                error: function (xhr, status, error) {
                    generate_button.prop('disabled', false);
                    generate_button.html('Generate Text ...');
                }
            });
        });
    });
</script>
 