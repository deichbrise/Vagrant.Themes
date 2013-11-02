<?php

namespace KayStrobach\Themes\Hook;

// class for: $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tstemplate.php']['includeStaticTypoScriptSourcesAtEnd'][]

use TYPO3\CMS\Core\Utility\GeneralUtility;

class T3libTstemplateIncludeStaticTypoScriptSourcesAtEndHook {
	/**
	 * Includes static template records (from static_template table) and static template files (from extensions) for the input template record row.
	 *
	 * @param	array		Array of parameters from the parent class.  Includes idList, templateId, pid, and row.
	 * @param	object		Reference back to parent object, t3lib_tstemplate or one of its subclasses.
	 * @return	void
	 */
	public static function main(&$params, &$pObj) {
		$idList = $params['idList'];
		$templateID = $params['templateId'];
		$pid = $params['pid'];
		$row = $params['row'];

		// Call hook for possible manipulation of current skin - oldstyle for compatibility for ext:skin_preview :D
		// @todo should be removed once theme_preview is stable ...
		// it's deprecated to use this hook
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/templavoila_framework/class.tx_templavoilaframework_lib.php']['assignSkinKey'])) {
			$_params = array('skinKey' => &$row['tx_themes_skin']);
			foreach($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/templavoila_framework/class.tx_templavoilaframework_lib.php']['assignSkinKey'] as $userFunc) {
				$row['tx_themes_skin'] = GeneralUtility::callUserFunction($userFunc, $_params, $ref = NULL);
			}
		}

		// Call hook for possible manipulation of current skin.
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/themes/Classes/Hook/T3libTstemplateIncludeStaticTypoScriptSourcesAtEndHook.php']['setTheme'])) {
			$_params = array('theme' => &$row['tx_themes_skin']);
			foreach($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/themes/Classes/Hook/T3libTstemplateIncludeStaticTypoScriptSourcesAtEndHook.php']['setTheme'] as $userFunc) {
				$row['tx_themes_skin'] = GeneralUtility::callUserFunction($userFunc, $_params, $ref = NULL);
			}
		}

		/**
		 * @var $themeRepository Tx_Skinselector_Domain_Repository_SkinRepository
		 */
		$themeRepository = GeneralUtility::makeInstance('Tx_Themes_Domain_Repository_ThemeRepository');
		$theme = $themeRepository->findByUid($row['tx_themes_skin']);
		if($theme !== NULL) {
			$theme->addTypoScriptForFe($params, $pObj);
		}

		// @todo add hook to inject template overlays, e.g. for previewed constants before save ...
		// Call hook for possible manipulation of current skin. constants
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/themes/Classes/Hook/T3libTstemplateIncludeStaticTypoScriptSourcesAtEndHook.php']['modifyTS'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/themes/Classes/Hook/T3libTstemplateIncludeStaticTypoScriptSourcesAtEndHook.php']['modifyTS'] as $userFunc) {
				$themeItem = GeneralUtility::callUserFunction($userFunc, $_params, $pObj);
				$pObj->processTemplate(
					$themeItem,
					$params['idList'] . ',themes_modifyTsOverlay',
					$params['pid'],
					'themes_' . 'themes_modifyTsOverlay',
					$params['templateId']
				);
			}
		}
	}
}