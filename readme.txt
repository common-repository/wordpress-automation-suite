=== WordPress Automation Suite ===
Contributors: anubisthejackle
Author URI: http://travisweston.com/
Plugin URI: http://travisweston.com/portfolio/wordpress-plugins/wordpress-automation-suite/
License: GPLv2
Donate link: http://travisweston.com/portfolio/wordpress-plugins/wordpress-automation-suite/
Tags: more, tag, content, development, travis, weston, pagination, pages, next page, next,page,intelligent,placement
Requires at least: 3.0
Tested up to: 3.3.2
Stable tag: 2.9

Makes your life easier by automating the mundane tasks of writing blog posts, so you can focus on the content.

== Description ==

Instead of focusing so much on the technical aspects of your posts, use the More Tag and Pagination modules to automate the process of adding these useful tags to your posts. Simply set the options, and let the plugin do it's job.

= Features =

 * Auto More Tag Module
 * Auto Pagination Module
 * Auto Post Tagging Module
 * Simple to understand, conversational options pages
 
Excellent quality modules allow this Automation Suite for WordPress to handle the menial task of formatting your posts for maximum effectiveness. Use the Auto More Tag Module to get that "Read More" effect that so many blogs use to lower their bounce rate, and use the Auto Pagination Module to get the multiple post pages effect that sites like Cracked.com have been using for years, to great effect.

= Auto More Tag Module =

 * Intelligent Placement
 * Set it and forget it options system

This module allows you to set guidelines for the placement of the more tags, which will be used when you write your post. Automatic placement is based on these locations, and put in using an intelligent placement in the closest, non-damaging, location.

= Auto Pagination Module =

 * Intelligent Placement
 * Set it and forget it options system

This module uses a similar Intelligent Placement system as the More tags. Using a set of guidelines such as minimum number of characters or words to break apart into multiple pages, and the number of pages that you want to break your posts into, you can set the settings, and let the plugin do the work for you.

= Auto Post Tagging Module =

 * Tagthe.net API
 
Add tags to your posts, automatically, without having to focus on them. This module uses a multitude of APIs to collect the best tags for your posts, to help you organize your site for search engines, as well as the searching reader. Never force yourself to tag your posts again.

== Installation ==

1. Upload the Zip archive to your /wp-content/plugins directory
2. Extract the files
3. Modify the settings, or rely on the default settings.

== Frequently Asked Questions ==
= I use the new no_more shortcode, but the more tag is still showing. Why? =
You're most likely using the other shortcode, amt_override, as well. If you do this, the no_more shortcode is **ignored** and will still show.

= I already use your Auto More Tag plugin. Will there be a conflict? =
Quite possibly. Auto more tag was a great plugin, which spawned this automation suite. But, with the installation of this plugin you can simply deactivate Auto More Tag, and setup the Auto More Tag module with the same settings. It is an updated version of that plugin.

= I can't seem to activate the Auto Tagger module? =
You most likely do not have the PHP cURL extension installed on your server. This is a requirement for the Auto Tagger module. You'll have to install this yourself, or if you do not have direct access to PHP, you'll have to ask your server admin to allow you access to this extension.

= What is the shortcode for Auto More Tag module's manual placement? =
That would be [amt_override]. Something to note, though, if you have the option Ignore Manual tags to true, then you can place as many of those short codes as you want, and it will ignore them all.

= I use the Pagination Module. It cuts my post off, but doesn't show new pages. Why? =
Post pagination has to be setup in the theme itself. Some themes ignore this, and don't include the required function call in the post page. Try adding a function call <?php wp_link_pages(); ?> to your themes single post page, in most cases that is *single.php* page.

= I use the More Tag Module, but my posts still show full length, why? =
It is quite possible that the theme you are using has purposely stopped any more tag use. To test this, you can change to the default WordPress theme and see if your posts show short there. If not, please contact me.

= What is Intelligent Placement? =

Intelligent Placement is a method of searching out the best placement for the tags. It does this through an analysis of the post, and finding a proper **break point**, which you can define as either an **End of Line** or a **Space**.

= Have a question? =

If you do, you should probabley email tweston@travisweston.com, or visit <http://travisweston.com/portfolio/wordpress-plugins/wordpress-automation-suite/> and post it in the comments!

== Screenshots ==

1. The Main Options Page, you turn each individual module on and off here, as well as decide if you would like to give me credit VIA a link to my site in your footer.
2. The Auto More Tag Module options page, look how simple those options are. Just fill out the paragraph, and you're set.
3. The Auto Pagination Module options page. Same conversational tone as the other modules.
4. The Auto Tagging Module, with that same conversational options page!
5. This is what the menu looks like, when all modules are activated. 

== Changelog ==
= 2.9 =
Removed the link-back credit feature.

= 2.8 =
Converted string functions over to multi-byte string functions to fix issues with non-ascii characters.

= 2.7 =
Added support for older versions of PHP by removing the anonymous function in automation-suite.php

= 2.6 =
Another error fix

= 2.5 =
Error fix important update

= 2.4 =
Fixed a glitch in Auto Tagger that throws an error when you have a single tag blacklisted.

= 2.3 =
Updated auto more tag module and added a new shortcode [no_more] which tells the post NOT to add a more tag. - Thanks to Rob Cole for the suggestion.
Thanks to Jerry Matheny as well, for finding some misspellings in the FAQ. A bit delayed, as this was in the previous version.

= 2.2 =

 * Updated auto tagger error message
 * Fixed a security glitch that could allow outside users to automatically update your blog, even if you had previously set the auto update option to no.

= 2.1 =

Fixed a nested forms glitch.

= 2.0 =

Added Auto Tagging module, and removed extraneous global calls to $wpdb, placed it as a constructor argument instead, added new footer messages, and periodic header donation request. Moved the all-post updaters to their own pages.

= 1.0 = 

Initial public release of code. Includes Auto More Tag module and Auto Pagination Module. 

== Upgrade Notice == 
= 2.9 =
Removed the link-back credit feature.

= 2.8 =
Converted string functions over to multi-byte string functions to fix issues with non-ascii characters.

= 2.7 =
Added support for older versions of PHP by removing the anonymous function in automation-suite.php

= 2.6 =
Another error fix

= 2.5 =
Error fix important update
= 2.4 =
Fixed a glitch in Auto Tagger that throws an error when you have a single tag blacklisted.

= 2.3 =

Updated auto more tag module and added a new shortcode [no_more] which tells the post NOT to add a more tag. - Thanks to Rob Cole for the suggestion.
Thanks to Jerry Matheny as well, for finding some misspellings in the FAQ. A bit delayed, as this was in the previous version.

= 2.2 =

 * Updated auto tagger error message
 * Fixed a security glitch that could allow outside users to automatically update your blog, even if you had previously set the auto update option to no.

= 2.1 =

Fixed a nested forms glitch.

= 2.0 =

Added Auto Tagging module, and removed extraneous global calls to $wpdb, placed it as a constructor argument instead, added new footer messages, and periodic header donation request. Moved the all-post updaters to their own pages.

= 1.0 =

This is the initial release of the code.