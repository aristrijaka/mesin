<?php
/**
 * The template for displaying single Team
 */
global $post, $cs_theme_options;
$cs_uniq = rand(11111111, 99999999);
$cs_teamObject = get_post_meta($post->ID, 'cs_full_data', true);

$cs_contact_tests = get_post_meta($post->ID, 'cs_contact_tests', true);
$team_address = get_post_meta($post->ID, 'cs_team_address', true);
$cs_team_position = get_post_meta($post->ID, 'cs_team_position', true);
$cs_team_phone = get_post_meta($post->ID, 'cs_team_phone', true);
$cs_team_email = get_post_meta($post->ID, 'cs_team_email', true);
$cs_team_facebook = get_post_meta($post->ID, 'cs_team_facebook', true);
$cs_team_twitter = get_post_meta($post->ID, 'cs_team_twitter', true);
$cs_team_google = get_post_meta($post->ID, 'cs_team_google', true);
$cs_team_linkedin = get_post_meta($post->ID, 'cs_team_linkedin', true);
$cs_team_specs = get_post_meta($post->ID, 'cs_team_specs', true);
$cs_team_specs_title = get_post_meta($post->ID, 'cs_team_specs_title', true);
$cs_team_specs_subtitle = get_post_meta($post->ID, 'cs_team_specs_subtitle', true);
$cs_team_specs_desc = get_post_meta($post->ID, 'cs_team_specs_desc', true);
$cs_team_specs_list = get_post_meta($post->ID, 'cs_team_specs_list', true);
$cs_team_exp = get_post_meta($post->ID, 'cs_team_exp', true);
$team_experience_switch = get_post_meta($post->ID, 'cs_team_experience_switch', true);
$team_specs_experience = get_post_meta($post->ID, 'cs_team_specs_experience', true);
$cs_team_exp_desc = get_post_meta($post->ID, 'cs_team_exp_desc', true);
$cs_team_exp_list = get_post_meta($post->ID, 'cs_team_exp_list', true);
$cs_team_partners = get_post_meta($post->ID, 'cs_team_partners', true);
$cs_team_partners_title = get_post_meta($post->ID, 'cs_team_partners_title', true);
$cs_team_exp_title = get_post_meta($post->ID, 'cs_team_exp_title', true);
$cs_sidebar_left = $cs_theme_options['cs_team_layout_sidebar'];
$cs_single_team_layout = $cs_theme_options['cs_single_team_layout'];
$cs_team_exp_shortcode = get_post_meta($post->ID, 'cs_team_exp_shortcode', true);
$cs_team_list_gallery = get_post_meta($post->ID, 'cs_team_list_gallery', true);
$cs_team_position_department = get_post_meta($post->ID, 'cs_team_position_department', true);
$cs_proc_names = get_post_meta($post->ID, 'cs_proc_name_array', true);
$cs_proc_descs = get_post_meta($post->ID, 'cs_proc_description_array', true);
$cs_team_tests_title = get_post_meta($post->ID, 'cs_team_tests_title', true);
$cs_team_tests = get_post_meta($post->ID, 'cs_team_tests', true);
$cs_get_testimonials = get_post_meta($post->ID, 'cs_testimonials_array', true);
$cs_testimonial_names = get_post_meta($post->ID, 'cs_testimonial_name_array', true);
$cs_testimonial_poss = get_post_meta($post->ID, 'cs_testimonial_pos_array', true);
$cs_testimonial_imgs = get_post_meta($post->ID, 'cs_testimonial_img_array', true);
$cs_testimonial_descs = get_post_meta($post->ID, 'cs_testimonial_desc_array', true);
$cs_get_skills = get_post_meta($post->ID, 'cs_skills_array', true);
$cs_skill_names = get_post_meta($post->ID, 'cs_skill_name_array', true);
$cs_skill_percs = get_post_meta($post->ID, 'cs_skill_perc_array', true);



$cs_get_exp = get_post_meta($post->ID, 'cs_exp_array', true);
$cs_exp_names = get_post_meta($post->ID, 'cs_exp_name_array', true);
$cs_exp_descs = get_post_meta($post->ID, 'cs_exp_desc_array', true);


get_header();


$width = 350;
$height = 350;
if (isset($cs_single_team_layout) and $cs_single_team_layout == "sidebar_right") {
    $page_content = "page-content";
} else {

    $page_content = "col-md-12";
}
if (have_posts()):
    while (have_posts()) : the_post();
        $image_url = cs_get_post_img_src($post->ID, $width, $height);
        ?>
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_html($page_content); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cs-section-title underline"> <h2><?php the_title(); ?></h2></div>
                            </div>
                            <div class="cs-team team-plain col-md-12">
                                <div class="team-list">
                                    <article class="activedetail">
                                        <div class="media">
                                            <?php if ($image_url <> '') { ?>
                                                <div class="media-left">
                                                    <img class="<?php echo cs_get_post_img_title($post->ID); ?>" src="<?php echo esc_url($image_url); ?>" 
                                                         alt="team">
                                                </div>
                                            <?php } ?>
                                            <div class="media-body">
                                                <h4><?php echo cs_allow_special_char($cs_team_position); ?></h4>
                                                <h3><?php echo cs_allow_special_char($cs_team_position_department); ?></h3>
                                                <div class="contactdiv_detail">
                                                    <ul>
                                                        <?php if ($cs_team_phone <> '') { ?>
                                                            <li>
                                                                <a href="mailto:<?php echo sanitize_email($cs_team_email); ?>" class="emaildiv">
                                                                    <ul>
                                                                        <li><i class="icon-envelope4"></i></li>
                                                                        <li><?php _e('Email:', 'cs_frame'); ?></li>
                                                                        <li><?php echo sanitize_email($cs_team_email); ?></li>
                                                                    </ul>
                                                                </a>
                                                            </li>
                                                        <?php } if ($cs_team_phone <> '') { ?>
                                                            <li>
                                                                <a href="#" class="emaildiv">
                                                                    <ul>
                                                                        <li><i class="icon-phone6"></i></li>
                                                                        <li><?php _e('Phone:', 'cs_frame'); ?></li>
                                                                        <li><?php echo esc_html($cs_team_phone); ?></li>
                                                                    </ul>
                                                                </a>
                                                            </li>
                                                        <?php } if ($team_address <> '') { ?>
                                                            <li>
                                                                <a href="#" class="emaildiv">
                                                                    <ul>
                                                                        <li><i class="icon-map-marker"></i></li>
                                                                        <li><?php _e('Address:', 'cs_frame'); ?></li>
                                                                        <li><?php echo esc_html($team_address) ?></li>
                                                                    </ul>
                                                                </a>
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
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <?php if (isset($cs_team_specs) and $cs_team_specs == "on") { ?>
                                <article class="col-md-12 biography"> 
                                    <?php
                                    $cs_team_spepx_list_li = nl2br($cs_team_specs_list);
                                    $cs_team_exp_list_li_detail = str_replace('<br />', '</li><li>', $cs_team_spepx_list_li);
                                    if ($cs_team_specs_title <> '') {
                                        echo '<h2>' . $cs_team_specs_title . '</h2>';
                                    }
                                    if ($cs_team_specs_subtitle <> '') {
                                        echo '<h6>' . $cs_team_specs_subtitle . '</h6>';
                                    }

                                    if ($cs_team_specs_desc <> '') {
                                        echo '<p class="detailtext">';
                                        echo esc_html($cs_team_specs_desc);
                                        echo '</p>';
                                    }
                                    if ($cs_team_specs_list <> '') {
                                        echo '<ul class="detaillisting"><li>
						 ' . cs_allow_special_char($cs_team_exp_list_li_detail) . '
                           </li></ul>';
                                    }
                                    ?>
                                </article>
                                <?php
                            }
                            if ($team_experience_switch == 'on') {
                                ?>
                                <article class="col-md-12 acadimic_experience"> 
                                    <h2><?php echo esc_html($team_specs_experience) ?></h2><?php
                                    if (isset($cs_get_exp) && is_array($cs_get_exp) && count($cs_get_exp) > 0) {
                                        ?>
                                        <ul class="timeline">
                                            <?php
                                            $proc_counter = 1;
                                            $cs_proc_counter = 0;
                                            foreach ($cs_get_exp as $proc_list) {

                                                if (isset($proc_list) && $proc_list <> '') {
                                                    $counter_extra_feature = $extra_feature_id = $proc_list;
                                                    $cs_proc_name = isset($cs_exp_names[$cs_proc_counter]) ? $cs_exp_names[$cs_proc_counter] : '';
                                                    $cs_proc_description = isset($cs_exp_descs[$cs_proc_counter]) ? $cs_exp_descs[$cs_proc_counter] : '';
                                                    ?>
                                                    <li>
                                                        <h6><i class="icon-clock3 timeline-image"></i><?php echo esc_attr($cs_proc_name) ?></h6>
                                                        <p><?php echo do_shortcode($cs_proc_description) ?></p>
                                                    </li>
                                                    <?php
                                                }
                                                $proc_counter++;
                                                $cs_proc_counter++;
                                            }
                                            ?>
                                        </ul> <!-- </ul>-->
                                    <?php } ?>
                                </article>

                                <?php
                            }
                            if (isset($cs_team_exp) and $cs_team_exp == "on") {
                                if (isset($cs_get_skills) && is_array($cs_get_skills) && count($cs_get_skills) > 0) {
                                    ?>               
                                    <div class="col-md-12" id="progressbar">

                                        <div class="skills-sec"> 
                                            <h4><?php echo esc_html($cs_team_exp_title); ?></h4>
                                            <?php
                                            $cs_skill_counter = 0;
                                            foreach ($cs_get_skills as $skills) {
                                                if (isset($skills) && $skills <> '') {

                                                    $counter_skill = $skill_id = $skills;
                                                    $cs_skill_name = isset($cs_skill_names[$cs_skill_counter]) ? $cs_skill_names[$cs_skill_counter] : '';
                                                    $cs_skill_perc = isset($cs_skill_percs[$cs_skill_counter]) ? $cs_skill_percs[$cs_skill_counter] : '';
                                                    ?>

                                                    <h5><?php echo esc_html($cs_skill_name); ?></h5>
                                                    <div class="skillbar" data-percent="<?php echo esc_html($cs_skill_perc); ?>%">
                                                        <div class="skillbar-bar" style="width:<?php echo esc_html($cs_skill_perc); ?>%; background: rgb(8, 56, 127);"><small><?php echo esc_html($cs_skill_perc); ?>%</small></div>
                                                    </div>
                                                    <?php
                                                } $cs_skill_counter++;
                                            }
                                            ?>
                                        </div> 
                                    </div>
                                    <?php
                                }
                            }
                            cs_enqueue_flexslider_script();
                            ?>
                            <script type='text/javascript'>
                                jQuery(window).load(function () {
                                    jQuery('.cs-testimonial-slider').flexslider({
                                        slideshowSpeed: 4000,
                                        animationDuration: 1100,
                                        animation: 'slide',
                                        directionNav: true,
                                        controlNav: false,
                                        prevText: "<i class='icon-arrow-left10'></i>",
                                        nextText: "<i class='icon-arrow-right10'></i>",
                                    });
                                });
                            </script> 


                            <?php if ($cs_team_tests == "on") { ?>

                                <div class="element-size-100">
                                    <div class="col-md-12">
                                        <div class="cs-testimonial testimonial-slider">
                                            <?php
                                            if ($cs_team_tests_title <> '') {
                                                echo'<h4>';
                                                echo esc_html($cs_team_tests_title);
                                                echo'</h4>';
                                            }
                                            ?>
                                            <div class="cs-testimonial-slider">
                                                <ul class="slides">
                                                    <?php
                                                    if (isset($cs_get_testimonials) && is_array($cs_get_testimonials) && count($cs_get_testimonials) > 0) {
                                                        $cs_testimonial_counter = 0;
                                                        foreach ($cs_get_testimonials as $testimonials) {
                                                            if (isset($testimonials) && $testimonials <> '') {
                                                                $counter_testimonial = $testimonial_id = $testimonials;
                                                                $cs_testimonial_name = isset($cs_testimonial_names[$cs_testimonial_counter]) ? $cs_testimonial_names[$cs_testimonial_counter] : '';
                                                                $cs_testimonial_pos = isset($cs_testimonial_poss[$cs_testimonial_counter]) ? $cs_testimonial_poss[$cs_testimonial_counter] : '';
                                                                $cs_testimonial_img = isset($cs_testimonial_imgs[$cs_testimonial_counter]) ? $cs_testimonial_imgs[$cs_testimonial_counter] : '';
                                                                $cs_testimonial_desc = isset($cs_testimonial_descs[$cs_testimonial_counter]) ? $cs_testimonial_descs[$cs_testimonial_counter] : '';
                                                                ?> 
                                                                <li>
                                                                    <div class="question-mark">
                                                                        <figure><img src="<?php echo esc_url($cs_testimonial_img); ?>" alt="image"></figure>
                                                                        <?php
                                                                        if ($cs_testimonial_desc <> '') {
                                                                            echo '  <p>';
                                                                            echo esc_html($cs_testimonial_desc);
                                                                            echo '  </p>';
                                                                        }
                                                                        ?> 
                                                                        <div class="cs-author">
                                                                            <?php
                                                                            if ($cs_testimonial_name <> '') {
                                                                                echo '  <h6>';
                                                                                echo esc_html($cs_testimonial_name);
                                                                                echo '  </h6>';
                                                                            }
                                                                            ?> 
                                                                            <?php
                                                                            if ($cs_testimonial_pos <> '') {
                                                                                echo '<span>';
                                                                                echo esc_html($cs_testimonial_pos);
                                                                                echo '</span>';
                                                                            }
                                                                            ?> 
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <?php
                                                            }
                                                            $cs_testimonial_counter++;
                                                        }
                                                    }
                                                    ?>     </ul>
                                            </div>



                                        </div>   
                                    </div>
                                </div> 

                            <?php } if ($cs_contact_tests == 'on') { ?>
                                <div class="section-fullwidth contact-detail">
                                    <?php
                                    $cs_team_contact_us = '[cs_contactus column_size="1/1" cs_contactus_section_title="" cs_contactus_view="plain" cs_contactus_send="' . $cs_team_email . '"]';
                                    echo do_shortcode($cs_team_contact_us);
                                    ?>
                                </div>

                            <?php } ?> 

                        </div> </div>
                    <div class="page-sidebar">
                        <?php
                        if (isset($cs_single_team_layout) and $cs_single_team_layout == "sidebar_right") {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : endif;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endwhile;
endif;

get_footer();
