<?php
/*
Plugin Name: Wetomo - Wordpress to mobile
Plugin URI: http://wetomo.tailmaster.com/?p=22
Description: This plugin will detect mobile phones, and redirect to m.tailmaster.com. 
Version: 0.3
Author: Roland Schmidt (based on the excellent Mowser Wordpress Mobile work by Mike Rowehl)
Author URI: http://wetomo.tailmaster.com
*/

/*  Copyright 2009 Roland Schmidt (email : support@tailmaster.com)

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
    
    Essentially all credits go to Mike Rowehl (email : info@mowser.com) since I 
    only had to change a few lines of Mike's Mowser Wordpress Mobile code to adapt it to Wetomo. 
    For any Wetomo related questions, bugs, features etc please contact 
    Roland Schmidt (email : support@tailmaster.com)
 */


function wetomo_mobile_url() 
{
  $alt_base = get_option('wetomo_alternatebaseurl');
  if ( $alt_base && !empty($alt_base) ) 
    return 'http://' . $alt_base . $_SERVER['REQUEST_URI'];
  return 'http://wp.tailmaster.com/?wtm_r=wp03&wtm_u=' . urlencode('http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

function wetomo_ismobile()
{ 
  $op = @strtolower($_SERVER['HTTP_X_OPERAMINI_PHONE']);
  $no = @strtolower($_SERVER['HTTP_X_MOBILE_GATEWAY']);
  $ua = @strtolower($_SERVER['HTTP_USER_AGENT']);
  $ac = @strtolower($_SERVER['HTTP_ACCEPT']);
  if ((strpos($ua, 'iphone')) || (strpos ($ua, 'ipod')))
    $isMobile=(get_option('wetomo_use_ipod')==1);
  elseif (strpos($ua, 'blackberry')) 
    $isMobile=(get_option('wetomo_use_bb')==1);
  elseif (strpos($ua, 'android')) 
    $isMobile=(get_option('wetomo_use_android')==1);
  else
    $isMobile = strpos($ac, 'application/vnd.wap.xhtml+xml') !== false
        || $op != ''
        || $no != '' 
        || strpos($ua, 'sony') !== false 
        || strpos($ua, 'symbian') !== false 
        || strpos($ua, 'nokia') !== false 
        || strpos($ua, 'samsung') !== false 
        || strpos($ua, 'mobile') !== false
        || strpos($ua, 'windows ce') !== false
        || strpos($ua, 'epoc') !== false
        || strpos($ua, 'opera mini') !== false
        || strpos($ua, 'nitro') !== false
        || strpos($ua, 'j2me') !== false
        || strpos($ua, 'midp-') !== false
        || strpos($ua, 'cldc-') !== false
        || strpos($ua, 'netfront') !== false
        || strpos($ua, 'mot') !== false
        || strpos($ua, 'up.browser') !== false
        || strpos($ua, 'up.link') !== false
        || strpos($ua, 'audiovox') !== false
        || strpos($ua, 'ericsson,') !== false
        || strpos($ua, 'panasonic') !== false
        || strpos($ua, 'philips') !== false
        || strpos($ua, 'sanyo') !== false
        || strpos($ua, 'sharp') !== false
        || strpos($ua, 'sie-') !== false
        || strpos($ua, 'portalmmm') !== false
        || strpos($ua, 'blazer') !== false
        || strpos($ua, 'avantgo') !== false
        || strpos($ua, 'danger') !== false
        || strpos($ua, 'palm') !== false
        || strpos($ua, 'series60') !== false
        || strpos($ua, 'palmsource') !== false
        || strpos($ua, 'pocketpc') !== false
        || strpos($ua, 'smartphone') !== false
        || strpos($ua, 'rover') !== false
        || strpos($ua, 'ipaq') !== false
        || strpos($ua, 'au-mic,') !== false
        || strpos($ua, 'alcatel') !== false
        || strpos($ua, 'ericy') !== false
        || strpos($ua, 'up.link') !== false
        || strpos($ua, 'vodafone/') !== false
        || strpos($ua, 'wap1.') !== false
        || strpos($ua, 'wap2.') !== false;
  return $isMobile;
}

function wetomo_headers() 
{
  echo "\n<!-- Added by wetomo Wordpress Mobile -->\n" . '<link rel="alternate" type="text/html" media="handheld" href="' . wetomo_mobile_url() . '" title="Mobile/PDA" />' . "\n";
  $mobilecss = get_option('wetomo_mobilecss');
  if ( $mobilecss === false ) 
    $mobilecss = wetomo_default_mobilecss();
  if ( !empty($mobilecss) ) 
    echo '<link rel="stylesheet" type="text/css" media="handheld" href="'.$mobilecss.'" />'."\n";
  echo "<!-- /added by wetomo Wordpress Mobile -->\n";
}

function wetomo_redirect() 
{ // PHP Code to redirect to wetomo:
  if ((wetomo_ismobile()) && (!isset($_SERVER['X-Wetomo-Rendered'])) && (isset($_SERVER['HTTP_USER_AGENT'])) && (stripos($_SERVER['HTTP_USER_AGENT'],'wetomo')===false))
  { header('Location: ' . wetomo_mobile_url());
    exit();
  }
}

function wetomo_admin() 
{
  if (function_exists('add_submenu_page'))
    add_options_page('Wetomo Setup', 'wetomo', 10, basename(__FILE__), 'wetomo_admin_page');
}

function wetomo_default_mobilecss() 
{ return 'http://m.tailmaster.com/x_css/wetomo.css';
}

function wetomo_admin_page() 
{
  if (isset($_POST['wetomo_options_submit'])) 
  {
    $use_ipod=(isset($_POST['wetomo_use_ipod']))?1:0;
    $use_bb=(isset($_POST['wetomo_use_bb']))?1:0;
    $use_android=(isset($_POST['wetomo_use_android']))?1:0;
    update_option('wetomo_mobilecss', $_POST['wetomo_mobilecss']);
    update_option('wetomo_use_ipod', $use_ipod);
    update_option('wetomo_use_bb', $use_bb);
    update_option('wetomo_use_android', $use_android);
    echo '<div id="message" class="updated fade"><p><strong>';
    _e('Options saved.');
    echo '</strong></p></div>';
  }

  $use_ipod = get_option('wetomo_use_ipod');
  if (($use_ipod === false) || ($use_ipod==0))
    $use_ipod = '';
  else
    $use_ipod = 'checked="yes"';
  $use_bb = get_option('wetomo_use_bb');
  if (($use_bb === false) || ($use_bb==0))
    $use_bb = '';
  else
    $use_bb = 'checked="yes"';
  $use_android = get_option('wetomo_use_android');
  if (($use_android === false) || ($use_android==0))
    $use_android = '';
  else
    $use_android = 'checked="yes"';
  $mobilecss = get_option('wetomo_mobilecss');
  if ($mobilecss === false) 
    $mobilecss = wetomo_default_mobilecss();
?>
  <div class="wrap">
  <h2>Wetomo - Wordpress to mobile Options Page</h2>
  <form name="wetomo_options_form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=' . basename(__FILE__); ?>" method="post">
  <ul style="width:75%">
<?php
  echo "<li><input type=\"checkbox\" name=\"wetomo_use_ipod\" id=\"wetomo_use_ipod\" $use_ipod /> <strong>Mobilize iPhone/iPod</strong><br />\n";
  echo "<input type=\"checkbox\" name=\"wetomo_use_bb\" id=\"wetomo_use_bb\" $use_bb /> <strong>Mobilize Blackberry</strong><br />\n";
  echo "<input type=\"checkbox\" name=\"wetomo_use_android\" id=\"wetomo_use_android\" $use_android /> <strong>Mobilize Android</strong><br />\n";
  echo "You can enable use of Wetomo for iPhone/iPod, Blackberry or Android phoes by selecting the checkboxes above.</li>\n";
  echo "<input type=\"hidden\" name=\"wetomo_mobilecss\" value=\"$mobilecss\" />";
  echo "<li><strong>Handheld Stylesheet</strong>: <input type=\"text\" name=\"wetomo_mobilecss\" value=\"$mobilecss\" /> (optional)<br />\n";
  echo "Handheld stylesheet to include when displaying the mobile version of your blog.  We have a default version hosted at <a href=\"$mobilecss\">$mobilecss</a> which you can either use as is, or copy locally and modify to suit your preferences.</li>\n";
?>
  </ul>
  <div class="submit" style="float:right">
  <input type="submit" name="wetomo_options_submit" value="<?php _e('Update Options &raquo;') ?>"/>
  </div>
  </form>
  </div>
<?php
}

function wetomo_widget_init() 
{
  if ( !function_exists('register_sidebar_widget') ) 
    return;
  function wetomo_widget($args) 
  {
    extract($args);
    echo $before_widget;
    echo $before_title.'Mobile Version'.$after_title;
    echo "<a href='" . wetomo_mobile_url() . "'>Switch to mobile view:</a>";
    echo "<a href='" . wetomo_mobile_url() . "'><img style='border:none;' width='80' height='15' src='http://m.tailmaster.com/x_img/wetomo-but1.gif' /></a><br />";
    echo $after_widget;
  }
  register_sidebar_widget('wetomo Widget', 'wetomo_widget');
}

add_action('wp_head', 'wetomo_headers'); 
add_action('template_redirect', 'wetomo_redirect');
add_action('admin_menu', 'wetomo_admin');
add_action('plugins_loaded', 'wetomo_widget_init');

?>
