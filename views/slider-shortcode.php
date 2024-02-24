<?php
$navShow =  isset( RM_Slider_Settings::$options['rm_slider_bullet']) && RM_Slider_Settings::$options['rm_slider_bullet'] == 1 ? true : false;
?>
<div class="flexslider">
<div class="demo-2">
<div id="slider" class="sl-slider-wrapper">

<div class="sl-slider">
    <?php
    $args = [
        'post_type' => 'rm_slider',
        'post_status' => 'publish',
        'post__in' => $id,
        'orderby' => $orderby
    ];

    $rm_query = new WP_Query( $args );
    
    if( $rm_query->have_posts() ):
        while( $rm_query->have_posts() ) : $rm_query->the_post();
        $rm_heading = get_post_meta( get_the_ID(), 'rm_slider_heading', true );
        $rm_des = get_post_meta( get_the_ID(), 'rm_slider_des', true );
        $rm_btn_text = get_post_meta( get_the_ID(), 'rm_slider_btn_text', true );
        $rm_btn_url = get_post_meta( get_the_ID(), 'rm_slider_btn_url', true );
        $image = wp_get_attachment_url( get_post_thumbnail_id() );
        $navCounts = $rm_query->post_count;
        ?>

    <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
        <div class="sl-slide-inner">
            <div class="bg-img bg-img-1">
                <img src="<?php echo $image; ?>" alt="">
            </div>
            <h2><?php echo $rm_heading; ?></h2>
            <blockquote><p><?php echo $rm_des; ?></p><a href="<?php echo $rm_btn_url; ?>" target="_blank"><cite><?php echo $rm_btn_text; ?></cite></a></blockquote>
        </div>
    </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <?php if($navShow) : ?>
        <nav id="nav-dots" class="nav-dots">
            <?php for($i = 1; $i <= $navCounts; $i++)
                if($i == 1){
                    echo "<span class='nav-dot-current'></span>";
                }else{
                    echo "<span></span>";
                }?>
        </nav>
    <?php endif; ?>

</div><!-- /slider-wrapper -->
</div>
</div>