<?php

/*
* Plugin Name:       RM Slider
* Plugin URI:        https://rashel.pro/plugins/rm-slider/
* Description:       Handle the basics with this plugin.
* Version:           1.0.0
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Mahamud Hasan Rashel
* Author URI:        https://rashel.pro/author
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Update URI:        https://rashel.pro/rm-slider/
* Text Domain:       rm-slider
* Domain Path:       /languages
*/

/*
RM Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

RM Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with RM Slider. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Plugin Class
 */
if ( ! class_exists( 'RM_Slider' ) ) {
    class RM_Slider {
        public function __construct(){
            $this->define_constant();

            // Admin menu
            add_action( 'admin_menu', [$this, 'add_menu'] );

            include_once( RM_plugin_path . 'post-types/class.rm-slider-post-type.php');
            new RM_Slider_Post_Type();

            include_once( RM_plugin_path . 'class.slider-settings.php' );
            new RM_Slider_Settings();

            include_once( RM_plugin_path . 'shortcode/class.rm-slider-shortcode.php' );
            new RM_Slider_Shortcode();

            add_action( 'wp_enqueue_scripts', [$this, 'register_scripts'], 999 );
            add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_custom_css'] );
        }

        public function define_constant(){
            define( 'RM_plugin_path', plugin_dir_path( __FILE__ ) );
            define( 'RM_plugin_url', plugin_dir_url( __FILE__ ) );
            define( 'RM_plugin_version', '1.0.0' );
        }

        public static function active(){
            update_option( 'rewrite_rules', '');
        }
        public static function deactive(){
            flush_rewrite_rules();
            unregister_post_type( 'rm_slider' );
        }
        public static function uninstall(){

        }

        /**
         * Add Admin Menu
         */
        public function add_menu(){
            add_menu_page(
                "RM Sliders",
                "RM Sliders",
                "manage_options",
                "rm-slider",
                array( $this, 'rm_slider_menu' ),
                'dashicons-images-alt',
                20
            );
            add_submenu_page(
                "edit.php?post_type=rm_slider",
                "Slider Options",
                "Slider Options",
                "manage_options",
                "rm-slider",
                [$this, 'rm_slider_menu']
            );
        }

        /**
         * Admin Menu Content
         */
        public function rm_slider_menu(){
            if( ! current_user_can( 'manage_options' ) ){
                return;
            }
            include RM_plugin_path . 'views/slider-options.php';
        }

        public function register_scripts(){
            wp_register_script( 'rm-slider-mian-jq', RM_plugin_url . 'vendor/rmSlider/rmSlider.js', ['jquery'], RM_plugin_version, true );
            wp_register_script( 'rm-slider-second-jq', RM_plugin_url . 'vendor/rmSlider/rmMod.js', [], RM_plugin_version, true );
            wp_register_script( 'rm-slider-third-jq', RM_plugin_url . 'vendor/rmSlider/rmSliderDep.js', ['jquery'], RM_plugin_version, true );
            wp_register_script( 'rm-slider-options', RM_plugin_url . 'vendor/rmSlider/rmSliderOptions.js', ['jquery'], RM_plugin_version, true );
            wp_register_style( 'rm-slider-style', RM_plugin_url . 'vendor/rmSlider/style.css', [],RM_plugin_version, 'all');
        }
        
        public function enqueue_admin_custom_css(){
            wp_enqueue_style('admin-custom', RM_plugin_url . 'vendor/rmSlider/admin-custom.css', [],RM_plugin_version, 'all');
        }
    }
}

if( class_exists( 'RM_Slider' ) ) {
    register_activation_hook( __FILE__, ['RM_Slider', 'active'] );
    register_deactivation_hook( __FILE__, ['RM_Slider', 'deactive'] );
    register_uninstall_hook( __FILE__, ['RM_Slider', 'uninstall'] );
    $init = new RM_Slider();
}