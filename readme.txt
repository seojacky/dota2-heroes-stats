=== Dota 2 Heroes Stats ===
Contributors: seo_jacky
Donate link: https://t.me/big_jacky
Tags: dota, dota2, heroes, statistics, esports, gaming, shortcode
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display Dota 2 heroes statistics including professional pick, ban, and win rates with a simple shortcode.

== Description ==

Dota 2 Heroes Stats is a lightweight WordPress plugin that displays up-to-date statistics for all Dota 2 heroes. Using data from the OpenDota API, this plugin shows professional match statistics including pick rates, ban rates, and win rates for each hero.

### Key Features

* **Easy Implementation**: Simple shortcode `[dota2_heroes_stats]` to add the heroes table anywhere
* **Professional Match Statistics**: View accurate data about hero usage in professional Dota 2 matches
* **Daily Updates**: Data automatically refreshes once per day to maintain accuracy while respecting API limits
* **Sortable Table**: Click on any column to sort heroes by name, picks, bans, or wins
* **Search Functionality**: Quickly find specific heroes with the built-in search filter
* **Responsive Design**: Looks great on all devices from desktop to mobile
* **Translation Ready**: Fully prepared for internationalization and localization

The plugin is perfect for Dota 2 community websites, gaming blogs, esports news sites, or any WordPress site looking to provide valuable Dota 2 statistics to their visitors.

### Pro Stats at a Glance

With Dota 2 Heroes Stats, your readers can quickly see:

* Which heroes are most frequently picked in professional matches
* Which heroes face the most bans
* Which heroes have the highest win rates at the professional level

All data is displayed in a clean, user-friendly table complete with hero icons for easy recognition.

### Developer-Friendly

The plugin is built with developers in mind:

* Clean, well-documented code
* WordPress coding standards compliant
* Hooks and filters for customization
* Optimized for performance with minimal API calls
* CSS is easily overridable for custom styling

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/dota2-heroes-stats` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Add the shortcode `[dota2_heroes_stats]` to any post or page where you want the hero statistics to appear

== Frequently Asked Questions ==

= How often is the data updated? =

The plugin updates hero statistics once per day at 3:00 GMT using WordPress cron functionality. This ensures your data stays fresh while respecting the OpenDota API rate limits.

= Do I need an API key to use this plugin? =

No, the plugin uses the free tier of the OpenDota API which doesn't require an API key.

= Can I customize the appearance of the table? =

Yes, the plugin uses standard HTML tables with specific CSS classes. You can override these styles in your theme's stylesheet to customize the appearance.

= Is the plugin compatible with page builders? =

Yes, the shortcode works in any text area of your WordPress site, including within page builders like Elementor, Beaver Builder, Divi, etc.

= What happens if the API is unavailable? =

The plugin caches the data after each successful API call. If the API becomes unavailable, the plugin will continue to display the most recently cached data until the API becomes available again.

= Can I change the update frequency? =

The current version updates data once daily at 3:00 GMT. This frequency respects the OpenDota API rate limits. Future versions may include options to customize the update schedule.

= Does this plugin slow down my website? =

No, the plugin is designed to be lightweight. It only loads its assets (CSS and JavaScript) on pages where the shortcode is used, and it caches API data to minimize server requests.

== Screenshots ==

1. Dota 2 Heroes Statistics Table
2. Responsive mobile view
3. Sorting and searching functionality

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release of Dota 2 Heroes Stats plugin.

== Privacy Policy ==

This plugin uses the OpenDota API to fetch publicly available Dota 2 game statistics. It does not collect, store, or share any personal data from your site visitors. The only API calls made are from your server to the OpenDota API to retrieve hero statistics.
