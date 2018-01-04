<?php

/*
 *
 * @Shortcode Name : Tweets
 * @retrun
 *
 */

if (!function_exists('cs_tweets_shortcode')) {

    function cs_tweets_shortcode($atts, $content = "") {
        /*    $defaults =
          array('column_size' => '1/1',
          'cs_tweets_section_title' => '',
          'cs_tweets_user_name' => 'default',
          'cs_tweets_color' => '',
          'cs_no_of_tweets' => '',
          'cs_tweets_class' => '',
          'cs_tweets_bg_color'=>''
          ); */
        $defaults = array('column_size' => '1/1', 'cs_tweets_section_title' => '', 'cs_tweets_user_name' => 'default', 'cs_no_of_tweets' => '', 'cs_tweets' => '', 'cs_tweets_class' => '', 'cs_tweets_bg' => '');

        extract(shortcode_atts($defaults, $atts));
        $column_class = cs_custom_column_class($column_size);
        $CustomId = '';
        if (isset($cs_tweets_class) && $cs_tweets_class) {
            $CustomId = 'id="' . $cs_tweets_class . '"';
        }

        $cs_tweets_color = isset($cs_tweets) ? $cs_tweets : '';
        $cs_tweets_bg = isset($cs_tweets_bg) ? $cs_tweets_bg : '';


        $rand_id = rand(5, 999999);
        $html = '';
        $section_title = '';


        $html .= cs_get_tweets($cs_tweets_user_name, $cs_no_of_tweets, $cs_tweets_color, $cs_tweets_bg);



        //return $html;
    }

    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_TWEETS, 'cs_tweets_shortcode');
}

/*
 *
 * @Get Tweets
 * @retrun
 *
 */
if (!function_exists('cs_get_tweets')) {

    function cs_get_tweets($username, $numoftweets, $cs_tweets_color = '', $cs_tweets_bg = '') {

        global $cs_theme_options, $cs_twitter_arg;

        $cs_twitter_arg['consumerkey'] = isset($cs_theme_options['cs_consumer_key']) ? $cs_theme_options['cs_consumer_key'] : '';
        $cs_twitter_arg['consumersecret'] = isset($cs_theme_options['cs_consumer_secret']) ? $cs_theme_options['cs_consumer_secret'] : '';
        $cs_twitter_arg['accesstoken'] = isset($cs_theme_options['cs_access_token']) ? $cs_theme_options['cs_access_token'] : '';
        $cs_twitter_arg['accesstokensecret'] = isset($cs_theme_options['cs_access_token_secret']) ? $cs_theme_options['cs_access_token_secret'] : '';
        $cs_cache_limit_time = isset($cs_theme_options['cs_cache_limit_time']) ? $cs_theme_options['cs_cache_limit_time'] : '';
        $cs_tweet_num_from_twitter = isset($cs_theme_options['cs_tweet_num_post']) ? $cs_theme_options['cs_tweet_num_post'] : '';
        $cs_twitter_datetime_formate = isset($cs_theme_options['cs_twitter_datetime_formate']) ? $cs_theme_options['cs_twitter_datetime_formate'] : '';
        if ($cs_twitter_arg['consumerkey'] <> '' && $cs_twitter_arg['consumersecret'] <> '' && $cs_twitter_arg['accesstoken'] <> '' && $cs_twitter_arg['accesstokensecret'] <> '') {
            require_once get_template_directory() . '/include/theme-components/cs-twitter/display-tweets.php';
            display_tweets_shortcode($username, $cs_twitter_datetime_formate, $cs_tweet_num_from_twitter, $numoftweets, $cs_cache_limit_time, $cs_tweets_color, $cs_tweets_bg);
        } else {
            echo '<p>' . __('Please Set Twitter API', 'agenda') . '</p>';
        }
    }

}
?>