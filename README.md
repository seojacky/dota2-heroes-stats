# Dota 2 Heroes Stats

A WordPress plugin to display Dota 2 heroes statistics including professional picks, bans, and wins.

## Description

Dota 2 Heroes Stats is a lightweight WordPress plugin that fetches and displays statistics for all Dota 2 heroes. The plugin uses the OpenDota API to retrieve data about professional matches including picks, bans, and wins for each hero.

### Features

- Display a sortable table of all Dota 2 heroes with their professional statistics
- Automatically updates data once per day via WordPress cron
- Optimized with API caching to respect OpenDota's rate limits
- Fully responsive design
- Easy implementation with a simple shortcode
- Search functionality to quickly find specific heroes
- Prepared for translation and localization

## Installation

1. Upload the `dota2-heroes-stats` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the shortcode `[dota2_heroes_stats]` in any post or page where you want to display the table

## Usage

Simply add the shortcode `[dota2_heroes_stats]` to any post or page where you want the hero statistics table to appear.

The plugin will automatically fetch data from the OpenDota API once per day at 3:00 GMT to ensure your statistics are up to date while respecting API rate limits.

## Technical Details

- The plugin uses the OpenDota API (`https://api.opendota.com/api/heroStats`) to fetch hero data
- Data is cached in the WordPress database to minimize API calls
- A scheduled event (using WordPress Cron) updates the data daily at 3:00 GMT
- CSS and JavaScript files are only loaded on pages where the shortcode is present
- The plugin is fully prepared for internationalization

## Frequently Asked Questions

### How often is the data updated?

The plugin fetches fresh data from the OpenDota API once per day at 3:00 GMT.

### Can I manually trigger a data update?

Currently, the plugin updates automatically based on the schedule. A manual update option may be added in future versions.

### Do I need an API key to use this plugin?

No, the plugin uses the free tier of the OpenDota API which doesn't require an API key.

## Changelog

### 1.0.0
* Initial release

## License

This plugin is licensed under the GPL v2 or later.

## Credits

- Data provided by [OpenDota API](https://www.opendota.com)
- Developed by [seo_jacky](https://t.me/big_jacky)
