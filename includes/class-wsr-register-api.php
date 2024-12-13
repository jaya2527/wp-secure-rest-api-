<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WSR_RegisterApi')) {
    class WSR_RegisterApi
    {
        protected static $instance;
        public function __construct() {
            add_action('rest_api_init', [$this,'wsr_rest_api_init']);
        }

        public static function get_instance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }
        public function wsr_rest_api_init()
        {
            register_rest_route(
                'wp-secure-rest-api/v1', 'posts',
                array(
                    'methods' => 'GET',
                    'callback' => [$this,'wsr_get_posts'],
                    'permission_callback' => function ($request) {
                       $header = $request->get_headers();
                       $auth = $header['authorization'] ?? '';
                       foreach ($auth as $key => $value){
                           if(str_contains($value,'Bearer ')){
                               return true;
                           }
                       }
                       return false;
                    }
                )
            );
        }
        public function wsr_get_posts(){
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $query=new WP_Query($args);
            $posts = array();

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $posts[] = array(
                        'id' => get_the_ID(),
                        'title' => get_the_title(),
                        'link' => get_the_permalink(),
                        'excerpt' => get_the_excerpt(),
                        'date' => get_the_date(),
                        'user' => get_current_user_id()
                    );
                }
            }
            wp_reset_postdata();
            return $posts;
        }

    }
}