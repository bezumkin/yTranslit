<?php
/**
 * Resolve the settings to setup the installed transliteration class
 *
 * @package ytranslit
 * @subpackage _build
 */
$success = false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
	case xPDOTransport::ACTION_UPGRADE:
		if (!$translitClassPath = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class_path'))) {
			$translitClassPath = $transport->xpdo->newObject('modSystemSetting');
			$translitClassPath->fromArray(array(
				'key' => 'friendly_alias_translit_class_path',
				'namespace' => 'core',
				'xtype' => 'textfield',
				'value' => '',
				'area' => 'furls',
			), '', true);
		}
		$translitClassPath->set('value', '{core_path}components/ytranslit/model/');
		$success = $translitClassPath->save();

		if (!$translitClass = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class'))) {
			$translitClass = $transport->xpdo->newObject('modSystemSetting');
			$translitClass->fromArray(array(
				'key' => 'friendly_alias_translit_class',
				'namespace' => 'core',
				'xtype' => 'textfield',
				'value' => '',
				'area' => 'furls',
			), '', true);
		}
		$translitClass->set('value', 'modx.ytranslit.modTransliterate');
		$success = $translitClass->save();

		if (!$translitUrl = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_ytranslit_url'))) {
			$translitUrl = $transport->xpdo->newObject('modSystemSetting');
			$translitUrl->fromArray(array(
				'key' => 'friendly_alias_ytranslit_url',
				'name' => 'Url of translation service',
				'description' => 'By default - it is Yandex.Translate',
				'namespace' => 'core',
				'xtype' => 'textfield',
				'value' => 'http://translate.yandex.net/api/v1/tr.json/translate?lang=ru-en&text=',
				'area' => 'furls',
			), '', true);
			$success = $translitUrl->save();
		}

		if (!$translitTimeout = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_ytranslit_timeout'))) {
			$translitTimeout = $transport->xpdo->newObject('modSystemSetting');
			$translitTimeout->fromArray(array(
				'key' => 'friendly_alias_ytranslit_timeout',
				'name' => 'Timeout in seconds for yTranslit',
				'description' => 'Timeout in seconds for waiting of yTranslit service',
				'namespace' => 'core',
				'xtype' => 'numberfield',
				'value' => 1,
				'area' => 'furls',
			), '', true);
			$success = $translitTimeout->save();
		}

		if (!$translitExclude = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_ytranslit_exclude'))) {
			$translitExclude = $transport->xpdo->newObject('modSystemSetting');
			$translitExclude->fromArray(array(
				'key' => 'friendly_alias_ytranslit_exclude',
				'name' => 'Regexp for exclude pagetitles',
				'description' => 'If pagetitle matching this regex - it is not sended to service',
				'namespace' => 'core',
				'xtype' => 'textfield',
				'value' => '/^[_-a-zA-z\d\s\:\(\)]+$/i',
				'area' => 'furls',
			), '', true);
			$success = $translitExclude->save();
		}
		break;
	case xPDOTransport::ACTION_UNINSTALL:
		if ($translitClassPath = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class_path'))) {
			$translitClassPath->set('value', '{core_path}components/');
			$success = $translitClassPath->save();
		}

		if ($translitClass = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_translit_class'))) {
			$translitClass->set('value', 'translit.modTransliterate');
			$success = $translitClass->save();
		}

		if ($translitUrl = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_ytranslit_url'))) {
			$success = $translitUrl->remove();
		}

		if ($translitTimeout = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_ytranslit_timeout'))) {
			$success = $translitTimeout->remove();
		}

		if ($translitExclude = $transport->xpdo->getObject('modSystemSetting', array('key' => 'friendly_alias_ytranslit_exclude'))) {
			$success = $translitExclude->remove();
		}
		break;
}

return $success;