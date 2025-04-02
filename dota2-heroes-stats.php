<?php
/**
 * Plugin Name: Dota 2 Heroes Stats
 * Plugin URI: https://github.com/seojacky/dota2-heroes-stats
 * Description: Display Dota 2 heroes statistics with a shortcode [dota2_heroes_stats].
 * Version: 1.0
 * Author: seo_jacky
 * Author URI: https://t.me/big_jacky
 * Text Domain: dota2-heroes-stats
 * Domain Path: /languages
 * GitHub Plugin URI: https://github.com/seojacky/dota2-heroes-stats
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('DHS_VERSION', '1.0');
define('DHS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DHS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DHS_TEXT_DOMAIN', 'dota2-heroes-stats');

class Dota2_Heroes_Stats {
    /**
     * Constructor
     */
    public function __construct() {
        // Initialize the plugin
        add_action('plugins_loaded', array($this, 'init'));
        
        // Register activation hook
        register_activation_hook(__FILE__, array($this, 'activate'));
        
        // Register deactivation hook
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        // Add shortcode
        add_shortcode('dota2_heroes_stats', array($this, 'shortcode_callback'));
        
        // Register cron event for API data update
        add_action('dhs_daily_cron_event', array($this, 'update_heroes_stats'));
        
        // Conditionally load scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Load translations
        load_plugin_textdomain(DHS_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    /**
     * Actions to perform on plugin activation
     */
    public function activate() {
        // Schedule daily cron job at 3:00 GMT
        if (!wp_next_scheduled('dota2_heroes_stats_cron_event')) {
            // Get timezone offset to calculate 3:00 GMT in local server time
            $gmt_offset = get_option('gmt_offset');
            $timestamp = strtotime('tomorrow 03:00:00') - ($gmt_offset * HOUR_IN_SECONDS);
            wp_schedule_event($timestamp, 'daily', 'dota2_heroes_stats_cron_event');
        }
        
        // Perform initial data fetch
        $this->update_heroes_stats();
    }
    
    /**
     * Actions to perform on plugin deactivation
     */
    public function deactivate() {
        // Clear scheduled cron job
        wp_clear_scheduled_hook('dota2_heroes_stats_cron_event');
    }
    
    /**
     * Fetch heroes stats from OpenDota API and store in database
     */
    public function update_heroes_stats() {
        $api_url = 'https://api.opendota.com/api/heroStats';
        
        $response = wp_remote_get($api_url, array(
            'timeout' => 15
        ));
        
        if (is_wp_error($response)) {
            error_log('Dota 2 Heroes Stats API Error: ' . $response->get_error_message());
            return;
        }
        
        $body = wp_remote_retrieve_body($response);
        $heroes_data = json_decode($body, true);
        
        if (empty($heroes_data) || !is_array($heroes_data)) {
            error_log('Dota 2 Heroes Stats: Invalid API response');
            return;
        }
        
        // Sort heroes by ID
        usort($heroes_data, function($a, $b) {
            return $a['id'] - $b['id'];
        });
        
        // Store data in WordPress options with timestamp
        $data_to_store = array(
            'timestamp' => time(),
            'heroes' => $heroes_data
        );
        
        update_option('dhs_heroes_data', $data_to_store);
    }
    
    /**
     * Conditionally enqueue scripts and styles
     */
    public function enqueue_scripts() {
        global $post;
        
        // Only load assets if the shortcode is present
        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'dota2_heroes_stats')) {
            wp_enqueue_style(
                'dhs-styles', 
                DHS_PLUGIN_URL . 'assets/css/dota2-heroes-stats.css', 
                array(), 
                DHS_VERSION
            );
            
            wp_enqueue_script(
                'dhs-scripts', 
                DHS_PLUGIN_URL . 'assets/js/dota2-heroes-stats.js', 
                array('jquery'), 
                DHS_VERSION, 
                true
            );
            
            // Localize script with translation strings
            wp_localize_script('dhs-scripts', 'dhsTranslations', array(
                'heroColumnTitle' => __('Hero', DHS_TEXT_DOMAIN),
                'proPicksColumnTitle' => __('Pro picks', DHS_TEXT_DOMAIN),
                'proBansColumnTitle' => __('Pro bans', DHS_TEXT_DOMAIN),
                'proWinsColumnTitle' => __('Pro wins', DHS_TEXT_DOMAIN),
                'dataUpdated' => __('Data updated:', DHS_TEXT_DOMAIN),
                'noDataAvailable' => __('No heroes data available. Please try again later.', DHS_TEXT_DOMAIN),
                'loading' => __('Loading heroes data...', DHS_TEXT_DOMAIN)
            ));
        }
    }
    
    /**
     * Shortcode callback function
     */
    public function shortcode_callback($atts) {
        // Get stored heroes data
        $stored_data = get_option('dhs_heroes_data');
        
        // Check if we have data
        if (empty($stored_data) || empty($stored_data['heroes'])) {
            return '<div class="dhs-error">' . __('No heroes data available. Please try again later.', DHS_TEXT_DOMAIN) . '</div>';
        }
        
        $heroes = $stored_data['heroes'];
        $last_updated = date_i18n(get_option('date_format') . ' ' . get_option('time_format'), $stored_data['timestamp']);
        
        // Start building output
        $output = '<div class="dhs-container">';
        // Add search container directly in PHP
        $output .= '<div class="dhs-search-container">';
        $output .= '<input type="text" class="dhs-search-input" placeholder="' . __('Search heroes...', DHS_TEXT_DOMAIN) . '">';
        $output .= '</div>';
        
        // Create table
        $output .= '<div class="dhs-table-responsive">';
        $output .= '<table class="dhs-heroes-table">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th>' . __('Hero', DHS_TEXT_DOMAIN) . '</th>';
        $output .= '<th>' . __('Pro picks', DHS_TEXT_DOMAIN) . '</th>';
        $output .= '<th>' . __('Pro bans', DHS_TEXT_DOMAIN) . '</th>';
        $output .= '<th>' . __('Pro wins', DHS_TEXT_DOMAIN) . '</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        
        foreach ($heroes as $hero) {
            $hero_name = isset($hero['localized_name']) ? $hero['localized_name'] : '';
            $hero_image = 'https://cdn.dota2.com/apps/dota2/images/heroes/' . str_replace('npc_dota_hero_', '', $hero['name']) . '_sb.png';
            $pro_picks = isset($hero['pro_pick']) ? $hero['pro_pick'] : 0;
            $pro_bans = isset($hero['pro_ban']) ? $hero['pro_ban'] : 0;
            $pro_wins = isset($hero['pro_win']) ? $hero['pro_win'] : 0;
            
            $output .= '<tr>';
            $output .= '<td class="dhs-hero-cell">' . $hero['id'] . '. <img src="' . esc_url($hero_image) . '" alt="' . esc_attr($hero_name) . '"> ' . esc_html($hero_name) . '</td>';
            $output .= '<td>' . esc_html($pro_picks) . '</td>';
            $output .= '<td>' . esc_html($pro_bans) . '</td>';
            $output .= '<td>' . esc_html($pro_wins) . '</td>';
            $output .= '</tr>';
        }
        
        $output .= '</tbody>';
        $output .= '</table>';
        $output .= '</div>';
        
        // Add last updated info
        $output .= '<div class="dhs-updated-info">';
        $output .= __('Data updated:', DHS_TEXT_DOMAIN) . ' ' . $last_updated;
        $output .= '</div>';
        
        $output .= '</div>';
        
        return $output;
    }
}

// Initialize the plugin
$dota2_heroes_stats = new Dota2_Heroes_Stats();
