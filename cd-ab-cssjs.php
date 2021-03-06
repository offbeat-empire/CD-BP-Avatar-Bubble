<?php
add_action('wp_print_scripts', 'cd_ab_add_js');
function cd_ab_add_js() {
    // do not load on admin pages
    if (is_admin())
        return false;

    $cd_ab = get_blog_option(bp_get_root_blog_id(), 'cd_ab');
    if ( $cd_ab['access'] == 'admin' && !is_super_admin() )
        return false;

     if ( $cd_ab['action'] == 'click') {
        wp_enqueue_script('CD_AB_JS', plugin_dir_url( __FILE__ ) . '_inc/click.min.js', array('jquery'),true, 2 );
    }else{
        wp_enqueue_script('CD_AB_JS', plugin_dir_url( __FILE__ ) . '_inc/hover.min.js', array('jquery') ,true);
    }
}

// Global js variables
add_action('wp_head', 'cd_ab_add_global_js_vars');
function cd_ab_add_global_js_vars() {
    // do not load on admin pages
    if (is_admin())
        return false;
        
    $cd_ab = get_blog_option(bp_get_root_blog_id(), 'cd_ab'); ?>
    <script type="text/javascript">
        var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
        var ajax_image = "<?php echo CD_AB_IMAGE_URI; ?>";
        var ajax_delay = "<?php echo $cd_ab['delay'] ?>";
    </script>
<?php }

function cd_ab_add_css() {
    // do not load on admin pages
    if (is_admin())
        return false;
        
    $cd_ab = get_blog_option(bp_get_root_blog_id(), 'cd_ab');

    if ( $cd_ab['access'] == 'admin' && !is_super_admin() )
        return false;

    $url  = plugin_dir_url( __FILE__ ) . '_inc/css/';
    $path = plugin_dir_path( __FILE__ ). '_inc/css/';

    switch($cd_ab['color']){
        case 'red':
            $bubbleUrl  = $url .$cd_ab['borders'].'/bubble-red.css';
            $bubbleFile = $path.$cd_ab['borders'].'/bubble-red.css';
            break;
        case 'black':
            $bubbleUrl  = $url .$cd_ab['borders'].'/bubble-black.css';
            $bubbleFile = $path.$cd_ab['borders'].'/bubble-black.css';
            break;
        case 'grey':
            $bubbleUrl  = $url .$cd_ab['borders'].'/bubble-grey.css';
            $bubbleFile = $path.$cd_ab['borders'].'/bubble-grey.css';
            break;
        case 'green':
            $bubbleUrl  = $url .$cd_ab['borders'].'/bubble-green.css';
            $bubbleFile = $path.$cd_ab['borders'].'/bubble-green.css';
            break;
        case 'blue':
        default:
            $bubbleUrl  = $url .$cd_ab['borders'].'/bubble-blue.css';
            $bubbleFile = $path.$cd_ab['borders'].'/bubble-blue.css';
            break;
    }

    if ( file_exists($bubbleFile) ) {
        wp_register_style('bubbleSheets', $bubbleUrl);
        wp_enqueue_style('bubbleSheets');
    }
}
add_action('wp_print_styles', 'cd_ab_add_css');
?>
