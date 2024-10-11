<?php


function ww_sl_options_page()
{
    register_setting( 'ww_sl', 'option_1' );
    register_setting( 'ww_sl', 'option_2' );
    register_setting( 'ww_sl', 'option_3' );
    register_setting( 'ww_sl', 'option_4' );
    register_setting( 'ww_sl', 'option_5' );
    register_setting( 'ww_sl', 'option_6' );

	add_submenu_page(
		'themes.php', //apage
		'Simple Social Links settings', //page title
		'Social Links', //menu tital
		'manage_options', //capability
		'ww_sl', //menu slug
		'ww_sl_options_page_html'
	);
}

function ww_sl_scripts() {
    wp_enqueue_style('ww_sl_scripts', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script('ww_sl_scripts', plugins_url('js/script.js', __FILE__), array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'ww_sl_scripts');
add_action('admin_menu', 'ww_sl_options_page');

?>