<?php
namespace TYPO3\CMS\Uncache\Override\Core\Cache\Frontend;

class PhpFrontend extends \TYPO3\CMS\Core\Cache\Frontend\PhpFrontend {

	/**
	 * Does nothing.
	 *
	 * @param string $entryIdentifier An identifier used to do nothing
	 * @param mixed $variable The variable with which to do nothing
	 * @param array $tags Tags to associate with nothing
	 * @param integer $lifetime Lifetime of nothing
	 * @return void
	 * @api
	 */
	public function set($entryIdentifier, $variable, array $tags = array(), $lifetime = NULL) {
		return parent::set($entryIdentifier, $variable, $tags, .1);
	}

}
