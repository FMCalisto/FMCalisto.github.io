=== Plugin Name ===
Contributors: Saleh_Coder, SalehCoder
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YERV9ZMQBF98J
Tags: people, list, academic, alumni, research, university, college, school, plugin, wordpress, academic profile, profile, users, bibliography, scholar, citations
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 0.4.1

Provides the ability to profile users academically and create categories of academic people. View a list of projects, publications, and research areas and who's involved. This is useful for school alumni and research group websites. 

== Description ==

With this plugin you can now use WordPress effectively for a research group website or alumni website by associating additional academic information to selected users. 

** Features **

*	Upgrade and downgrade a user to academic user.
*	View list of users with profile pictures and academic information.
*	Categorize your users.
*	Add and remove projects and categorize them into research areas.
*	Add publications and categorize them.


You can create categories of academic people. For example, your research group has a group for 'social network research' and another group for 'A.I. neurological research', and you want to list people working on each group separately. That's now possible with this plugin.

You can also categorize your projects into research areas. Like a research area 'Computer Engineering' has the two previously mentioned projects, 'social network research' and 'A.I. neurological research'.

Users can attach all of the following details to their accounts:

*	Academic phone number
*	Website 
*	Academic email 
*	Current job 
*	Bachelor degree area, institution, and year
*	Master degree area, institution, and year
*	Ph.D. area, institution, and year 
*	Academic biography
*	Address


Admin will have to explicitly select users and upgrade them to academic users. Those users will be able to edit their academic profiles accordingly by accessing the 'wp-admin/' directory.

To show academic users you will have to use '[academic-people-list]' shortcode in any page or post. Optionally, you can specify the 'category' and 'show_cat' attributes. Here is how to use it:

*	[academic-people-list]: All users from all academic categories and will show list of categories
*	[academic-people-list category='CATEGORY 1' show_cat='false']: Users from CATEGORY 1 and will not show list of categories
*	[academic-people-list category='Group A']: Users from Group A and will show list of categories

You can also use the follow shortcodes:

*	[academic-research-areas]: To view list of research areas. This is used for research groups. 
*	[academic-projects]: To view list of projects. You can use the 'research_area' attribute here to list all projects under that particular research area. e.g. [academic-research-areas research_area='research area 1']
*	[academic-publications]: view list of publications. The 'type' attribute is available for viewing certain type of publications.

For profile pictures to work correctly, you'll have to use the [User Photo plugin](http://wordpress.org/extend/plugins/user-photo/ "User Photo plugin"). 

You can request additional features on this [plugin WordPress forum](http://wordpress.org/tags/wp-academic-people?forum_id=10 "plugin WordPress forum").

== Installation ==

1. Upload the wp-academic-people folder to your /wp-content/plugins/ directory
2. Activate the plugin using the Plugins menu in WordPress
3. On the Admin panel, use the Academic People menu to adjust the plugin
4. Use any of the mentioned shortcodes.
5. That's it! You're all set.

Alternatively, you can easily go to plugins on the admin panel and add the plugin by searching the name. It will automatically download and install it.


== Changelog ==

= 0.1.1 =
*Fixed issue with viewing images.
*Added detailed page for each individual.

= 0.1.2 =
* Fixed an issue where user was unable to edit his/her academic profile.

= 0.1.3 =
* Fixed an issue where a user photo was not appearing.

= 0.2.0 =
* Introduced Projects and Research Areas functionality.

= 0.3.0 =
* Introduced Publications functionality.
* Done some fixing here and there.

= 0.3.1 =
* Minor change to fix issue with profile picture not showing.

= 0.3.2 =
* Minor improvements here and there.

= 0.4.0 =
* Fixed an issue where the plugin does not work when permalinks is activated. 

= 0.4.1 =
* Fixed an issue where the full name is displayed incorrectly when the middle name is empty. 

== Upgrade Notice ==

= 0.1.1 =
* Fixed various issues.

= 0.1.2 =
* Fixed an issue where user was unable to edit his/her academic profile. UPGRADE IMMEDIATELY!

= 0.1.3 =
* Fixed an issue where a user photo was not appearing. UPGRADE IMMEDIATELY!

= 0.2.0 =
* Added the ability to add projects and research areas. You can assign users to projects.

= 0.3.0 =
* Now you can add publications like journals and conference papers.

= 0.3.1 =
* Compulsory update to fix issue with picture profile not showing.

= 0.3.2 =
* Minor improvements here and there.

= 0.4.0 =
* Now works with permalinks activated. Sorry for the delay on the fix.

= 0.4.1 =
* Fixed issue with full name being displayed incorrectly in some occasions. Thanks to Xabier.






