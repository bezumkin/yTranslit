<?php
/**
 * @var xPDOTransport $transport
 * @var modSystemSetting $translitClassPath
 * @var modSystemSetting $translitClass
 */
$success = false;
$xpdo = & $transport->xpdo;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
	case xPDOTransport::ACTION_UPGRADE:
		if ($translitClassPath = $xpdo->getObject('modSystemSetting', 'friendly_alias_translit_class_path')) {
			$translitClassPath->set('value', '{core_path}components/ytranslit/model/');
			$translitClassPath->save();
		}
		if ($translitClass = $xpdo->getObject('modSystemSetting', 'friendly_alias_translit_class')) {
			$translitClass->set('value', 'modx.ytranslit.modTransliterate');
			$translitClass->save();
		}
		break;

	case xPDOTransport::ACTION_UNINSTALL:
		if ($translitClassPath = $xpdo->getObject('modSystemSetting', 'friendly_alias_translit_class_path')) {
			$translitClassPath->set('value', '{core_path}components/');
			$translitClassPath->save();
		}
		if ($translitClass = $xpdo->getObject('modSystemSetting', 'friendly_alias_translit_class')) {
			$translitClass->set('value', 'translit.modTransliterate');
			$translitClass->save();
		}
		// Clean yTranslit settings
		$settings = array(
			'friendly_alias_ytranslit_url'
			,'friendly_alias_ytranslit_key'
			,'friendly_alias_ytranslit_timeout'
			,'friendly_alias_ytranslit_exclude'
		);
		foreach ($settings as $setting) {
			/* @var modSystemSetting $tmp */
			if ($tmp = $xpdo->getObject('modSystemSetting', $setting)) {
				$tmp->remove();
			}
		}
		break;
}

return true;