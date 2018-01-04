<?php
global $post, $wpdb, $cs_theme_options, $cs_counter_node, $column_attributes, $cs_team_post_description, $cs_team_post_excerpt;
extract($wp_query->query_vars);
$width = '350';
$height = '350';
$title_limit = 1000;
?>   

<div class="cs-team team-grid">

    <?php
    $query = new WP_Query($args);
    $post_count = $query->post_count;
    if ($query->have_posts()) {
        $postCounter = 0;
        while ($query->have_posts()) : $query->the_post();
            $cs_position_color = get_post_meta($post->ID, 'cs_position_color', true);
            $cs_team_title_color = get_post_meta($post->ID, 'cs_team_title_color', true);
            $cs_description_color = get_post_meta($post->ID, 'cs_description_color', true);
            $cs_team_phone = get_post_meta($post->ID, 'cs_team_phone', true);
            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);
            $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
            $cs_team_position = get_post_meta($post->ID, 'cs_team_position', true);
            $cs_team_email = get_post_meta($post->ID, 'cs_team_email', true);
            $cs_team_facebook = get_post_meta($post->ID, 'cs_team_facebook', true);
            $cs_team_twitter = get_post_meta($post->ID, 'cs_team_twitter', true);
            $cs_team_google = get_post_meta($post->ID, 'cs_team_google', true);
            $cs_team_linkedin = get_post_meta($post->ID, 'cs_team_linkedin', true);
            ?> 
            <article class="col-sm-6 col-md-3">
                <div class="thumbnail custom-fig">
                    <?php if ($thumbnail <> '') { ?>
                        <div class="overlayslide-team">
                            <figure>
                                <a href="<?php esc_url(the_permalink()); ?>"><img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo cs_get_post_img_title($post->ID); ?>"></a>
                                <figcaption>
                                    <a href="<?php echo esc_url($thumbnail); ?>" rel="" title=""><i class="icon-plus8"></i></a>
                                </figcaption>
                            </figure>
                        </div>
                    <?php } ?>
                    <div class="caption">
                        <h4><a href="<?php esc_url(the_permalink()); ?>" style="color:<?php echo esc_html($cs_team_title_color); ?> !important"><?php the_title(); ?></a></h4> 
                        <?php if ($cs_team_position <> '') { ?>

                            <h3 style="color:<?php echo cs_allow_special_char($cs_position_color); ?> !important"><?php echo esc_attr($cs_team_position); ?></h3>
                        <?php } ?>
                        <div class="thumbcontactdiv">
                            <ul>
                                <?php if ($cs_team_phone <> '') { ?>
                                    <li><span><i class="icon-phone6"></i></span><?php echo esc_html($cs_team_phone); ?>
                                    </li>
                                <?php } ?>
                                <li>
                                    <?php if ($cs_team_email <> '') { ?>
                                        <a href="mailto:<?php echo sanitize_email($cs_team_email); ?>" class="emaildiv"><span><i class="icon-envelope4"></i></span><?php echo sanitize_email($cs_team_email); ?></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12 marginleft">
                            <div class="social-media-blog"> 
                                <?php
                                if ($cs_team_facebook <> '' || $cs_team_twitter <> '' || $cs_team_google <> '' || $cs_team_linkedin <> '') {
                                    ?>
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
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <?php
        endwhile;
    } else {
        _e('No team found.', 'cs_frame');
    }
    ?>

</div>