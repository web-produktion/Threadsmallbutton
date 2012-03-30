<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractAction.class.php');

/**
 * Description of SmallButtonSortclass
 *
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButtonSortAction extends AbstractAction {

	/**
	 * new positions
	 *
	 * @var array
	 */
	public $positions = array();

	public $pageNo = 1;


	/**
	 * @see Action::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_POST['smallbuttonListPositions']) && is_array($_POST['smallbuttonListPositions'])) $this->positions = ArrayUtil::toIntegerArray($_POST['smallbuttonListPositions']);
		if (isset($_REQUEST['pageNo'])) $this->pageNo = intval($_REQUEST['pageNo']);
	}

	/**
	 * @see Action::execute()
	 */
	public function execute() {
		parent::execute();

		// check permission
		WCF::getUser()->checkPermission('admin.smallbutton.canEdit');

		// update postions
		foreach ($this->positions as $smallbuttonID => $data) {
			$sql = "UPDATE  wbb".WBB_N."_smallbutton
					SET     showOrder = ".$data."
					WHERE   smallbuttonID = ".$smallbuttonID;
			WCF::getDB()->sendQuery($sql);
		}

		// clear Cache
		WCF::getCache()->clear(WBB_DIR.'cache/','cache.threadsmallbutton.php');
		
		// forward to list page
		HeaderUtil::redirect('index.php?page=SmallButtonList&pageNo='.$this->pageNo.'&packageID='.PACKAGE_ID.SID_ARG_2ND_NOT_ENCODED);
		exit();
	}
}
?>
