<?php
global $post, $wpdb, $cs_theme_options, $cs_counter_node, $column_attributes, $cs_team_post_description, $cs_team_post_excerpt;
extract($wp_query->query_vars);
$width = '350';
$height = '350';
$title_limit = 1000;
?>   

<div class="cs-team team-box col-md-12">
    <?php
    $query = new WP_Query($args);
    $post_count = $query->post_count;
    if ($query->have_posts()) {
        $postCounter = 0;
        while ($query->have_posts()) : $query->the_post();
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);
            $cs_position_color = get_post_meta($post->ID, 'cs_team_title_color', true);
            $cs_team_title_color = get_post_meta($post->ID, 'cs_team_title_color', true);
            $cs_description_color = get_post_meta($post->ID, 'cs_description_color', true);

            $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
            $cs_team_position = get_post_meta($post->ID, 'cs_team_position', true);
            $cs_team_email = get_post_meta($post->ID, 'cs_team_email', true);
            $cs_team_specs_desc = get_post_meta($post->ID, 'cs_team_specs_desc', true);
            $cs_team_phone = get_post_meta($post->ID, 'cs_team_phone', true);
            $cs_team_facebook = get_post_meta($post->ID, 'cs_team_facebook', true);
            $cs_team_twitter = get_post_meta($post->ID, 'cs_team_twitter', true);
            $cs_team_google = get_post_meta($post->ID, 'cs_team_google', true);
            $cs_team_linkedin = get_post_meta($post->ID, 'cs_team_linkedin', true);
            ?> 
            <div class="graybackground">
                <div class="media">
                    <?php if ($thumbnail <> '') { ?>
                        <div class="media-left">
                            <div class="overlayslide-team">
                                <a href="<?php esc_url(the_permalink()); ?>">
                                    <img class="media-object" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo cs_get_post_img_title($post->ID); ?>">
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="media-body">
                        <h4 style="color:<?php echo esc_html($cs_team_title_color); ?> !important"><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>
                        <?php if ($cs_team_position <> '') { ?>
                            <h3 style="color:<?php echo cs_allow_special_char($cs_position_color); ?> !important"><?php echo esc_attr($cs_team_position); ?></h3>
                        <?php }
                        if ($cs_team_specs_desc <> '' and $cs_team_post_description == 'yes') {
                            ?>
                            <p class="whitecolor-text" style="color:<?php echo esc_html($cs_description_color); ?> !important">
                                <?php
                                echo substr($cs_team_specs_desc, 0, $cs_team_post_excerpt);
                                ?>
                            </p>
        <?php } ?>
                        <div class="contactdiv">
                            <ul>   
        <?php if ($cs_team_email <> '') { ?>
                                    <li>

                                        <a href="mailto:<?php echo sanitize_email($cs_team_email); ?>" class="emaildiv">
                                            <span><i class="icon-envelope4"></i></span><?php echo sanitize_email($cs_team_email); ?>
                                        </a>
                                    </li>
                                    <?php } if ($cs_team_phone <> '') { ?>
                                    <li><span><i class="icon-phone6"></i></span>
                                    <?php echo esc_html($cs_team_phone); ?> 
                                    </li>
        <?php } ?>
                            </ul>
                        </div>
                        <div class="col-lg-12 marginleft">
                            <?php
                            if ($cs_team_facebook <> '' || $cs_team_twitter <> '' || $cs_team_google <> '' || $cs_team_linkedin <> '') {
                                ?>
                                <div class="social-media-blog"> 
                                    <ul>
                                        <ul>
                                            <?php if ($cs_team_facebook <> '') { ?> 
                                                <li><a href="<?php echo esc_url($cs_team_facebook); ?>" data-original-title="Facebook" class="icon-facebook2"></a></li>
                                            <?php }if ($cs_team_twitter <> '') { ?> 
                                                <li><a href="<?php echo esc_url($cs_team_twitter); ?>" data-original-title="Twitter" class="icon-twitter6"></a></li>
                                            <?php }if ($cs_team_google <> '') { ?> 
                                                <li><a href="<?php echo esc_url($cs_team_google); ?>" data-original-title="GooglePlus" class="icon-googleplus7"></a></li>
                                            <?php }if ($cs_team_linkedin <> '') { ?> 
                                                <li><a href="<?php echo esc_url($cs_team_linkedin); ?>" data-original-title="Instagram" class="icon-instagram4"></a></li>
                                                <?php }if ($cs_team_email <> '') { ?> 
                                                <li><a href="mailto:<?php echo sanitize_email($cs_team_email); ?>" data-original-title="Email" class="icon-envelope4"> <span><?php _e('Email', 'cs_frame'); ?></span></a></li>
            <?php } ?>
                                        </ul>
                                    </ul>
                                </div>
        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    } else {
        _e('No team found.', 'cs_frame');
    }
    ?>
</div>

