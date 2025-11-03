<?php

/**
 *  @package: MyPlugin
 */
/**
 * 	Plugin Name: My Plugin
 *  Plugin URI: http://localhost:80
 * 	Description:  This is a tutorial plugin
 * 	Version: 1.0.0
 * 	Author: Heltson.com
 * 	License: GPLv2 or later
 * 	Text Domain: my-plugin
 */

defined('ABSPATH') or die('What are you doing you silly human');

class MyPlugin
{

	public $pluginName;

	public function __construct()
	{
		add_action('init', [$this, 'custom_post_type']);
		$this->pluginName = plugin_basename(__FILE__);
	}


	public function register()
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueue']);
		add_action('admin_menu', [$this, 'add_admin_pages']);
		add_filter("plugin_action_links_$this->pluginName", [$this, 'settings_link'],);
	}

	public function settings_link($links)
	{
		// add custom settings link 
		$settings_link = '<a href="admin.php?page=my_plugin_slug" >Myplugin settings</a>';
		array_push($links, $settings_link);
		return $links;
	}

	public function add_admin_pages()
	{
		add_menu_page(
			'Myplugin',             // Page title
			'Myplugin',             // Menu title
			'manage_options',       // Capability
			'my_plugin_slug',            // <-- This is the slug
			[$this, 'admin_index'], // Callback function
			'dashicons-store',      // Icon
			110                     // Position
		);
	}


	public function admin_index()
	{
		// require template
		require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
	}

	public function custom_post_type()
	{
		register_post_type('book',  ['public' => true, 'label' => 'Books']);
	}

	public function enqueue()
	{
		wp_enqueue_style('myplugin-style', plugins_url('/assets/mypluginstyle.css', __FILE__));
		wp_enqueue_script('myplugin-script', plugins_url('/assets/mypluginscript.js', __FILE__));
	}

	public function activate()
	{
		require_once plugin_dir_path(__FILE__) . 'inc/MyPluginActivate.php';
		MyPluginActivate::activate();
	}
}

if (class_exists('MyPlugin')) {
	$myPlugin = new MyPlugin();
	$myPlugin->register();
}


register_activation_hook(__FILE__, [$myPlugin, 'activate']);

require_once plugin_dir_path(__FILE__) . 'inc/MyPluginDeactivate.php';
register_deactivation_hook(__FILE__, ['MyPluginDeactivate', 'deactivate']);
