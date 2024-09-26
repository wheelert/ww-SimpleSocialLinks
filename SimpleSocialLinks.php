/*
Plugin Name:  Simple Social Link Plugin 
Plugin URI:   https://www.wheelerwire.com/SimpleSocialLinks
Description:  This plugin is a simple way to add social media icons to single page posts.
Version:      1.0
Author:       WPBeginner
Author URI:   https://www.wheelerwire.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  ww-simplesociallinks
Domain Path:  /languages
*/

<?php
function ww_SocialLinks($content) {
 
// Only do this when a single post is displayed
if ( is_single() ) { 
 
// Message you want to display after the post
// Add URLs to your own Twitter and Facebook profiles
 
$content .= '<p class="ww-sociallinks">If you liked this article, then please follow us on <a href="http://x.com/wheelert" title="WheelerWire" target="_blank" rel="nofollow">X.com</a></p>';
 
}
// Return the content
return $content; 
 
}
// Hook our function to WordPress the_content filter
add_filter('the_content', 'ww_SocialLinks'); 
