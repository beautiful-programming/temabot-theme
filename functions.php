<?php
add_action('after_setup_theme', 'temabot_setup');
function temabot_setup()
{
    load_theme_textdomain('temabot', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'temabot')));
}

add_action('wp_enqueue_scripts', 'temabot_load_scripts');
function temabot_load_scripts()
{
    wp_enqueue_style('temabot-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, '3.4.1');
        wp_enqueue_script('jquery');
        wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', null, null, true);
//        function add_attr_scripts($tag, $handle)
//        {
//
//            $handles = [
////                    [
////                            'script' => 'jquery',
////                        'attr' => 'async'
////                    ],
//                [
//                    'script' => 'fontawesome',
//                    'attr' => 'async'
//                ],
//                [
//                    'script' => 'temabot-style',
//                    'attr' => 'async'
//                ]
//            ];
//            foreach ($handles as $item) {
//                if ($item['script'] === $handle) {
//                    return str_replace(' src', ' ' . $item['attr'] . ' src', $tag);
//                }
//            }
//
//            return $tag;
//        }

//        add_filter('script_loader_tag', 'add_attr_scripts', 10, 2);
    }
}

function my_deregister_styles_and_scripts() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_print_styles', 'my_deregister_styles_and_scripts', 100 );

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

add_action('wp_footer', 'temabot_footer_scripts');
function temabot_footer_scripts()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            var deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass("ios");
                $("html").addClass("mobile");
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
    <?php
}

add_filter('intermediate_image_sizes_advanced', 'temabot_image_insert_override');
function temabot_image_insert_override($sizes)
{
    unset($sizes['medium_large']);
    return $sizes;
}

add_action('wp_head', 'temabot_pingback_header');
function temabot_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('comment_form_before', 'temabot_enqueue_comment_reply_script');
function temabot_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function temabot_custom_pings($comment)
{
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter('get_comments_number', 'temabot_comment_count', 0);
function temabot_comment_count($count)
{
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

//add_action('template_redirect','show_sitemap');
//
//function show_sitemap() {
//    if (isset($_GET['show_sitemap'])) {
//        $the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish'));
//        $urls = array();
//        while ($the_query->have_posts()) {
//            $the_query->the_post();
//            $urls[] = get_permalink();
//        }
//        die(json_encode($urls));
//    }
//}