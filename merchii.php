<?php

	/*
	Plugin Name: Merchii
	Plugin URI: http://merchii.com
	Description: Add tags to your images with Merchii. Go to <a href="plugins.php?page=merchii-settings">settings</a>.
	Version: 1.0.0
	Author: Merchii
	Author URI: http://merchii.com
	*/

	/*  Copyright YEAR  Merchii  (email : operations@merchii.com)

	    This program is free software; you can redistribute it and/or modify
	    it under the terms of the GNU General Public License, version 2, as 
	    published by the Free Software Foundation.

	    This program is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.

	    You should have received a copy of the GNU General Public License
	    along with this program; if not, write to the Free Software
	    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

	class Merchii {
		
		const PLUGIN_NAME = "Merchii";
		const PLUGIN_VERSION = "1.0.0";
		const PLUGIN_CONFIG_HOOK = "merchii-settings";
		const PLUGIN_CONFIG_URL = "/merchii/merchii-settings.php";

		/* --------------------------------------------------
		Template Functions
		-------------------------------------------------- */
		function add_merchii_to_footer(){
		  $merchii_id = get_option('merchii_id');
		 //  echo "
			// 	<script type=\"text/javascript\">
			// 	__tlid = '$thinglink_id';
			// 	__tlconfig = {hOverflow: false, vOverflow: false};
			// 	setTimeout(function(){(function(d,t){var s=d.createElement(t),x=d.getElementsByTagName(t)[0];
			// 	s.type='text/javascript';s.async=true;s.src='//cdn.thinglink.me/jse/embed.js';
			// 	x.parentNode.insertBefore(s,x);})(document,'script');},0);
			// 	</script>";
			// }
		  echo "
				<!-- Merchii:BEGIN -->
    				<script>window.MERCHII_SITE_ID='$merchii_id'</script>
    				<script type='text/javascript' src='//embed.merchii.com/core.js' async='true'></script>
    			<!-- Merchii:END -->
				";
			}
	
		/* --------------------------------------------------
		Settings & Config
		-------------------------------------------------- */
		function admin_init(){
		  register_setting('merchii-group', 'merchii_id');
		}
	
		function admin_menu(){
			add_submenu_page('plugins.php', self::PLUGIN_NAME, self::PLUGIN_NAME, 'manage_options', self::PLUGIN_CONFIG_HOOK, array(&$this, 'admin_menu_options'));
		}
	
		function admin_menu_options() {
			$plugin_name = self::PLUGIN_NAME;
			include(WP_PLUGIN_DIR . self::PLUGIN_CONFIG_URL);
		}
	
		function plugin_action_links($links, $file) {
			if ($file == "merchii/merchii.php") {
				$href = admin_url("plugins.php?page=" . self::PLUGIN_CONFIG_HOOK);
				$text = __('Settings');
				array_unshift($links, "<a href=\"{$href}\">{$text}</a>");
			}
			return $links;
		}
		
	}
	
	/* --------------------------------------------------
	Initialize
	-------------------------------------------------- */
	$merchii = new Merchii();
	
	/* --------------------------------------------------
	WordPress Hooks
	-------------------------------------------------- */
	add_action('wp_footer', array($merchii, 'add_merchii_to_footer'));
	add_action('admin_init', array($merchii, 'admin_init'));
	add_action('admin_menu', array($merchii, 'admin_menu'));
	add_filter('plugin_action_links', array($merchii, 'plugin_action_links'), 10, 2);

?>