=== Plugin Name ===
Contributors: davidwalsh83
Tags: categories, posts
Requires at least: 3.0.1
Tested up to: 3.4.2
Stable tag: 1.01
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows WordPres admins to prevent posts in a given category from dislaying on the homepage / main loop.

== Description ==

This plugin allows WordPres admins to prevent posts in a given category from dislaying on the homepage / main loop.

A new checkbox will display on the "Add New Category" and "Edit Category" screens -- it's that simple!

== Installation ==

Installation is easy:

1. Upload `remove-category-from-loop.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Will posts in given categories still display within the RSS feed? =

Yes, posts in marked categories will still display in the RSS feed in their normal position.

= What is this plugin's option key? =

The option key is `remove-loop-cats`;  all categories marked not to display in the main loop are stored in this option to keep the DB footprint as low as possible.

== Screenshots ==

1. The checkbox appears on the "Add New Category" and "Edit Category" forms.

== Changelog ==

= 1.01 =
* Improved layout of both the "Add Category" and "Edit Category" screens
* Fixed option key value within the FAQ

= 1.0 =
* Initial release of plugin