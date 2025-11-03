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

	public function  __construct()
	{
		add_action('init', [$this, 'custom_post_type']);
	}

	public function register()
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueue']);
	}

	public function activate()
	{
		$this->custom_post_type();
		flush_rewrite_rules();
	}

	public function deactivate()
	{
		flush_rewrite_rules();
	}

	public function custom_post_type()
	{
		register_post_type('Book',  ['public' => true, 'label' => 'Books']);
	}

	public function enqueue()
	{
		wp_enqueue_style('mypluginstyle', plugins_url('/assets/mypluginstyle.css', __FILE__));
		wp_enqueue_script('mypluginstyle', plugins_url('/assets/mypluginscript.js', __FILE__));
	}
}

if (class_exists('MyPlugin')) {
	$myPlugin = new MyPlugin();
	$myPlugin->register();
}

register_activation_hook(__FILE__, [$myPlugin, 'activate']);
register_deactivation_hook(__FILE__, [$myPlugin, 'deactivate']);
