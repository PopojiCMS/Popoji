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

if (!function_exists('getSettingGroup')) {
    function getSettingGroup($groups)
    {
		$result = Setting::where('groups', $groups)->orderBy('id', 'asc')->get();
		if ($result) {
			return $result;
		} else {
			return [];
		}
	}
}
