<?php

/**
 * Get a setting value
 * 
 * @param string $key Setting key
 * @param mixed $default Default value if not found
 * @return mixed
 */
function setting($key, $default = null)
{
    return \App\Models\Setting::get($key, $default);
}

/**
 * Get all settings
 * 
 * @return array
 */
function allSettings()
{
    return \App\Models\Setting::getAllFlat();
}

/**
 * Get settings by group
 * 
 * @param string $group Group name
 * @return array
 */
function settingsByGroup($group)
{
    return \App\Models\Setting::where('group', $group)->pluck('value', 'key')->toArray();
}
