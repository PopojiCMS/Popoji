<?php

use App\Setting;

if (!function_exists('getSetting')) {
    function getSetting($options)
    {
		$result = Setting::where('options', $options)->first();
		if ($result) {
			return $result->value;
		} else {
			return '';
		}
	}
}
