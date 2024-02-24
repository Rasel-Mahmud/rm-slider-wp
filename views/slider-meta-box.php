<?php
$rm_heading = get_post_meta( get_the_ID(), 'rm_slider_heading', true );
$rm_des = get_post_meta( get_the_ID(), 'rm_slider_des', true );
$rm_btn_text = get_post_meta( get_the_ID(), 'rm_slider_btn_text', true );
$rm_btn_url = get_post_meta( get_the_ID(), 'rm_slider_btn_url', true );
?>
<table class="form-table rm-slider-meta-box">
<input type="hidden" name="_rm_slider_nonce" value="<?php echo wp_create_nonce( '_rm_slider_nonce' ); ?>">
    <tr>
        <th>
            <label for="rm_slider_heading">Heading</label>
        </th>
        <td>
            <input
                type="text"
                class="regular-text link-text rm-admin-input-style"
                name="rm_slider_heading"
                id="rm-slider-link-text"
                value="<?php echo $rm_heading ? esc_html( $rm_heading ) : ''; ?>"
                required
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="rm_slider_des">Description</label>
        </th>
        <td>
            <textarea
            name="rm_slider_des"
            class="regular-text link-text rm-admin-input-style"
            id="rm-slider-link-text"
            cols="30"
            rows="4"><?php echo $rm_des ? esc_html( $rm_des ) : ''; ?></textarea>
        </td>
    </tr>
    <tr>
        <th>
            <label for="rm_slider_btn_text">Button Text</label>
        </th>
        <td>
            <input
                type="text"
                class="regular-text link-text rm-admin-input-style"
                name="rm_slider_btn_text"
                id="rm-slider-link-url"
                value="<?php echo $rm_btn_text ? esc_html( $rm_btn_text ) : '' ?>"
                required
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="rm_slider_btn_url">Button URL</label>
        </th>
        <td>
            <input
                type="text"
                class="regular-text link-text rm-admin-input-style"
                name="rm_slider_btn_url"
                id="rm-slider-link-url"
                value="<?php echo $rm_btn_url ? esc_url( $rm_btn_url ) : '' ?>"
                required
            >
        </td>
    </tr>
</table>