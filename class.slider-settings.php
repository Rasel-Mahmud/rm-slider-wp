<?php

if( ! class_exists( 'RM_Slider_Settings' ) ) {
    class RM_Slider_Settings {
        public static $options;
        public function __construct(){
            self::$options = get_option( 'rm_slider_settings' );
            add_action( 'admin_init', [$this, 'admin_init'] );
        }

        public function admin_init(){
            register_setting( 'rm_slider_settings_group', 'rm_slider_settings', [$this, 'rm_slider_validation']);

            add_settings_section( 'rm_slider_main', 'How does it works?', null, 'rm_slide_page1');
            add_settings_field( 'rm_slider_shortcode', 'Shortcode', [$this, 'rm_slider_shortcode_callback'], 'rm_slide_page1', 'rm_slider_main');

            add_settings_section( 'rm_slider_second', 'Settings', null, 'rm_slide_page2');

            add_settings_field( 'rm_slider_buttet', 'Display bullet', [$this, 'rm_slider_bullet_callback'], 'rm_slide_page2', 'rm_slider_second', ['label_for' => 'rm_slider_bullet']);

        }

        public function rm_slider_shortcode_callback(){
            ?>
            <span>Use the shortcode <code>[rm-slider]</code> to display slider in posts / pages / widgets</span>
            <?php
        }
        
        public function rm_slider_bullet_callback(){
            ?>
            <input type="checkbox" name="rm_slider_settings[rm_slider_bullet]" value="1" id="rm_slider_bullet"
            <?php
                if( isset(self::$options['rm_slider_bullet']) ){
                    checked( "1", self::$options['rm_slider_bullet'], true );
                }
            ?>>
            <label for="rm_slider_bullet">whether to display bullet or not</label>
            <?php
        }

        public function rm_slider_validation( $input ){
            $new_input = [];
            foreach($input as $key => $value){

                switch ($key) {
                    case 'rm_slider_title' :
                        $new_input[$key] = sanitize_text_field( $value );
                        break;
                    case 'rm_slider_bullet' :
                        $new_input[$key] = absint( $value );
                        break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                        break;
                }

            }
            return $new_input;
        }
    }
}
