=== Plugin Name ===
Contributors: meixxi
Donate link: http://www.cip4.org
Tags: download, folder, file based, no database
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: 1.12
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget that list all files in a defined folder for download.

== Description ==

This widget lists all files form a specified directory for download. Further, 
there is a download counter which indicates the total number downloads per file.
In contrast to most other download manager, this widget comes without a database.
All information needed are stored in a hidden CSV file in the directory.

Another advantage, no manual upload of files is needed. Just put your fils via ssh
or ftp to the specified directory and everything is fine. 

Originally this plugin was developed for personal use, only. However, if you like it, feel free
to use it :-)

The download icons are part of the crystal project and are published under GNU Lesser General Public License 2.1 (LGPL) 
(http://creativecommons.org/licenses/LGPL/2.1/)

Shortcode: cip4download

Shortcode Attributes:
title = Widget title
folder = Download Folder
is_desc = Descending Order (true / false)

Example [cip4download title="MyFolder" folder="wp-content/uploads/" is_desc="true"]

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the `cip4-folder-download-widget` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. The Widget is optimized to be included by shortcodes using ids.

== Frequently Asked Questions ==

* if you have some questions feel free to contact me!


== Screenshots ==

1. Screenshot of the widget
2. Widget configuration
3. Implementation using shortcuts

== Changelog ==

= 1.0 =
* First very simple version

= 1.1 =
* Icons for mime types
* Implementation of time interval for all items younger than  a month.
* Automtic extension of the last slash in configuration if necessary

= 1.2 =
* Minor Bugfix
* Extension of the documentation 

= 1.3 =
* Sort mechanism for filename (asc and desc)

= 1.4 =
* New download mechanism.

= 1.5 =
* Automatic Content-Type detection.

= 1.6 =
* Improvement download mechanism.

= 1.7 =
* Bugfix.

= 1.8 =
* I'm sorry for that, but there was another bug...

= 1.9 =
* Introduction of own shortcode "cip4download"

= 1.10 =
* Performance improvement.

= 1.11 =
* Security update.

= 1.12 =
* Minor Bugfix.

== Upgrade Notice ==

= 1.0 =
* First version

= 1.1 =
* Usability improvements
* Appearance improvements

= 1.2 =
* Minor Bugfix

= 1.3 =
* New feature: sort mechanism for filename

= 1.4 =
* New download mechanism.

= 1.5 =
* Automatic Content-Type detection.

= 1.6 =
* Improvement download mechanism.

= 1.7 =
* Bugfix.

= 1.8 =
* I'm sorry for that, but there was another bug...

= 1.9 =
* Introduction of own shortcode "cip4download"

= 1.10 =
* Performance improvements

= 1.11 =
 * Protection against directory traversal
 
 = 1.12 =
 * Minor Bugfix

== Arbitrary section ==

Yeahh...

== A brief Markdown Example ==


