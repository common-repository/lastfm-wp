<?php
/*
Plugin Name: Last.FM WP
Plugin URI: http://plugins.extendedproduct.com/lastfm-wp-plugin/
Description: Displays your recent last.fm tracks as a widget.
Version: 1.0.1
Author: ExtendedProduct
Author URI: http://www.extendedproduct.com
*/

/*  Copyright 2010 ExtendedProduct - support@extendedproduct.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'lastfm_wp_add_pages');
add_action('wp_head','lastfm_delete_cache');
add_action('delete_lastfm_cache','delete_lastfm_cache');

// action function for above hook
function lastfm_wp_add_pages() {
    add_options_page('Last.FM WP', 'Last.FM WP', 'administrator', 'lastfm_wp', 'lastfm_wp_options_page');
}

// lastfm_wp_options_page() displays the page content for the Test Options submenu
function lastfm_wp_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_lastfm_account';
    $opt_name_2 = 'mt_lastfm_limit';
    $opt_name_5 = 'mt_lastfm_plugin_support';
    $opt_name_6 = 'mt_lastfm_title';
    $opt_name_9 = 'mt_lastfm_cache';
	$opt_name_10 = 'mt_lastfm_title2';
	$opt_name_11 = 'mt_lastfm_title3';
	$opt_name_12 = 'mt_lastfm_title4';
    $hidden_field_name = 'mt_lastfm_submit_hidden';
    $data_field_name = 'mt_lastfm_account';
    $data_field_name_2 = 'mt_lastfm_limit';
    $data_field_name_5 = 'mt_lastfm_plugin_support';
    $data_field_name_6 = 'mt_lastfm_title';
    $data_field_name_9 = 'mt_lastfm_cache';
	$data_field_name_10 = 'mt_lastfm_title2';
	$data_field_name_11 = 'mt_lastfm_title3';
	$data_field_name_12 = 'mt_lastfm_title4';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt_val_2 = get_option($opt_name_2);
    $opt_val_5 = get_option($opt_name_5);
    $opt_val_6 = get_option($opt_name_6);
    $opt_val_9 = get_option($opt_name_9);
	$opt_val_10 = get_option($opt_name_10);
	$opt_val_11 = get_option($opt_name_11);
	$opt_val_12 = get_option($opt_name_12);
    
if ($_POST['delcache']=="true") {
update_option("mt_lastfm_cachey", "");
update_option("mt_lastfm_cachey2", "");
update_option("mt_lastfm_cachey3", "");
update_option("mt_lastfm_cachey4", "");
}

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt_val_2 = $_POST[$data_field_name_2];
        $opt_val_5 = $_POST[$data_field_name_5];
        $opt_val_6 = $_POST[$data_field_name_6];
        $opt_val_9 = $_POST[$data_field_name_9];
		$opt_val_10 = $_POST[$data_field_name_10];
		$opt_val_11 = $_POST[$data_field_name_11];
		$opt_val_12 = $_POST[$data_field_name_12];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 ); 
        update_option( $opt_name_9, $opt_val_9 );
		update_option( $opt_name_10, $opt_val_10 );
		update_option( $opt_name_11, $opt_val_11 );
		update_option( $opt_name_12, $opt_val_12 );
		update_option("mt_lastfm_cachey", "");
		update_option("mt_lastfm_cachey2", "");
		update_option("mt_lastfm_cachey3", "");
		update_option("mt_lastfm_cachey4", "");

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Last.FM WP Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
   
    $change3 = get_option("mt_lastfm_plugin_support");
    $change6 = get_option("mt_lastfm_cache");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Widget Latest Tracks Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_6; ?>" value="<?php echo $opt_val_6; ?>" size="50">
</p><hr />

<p><?php _e("Widget Top Tracks Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_10; ?>" value="<?php echo $opt_val_10; ?>" size="50">
</p><hr />

<p><?php _e("Widget Friends Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_11; ?>" value="<?php echo $opt_val_11; ?>" size="50">
</p><hr />

<p><?php _e("Widget Shouts Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_12; ?>" value="<?php echo $opt_val_12; ?>" size="50">
</p><hr />

<p><?php _e("Last.FM Username:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p><?php _e("Maximum Number - Limit:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>" size="3">
</p><hr />

<p><?php _e("How long should the cache last for? Recommended 10 minutes.", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_9; ?>" value="<?php echo $opt_val_9; ?>" size="4"> Minutes
</p><hr />

<p><?php _e("Support this Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>

<form action="" method="post"><input type="hidden" name="delcache" value="true" /><input type="submit" value="Delete Cache" /></form><br /><br />
</div>
<?php
 
}

function lastfm_delete_cache() {
$optionlastfmcache = get_option("mt_lastfm_cache");

$optionlastfmcache=$optionlastfmcache*60;

$schedule=wp_next_scheduled("delete_lastfm_cache");

if ($schedule=="") {
wp_schedule_single_event(time()+$optionlastfmcache, 'delete_lastfm_cache'); 
}
}

function delete_lastfm_cache() {
update_option("mt_lastfm_cachey", "");
update_option("mt_lastfm_cachey2", "");
update_option("mt_lastfm_cachey3", "");
update_option("mt_lastfm_cachey4", "");
}

function show_lastfm_latest($args) {

extract($args);

  $widget_title = get_option("mt_lastfm_title"); 
  $widget_title2 = get_option("mt_lastfm_title2");
  $max_tracks = get_option("mt_lastfm_limit");  
  $optionlastfm = get_option("mt_lastfm_account");
  $supportplugin = get_option("mt_lastfm_plugin_support"); 
  $optionlastfmcache = get_option("mt_lastfm_cache");
if (!$optionlastfm=="") {

$widget_title=str_replace("%user%", $optionlastfm, $widget_title);

$doc = new DOMDocument();
 
if($doc->load('http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user='.$optionlastfm.'&limit='.$max_tracks.'&api_key=493bd628f307f4c4d268f24ab5239472')) {
 
  $i = 1;

$cachey = get_option("mt_lastfm_cachey");

if (!$cachey=="") {
if (!$optionlastfmcache=="0") {
echo $cachey;

lastfm_delete_cache();
}

} else {
$lastfmdisp="";

  $lastfmdisp .= $before_title.$widget_title.$after_title."<br />".$before_widget;

  foreach ($doc->getElementsByTagName('track') as $node) {

    $t_song = $node->getElementsByTagName('name')->item(0);
	$t_artist = $node->getElementsByTagName('artist')->item(0); 
    $t_url = $node->getElementsByTagName('url')->item(0);
    $song = $t_song->nodeValue;	
	$artist = $t_artist->nodeValue;	
	$url = $t_url->nodeValue;	
 
    $lastfmdisp .= '<li><font color="#000000" size="2"><a href="'.$url.'">'.$song.' - '.$artist.'</a></font></li>';
 
    if($i++ >= $max_tracks) break;
  }

if ($supportplugin=="Yes" || $supportplugin=="") {
$lastfmdisp .= "<p style='font-size:x-small'>Last.FM Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}

$lastfmdisp .= $after_widget;
echo $lastfmdisp;

update_option("mt_lastfm_cachey", $lastfmdisp);

}

}

}

}

function show_lastfm_top($args) {

extract($args);

  $widget_title = get_option("mt_lastfm_title"); 
  $widget_title2 = get_option("mt_lastfm_title2");
  $max_tracks = get_option("mt_lastfm_limit");  
  $optionlastfm = get_option("mt_lastfm_account");
  $supportplugin = get_option("mt_lastfm_plugin_support"); 
  $optionlastfmcache = get_option("mt_lastfm_cache");
if (!$optionlastfm=="") {

$widget_title2=str_replace("%user%", $optionlastfm, $widget_title2);

$doc = new DOMDocument();
 
if($doc->load('http://ws.audioscrobbler.com/2.0/?method=user.getTopTracks&user='.$optionlastfm.'&period=overall&api_key=493bd628f307f4c4d268f24ab5239472')) {
 
  $i = 1;

$cachey2 = get_option("mt_lastfm_cachey2");

if (!$cachey2=="") {
if (!$optionlastfmcache=="0") {
echo $cachey2;

lastfm_delete_cache();
}

} else {
$lastfmdisp="";

  $lastfmdisp .= $before_title.$widget_title2.$after_title."<br />".$before_widget;
$z=0;
$x=0;
  foreach ($doc->getElementsByTagName('track') as $node) {

    $t_song = $node->getElementsByTagName('name')->item(0);
	$t_playcount = $node->getElementsByTagName('playcount')->item(0); 
    $t_url = $node->getElementsByTagName('url')->item(0);
    $song = $t_song->nodeValue;	
	$playcount = $t_playcount->nodeValue;	
	$url = $t_url->nodeValue;
  foreach ($doc->getElementsByTagName('artist') as $node) {
    $t_artist = $node->getElementsByTagName('name')->item(0);
    $artist = $t_artist->nodeValue;	

$artists[$z]=$artist;
$z ++;
}	
 
    $lastfmdisp .= '<li><font color="#000000" size="2"><a href="'.$url.'">'.$song.' - '.$artists[$x].' - '.$playcount.' Plays</a></font></li>';
$x ++;
    if($i++ >= $max_tracks) break;
  }

if ($supportplugin=="Yes" || $supportplugin=="") {
$lastfmdisp .= "<p style='font-size:x-small'>Last.FM Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}

$lastfmdisp .= $after_widget;
echo $lastfmdisp;

update_option("mt_lastfm_cachey2", $lastfmdisp);

}

}

}

}

function show_lastfm_friends($args) {

extract($args);

  $widget_title = get_option("mt_lastfm_title"); 
  $widget_title2 = get_option("mt_lastfm_title2");
  $widget_title3 = get_option("mt_lastfm_title3");
  $max_tracks = get_option("mt_lastfm_limit");  
  $optionlastfm = get_option("mt_lastfm_account");
  $supportplugin = get_option("mt_lastfm_plugin_support"); 
  $optionlastfmcache = get_option("mt_lastfm_cache");
  
if (!$optionlastfm=="") {

$widget_title3=str_replace("%user%", $optionlastfm, $widget_title3);

$doc = new DOMDocument();
 
if($doc->load('http://ws.audioscrobbler.com/2.0/?method=user.getFriends&user='.$optionlastfm.'&limit='.$max_tracks.'&api_key=493bd628f307f4c4d268f24ab5239472')) {
 
  $i = 1;

$cachey3 = get_option("mt_lastfm_cachey3");

if (!$cachey3=="") {
if (!$optionlastfmcache=="0") {
echo $cachey3;

lastfm_delete_cache();
}

} else {
$lastfmdisp="";

  $lastfmdisp .= $before_title.$widget_title3.$after_title."<br />".$before_widget;

  foreach ($doc->getElementsByTagName('friends') as $node) {

    $t_song = $node->getElementsByTagName('name')->item(0);
    $t_url = $node->getElementsByTagName('url')->item(0);
    $song = $t_song->nodeValue;	
	$url = $t_url->nodeValue;	
 
    $lastfmdisp .= '<li><font color="#000000" size="2"><a href="'.$url.'">'.$song.'</a></font></li>';
 
    if($i++ >= $max_tracks) break;
  }

if ($supportplugin=="Yes" || $supportplugin=="") {
$lastfmdisp .= "<p style='font-size:x-small'>Last.FM Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}

$lastfmdisp .= $after_widget;
echo $lastfmdisp;

update_option("mt_lastfm_cachey3", $lastfmdisp);

}

}

}

}

function show_lastfm_shouts($args) {

extract($args);

  $widget_title = get_option("mt_lastfm_title"); 
  $widget_title2 = get_option("mt_lastfm_title2");
  $widget_title3 = get_option("mt_lastfm_title3");
  $widget_title4 = get_option("mt_lastfm_title4");
  $max_tracks = get_option("mt_lastfm_limit");  
  $optionlastfm = get_option("mt_lastfm_account");
  $supportplugin = get_option("mt_lastfm_plugin_support"); 
  $optionlastfmcache = get_option("mt_lastfm_cache");
  
if (!$optionlastfm=="") {

$widget_title4=str_replace("%user%", $optionlastfm, $widget_title4);

$doc = new DOMDocument();
 
if($doc->load('http://ws.audioscrobbler.com/2.0/?method=user.getShouts&user='.$optionlastfm.'&api_key=493bd628f307f4c4d268f24ab5239472')) {
 
  $i = 1;

$cachey4 = get_option("mt_lastfm_cachey4");

if (!$cachey4=="") {
if (!$optionlastfmcache=="0") {
echo $cachey4;

lastfm_delete_cache();
}

} else {
$lastfmdisp="";

  $lastfmdisp .= $before_title.$widget_title4.$after_title."<br />";

  foreach ($doc->getElementsByTagName('shout') as $node) {

    $t_song = $node->getElementsByTagName('body')->item(0);
    $t_url = $node->getElementsByTagName('author')->item(0);
    $song = $t_song->nodeValue;	
	$url = $t_url->nodeValue;	
 
    $lastfmdisp .= $before_widget.'<font color="#000000" size="2">'.$url.' - '.$song.'</font>'.$after_widget;
 
    if($i++ >= $max_tracks) break;
  }

if ($supportplugin=="Yes" || $supportplugin=="") {
$lastfmdisp .= "<p style='font-size:x-small'>Last.FM Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}

echo $lastfmdisp;

update_option("mt_lastfm_cachey4", $lastfmdisp);

}

}

}

}

function init_lastfm_widget() {
register_sidebar_widget("Last.FM WP Latest Tracks", "show_lastfm_latest");
register_sidebar_widget("Last.FM WP Top Tracks", "show_lastfm_top");
register_sidebar_widget("Last.FM WP Friends", "show_lastfm_friends");
register_sidebar_widget("Last.FM WP Shouts", "show_lastfm_shouts");
}

add_action("plugins_loaded", "init_lastfm_widget");

?>
