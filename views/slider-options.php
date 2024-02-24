<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <?php
        $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'main_option';
    ?> 
    <h2 class="nav-tab-wrapper">
        <a href="?post_type=rm_slider&page=rm-slider&tab=main_option" class="nav-tab <?php echo $active_tab === 'main_option' ? 'nav-tab-active' : ''; ?>">Main options</a>
        <a href="?post_type=rm_slider&page=rm-slider&tab=additional_option" class="nav-tab <?php echo $active_tab === 'additional_option' ? 'nav-tab-active' : ''; ?>">Additional Options</a>
    </h2>
    <form action="options.php" method="post">
        <?php
            if($active_tab == 'main_option'){
                settings_fields( 'rm_slider_settings_group' );
                do_settings_sections( 'rm_slide_page1' );
            }else {
                settings_fields( 'rm_slider_settings_group' );
                do_settings_sections( 'rm_slide_page2' );
                submit_button( 'Save Settings' );
            }
            
        ?>
    </form>
</div>