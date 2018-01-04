
<?php
global $cs_node, $post, $cs_theme_option, $counter_node, $wpdb, $cs_gal_album, $cs_gal_media_per_page, $cs_gal_pagination, $cs_theme_option;


if (empty($_GET['page_id_all']))
    $_GET['page_id_all'] = 1;
$args = array('posts_per_page' => $cs_gal_media_per_page, 'post_type' => 'cs_gallery', 'paged' => $_GET['page_id_all'], 'cs_gallery-category' => $cs_gal_album);
$query = new WP_Query($args);
$width = '243';
$height = '137';

cs_framework::cs_enqueue_gallery_script();
cs_framework::cs_enqueue_prettyphoto_script();
$counter_gal = 0;
?>
<div class="col-md-12">
    <section id="portfolio-section">
        <div class="wrap-pad first">
            <div class="row">
                <div class="cs-main-filterable col-md-12">
                    <ul class="portfolio-filter cs-filter-nav">
                        <?php
                        global $aPostId;
                        $query = new WP_Query($args);
                        $post_count = $query->post_count;
                        if ($query->have_posts()):
                            $i = 1;
                            ?>
                            <li>
                                <a class="btn <?php echo 'active'; ?> margin-5" href="#" data-filter="*">
                                    <i class="icon-pictures5"></i>
                                    <?php _e('Show All', 'uoce'); ?>
                                </a>
                            </li>
                            <?php
                            while ($query->have_posts()) : $query->the_post();
                                $active = '';
                                $aPostId[] = $post->ID;
                                $dataFilterClass = '.id_' . $post->ID;
                                ?>
                                <li>
                                    <a class="btn <?php echo esc_html($active); ?> margin-5" href="#" data-filter="<?php echo esc_html($dataFilterClass) ?>">
                                        <i class="icon-pictures5"></i>
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </li>

                                <?php
                                if ($i == 5) {
                                    break;
                                }
                                $i++;
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>

                <?php if (count($aPostId) > 0) { ?>
                    <div class="cs-gallery classic-gallery col-md-12">
                        <ul class="portfolio-items">
                            <?php
                            for ($i = 0; $i < sizeof($aPostId); $i++) {
                                global $aPostId;
                                $cs_meta_gallery_options = get_post_meta($aPostId[$i], "cs_meta_gallery_options", true);
                                if ($cs_meta_gallery_options <> "") {
                                    $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
                                    ?>
                                    <?php
                                    foreach ($cs_xmlObject->children() as $cs_node) {
                                        if ($cs_node->getName() == "gallery") {
                                            $counter_gal++;
                                            $counter = $post->ID . $counter_gal;

                                            //cs_gallery_uoc_show($aPostId[$i]);
                                            /*                                             * ******************************************** */
                                            global $cs_node, $counter, $value_id, $str;
                                            //$dataFilterClass = $postId; // id to group images for tabs

                                            if (isset($cs_node->image_link_url)) {
                                                $link_url = $cs_node->image_link_url;
                                            }

                                            $image_path = wp_get_attachment_image_src((int) $cs_node->path, array($width, $height));
                                            $image_url_full = cs_attachment_image_src((int) $cs_node->path, 300, 300);
                                            $url = $image_url_full;
                                            $icon = '<i class="icon-plus8"></i>';
                                            if (isset($link_url) && $link_url <> "") {
                                                $icon = '<i class="icon-play7"></i>';
                                                $url = $link_url;
                                            }
                                            $title = isset($title) ? $title : '';
                                            ?>
                                            <li class="portfolio-item <?php echo 'id_' . $aPostId[$i]; ?> col-md-3">
                                                <div class="item-main">
                                                    <div class="portfolio-image"> 
                                                        <figure>
                                                            <a href="<?php echo esc_url($image_path[0]); ?>">
                                                                <img src="<?php echo esc_url($image_path[0]) ?>" alt="gallery image" title="<?php echo($title) ?>" >
                                                            </a>
                                                            <figcaption>
                                                                <ul class="gallery clearfix"> </ul>   
                                                                <ul class="gallery clearfix">    
                                                                    <a rel="prettyPhoto[myGallery]"  href="<?php echo esc_url($url) ?>" data-rel="prettyPhoto[gallery<?php echo esc_html($aPostId[$i]) ?>]"  title="<?php echo($title) ?>">
                                                                        <?php echo cs_allow_special_char($icon); ?>
                                                                    </a>
                                                                </ul>   
                                                            </figcaption>

                                                        </figure> 
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                            /*                                             * ********************************************* */
                                        }
                                    }
                                }
                                ?> 

                            <?php } // end for loop  ?>
                        </ul>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
</div>
<?php
$qrystr = ''; //cs_gal_media_per_page
if ($cs_node->media_per_page > 0 and $count_post > $cs_node->media_per_page) {
    $qrystr = '';
    if (isset($_GET['page_id']))
        $qrystr = "&page_id=" . $_GET['page_id'];
    echo cs_pagination($count_post, $cs_node->media_per_page, $qrystr);
}
// pagination end
?>
<!--</div>-->  
<script type="text/javascript">
    jQuery(window).load(function () {
        $portfolio = jQuery('.portfolio-items');
        $portfolio.isotope({
            itemSelector: 'li',
            layoutMode: 'fitRows'
        });
        $portfolio_selectors = jQuery('.portfolio-filter >li>a');
        $portfolio_selectors.on('click', function () {
            $portfolio_selectors.removeClass('active');
            jQuery(this).addClass('active');
            var selector = jQuery(this).attr('data-filter');
            $portfolio.isotope({filter: selector});
            return false;
        });
    });


</script>