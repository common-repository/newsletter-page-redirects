<?php

class AI_Magic_OpenAI {

    // The URL for the OpenAI API service
    private $api_url;

    // The API key used for authentication with the OpenAI API
    private $api_key;

    // The maximum number of tokens to generate for the OpenAI API response
    private $max_tokens;

    // Controls the randomness of the OpenAI API's output (higher value means more randomness)
    private $temperature;

    // Controls the diversity of the probabilities of the tokens in the OpenAI API's output
    private $top_p;

    // Penalizes the frequency of new tokens in the OpenAI API's output
    private $frequency_penalty;

    // Penalizes the presence of specific tokens in the OpenAI API's output
    private $presence_penalty;

    private $stream;
    private $logprobs;
    
    private $stop;

    private $legacyModels;

    private $chatcompletionmodels;

    private $engine;
    private $model;
    private $rate_limit;
    private $chatModels;
    
    public function __construct() {
 
        // Set the API URL for OpenAI service
        $this->api_url = 'https://api.openai.com/v1/%s';

        // Retrieve the API key from WordPress options
        $this->api_key = get_option('ai_magic_api_key');

        // Retrieve the model name (e.g., "text-davinci-002") from WordPress options
        $this->model = get_option('ai_magic_model');  

        // Retrieve the engine type (e.g., "davinci") from WordPress options
        $this->engine = get_option('ai_magic_engine');

        // Retrieve and cast the maximum token limit as an integer from WordPress options
        $this->max_tokens = (int) get_option('ai_magic_max_tokens');

        // Retrieve and cast the temperature setting as a float from WordPress options
        $this->temperature = (float) get_option('ai_magic_temperature');

        // Retrieve and cast the "top_p" parameter as a float from WordPress options
        $this->top_p = (float)get_option('ai_magic_top_p');  

        // Retrieve and cast the frequency penalty as a float from WordPress options
        $this->frequency_penalty =(float) get_option('ai_magic_frequency_penalty');

        // Retrieve and cast the presence penalty as a float from WordPress options
        $this->presence_penalty = (float)get_option('ai_magic_presence_penalty');

        // Retrieve and cast the "stream" parameter as a boolean from WordPress options
        $this->stream = (bool) get_option('ai_magic_stream');

        // Retrieve and cast the "logprobs" parameter as an integer from WordPress options
        $this->logprobs = (int) get_option('ai_magic_logprobs');

        // Retrieve the "stop" parameter from WordPress options
        // Note: "stop" could be a string or an array, so we don't cast it
        $this->stop = get_option('ai_magic_stop');

        $this->rate_limit = get_option('ai_magic_rate_limit', 1);

        $this->chatModels = [
            "gpt-4", "gpt-4-0613", "gpt-4-0314",
            "gpt-3.5-turbo-16k-0613", "gpt-3.5-turbo-16k",
            "gpt-3.5-turbo-0613", "gpt-3.5-turbo-0301",
            "gpt-3.5-turbo"
        ];

        ini_set( 'max_execution_time', 2000 );

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }

    public function sendRequest($data){

        // Create an empty array to store the parameters
        $params = array();

        if (!empty($data['prompt'])) {
            $params['prompt'] = $data['prompt'];
        }
        if (!empty($this->max_tokens)) {
            $params['max_tokens'] = (int) $this->max_tokens;
        }
        if (!empty($this->temperature)) {
            $params['temperature'] = (float) $this->temperature;
        }
        if (!empty($this->top_p)) {
            $params['top_p'] = (float) $this->top_p;
        }
        if (!empty($this->frequency_penalty)) {
            $params['frequency_penalty'] = (float) $this->frequency_penalty;
        }
        if (!empty($this->presence_penalty)) {
            $params['presence_penalty'] = (float) $this->presence_penalty;
        }

        $params['stream'] = false;

        // Additional 'todo' keys can be added similarly
        /*
        if (!empty($this->n)) {
            $params['n'] = $this->n;
        }
        if (!empty($this->stream)) {
            $params['stream'] = $this->stream;
        }
        if (!empty($this->logprobs)) {
            $params['logprobs'] = $this->logprobs;
        }
        if (!empty($this->stop)) {
            $params['stop'] = $this->stop;
        }
        */

        // API request headers
        $headers = array(
            'Authorization' => 'Bearer ' . $this->api_key,
            'Content-Type' => 'application/json',
        );
        
        # https://platform.openai.com/docs/api-reference/introduction
        $endpoints = array(
            'chat' => array('method' => 'POST', 'path' => "chat/completions"),
            'completion' => array('method' => 'POST', 'path' => sprintf("engines/%s/completions", $this->model)),
            'completions' => array('method' => 'POST', 'path' => 'completions'),
            'moderations' => array('method' => 'GET', 'path' => 'moderations'), // Content moderation related operations
            'classifications' => array('method' => 'GET', 'path' => 'classifications'), // Text classification tasks
            'embeddings' => array('method' => 'GET', 'path' => 'embeddings'), // Text embeddings
            'image' => array('method' => 'POST', 'path' => 'images/generations'), // Image-related operations
            'images' => array('method' => 'GET', 'path' => 'images'), // Image-related operations
            'answers' => array('method' => 'POST', 'path' => 'answers'), // Providing answers to questions
            'models' => array('method' => 'GET', 'path' => 'models'), // Model information and management
            'chat/completions' => array('method' => 'POST', 'path' => 'chat/completions'), // Chat conversation completions
            'fine_tuning/jobs' => array('method' => 'POST', 'path' => 'fine_tuning/jobs'), // Fine-tuning job operations
        
            'search' => array('method' => 'GET', 'path' => sprintf("engine/%s", $this->model)), // Search operations for a specific engine
            'engines/engine' => array('method' => 'GET', 'path' => sprintf("engines/%s", $this->model)), 
        
            'engines' => array('method' => 'GET', 'path' => 'engines'), // List of engines and engine details
            'list-engines' => array('method' => 'GET', 'path' => 'engines/list'), // List of available engines
            'user' => array('method' => 'GET', 'path' => 'users'), // User account-related operations
            'get-usage' => array('method' => 'GET', 'path' => 'usage/%s'), // Retrieve usage information for a user
            'list-usage' => array('method' => 'GET', 'path' => 'usage'), // List of usage data
        );

        $section = 'completion';

        if (in_array($this->model, $this->chatModels)) {
           
            $params['messages'] = array(
                array('role' => 'user', 'content' => $params['prompt'])
            );

            unset($params['prompt']);
            unset($params['best_of']);

            $section = 'chat';

        }

        $endpoint = $endpoints[$section]['path'];
        $method = $endpoints[$section]['method'];

        $api_url = sprintf($this->api_url, $endpoint);

        // Make the API request
        if($method == 'POST'){

            $response = wp_safe_remote_post($api_url, array(
                'timeout'     => 1000,
                'sslverify' => false,
                'headers' => $headers,
                'body' => wp_json_encode($params),
            ));

        }else{

            $response = wp_safe_remote_get($api_url, array(
                'timeout'     => 1000,
                'sslverify' => false,
                'headers' => $headers,
                'body' => wp_json_encode($params),
            ));
        }

        sleep($this->rate_limit);

        return $response;
    }

    public function parseContent($text) {
    
        // Belirtilen anahtar kelimelere dayanarak alanları çıkar
        $fields = array("title", "slug", "excerpt", "tags", "content");
        $parsed_data = array();
    
        foreach ($fields as $field) {
            preg_match("/#$field: (.*?)(?=#\\w+:|$)/s", $text, $matches);
            $parsed_data[$field] = isset($matches[1]) ? trim($matches[1]) : "";
        }
    
        return (object) $parsed_data;
    }

    public function generateText($title_text) {

        $start_time = microtime(true);

		include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ai-magic-vars.php';

        // Retrieve the selected language option from WordPress database, default is 'en' (English)
        $writing_language = get_option('ai_magic_writing_language', "en"); 

        // Retrieve the selected writing style option from WordPress database, default is 'infor' (Informative)
        $writing_style = get_option('ai_magic_writing_style', "infor"); 

        // Retrieve the selected tone of writing option from WordPress database, default is 'formal'
        $writing_tone = get_option('ai_magic_writing_tone', "formal");

        // Retrieve the minimum word count for the content from WordPress database, default is 500
        $word_count = get_option('ai_magic_min_content_length', 500);

        // Retrieve the maximum keyword count to include in the content from WordPress database, default is 3
        $keyword_count = get_option('ai_magic_max_keyword', 3);

        // Translate the language option code to its full name
        $writing_language = $languageOptions[$writing_language];

        // Translate the writing style option code to its full name
        $writing_style = $writingStyleOptions[$writing_style];

        // Translate the writing tone option code to its full name
        $writing_tone = $writingToneOptions[$writing_tone];

        // Replace pl
        $prompt = '

            Subject: "Compose a meticulously researched and engaging article of no fewer than [word_count] words on the subject of "[title]" in [language]. Design the article with a clear hierarchy, utilizing appropriate header tags such as <h1>, <h2>, and so on. Your content should be reader-friendly with engaging subheadings that captivate attention.

            Aim to enlighten the reader with rich information, peppered with relevant examples, real-world case studies, and pertinent statistics that bolster your arguments. Enhance the structure with unordered lists using the <ul> and <li> tags where it enhances clarity. End on a resonant note with a robust summary that encapsulates the crux of your discussion. Always wrap your headers within the mentioned heading tags and surround every paragraph with <p> tags, optimizing for smooth content digestion.
            "
            
            Writing specifications:
            Style: [style],
            Tone: [tone],
            Language: [language],
            Return Format:
                #title:
                ________________________________________________________________
                #slug:
                ________________________________________________________________
                #excerpt:
                ________________________________________________________________
                #tags:
                ________________________________________________________________
                #content: "HTML content"

        ';

        $test = "
            
            Write a comprehensive article with a minimum of [word_count] words about '[title]' in [language]. 

            1. **Format & Structure**: 
                - Begin with a captivating introduction that hooks the reader.
                - Divide your content using clear headings and subheadings. For main headings, use <h1> tags, and for subheadings, utilize <h2>, <h3>, and so on.
                - Make sure to enclose each paragraph within <p> tags to enhance readability.
                
            2. **Content Quality**: 
                - Your article should be well-researched, backed by credible sources.
                - Incorporate real-world examples, relevant case studies, and pertinent statistics to reinforce your arguments.
                - Where suitable, organize your thoughts using bullet points, employing <ul> for unordered lists and <li> for each list item.
                
            3. **Engagement**: 
                - Use engaging subheadings to break up long sections of text.
                - Keep your audience in mind and ensure the content speaks to their interests and needs.
                
            4. **Conclusion**: 
                - Sum up the main points discussed in the article.
                - Offer actionable takeaways or thought-provoking questions for the readers.

            5. **User Experience**: 
                - Remember that properly using heading tags not only structures your article but also enhances user experience and SEO.
                - Ensure that the content flows seamlessly from one section to the next, providing a cohesive reading experience.

            Remember, your goal is to produce an article that's not only informative but also engaging and valuable to the reader.
        ";
 

        $prompt = str_replace("[title]", $title_text, $prompt);
        $prompt = str_replace("[language]", $writing_language, $prompt);
        $prompt = str_replace("[style]", strtolower($writing_style), $prompt);
        $prompt = str_replace("[tone]", strtolower($writing_tone), $prompt);
        $prompt = str_replace("[word_count]", strtolower($word_count), $prompt);
        $prompt = str_replace("[keyword_count]", strtolower($keyword_count), $prompt);
 
        $max_execution_time = ini_get('max_execution_time');

        if($max_execution_time < 1000){
        
            return ['type' => 'error', 'message' => __('It appears that your PHP INI max execution time is less than 1000 seconds. Please increase it to ensure that the plugin functions properly', 'ai_magic')];

        }
 
        $response = $this->sendRequest([
            'prompt' => $prompt,
        ]);


        // Make API call here
        // Let's assume $response holds the API response

        if (!is_wp_error($response)) {

            // Decode the JSON response to an associative array
            $response_data = json_decode(wp_remote_retrieve_body($response), true);
         
            // Check if there is a warning, usually indicating a deprecated model or another issue
            if (isset($response_data['warning'])) {
                // Log the warning or take other necessary actions
                error_log('OpenAI Warning: ' . $response_data['warning']);
            }

            // Check for errors in the API response
            if (isset($response_data['error'])) {
                // Return an error message
                return ['type' => 'error', 'message' => $response_data['error']['message']];
            }

            if ( $response_data['choices'][0]['finish_reason'] === 'length' ) {
                wp_send_json( [
                    'error' => true,
                    'message' => __( 'Operation failed: Max Token value is not enougth for this prompt!', 'ai_magic' ),
                ] );
            }

            // If everything is okay, proceed to extract the text data
            if (isset($response_data['choices'][0]['text'])) {

                $content = $this->parseContent($response_data['choices'][0]['text']);

                if(!$content){
                    return ['type' => 'error', 'message' =>  __('Invalid content creation. Please try again.', 'ai_magic')];
                }

                $post_data = array(
                    'post_title'    => wp_strip_all_tags($content->title),
                    'post_excerpt'   => $content->excerpt,
                    'post_content'   => $content->content,
                    'post_name'   => $content->slug,
                    'post_tags'   => $content->tags,
                    'post_status'   => 'publish',
                    'post_type'     => 'ai_magic_logs',
                    'post_author'   => get_current_user_id()
                );
            
                $post_id = wp_insert_post($post_data);

                $end_time = microtime(true);
                $duration = ($end_time - $start_time) * 1000; 

                update_post_meta($post_id, 'duration', $duration);
                update_post_meta($post_id, 'prompt', $title_text);
                update_post_meta($post_id, 'tags', $content->tags);
                update_post_meta($post_id, 'prompt_tokens', $response_data['usage']['prompt_tokens']);
                update_post_meta($post_id, 'completion_tokens', $response_data['usage']['completion_tokens']);
                update_post_meta($post_id, 'total_tokens', $response_data['usage']['total_tokens']);
                update_post_meta($post_id, 'model', $response_data['model']);
                update_post_meta($post_id, 'chat_id', $response_data['id']);

                // Return success message along with the text data
                return [
                    'type' => 'success',
                    'message' => 'Success',
                    'data' => $post_data,
                ];
            } else {
                // Return a message indicating the text could not be extracted
                return ['type' => 'error', 'message' =>  __('Text data could not be extracted from the API response.', 'ai_magic')];
            }
        } else {
            // Log the error or take other necessary actions
            return ['type' => 'error', 'message' =>  __('An error occurred while making the API request.', 'ai_magic')];;
        }
    }
}
