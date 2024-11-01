=== Wetomo Wordpress to Mobile ===
Contributors: r1schmidt
Tags: mobile, formatting, xhtml, cellphone, handset, wetomo, phone, pda, stylesheet, handheld, widget
Requires at least: 2.0.2
Tested up to: 2.7.1
Stable tag: 0.3

This plugin will detect mobile phones, and redirect to m.tailmaster.com as proxy
to display a mobile optimized version of the page.

== Credits ==
Essentially all credits go to Mike Rowehl (email : info@mowser.com) since I 
only had to change a few lines of Mike's Mowser Wordpress Mobile code to 
adapt it to Wetomo. 

== Description ==
Wetomo (Web to Mobile) is a service that allows publishers to display
their existing web content to users on mobile phones and other handheld 
devices.  This plugin detects when a user is on a mobile phone and 
automatically redirects them to Wetomo, which acts a a proxy between the
mobile phone and the Wordpress site and adapts the web site content to the 
mobile phone capabilities.

For more information about Wetomo see http://wetomo.tailmaster.com. 

== Installation ==

Like most other WordPress plugins, you can install the Wetomo plugin by
unpacking the distributed plugin file in the wp-content/plugins directory
of your WordPress installation.  Once unpacked you should see a "Wetomo -
Wordpress to mobile" entry in the "Plugins" tab of your administrative 
interface for WordPress. You'll need to use the "Activate" link under 
Plugin Management to start using the plugin.

As soon as the plugin is active it will start redirecting mobile users to the
Wetomo version of your blog.  You can test this on your own phone by entering
the URL for your blog into your mobile browser.  Or if you don't have a phone
that you can test web pages from you can try using the OperaMini Simulator:

http://www.operamini.com/demo/

To conveniently check the Wetomo presentation of your pages via OperaMini I suggest
to use a Bookmarklet that you can find here:

http://www.opera.com/mini/developer/#bookmarklet


You can disable selected sections of your site by entering the HTML tag attribute
wtm_skip="1' in any nested HTML tag. If Wetomo finds such a tag attribute it will
not display the content of that tag and all its children. 
For more details see http://wetomo.tailmaster.com

== Screenshots ==

1. Wetomo provides a navigation bar and a content area. In the navigation bar Wetomo
allows the user to specify the mobile device capabilities (such as display size or 
max. memory) via the MySettings section. The content may be split in sub pages depending
on the device memory (see the navigation elements in the screenshot).
2. Images on your site are resized based on the device capabilities as specified by the
user.

== Frequently Asked Questions ==

= How do I configure custom advertising for my mobile version? =

If you would like to add AdMob advertisements to the mobile version of your
pages all you have to do is to add the following tag at the locations where 
you want to display the Admob ad:
<wtm_ad net="admob" pub="<publisher_account>" context="<keywords>" />
Note that this code will not interfere with the user experience even if users
visit your site without the Wetomo proxy. 
For more details see http://wetomo.tailmaster.com/?page_id=9#ads

= Is there a way to structure the page for easy mobile navigation? =

You can specify sections in your page that shall be displayed on the mobile phone. 
Each section is given a label that is used for navigation. In essence these sections 
are specified by using Wetomo specific tag attributes that can be added to nearly any 
tag. Wordpress themes allow to specify these tag attributes at selected locations, 
making them valid for all pages shown.
For more details see http://wetomo.tailmaster.com/?page_id=9#pagestruc

= Can I showcase to my users how my site would look like on a cell phone? =

Absolutely, besides Opera Mobile there is a emulator available to do that. For details
check out the emulator section at http://wetomo.tailmaster.com/?page_id=9#emulator

== Release Notes ==

= V0.3 =

* automatic detection of device capabilities, such as display size and deck size
* ability to enable/disable mobilization via Wetomo for iPhone, Blackberry or Android. 
* support for additional ad networks, see http://wetomo.tailmaster.com/?page_id=9#ads
* adaptation to changes on the Wetomo server side, see http://wetomo.tailmaster.com/?page_id=50 
for details of service improvements


= V0.2 =

* improved reload function to prevent side effects caused by filtering wap gateways  
* changed default css
* adaptation to changes on the Wetomo server side, see http://wetomo.tailmaster.com/?page_id=50 
for details of service improvements

= V0.1 = 

* initial release
