=== MailPress ===
Contributors: andre renaut
Donate link: http://www.mailpress.org/wiki
Tags: mail, mails, comments, comment, subscribe, newsletters, newsletter, Wordpress, Plugin, swiftmailer, post, posts, smtp, sendmail, phpmail, notification, notifications, mail, mails, contact form
Requires at least: 3.3
Tested up to: 3.3
Stable tag: 5.2.1

The WordPress mailing platform 

== Description ==

1. Style your html and plain text mails with dedicated themes and templates.
1. Double opt-in subscription.
1. Subscriptions to Comments, Newsletters/Post notifications and even to Mailing lists.
1. Newsletters/Post notifications on a per post, daily, weekly, monthly basis.
1. Optional : full control on all mails sent by WordPress.

**Follow Installation or Upgrade guidelines**

Some technical stuff :

1. Switmailer 4.1.4
1. jQuery 1.7.1 supported.
1. Google Map API V3 supported.
1. Code Mirror 0.9 (2.2)

Some bugs fixed of course (see changelog)

Please report any bug in the mailpress google group http://groups.google.com/group/mailpress
starting your subject title with : "(MailPress 5.2)".

Thank you

== Installation ==

1. Make sure you have already installed WordPress 3.3 or above.
1. Unzip the MailPress package.
1. Upload the mailpress folder into wp-content/plugins.
1. Make sure the wp-content/plugins/mailpress/tmp folder is writable.
1. Log in to your WordPress admin and point your browser to "Plugins" page.
1. Activate MailPress plugin.
1. Point your browser to "Plugins > MailPress Add-ons" and activate required/desired add-ons.
1. Point your browser to "Settings > MailPress", fill and save the settings for each tab (General, (Connection to your mail server), Test, ... add-ons).
1. Once everything is installed, use the Test tab in "Settings > MailPress" to validate your settings.

**Never use WordPress automatic upgrade** : you will loose the content of mailpress/mp-content and mailpress/tmp folders !

== Upgrade Notice ==

**Never use WordPress automatic upgrade** : you will loose the content of mailpress/mp-content and mailpress/tmp folders !

1. Point your browser to "Plugins > MailPress Add-ons" page and deactivate all add ons.
1. Point your browser to "Plugins" page and deactivate MailPress plugin.
1. Save mailpress/tmp folder + your MP theme + any customized file in mailpress/mp-content/advanced (since 5.0.1, xml format in mp-content/advanced/newsletters has changed).
1. Delete wp-content/plugins/mailpress folder.
1. Unzip the MailPress package.
1. Upload the mailpress folder into wp-content/plugins.
1. Make sure the wp-content/plugins/mailpress/tmp folder is writable.
1. Restore mailpress/tmp folder + your MP theme + any customized file in mailpress/mp-content/advanced (since 5.0.1, xml format in mp-content/advanced/newsletters has changed).
1. If you implemented page or category template, upgrade from mailpress/mp-content/xtras folder if necessary.
1. Refresh "Plugins" page and activate MailPress plugin.
1. Activate MailPress previous add-ons (Plugins > MailPress Add-ons) + new ones such as Newsletter or Comment if previously used.

MailPress themes and templates do not need to be changed if customized in a previous MailPress release. 

== Frequently Asked Questions ==

* see wiki page http://www.mailpress.org/wiki

== Screenshots ==

1. none

== Changelog ==

** 5.2.1 ** 12/25/2011
* some code optimizations and fixes on admin lists
* Switmailer 4.1.4
* Walker args consistancy (avoid E_STRICT php errors)
* Google Map Api V3 changes : fixing js bugs +  change icons
* bug fix : http://blog.mailpress.org/2011/12/21/bug-notification-mailpress-5-2/

** 5.2 ** 12/13/2011
* Child themes
   - A MailPress child theme is a theme that inherits the functionality of another theme, called the parent theme, and allows you to modify, or add to, the functionality of that parent theme.
   - All mp themes reviewed
   - more on Child themes at http://blog.mailpress.org/2011/11/16/child-themes/
* Help admin bar
   - adding per_page parameter on all mailpress admin lists
   - contextual help
* Add-Ons
   - (bug fix) MP_Bounce_api.class.php not tallying bounces correctly
   - MailPress_Import : 'export' files are now included in media list
   - MailPress_Upload_media : support 'Upload/Insert' new media button on editor
   - MailPress_delete_old_mails : new add-on
   - MailPress_WPML : not tested in 5.2 and not supported by me !
   - smtp, sendmail, php_mail connections reviewed
* Miscellaneous
   - new design for some setting tabs
   - new design for pagination block on lists (same as wp)
   - logs : automatically activated on first activation (plugin & add-ons), files named changed, purge reviewed
   - css reviewed, list icons reviewed.
   - some javascript changes for mp-ajax-response, mp-lists, thickbox, markerclusterer ...
   - pluggable functions reviewed
   - tracking deprecated functions ...
   - lot of mailpress classes renamed (mostly abstract ones)
   - file_exists() replaced by is_file()
   - upgrade to SwiftMailer 4.1.3 + specific batchSend()
   - commented code removed
   - MP_Mail viewhtml() and viewplaintext() merged in view()

** 5.1.1 ** 09/03/2011

09/03/11
* add 'waiting' list in New Mail

08/14/11
* shortcode mailinglist(bug fix) autoresponder mailinglist waiting/active bug still not fixed !
* mp twentyten ten header image when wp twenty ten is not active (bug fix)
* Mails Activity pie chart (bug fix)

08/04/11
* new exporter to allow export of a mailinglist into another mailinglist
* set abstract class as abstract class

07/30/11
* Integration of WPML add on
* mp-admin/write.php + mp-admin/js/write.js + mp-includes/js/autosave.js : code review

07/28/11
* MP_Bounce.class.php    : code review fixing bugs detected by ovidiu
* MP_Pluggable.class.php : support of $message as an array

07/19/11
* New settings in bounce_handling_II when bounce_handling not active : Return-Path
* Fixing uninstall bug

** 5.1 ** 07/06/2011

Changes & Enhancements :

* MailPress::require_class deprecated, replaced by an autoloader.
* modifying some code due to WordPress deprecated functions.

1. Ip

* code review for ipinfodb provider, requires a api key now (see mailpress-config-sample.php)

1. Autoresponder

* autoresponders can be scheduled with year, month, week, day, hour.

1. Bounce & Batch

* code review, new Bounce_api class.
* better support for W3 Total Cache
* new add on for detecting bounces on mail content

1. Form

* From email and name are the visitor ones when available for recipient mail (can be overrided by your MTA).
* code review on composite field types merging default template formats with customized ones.
* (bug fix) control of recipient email when creating/modifying a new form...
* (bug fix) creating some mysql tables on install can be usefull ...

1. Newsletter

* (bug fix) changing wday for weekly newsletter for scheduler and/or processor in xml files was not working ...

** 5.0.1 ** 01/12/2010

Changes & Enhancements :

**in 5.0.1, mp-content/advanced/newsletters : xml format has changed**

* end of support for default and classic themes.
* new mail status : archived, only available for mails with status 'sent' 
	+ new dashboard widget 
	+ wp page template sample (mailpress/mp-content/xtras/archives)
* new functions in Mail api : $this->the_subject(); $this->get_the_subject();
* MailPress now supports Google Map API V3. 'google map api key' in general settings suppressed !
* all themes reviewed (HTML5).
* theme selection in 'MailPress test' metabox
* wp_enqueue scripts for MailPress subscription form available (see mailpress/mailpress-config-sample.php).
* (bug fix) ajax for widget requires home url instead of site url !
* (bug fix) is_email (javascript) : uppercase allowed in local part of email
* (bug fix) dashboard widget init var (subscriber activity)
* (bug fix) tracking widget url for os & browser icons
* (bug fix) remove edited mailinglist from parent list
* (bug fix) MailPress wp_mail now supports attachments
* (bug fix) provider Infosniper discarded.

1. ! New add-on ! Name_fields : to generate custom fields based on subscriber's name (original idea of Graham)

1. Autoresponder

* autoresponders scheduled with month : 0, day : 0, hour : 0 are now send directly (no wp_cron scheduling).

1. Form

* field_types :
	** (all) : code reviewed
	** captcha_gd2 : words files (en, es, fr) reviewed
	** geotag : support of Google Static Maps API V2

* minor change on tab orders for form settings
* due to support of Google Static Maps API V2, no more maps stored in tmp folder.
* (bug fix) deleting related fields when deleting a form + adding primary keys on related mysql tables.

1. Mailing list

* can subscribe to default mailing list
* two new autoresponder events (subscribe/unsubscribe to specific mailing list)

1. Newsletter

**mp-content/advanced/newsletters : xml format has changed**
* new settings for processors to define the beginning of a period of time to select posts (day, week, month)
* schedulers & processors reviewed

1. Post

* manual template simplified and called only if posts attached to the mail.

1. Tracking_ga

* (bug fix) anchor bug fixed !

1. Tracking_rewrite_url

* (bug fix) support of home and site urls !

1. Others : Import, Ip, Tracking ...

* code review in mp-includes/class/options

** 5.0 ** 06/13/2010

Changes & Enhancements :

1. Add-ons specific admin page (Plugins > MailPress Add-ons) 

* for developpers, more info in mp-content/add-ons/readme.txt

1. Comment

* becomes an autonomous add-on
* Settings > MailPress > subscriptions shows a disabled checked option as a reminder
* Subscriber to comments to a post now have a link to manage their subscriptions instead of a checked box.

1. Newsletter

* becomes an autonomous add-on
* newsletter declarations are now stored in xml files (mp-content/newsletters).

1. Mailing lists

* list code review.

fixes several bugs since 4.0.2 released Nov 17, 2009 :

1. bounces : 

* (bug fix) code sequence changed for connect/disconnect to db

1. pluggable :  

* (bug fix) password reset was not working : invalid link

1. tracking : 

* (bug fix) better detections of links to track.
* (bug fix) mp-admin/includes/settings/tracking.php : php syntax error.
* (bug fix) changing '&amp;amp;' to '&' before storing original link.
* (bug fix) tallying opened + clicked per day.

1. mail links

* (review) mp-includes/class/MP_Mail_links.class.php

1. Dashboard widgets :

* (bug fix) subscriber activity.
* code review for some widgets using google charts.



**Please Donate** https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=andre%2erenaut%40gmail%2ecom&lc=US&item_name=MailPress&item_number=gg&amount=5%2e00&currency_code=EUR&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest
