<?php
add_action('init', 'create_ai_magic_logs_post_type');

function create_ai_magic_logs_post_type() {
    register_post_type('ai_magic_logs',
        array(
            'labels' => array(
                'name' => __('History'),
                'singular_name' => __('AI Magic Log'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New AI Magic Log'),
                'edit' => __('Edit'),
                'edit_item' => __('Edit AI Magic Log'),
                'new_item' => __('New AI Magic Log'),
                'view' => __('View AI Magic Log'),
                'view_item' => __('View AI Magic Log'),
                'search_items' => __('Search AI Magic Logs'),
                'not_found' => __('No AI Magic Logs found'),
                'not_found_in_trash' => __('No AI Magic Logs found in Trash'),
                'parent' => __('Parent AI Magic Log')
            ),
            'public' => true,
            'menu_position' => 5,
            'supports' => array('title', 'editor', 'author', 'custom-fields'),
           
            
            'publicly_queryable' => true,
            'show_ui'            => true,
            'query_var'          => true,
            'rewrite'            => false,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,

            
            'menu_icon' => 'dashicons-analytics',
            'has_archive' => true,
            'show_in_menu' => 'ai-magic-menu', // Parent menu slug here
        )
    );
}


add_filter('manage_ai_magic_logs_posts_columns', 'ai_magic_logs_table_head');

function ai_magic_logs_table_head($defaults) {
    $defaults['duration'] = 'Duration';
    $defaults['provider'] = 'Provider';
    $defaults['model'] = 'Model';
    $defaults['word_count'] = 'Word Count';
    $defaults['Language'] = 'Language';
    $defaults['Params'] = 'Params';
    return $defaults;
}
