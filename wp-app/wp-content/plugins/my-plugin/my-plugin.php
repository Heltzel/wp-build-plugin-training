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
}

if (class_exists('MyPlugin')) {
	$myPlugin = new MyPlugin();
}

register_activation_hook(__FILE__, [$myPlugin, 'activate']);
register_deactivation_hook(__FILE__, [$myPlugin, 'deactivate']);
