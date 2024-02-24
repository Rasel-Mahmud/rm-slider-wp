<?php

if( ! class_exists('RM_Slider_Shortcode') ){
    class RM_Slider_Shortcode{
        public function __construct(){
            add_shortcode( 'rm-slider', [$this, 'add_shortcode'] );
        }

        public function add_shortcode( $atts = [], $content = null, $tag = '' ){
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            extract(shortcode_atts( ['id' => '', 'orderby' => 'date'], $atts, $tag ));

            if( !empty($id) ){
                $id = array_map('absint', explode(',', $id));
            }

            ob_start();
            require( RM_plugin_path . 'views/slider-shortcode.php' );
            wp_enqueue_script( 'rm-slider-second-jq' );
            wp_enqueue_script( 'rm-slider-mian-jq' );
            wp_enqueue_script( 'rm-slider-third-jq' );
            wp_enqueue_script( 'rm-slider-options' );
            wp_enqueue_style( 'rm-slider-style' );
            return ob_get_clean();
        }
    }
}