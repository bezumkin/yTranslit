<?php
/**
 * Loads system settings into build
 *
 * @package modextra
 * @subpackage build
 */
$settings = array();

$tmp = array(
	'translit_class_path' => array(
		'xtype' => 'textfield'
		,'value' => '{core_path}components/ytranslit/model/'
		,'namespace' => 'core'
	)
	,'translit_class' => array(
		'xtype' => 'textfield'
		,'value' => 'modx.ytranslit.modTransliterate'
		,'namespace' => 'core'
	)
	,'ytranslit_url' => array(
		'xtype' => 'textfield'
		,'value' => 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=[[+key]]&lang=ru-en&text='
	)
	,'ytranslit_timeout' => array(
		'xtype' => 'numberfield'
		,'value' => 1
	)
	,'ytranslit_exclude' => array(
		'xtype' => 'textfield'
		,'value' => '/^[_-a-zA-z\d\s\:\(\)]+$/i'
	)
	,'ytranslit_key' => array(
		'xtype' => 'textfield'
		,'value' => ''
		,'name' => ''
		,'description' => ''
	)
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'friendly_alias_'.$k
			,'namespace' => PKG_NAME_LOWER
		), $v
	),'',true,true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;