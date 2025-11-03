<?php

class MypluginDeactivate
{
	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}
