 * Plugin Name: Divi Shortcode Detector
 * Description: Detects pages using Divi shortcodes and lists them with links.
 * Version: 1.0
 * Author: maikunari
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/*
class Divi_Shortcode_Detector {

    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'detect_divi_shortcodes'));
    }

    public function add_admin_menu() {
        add_management_page(
            'Divi Shortcode Detector', 
            'Divi Shortcodes', 
            'manage_options', 
            'divi-shortcode-detector', 
            array($this, 'display_detected_pages')
        );
    }

    public function detect_divi_shortcodes() {
        if (isset($_GET['page']) && $_GET['page'] == 'divi-shortcode-detector') {
            global $wpdb;

            $query = "
            SELECT ID, post_title, post_name
            FROM $wpdb->posts 
            WHERE post_type = 'page' 
            AND post_status = 'publish' 
            AND post_content LIKE '%[et_pb_%'
            ";

            $pages_with_divi = $wpdb->get_results($query);

            // Store results for display
            update_option('divi_shortcode_pages', $pages_with_divi);
        }
    }

    public function display_detected_pages() {
        $pages = get_option('divi_shortcode_pages', []);

        echo '<div class="wrap"><h1>Detected Pages Using Divi Shortcodes</h1>';
        if (!empty($pages)) {
            echo '<ul>';
            foreach ($pages as $page) {
                $url = get_permalink($page->ID);
                echo '<li><a href="' . esc_url($url) . '" target="_blank">' . esc_html($page->post_title) . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No pages found using Divi shortcodes.</p>';
        }
        echo '</div>';
    }
}

new Divi_Shortcode_Detector();
