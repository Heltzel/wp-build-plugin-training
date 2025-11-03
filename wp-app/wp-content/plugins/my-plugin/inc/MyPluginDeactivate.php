<?php

class MyPluginDeactivate
{
	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}
