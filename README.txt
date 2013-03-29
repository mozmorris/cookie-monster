=== Cookie Monster ===
Contributors: MozMorris
Tags: cookies

Displays a cookie information bar at the top of a WordPress site.

== Description ==

The plugin hooks into WordPress and displays a cookie information bar at the top of the page.

The user can choose to allow or restrict cookies. Ironically, this sets a cookie named `cookie-pref` which is either true of false. **True** is the user has allowed cookies, **false** if the user wishes to restrict cookies. It's then up to you to detect this preference throughout your WordPress site and adjust functionality accordingly.

== Installation ==

1. Upload the `cookie-monster` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= Why do I need this? =

[Read more about the EU Cookie Law (e-Privacy Directive)](http://www.ico.org.uk/for_organisations/privacy_and_electronic_communications/the_guide/cookies)

= Does this automatically restrict cookies? =

No. It provides a way to detect the user's cookie preference throughout your WordPress site

== Changelog ==

= 0.1 =
* Unleash the cookie monster.
