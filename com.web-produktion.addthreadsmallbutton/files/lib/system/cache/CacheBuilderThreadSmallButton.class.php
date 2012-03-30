<?php
// wcf imports
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

/**
 * Caches Thread Small Button
 *
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class CacheBuilderThreadSmallButton implements CacheBuilder {

	/**
	 * @see CacheBuilder::getData()
	 */
	public function getData($cacheResource) {
		$data = array ();

		$sql = "SELECT      *
				FROM        wbb".WBB_N."_smallbutton
				WHERE       isDisabled = '0'
				ORDER BY    showOrder ASC";
		$result = WCF::getDB()->sendQuery($sql);
		while($row = WCF::getDB()->fetchArray($result)) {
			$data[]= $row ;
		}

		return $data ;
	}
}
?>