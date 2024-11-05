# wordpress-line-at-notification
A plugin application that automatically pushes new posts to users via Line@.

=== Line@ Notification ===
Contributors: YuCts Travel
Tags: line, line@, notification, auto push, new post
Requires at least: 4.0
Tested up to: 6.6
Stable tag: 1.2.12
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

一款透過 Line@ 自動推送新文章給用戶的插件應用。
A plugin application that automatically pushes new posts to users via Line@.

== Description ==

=== 繁體中文說明 ===
Line@ Notification 是一款用於 WordPress 的插件，主要功能為在發佈新文章時，自動推送通知到 Line@ 用戶端。插件的運行依賴 LINE Channel Access Token，並透過 LINE API 進行廣播推播。

功能包含：
* 當文章發佈時，自動推播通知給 Line@ 用戶。
* 支援文字與圖片類型的推播內容。
* 後台設定頁面，方便配置 LINE Channel Access Token。
* 可手動選擇文章進行推播。

更多資訊請參考：  
幻冰星空: https://tedsky.com  
YucDu 佑瑄: https://yucdu.com  

=== English Description ===
Line@ Notification is a WordPress plugin designed to automatically send notifications of new posts to Line@ users. The plugin uses the LINE Channel Access Token and sends broadcast messages via the LINE API.

Features include:
* Automatically sending notifications to Line@ users when a post is published.
* Supports text and image-based notifications.
* Includes an admin settings page for easy configuration of the LINE Channel Access Token.
* Allows for manual post notification selection.

For more information, visit:  
TedSky: https://tedsky.com  
YucDu: https://yucdu.com  

== Installation ==

=== 繁體中文安裝說明 ===
1. 下載並解壓縮插件檔案，並將 `line-at-notification` 資料夾上傳至 WordPress 的 `wp-content/plugins/` 目錄。
2. 在 WordPress 管理後台，啟用 Line@ Notification 插件。
3. 前往「設定」→「Line Notification」頁面，並輸入 LINE Channel Access Token。
4. 新文章發佈後，通知將自動推送至 Line@。

=== English Installation Instructions ===
1. Download and unzip the plugin file, and upload the `line-at-notification` folder to the `wp-content/plugins/` directory in WordPress.
2. Activate the Line@ Notification plugin in the WordPress admin panel.
3. Go to "Settings" → "Line Notification" and enter your LINE Channel Access Token.
4. Notifications will automatically be sent to Line@ after new posts are published.

== Frequently Asked Questions ==

= Q: Where do I find the LINE Channel Access Token? =
A: You can get the LINE Channel Access Token from the LINE Developer Console after setting up a channel.

= 問：我該去哪裡找到 LINE Channel Access Token？ =
答：您可以從 LINE 開發者控制台中設置頻道後獲取 LINE Channel Access Token。

= Q: Does this plugin support manual push notifications? =
A: Yes, you can manually send notifications by selecting a post on the plugin settings page.

= 問：這個插件支援手動推播嗎？ =
答：是的，您可以在插件設置頁面選擇文章並手動推播。

== Screenshots ==

1. Plugin Settings Page (Line Notification)
2. Manually Push a Post Notification

== Changelog ==

= 1.2.12 =
* Added manual post push functionality
* Improved error logging for failed message deliveries

= 1.2.0 =
* Initial release with automatic push notification feature for new posts

== Upgrade Notice ==

= 1.2.12 =
Added manual post push functionality and improved error handling.
