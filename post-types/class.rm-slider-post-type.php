<?php

if( ! class_exists('RM_Slider_Post_Type') ){
    class RM_Slider_Post_Type {
        public function __construct(){
            add_action( 'init', [$this, 'create_post_type'] );
            add_action( 'add_meta_boxes', [$this, 'add_meta_boxes']);
            add_action( 'save_post', [$this, 'save_post'] );
        }

        /**
         * Custom post type created named "rm_slider"
         */
        public function create_post_type(){
            register_post_type('rm_slider', [
                'labels' => [
                    'name'          => __('Sliders', 'rm-slider'),
                    'singular_name' => __('Slider', 'rm-slider'),
                    'add_new'       => __('Add Slider', 'rm-slider'),
			        'add_new_item'  => __('Add New Slider', 'rm-slider'),
                ],
                'supports' => [
                    'title',
                    'thumbnail'
                ],
                'public'      => true,
                'has_archive' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menu' => true,
                'can_export' => true,
                'has_archive' => false,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-images-alt'
            ]);
        }

        /**
         * "rm_slider" Post type meta box
         */
        public function add_meta_boxes(){
            add_meta_box(
                'rm_slider-meta-box',
                'Slider',
                [$this, 'rm_slider_inner_meta'],
                'rm_slider',
                'advanced',
                'high'
            );
        }

        /**
         * "rm_slider-meta-box" views file
         */
        public function rm_slider_inner_meta(){
            include_once( RM_plugin_path . 'views/slider-meta-box.php');
        }

        public function save_post($post_id){

            // WP Nonce Verification
            if( isset($_POST['_rm_slider_nonce'] ) ){
                if( ! wp_verify_nonce( $_POST['_rm_slider_nonce'], '_rm_slider_nonce' ) ){
                    return;
                }
            }

            // NOT save data while auto saving the post
            if( defined( 'DOING_AUTOSAVE' ) &&  DOING_AUTOSAVE){
                return;
            }

            // Check if current user can
            if( isset($_POST['post_type']) && $_POST['post_type'] == 'rm_slider'){
                if( ! current_user_can( 'edit_post', $post_id ) ){
                    return;
                }elseif( ! current_user_can( 'edit_page', $post_id ) ){
                    return;
                }
            }

            // Update the post meta
            if( isset($_POST['action']) && $_POST['action'] == 'editpost' ){
                $old_heading = get_post_meta( $post_id, 'rm_slider_heading', true );
                $new_heading = $_POST['rm_slider_heading'];

                $old_des = get_post_meta( $post_id, 'rm_slider_des', true );
                $new_des = $_POST['rm_slider_des'];

                $old_btn_text = get_post_meta( $post_id, 'rm_slider_btn_text', true );
                $new_btn_text = $_POST['rm_slider_btn_text'];

                $old_btn_url = get_post_meta( $post_id, 'rm_slider_btn_url',true );
                $new_btn_url = $_POST['rm_slider_btn_url'];

                update_post_meta( $post_id, 'rm_slider_heading', sanitize_text_field( $new_heading ), $old_heading );
                update_post_meta( $post_id, 'rm_slider_des', sanitize_text_field( $new_des ), $old_des );
                update_post_meta( $post_id, 'rm_slider_btn_text', sanitize_text_field( $new_btn_text ), $old_btn_text );
                update_post_meta( $post_id, 'rm_slider_btn_url', sanitize_text_field($new_btn_url), $old_btn_url );
            }
        }
    }
} 