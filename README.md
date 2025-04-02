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

### 1.0
* Initial release

## Example API

`https://api.opendota.com/api/heroStats'

```
[
  {
    "id": 1,
    "name": "npc_dota_hero_antimage",
    "primary_attr": "agi",
    "attack_type": "Melee",
    "roles": [
      "Carry",
      "Escape",
      "Nuker"
    ],
    "img": "/apps/dota2/images/dota_react/heroes/antimage.png?",
    "icon": "/apps/dota2/images/dota_react/heroes/icons/antimage.png?",
    "base_health": 120,
    "base_health_regen": 1,
    "base_mana": 75,
    "base_mana_regen": 0,
    "base_armor": 1,
    "base_mr": 25,
    "base_attack_min": 29,
    "base_attack_max": 33,
    "base_str": 21,
    "base_agi": 24,
    "base_int": 12,
    "str_gain": 1.6,
    "agi_gain": 2.8,
    "int_gain": 1.8,
    "attack_range": 150,
    "projectile_speed": 0,
    "attack_rate": 1.4,
    "base_attack_time": 100,
    "attack_point": 0.3,
    "move_speed": 310,
    "turn_rate": null,
    "cm_enabled": true,
    "legs": 2,
    "day_vision": 1800,
    "night_vision": 800,
    "localized_name": "Anti-Mage",
    "1_pick": 21710,
    "1_win": 11154,
    "2_pick": 64046,
    "2_win": 32809,
    "3_pick": 83058,
    "3_win": 42480,
    "4_pick": 83176,
    "4_win": 42385,
    "5_pick": 63749,
    "5_win": 32185,
    "6_pick": 39915,
    "6_win": 19986,
    "7_pick": 23774,
    "7_win": 11784,
    "8_pick": 11723,
    "8_win": 5785,
    "turbo_picks": 150574,
    "turbo_picks_trend": [23002, 23423, 25984, 25659, 21078, 20316, 11112],
    "turbo_wins": 78108,
    "turbo_wins_trend": [11862, 12137, 13557, 13380, 10912, 10446, 5814],
    "pro_pick": 158,
    "pro_win": 73,
    "pro_ban": 416,
    "pub_pick": 423807,
    "pub_pick_trend": [61845, 64238, 71536, 73240, 60786, 59093, 33069],
    "pub_win": 214994,
    "pub_win_trend": [31129, 32633, 36218, 37163, 31040, 30099, 16712]
  },
...
{
    "id": 145,
    "name": "npc_dota_hero_kez",
    "primary_attr": "agi",
    "attack_type": "Melee",
    "roles": [
      "Carry",
      "Escape",
      "Disabler"
    ],
    "img": "/apps/dota2/images/dota_react/heroes/kez.png?",
    "icon": "/apps/dota2/images/dota_react/heroes/icons/kez.png?",
    "base_health": 120,
    "base_health_regen": 1,
    "base_mana": 75,
    "base_mana_regen": 0,
    "base_armor": 1,
    "base_mr": 25,
    "base_attack_min": 23,
    "base_attack_max": 29,
    "base_str": 19,
    "base_agi": 27,
    "base_int": 18,
    "str_gain": 2.6,
    "agi_gain": 3.5,
    "int_gain": 1.7,
    "attack_range": 225,
    "projectile_speed": 900,
    "attack_rate": 2,
    "base_attack_time": 100,
    "attack_point": 0.35,
    "move_speed": 315,
    "turn_rate": 1,
    "cm_enabled": false,
    "legs": 2,
    "day_vision": 1800,
    "night_vision": 800,
    "localized_name": "Kez",
    "1_pick": 6469,
    "1_win": 3006,
    "2_pick": 15415,
    "2_win": 6938,
    "3_pick": 19489,
    "3_win": 8723,
    "4_pick": 22072,
    "4_win": 9848,
    "5_pick": 19378,
    "5_win": 8600,
    "6_pick": 15244,
    "6_win": 6894,
    "7_pick": 10974,
    "7_win": 5127,
    "8_pick": 5970,
    "8_win": 2768,
    "turbo_picks": 66605,
    "turbo_picks_trend": [9415, 10304, 10912, 11167, 10243, 9623, 4941],
    "turbo_wins": 30055,
    "turbo_wins_trend": [4245, 4678, 5008, 5033, 4535, 4349, 2207],
    "pro_pick": 18,
    "pro_win": 8,
    "pro_ban": 30,
    "pub_pick": 125457,
    "pub_pick_trend": [17236, 18990, 20373, 20527, 19615, 18600, 10116],
    "pub_win": 56772,
    "pub_win_trend": [7782, 8674, 9194, 9401, 8718, 8385, 4618]
  }
]
```

`https://api.opendota.com/api/constants/hero_abilities`

```
{
  "npc_dota_hero_antimage": {
    "abilities": [
      "antimage_mana_break",
      "antimage_blink",
      "antimage_counterspell",
      "antimage_counterspell_ally",
      "antimage_persectur",
      "antimage_mana_void"
    ],
    "talents": [
      {
        "name": "special_bonus_hp_regen_3",
        "level": 1
      },
      {
        "name": "special_bonus_unique_antimage_manavoid_aoe",
        "level": 1
      },
      {
        "name": "special_bonus_unique_antimage_7",
        "level": 2
      },
      {
        "name": "special_bonus_unique_antimage_5",
        "level": 2
      },
      {
        "name": "special_bonus_unique_antimage_6",
        "level": 3
      },
      {
        "name": "special_bonus_unique_antimage_8",
        "level": 3
      },

```

`https://api.opendota.com/api/heroes`

```
[
  {
    "id": 1,
    "name": "npc_dota_hero_antimage",
    "localized_name": "Anti-Mage",
    "primary_attr": "agi",
    "attack_type": "Melee",
    "roles": [
      "Carry",
      "Escape",
      "Nuker"
    ],
    "legs": 2
  },
  {
    "id": 2,
    "name": "npc_dota_hero_axe",
    "localized_name": "Axe",
    "primary_attr": "str",
    "attack_type": "Melee",
    "roles": [
      "Initiator",
      "Durable",
      "Disabler",
      "Carry"
    ],
    "legs": 2
  },
```

## License

This plugin is licensed under the GPL v2 or later.

## Credits

- Data provided by [OpenDota API](https://www.opendota.com)
- Developed by [seo_jacky](https://t.me/big_jacky)
