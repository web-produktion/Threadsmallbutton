<?php
// wcf imports
require_once(WCF_DIR.'lib/data/DatabaseObject.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButton extends DatabaseObject {

	public function __construct($smallbuttonID = null, $row = null) {
		if ($smallbuttonID !== null) {
			$sql = "SELECT	*
					FROM	wbb".WBB_N."_smallbutton
					WHERE	smallbuttonID = ".$smallbuttonID;
			$row = WCF::getDB()->getFirstRow($sql);
		}

		parent::__construct($row);
	}
}
?>