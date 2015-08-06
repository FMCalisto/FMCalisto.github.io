=== WP Plugin Info Card ===
Contributors: briKou
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7Z6YVM63739Y8
Tags: API, plugin, card, blog, developper, design, dashboard, shortcode, ajax, WordPress, plugin API, CSS, rotate, flip card, awesome, UX, ui, showcase, theme API, themes, theme, jquery, Envato
Requires at least: 3.7
Tested up to: 4.2
Stable tag: 2.3.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

 
WPPIC displays plugins & themes data in a beautiful box with a smooth rotation effect using WP Plugin & Theme APIs. Dashboard widget included.

== Description ==

[PREMIUM ADD-ON - WP Envato Affiliate Card](http://b-website.com/wp-envato-affiliate-card-powered-envato-market-api "WP Envato Affiliate Card")


= How does it work? =

WP Plugin Info Card lets you display plugins & themes identity cards in a beautiful box with a smooth 3D rotation effect, or in a more large and responsive layout.

It uses WordPress.org plugins API & themes API to fetch data. All you need to do is provide a valid plugin/theme ID (slug name), and then insert the shortcode in any page to make it work at once!

This plugin is very light and includes scripts and CSS only if and when required (you can force scripts enqueuing in admin settings). The shortcode may be added anywhere shortcodes are supported within your theme.

The plugin also uses WordPress transients to store data returned by the API for 12 hours (720min by default), so your page loading time will not be increased due to too many requests.

The dashboard widget is very easy to set up: you simply add as many plugins and themes as you want in the admin page and they become visible in your dashboard. Fields are added on-the-fly and are sortable via drag-and-drop.

It is perfect to keep track of your own plugins!

This plugin uses the TinyMCE API to improve UI and make inserting shortcodes easier!


* NEW feature (added in 2.2): Layout option added, LARGE template added.
* NEW feature (added in 2.2): You may now provide a list of slugs (comma-separated) in your shortcode slug parameter, WPPIC will randomly choose one item from the list on each page refresh.
* NEW Beta feature (added in 2.2): You may now easily overload the plugin rendering. You need to create a new "wppic-templates" folder into your theme folder, then copy the template you want to overload from the WP Plugin Info Card "wppic-templates" folder.
* NEW Beta feature (added in 2.2): You may now create your own template file. You need to create a new "wppic-templates" folder into your theme folder, then copy the template file "wppic-template-plugin-large.php" or "wppic-template-theme-large.php" from the WP Plugin Info Card '/wppic-templates' folder. Rename the file as "wppic-template-plugin-NEWTEMPLATE.php" or "wppic-template-theme-NEWTEMPLATE.php", edit it as you go, and add your own CSS rules. Finally, call your new template by adding the following parameter in your shortcode: layout="NEWTEMPLATE"



**Please ask for help or report bugs if anything goes wrong. It is the best way to make the community benefit!**

[CHECK OUT THE DEMO](http://b-website.com/wp-plugin-info-card-for-wordpress "Try It!")


= Shortcode parameters =

* **type:** plugin, theme (default: plugin)
* **slug:** plugin slug name - Please refer to the plugin/theme URL on wordpress.org to determine its slug: https://wordpress.org/plugins/THE-SLUG/
* **layout:** template layout to use - Default is "card" so you may leave this parameter empty. Available layouts are: card, large (default: empty)
* **scheme:** card color scheme: scheme1 to scheme10 (default: default color scheme defined in admin)
* **image:** image url to replace the default image or logo(default: empty)
* **align:** center, left, right (default: empty)
* **containerid:** custom div id, may be used for anchor (default: wp-pic-PLUGIN-NAME)
* **margin:** custom container margin - eg: "15px 0" (default: empty)
* **clear:** clear float before or after the card: before, after (default: empty)
* **expiration:** cache duration in minutes - numeric format only (default: 10)
* **ajax:** load the plugin data asynchronously with AJAX: yes, no (default: no)
* **custom:** value to display: (default: empty)	
	* For plugins: url, name, icons, banners, version, author, requires, rating, num_ratings, downloaded, last_updated, download_link	
	* For themes: url, name, version, author, screenshot_url, rating, num_ratings, downloaded, last_updated, homepage, download_link


logo & banner parameters are dreprecated - not needed anymore!


= Examples =

The slug is the only required parameter for plugin. You have to set the "type" parameter for themes : type="theme"
`[wp-pic slug="wp-plugin-info-card"]`

`[wp-pic type="theme" slug="zerif-lite" align="right" expiration="60" ajax="yes"]`

`[wp-pic slug="adblock-notify-by-bweb" layout="large" scheme="scheme1" align="right" margin="0 0 0 20px" containerid="download-sexion" ajax="yes"]`

`[wp-pic slug="wp-plugin-info-card" custom="name" ] has been downloaded [wp-pic slug="wp-plugin-info-card" custom="downloaded" ] times!`


[FULL DOCUMENTATION AND EXAMPLES](http://b-website.com/wp-plugin-info-card-for-wordpress "Documentation & examples")



= Languages =

* English
* French
* Polish - Thanks to [Kuba Mikita](http://www.wpart.pl/ "Kuba Mikita")
* Deutsch - Thanks to [Christian Zumbrunnen](https://profiles.wordpress.org/chzumbrunnen "Christian Zumbrunnen")
* Serbo-Croatian - Thanks to Andrijana Nikolic from [Web Hosting Geeks](http://webhostinggeeks.com/ "Web Hosting Geeks")

Become a translator and send me your translation! [Contact-me](http://b-website.com/contact "Contact")


== Installation ==

1. Upload and activate the plugin (or install it through the WP admin console)
2. Click on the "WP Plugin Info Card" sub-menu
3. Follow instructions, every option is documented ;-)

== Frequently Asked Questions ==

= Is the card-flipping effect cross-browser compatible? =

Yes, it is compatible with most recent browsers, except for Opera (but IE10+ works!)


== Screenshots ==

1. Plugin identity card
2. Admin page
3. Dashboard widget
4. Shortcode builder
5. Shortcode button
6. Another example with a theme (back of the card), a plugin with a custom icon, a plugin without icon (default WorPress logo)
7. Theme with the large layout
8. Plugin with the large layout
9. Plugin with the large layout in the sidebar


== Changelog ==

= 2.3.9 =
* Fix a PHP warning using is_wp_error if plugin or theme slug does not exists
* Fix a JS bug on the preview card when changing the color sheme on the fly
* Minor CSS fix in the admin with WP 4.2 (.card class is now used by the core in admin)
* Tested on WP 4.2 with success!
* readme.txt update

= 2.3.8 =
* Serbo-Croatian translation by Andrijana Nikolic from [Web Hosting Geeks](http://webhostinggeeks.com/ "Web Hosting Geeks")
* Targeting user appreciation links to 5 stars :)
* Replace the credit's link target with the plugin's documentation english page

= 2.3.7 =
* French translation updated
* New option added to ask for displaying the credit on cards.
* Security issue fix thanks to [Julio Potier](https://profiles.wordpress.org/juliobox "Julio Potier") :)


= 2.3.6 =
* Minor CSS fix - max-with 100% for large layout image
* Use PNG icon as SVG fallback on the visual editor button

= 2.3.5 =
* Change "Download" into "More info" on card layout
* Translations update

= 2.3.4 =
* Deutsch translation by [Christian Zumbrunnen](https://profiles.wordpress.org/chzumbrunnen "Christian Zumbrunnen")

= 2.3.3 =
* Minor security improvements
* Minor CSS fix on dashboard widget
* Purge transients on plugin activation/updates

= 2.3.2 =
* Fix date format on dashboard widget
* Date internationalization
* Templates update for better date support

= 2.3.1 =
* Minor PHP improvements
* Check if Memcache is loaded to prevent unncessary db request during transients purge
* Template update - differents links added on icons
* Remove logo from meta
* Minor CSS updates

= 2.3 =
* PHP fixes on admin error
* Better performance - options stored in a global var (less db requests)
* Relief of admin page functions (more maintainable)
* FR Translation fixes - backslash issues

= 2.2.1 =
* New hook added
* readme.txt update

= 2.2 =
* Total re-factoring of the plugin core files and structures
* Many hooks added
* CSS updates and fixes
* Translation update
* PHP fixes
* Fixed issue on Widget cache duration (5min)
* Random slug from slugs list (comma-separated)
* Large layout template added
* Color scheme and layout parameters added to WYSIWYG UI
* Custom template layout support
* Better scripts enqueuing (new action)
* New option to force scripts enqueuing
* Tested on WP 4.1 with success!
* New screenshots
* readme.txt update
* Special thanks to [Hugh Lashbrooke](https://profiles.wordpress.org/hlashbrooke "Hugh Lashbrooke") for his help in improving the plugin :)

= 2.1 =
* Many hooks added
* More clean code and template render
* Clear cache button in admin
* CSS updates and fixes
* Translation update
* PHP fixes
* Remove ugly paypal donate button in admin
* Random slug from slugs list (comma-separated)
* Large layout template added

= 2.0.1 =
* SVG logo in admin menu (base64 encoded)
* Improvement of theme & plugin template
* PHP fix
* Square image for themes card
* readme.txt update

= 2.0 =
* Media upload in TinyMCE ui modal for default thumb
* Introduction of card template (beta)
* Theme API added + new template
* Using WordPress native functions to fetch data from API, including icon and banner
* Remove banner + logo parameters
* Many PHP bug fixes
* Js improvement (better ui)
* CSS improvement (better ui)
* Widget improvement fot plugins+theme display
* Set transient default lifetime to 720 (before 10)
* Specifice transient for widget (10 min)
* Translation string added
* Form validation in TinyMCE ui modal
* New admin options for theme API
* readme.txt update

= 1.7 =
* New option for color scheme
* New param for color scheme
* Minor CSS improvements
* 10 new colors schemes/skins

= 1.6.2 =
* Polish translation by [Kuba Mikita](http://www.wpart.pl/ "Kuba Mikita")
* Widget UI translation
* Plugin meta translation

= 1.6.1.1 =
* Logo on plugin directory list
* Remove unnecessary files from trunk

= 1.6.1 =
* New logo
* Minor CSS fixes
* Admin + widget minor updates

= 1.6 =
* New param added to ajaxify the card
* Fix minor php issue
* Improve dashboard widget ajax function.
* New admin option to activate or deactivate ajax on widget
* Minor CSS fixes and improvement
* Now use minify css and scripts un front
* Added error message when slug is wrong or plugin offline
* readme.txt update + admin page documentation update

= 1.5 =
* Shortcode may now be displayed everywhere in the page (content/widget) because JS & CSS are loaded via a global var.
* Ajaxify dashboard widget.
* Fix bug on saving empty plugin list with deactivated dashboard widget
* New param added to specify transient life time
* Daily cron added to purge transients

= 1.04 =
* Fix on foreach. Related topic: https://wordpress.org/support/topic/errors-on-saving-dashboard-widget?replies=5#post-6197891

= 1.03 =
* Fix on widget if plugin list is empty

= 1.02 =
* Typo fix.
* PHP fix if no plugin slug is set during options updates
* CSS fix for transparent logos
* Fix if required version already includes 'WP'
* Now translatable + add French translation
* Update readme.txt

= 1.01 =
* Typo fix.
* Add link to admin page
* Update readme.txt

= 1.0 =
* First release.

== Upgrade Notice ==

= 1.5 =
* If you have installed the plugin before version 1.5 you have to deactivate it then reactivate it in order to register the cron job which will purge the plugin transients everyday.

= 1.0 =
* First release.