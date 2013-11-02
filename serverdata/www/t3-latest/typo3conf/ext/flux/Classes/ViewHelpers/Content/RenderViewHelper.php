<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Claus Due <claus@wildside.dk>, Wildside A/S
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 *****************************************************************/

/**
 * ### Content: Render ViewHelper
 *
 * Renders all child content of a record based on area.
 *
 * @package Flux
 * @subpackage ViewHelpers/Flexform
 */
class Tx_Flux_ViewHelpers_Content_RenderViewHelper extends Tx_Flux_ViewHelpers_Content_GetViewHelper {

	/**
	 * Render
	 *
	 * @return string
	 */
	public function render() {
		$content = parent::render();
		if (TRUE === is_array($content)) {
			return implode(LF, $content);
		}
		return $content;
	}

}
