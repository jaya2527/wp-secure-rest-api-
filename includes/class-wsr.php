<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WSR')) {
    class WSR
    {
        public static $instance;
        public $jca_register;


        public function __construct()
        {
            add_action('plugins_loaded', [$this, 'initialize']);
        }

        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function initialize()
        {
            $this->includes();
            $this->run();
        }

        private function includes()
        {
            include_once(WSR_INCLUDES . 'class-wsr-register-api.php');
        }

        private function run()
        {
            $this->jca_register = WSR_RegisterApi::get_instance();
        }

    }
}