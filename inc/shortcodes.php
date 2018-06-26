<?php





/**
* SmartDevices Shortcodes  file
*
* @package SmartDevices
*/
define('DH_SHORTCODES_DIR', get_template_directory_uri().'/inc/shortcodes_assets');







/*-----------------------------------------------------------------------------------*/
/* Defining SHORTCODE ACTIONS
/*-----------------------------------------------------------------------------------*/
/*
* Pilpil Lazy loading image loader
*/
function pilpil_lazy_image($atts, $content = null){
    // parameters of shortcode
    extract(shortcode_atts(array(
        'id' => '', //id of image
        'size' => 'post', // availible [hd, cover, post, category, avatar, tiny]
        'maxwidth' => '' // max width of pilpil wrapper
    ), $atts, 'pilpil'));

    // applying maxWidth - checking because it is optional
    if($maxwidth && $maxwidth != ""){
        $wrapper_maxwidth = 'style="max-width:'.$maxwidth.'px;"';
    }else{
        $wrapper_maxwidth = 'style="max-width: 100%;"';
    }
    if($size && $size != ""){
        $image_size = $size;
    }else{
        $image_size = 'post';
    }



    // big for lazy loading
    $big_post_image = wp_get_attachment_image_src($id, 'smartdevices-' . $image_size);
    $big_width = $big_post_image[1];
    $big_height = $big_post_image[2];
    $big_post_image = $big_post_image[0];

    //tiny to blur
    $small_post_image = wp_get_attachment_image_src($id, 'smartdevices-tiny');
    $small_post_image = $small_post_image[0];

    // image title for alt+title attributes
    $img_title = get_the_title($id);


    if ($big_post_image && $small_post_image){
        $output = '<div class="pilpil-wrapper">
        <div class="aspectRatioPlaceholder from_shortcode size-'. $image_size .' id-'. $id .'" '. $wrapper_maxwidth .'><div class="aspectRatioPlaceholder-fill"></div><div class="progressiveMedia" data-width="' . $big_width .'" data-height="' . $big_height .'"><img class="progressiveMedia-thumbnail" id="progressiveMedia-thumbnail" src="' . $small_post_image .'" alt="' . $img_title .'" title="' . $img_title .'"><canvas class="progressiveMedia-canvas" id="progressiveMedia-canvas"></canvas><img class="progressiveMedia-image" src="" data-src="' . $big_post_image .'" alt="' . $img_title .'" title="' . $img_title .'"><noscript class="js-progressiveMedia-inner">&amp;amp;lt;img class=&amp;#8221;progressiveMedia-noscript js-progressiveMedia-inner&amp;#8221; src=&amp;#8221;' . $big_post_image .'&amp;#8221;&amp;amp;gt;</noscript>
        </div></div></div>';
    }else{
        $output = '<div class="shortcode-pilpil ' . $big_post_image .' ' . $small_post_image .' p-2 pr-3 pl-3 mt-2 mb-2 color-light bg-error radius-small error-bar"><p class="align-middle display-inlineBlock low-lineheight m-0">Dammit! Something went wrong<span class="tiny display-inlineBlock align-middle ml-3">go check shortcodes file!</span></p></div>';
    }
    return $output;
}












/*
* Layout one for description
*/
function description_layout_one($atts, $content = null){
    // parameters of shortcode
    extract(shortcode_atts(array(
        'layout_title' => '',
        'title_under_image' => "false",
        'image_id' => '',
        'image_size' => 'post',
        'image_maxwidth' => '',
        'left_side_text' => '',
        'right_side_text' => '',
        'dark_bg' => "false",
        'black_bg' => "false",
        'check_custom_color' => "false",
        'custom_bg_color' => '',
        'custom_text_color' => '',
        'divider_top' => "false",
        'divider_bottom' => "false",
    ), $atts, 'layout_one'));

    $all_classes  = "";

    // Putting title under image if is true
    if($title_under_image != "false"){
        $all_classes .= "checked-title_under_image";
        $image_and_title = ''.do_shortcode( '[pilpil id="'.$image_id.'" size="'.$image_size.'" maxwidth="'.$image_maxwidth.'"]' ).'
        <h1 class="mt-5 low-lineheight fw-3 mb-3 mb-sm-3 text-center">'.$layout_title.'</h1>';
    }else{
        $image_and_title = '<h1 class="mt-5 low-lineheight fw-3 mb-3 mb-sm-3 text-center">'.$layout_title.'</h1>
        '.do_shortcode( '[pilpil id="'.$image_id.'" size="'.$image_size.'" maxwidth="'.$image_maxwidth.'"]' ).'';
    }


    // adding dark bg with white color if checked
    if($dark_bg != "false" && $black_bg == "false"){
        $all_classes .= " checked-dark_bg";
        $dark_class = "bg-dark color-light";
    }else{
        $dark_class = "";
    }

    // adding black bg with white color if checked
    if($black_bg != "false" && $dark_bg == "false"){
        $all_classes .= " checked-black_bg";
        $black_class = "bg-black color-light";
    }else{
        $black_class = "";
    }

    // adding custom bg with custom color if checked and values provided
    if($check_custom_color != "false" && ($dark_bg == "false" && $black_bg == "false")){
        $all_classes .= " checked-check_custom_color";
        $custom_styles = 'style="background-color: '.$custom_bg_color.' !important;  color: '.$custom_text_color.' !important;"';
    }else{
        $custom_styles = "";
    }

    // adding divider on top or bottom..depends on checked
    if($divider_top != "false"){
        $all_classes .= " checked-divider_top";
        $hr_top = '<hr>';
    }else{
        $hr_top = '';
    }
    if($divider_bottom != "false"){
        $all_classes .= " checked-divider_bottom";
        $hr_bottom = '<hr>';
    }else{
        $hr_bottom = '';
    }




    $output = $hr_top.' <section class="layout_one all_full-width '.$all_classes.'">
                    <div class="introduction container-fluid '.$dark_class.' '.$black_class.'" '.$custom_styles.'>
                        <div class="introduction_wrapper row with-gutters between-xl">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                '.$image_and_title.'
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p class="pt-4">'.$left_side_text.'</p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p class="pt-4">'.$right_side_text.'</p>
                            </div>
                        </div>
                    </div>
                </section> '.$hr_bottom.'';



    return $output;
}









/*
* Layout one for description
*/
function description_layout_two($atts, $content = null){

    // parameters of shortcode
    extract(shortcode_atts(array(
        'layout_title' => '',
        'image_id' => '',
        'image_size' => 'post',
        'image_maxwidth' => '',
        'right_side_text' => '',
        'bottom_text' => '',
        'dark_bg' => "false",
        'black_bg' => "false",
        'check_custom_color' => "false",
        'custom_bg_color' => '',
        'custom_text_color' => '',
        'divider_top' => "false",
        'divider_bottom' => "false",
    ), $atts, 'layout_two'));

    $all_classes  = "";

    // adding dark bg with white color if checked
    if($dark_bg != "false" && $black_bg == "false"){
        $all_classes .= " checked-dark_bg";
        $dark_class = "bg-dark color-light";
    }else{
        $dark_class = "";
    }

    // adding black bg with white color if checked
    if($black_bg != "false" && $dark_bg == "false"){
        $all_classes .= " checked-black_bg";
        $black_class = "bg-black color-light";
    }else{
        $black_class = "";
    }

    // adding custom bg with custom color if checked and values provided
    if($check_custom_color != "false" && ($dark_bg == "false" && $black_bg == "false")){
        $all_classes .= " checked-check_custom_color";
        $custom_styles = 'style="background-color: '.$custom_bg_color.' !important;  color: '.$custom_text_color.' !important;"';
    }else{
        $custom_styles = "";
    }

    // adding divider on top or bottom..depends on checked
    if($divider_top != "false"){
        $all_classes .= " checked-divider_top";
        $hr_top = '<hr>';
    }else{
        $hr_top = '';
    }
    if($divider_bottom != "false"){
        $all_classes .= " checked-divider_bottom";
        $hr_bottom = '<hr>';
    }else{
        $hr_bottom = '';
    }


    $output = $hr_top.' <section class="layout_two all_full-width '.$all_classes.'">
                    <div class="pt-0 pb-0 container-fluid '.$dark_class.' '.$black_class.'" '.$custom_styles.'>
                        <div class="row_wrapper row with-gutters middle-xl middle-lg between-xl p-3 p-xl-5">
                            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12">
                                '.do_shortcode( '[pilpil id="'.$image_id.'" size="'.$image_size.'" maxwidth="'.$image_maxwidth.'"]' ).'
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12">
                                <h3 class="mt-2 fw-6 mb-1 mb-sm-3">'.$layout_title.'</h3>
                                <p class="full-width">'.$right_side_text.'</p>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p class="full-width pt-4">'.$bottom_text.'</p>
                            </div>
                        </div>
                    </div>
                </section> '.$hr_bottom.'';


    return $output;
}










/*
* Layout one for description
*/
function description_layout_three($atts, $content = null){


    // parameters of shortcode
    extract(shortcode_atts(array(
        'invert_whole' => "false",
        'layout_title' => '',
        'image_id' => '',
        'image_size' => 'post',
        'image_maxwidth' => '',
        'side_text' => '',
        'dark_bg' => "false",
        'black_bg' => "false",
        'check_custom_color' => "false",
        'custom_bg_color' => '',
        'custom_text_color' => '',
        'divider_top' => "false",
        'divider_bottom' => "false",
    ), $atts, 'layout_three'));

    $all_classes  = "";

    // Inverting whole thing if is true
    if($invert_whole != "false"){
        $all_classes .= "checked-invert_whole";
        $invert_class = 'first-xl first-lg';
    }else{
        $invert_class = '';
    }



    // adding dark bg with white color if checked
    if($dark_bg != "false" && $black_bg == "false"){
        $all_classes .= " checked-dark_bg";
        $dark_class = "bg-dark color-light";
    }else{
        $dark_class = "";
    }

    // adding black bg with white color if checked
    if($black_bg != "false" && $dark_bg == "false"){
        $all_classes .= " checked-black_bg";
        $black_class = "bg-black color-light";
    }else{
        $black_class = "";
    }

    // adding custom bg with custom color if checked and values provided
    if($check_custom_color != "false" && ($dark_bg == "false" && $black_bg == "false")){
        $all_classes .= " checked-check_custom_color";
        $custom_styles = 'style="background-color: '.$custom_bg_color.' !important;  color: '.$custom_text_color.' !important;"';
    }else{
        $custom_styles = "";
    }

    // adding divider on top or bottom..depends on checked
    if($divider_top != "false"){
        $all_classes .= " checked-divider_top";
        $hr_top = '<hr>';
    }else{
        $hr_top = '';
    }
    if($divider_bottom != "false"){
        $all_classes .= " checked-divider_bottom";
        $hr_bottom = '<hr>';
    }else{
        $hr_bottom = '';
    }


    $output = $hr_top.' <section class="layout_three all_full-width '.$all_classes.'">
                    <div class="t-0 pb-0 container-fluid '.$dark_class.' '.$black_class.'" '.$custom_styles.'>
                        <div class="row_wrapper row with-gutters middle-xl middle-lg between-xl p-3 p-xl-5">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                '.do_shortcode( '[pilpil id="'.$image_id.'" size="'.$image_size.'" maxwidth="'.$image_maxwidth.'"]' ).'
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 '.$invert_class .'">
                                <h3 class="mt-2 fw-6 mb-1 mb-sm-3">'.$layout_title.'</h3>
                                <p class="full-width">'.$side_text.'</p>
                            </div>
                        </div>
                    </div>
                </section> '.$hr_bottom.'';


    return $output;


}



























/*-----------------------------------------------------------------------------------*/
/* INIT SHORTCODES
/*-----------------------------------------------------------------------------------*/
add_shortcode('pilpil', 'pilpil_lazy_image');
add_shortcode('layout_one', 'description_layout_one');
add_shortcode('layout_two', 'description_layout_two');
add_shortcode('layout_three', 'description_layout_three');


/*-----------------------------------------------------------------------------------*/
/* SHORTCODE CONTENT FILTER
/*-----------------------------------------------------------------------------------*/

function shortcodes_the_content_filter($content){
    $shortcodes = array(
        "pilpil",
        "layout_one",
        "layout_two",
        "layout_three"
    );
    $block = join("|", $shortcodes);
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content);
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep);
    return $rep;
}
add_filter("the_content", "do_shortcode", 7);
add_filter("the_content", "shortcodes_the_content_filter");





/*-----------------------------------------------------------------------------------*/
/* TINYMCE CONTROLS
/*-----------------------------------------------------------------------------------*/

function dh_tinymce_init(){
    global $typenow;
    if(!in_array($typenow, array('post', 'page', 'product'))) return ;
    add_filter('mce_external_plugins', 'dh_tinymce_plugin');
    add_filter('mce_buttons', 'dh_tinymce_button');
}
add_action('admin_head', 'dh_tinymce_init');

function dh_theme_css(){
    $active_theme = wp_get_theme();
    $active_theme = $active_theme->display('TextDomain', FALSE);
    ?>
    <style>
    .mce-theme-specific{ display:none !important; }
    .mce-theme-<?php echo $active_theme; ?> { display:block !important; }
    </style>
    <?php
}
add_action('admin_head', 'dh_theme_css');

function dh_tinymce_plugin($plugin_array){
    $plugin_array['dhshortcodes_options'] = DH_SHORTCODES_DIR . '/js/dh_shortcodes.js';
    return $plugin_array;
}

function dh_tinymce_css(){
    wp_enqueue_style('dhshortcodes_css', DH_SHORTCODES_DIR . '/css/dh_plugin.css');
}
add_action('admin_enqueue_scripts', 'dh_tinymce_css');

function dh_tinymce_button($buttons){
    array_push($buttons, 'dhshortcodesdisplay_button');
    return $buttons;
}
