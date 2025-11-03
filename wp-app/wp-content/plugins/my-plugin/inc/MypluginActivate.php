<?php

class MypluginActivate
{
	public static function activate()
	{
		flush_rewrite_rules();
	}
}
