<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WSR_RegisterApi' ) ) {
    class WSR_RegisterApi {
        protected static $instance;
        public function __construct() {

        }

        public static function get_instance() {
            if ( self::$instance === null ) {
                self::$instance = new self();
            }

            return self::$instance;
        }
        public function register_custom_api_routes(){
            register_rest_route();


        }

    }
}