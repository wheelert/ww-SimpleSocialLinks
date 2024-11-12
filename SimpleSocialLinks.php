<?php
/*
Plugin Name:  Simple Social Link Plugin 
Plugin URI:   https://www.wheelerwire.com/SimpleSocialLinks
Description:  This plugin is a simple way to add social media icons to single page posts.
Version:      1.0
Author:       WheelerWire
Author URI:   https://www.wheelerwire.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  ww-simplesociallinks
Domain Path:  /languages
*/


// Include other plugin files
require_once(plugin_dir_path(__FILE__) . 'includes/scripts.php');
require_once(plugin_dir_path(__FILE__) . 'includes/shortcodes.php');

function ww_sl_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php

            add_settings_section(  
                'sl_settings_section', // Section ID 
                'Social Media Links', // Section Title
                'my_section_options_callback', // Callback
                'ww_sl' // What Page?  This makes the section show up on the General Settings Page
            );

            add_settings_field( // Option 1
                'option_1', // Option ID
                'X', // Label
                'my_textbox_callback', // !important - This is where the args go!
                'ww_sl', // Page it will be displayed (General Settings)
                'sl_settings_section', // Name of our section
                array( // The $args
                    'option_1',// Should match Option ID
                    'label_for' => 'option_1',
                    'class' => 'ww_label' 
                )  
            ); 

            add_settings_field( // Option 2
                'option_2', // Option ID
                'Rumble', // Label
                'my_textbox_callback', // !important - This is where the args go!
                'ww_sl', // Page it will be displayed (General Settings)
                'sl_settings_section', // Name of our section
                array( // The $args
                    'option_2' // Should match Option ID
                )  
            ); 

            add_settings_field( // Option 3
                'option_3', // Option ID
                'Truth Social', // Label
                'my_textbox_callback', // !important - This is where the args go!
                'ww_sl', // Page it will be displayed (General Settings)
                'sl_settings_section', // Name of our section
                array( // The $args
                    'option_3' // Should match Option ID
                )  
            ); 

            add_settings_field( // Option 4
                'option_4', // Option ID
                'Facebook', // Label
                'my_textbox_callback', // !important - This is where the args go!
                'ww_sl', // Page it will be displayed (General Settings)
                'sl_settings_section', // Name of our section
                array( // The $args
                    'option_4' // Should match Option ID
                )  
            ); 

            add_settings_field( // Option 5
                'option_5', // Option ID
                'Instagram', // Label
                'my_textbox_callback', // !important - This is where the args go!
                'ww_sl', // Page it will be displayed (General Settings)
                'sl_settings_section', // Name of our section
                array( // The $args
                    'option_5' // Should match Option ID
                )  
            ); 

            add_settings_field( // Option 6
                'option_6', // Option ID
                'Youtube', // Label
                'my_textbox_callback', // !important - This is where the args go!
                'ww_sl', // Page it will be displayed (General Settings)
                'sl_settings_section', // Name of our section
                array( // The $args
                    'option_6' // Should match Option ID
                )  
            ); 

			
			settings_fields( 'ww_sl' );
			do_settings_sections( 'ww_sl' );
			
            // output save settings button
			submit_button( __( 'Save Settings', 'textdomain' ) );
            
			?>
		</form>
	</div>
	<?php
}

function my_textbox_callback($args){
    $name = $args[0];
    echo '<input name="'.$name.'" value="'. get_option($name) .'" placeholder="https://" size="70" />';
}

//
// add settings saved message
//
add_action( 'admin_notices', 'ww_sociallinks_notice' );

function ww_sociallinks_notice() {

	if(
		isset( $_GET[ 'page' ] ) 
		&& 'ww_sl' == $_GET[ 'page' ]
		&& isset( $_GET[ 'settings-updated' ] ) 
		&& true == $_GET[ 'settings-updated' ]
	) {
		?>
			<div class="notice notice-success is-dismissible">
				<p>
					<strong>Settings saved.</strong>
				</p>
			</div>
		<?php
	}

}


//
// Main plugin function
//
function ww_SocialLinks($content) {
 
// Only do this when a single post is displayed
if ( is_single() ) { 
 
// Message you want to display after the post
// Add URLs to your own Twitter and Facebook profiles
$ico_path = plugin_dir_url( __FILE__ );

$post_url = get_permalink();    
$post_title = get_the_title();

$option_1 = get_option("option_1");
$option_1 = '<a href="http://twitter.com/share?text='.$post_title.'&url='.$post_url.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/x-50.png" /></a>';
$option_2 = get_option("option_2");
$option_3 = get_option("option_3");
$option_3 = '<a href="https://truthsocial.com/share?text='.$post_title.'&url='.$post_url.'"><img src="'.$ico_path.'/icons/truth-48.png" /></a>';
$option_4 = get_option("option_4");
$option_5 = get_option("option_5");
$option_6 = get_option("option_6");



$content .= '<p class="ww-sociallinks"><span>Share via:</span>';
//X.com
if($option_1 != ""){
    //$X_ico = '<a href="'.$option_1.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/x-50.png" /></a>';
    $X_ico = $option_1;
    $content .= $X_ico;
}

if($option_2 != ""){
    $X_ico = '<a href="'.$option_2.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/rumble-48.png" /></a>';
    $content .= $X_ico;
    
}

if($option_3 != ""){
    $X_ico = $option_3; 
    $content .= $X_ico;
    
}

if($option_4 != ""){
    $X_ico = '<a href="'.$option_4.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/facebook-48.png" /></a>';
    $content .= $X_ico;
    
}

if($option_5 != ""){
    $X_ico = '<a href="'.$option_5.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/instagram-48.png" /></a>';
    $content .= $X_ico;
    
}

if($option_6 != ""){
    $X_ico = '<a href="'.$option_6.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/youtube-48.png" /></a>';
    $content .= $X_ico;
    
}


$content .= '</p>';

}
// Return the content
return $content; 
 
}
// Hook our function to WordPress the_content filter
add_filter('the_content', 'ww_SocialLinks'); 

//
// shortcode for follow links
//
function ww_SocialLinks_follow(){
    
    $ico_path = plugin_dir_url( __FILE__ );

    $option_1 = get_option("option_1");
    $option_2 = get_option("option_2");
    $option_3 = get_option("option_3");
    $option_4 = get_option("option_4");
    $option_5 = get_option("option_5");
    $option_6 = get_option("option_6");
    
    
    
    $content = '<p class="ww-sociallinks"><span>Follow us on:</span>';
    //X.com
    if($option_1 != ""){
        $X_ico = '<a href="'.$option_1.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/x-50.png" /></a>';
        $content .= $X_ico;
    }
    
    if($option_2 != ""){
        $X_ico = '<a href="'.$option_2.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/rumble-48.png" /></a>';
        $content .= $X_ico;
        
    }
    
    if($option_3 != ""){
        $X_ico = '<a href="'.$option_3.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/truth-48.png" /></a>';
        $content .= $X_ico;
        
    }
    
    if($option_4 != ""){
        $X_ico = '<a href="'.$option_4.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/facebook-48.png" /></a>';
        $content .= $X_ico;
        
    }
    
    if($option_5 != ""){
        $X_ico = '<a href="'.$option_5.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/instagram-48.png" /></a>';
        $content .= $X_ico;
        
    }
    
    if($option_6 != ""){
        $X_ico = '<a href="'.$option_6.'" target="_blank" rel="nofollow"><img src="'.$ico_path.'/icons/youtube-48.png" /></a>';
        $content .= $X_ico;
        
    }
    
    
    $content .= '</p>';
    
    return $content;
    
    }
    
    //
    // add shortcode
    //
        add_shortcode('ww_sociallinks', 'ww_SocialLinks_follow');
