<?php
/**
 * Plugin Name: Line@ Notification
 * Description: A plugin application that automatically pushes new posts to users via Line@.
 * Version: 1.2.12
 * Author: YuCts Travel
 * Author URI: https://yucts.com
 * License: GPLv2 or later
 * Domain Path: /languages
 * Tested up to: 6.6
 */

// 防止直接訪問
if (!defined('ABSPATH')) {
    exit;
}

// 加載翻譯檔案
function line_at_notification_load_textdomain() {
    load_plugin_textdomain('line-at-notification', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'line_at_notification_load_textdomain');

// 新增 Line Notification 設定頁面
function line_at_notification_settings_page() {
    add_options_page(
        'Line Notification Settings',
        'Line Notification',
        'manage_options',
        'line-notification',
        'line_at_notification_settings_page_html'
    );
}
add_action('admin_menu', 'line_at_notification_settings_page');

// 設定頁面 HTML
function line_at_notification_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // 處理設定頁面提交
    if (isset($_POST['lnp_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['lnp_nonce'])), 'line_notification_settings')) {
        $line_token = isset($_POST['line_token']) ? sanitize_text_field(wp_unslash($_POST['line_token'])) : '';
        update_option('line_notification_token', $line_token);
    }

    $line_token = esc_attr(get_option('line_notification_token', ''));
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Line Notification Settings', 'line-at-notification'); ?></h1>
        <form method="POST" action="">
            <?php wp_nonce_field('line_notification_settings', 'lnp_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php esc_html_e('LINE Channel Access Token', 'line-at-notification'); ?></th>
                    <td><input type="text" name="line_token" value="<?php echo esc_attr($line_token); ?>" class="regular-text"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// 發佈新文章時推播通知
function line_at_notification_push($post_id) {
    $line_token = get_option('line_notification_token', '');

    if (empty($line_token)) {
        return;
    }

    $post_title = get_the_title($post_id);
    $post_url = get_permalink($post_id);

    // 加入譯者註解並重新排列佔位符
    /* translators: 1: post title, 2: post URL */
    $message = sprintf(__('New post published: %1$s - %2$s', 'line-at-notification'), $post_title, $post_url);

    $response = wp_remote_post('https://api.line.me/v2/bot/message/broadcast', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $line_token,
            'Content-Type' => 'application/json',
        ),
        'body' => wp_json_encode(array(
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $message,
                ),
            ),
        )),
    ));

    if (is_wp_error($response)) {
        // 在這裡可以選擇使用 WordPress 通知系統或其他方式來顯示錯誤
        // 而不是使用 error_log()
        // 例如，可以使用 admin_notices 來顯示錯誤消息給用戶
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-error is-dismissible">
                <p><?php esc_html_e('Line Notification: There was an error sending the notification.', 'line-at-notification'); ?></p>
            </div>
            <?php
        });
    } else {
        $response_body = wp_remote_retrieve_body($response);
        $decoded_response = json_decode($response_body);
        if (isset($decoded_response->status) && $decoded_response->status !== 200) {
            // 在這裡也可以選擇顯示相應的錯誤消息
            add_action('admin_notices', function() {
                ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php esc_html_e('Line Notification: The notification was not sent successfully.', 'line-at-notification'); ?></p>
                </div>
                <?php
            });
        }
    }
}
add_action('publish_post', 'line_at_notification_push');
