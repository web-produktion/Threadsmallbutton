<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractAction.class.php');

// wbb imports
require_once(WBB_DIR.'lib/data/smallbutton/SmallButtonEditor.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButtonDeleteAction extends AbstractAction {
	// system
	public $neededPermissions = 'admin.smallbutton.canDelete';
	
	// data
	public $smallbuttonID = 0;
	public $pageNo = 1;

	/**
	 * @see Action::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_REQUEST['smallbuttonID'])) $this->smallbuttonID = intval($_REQUEST['smallbuttonID']);
		if (isset($_REQUEST['pageNo'])) $this->pageNo = intval($_REQUEST['pageNo']);
	}

	/**
	 * @see Action::execute()
	 */
	public function execute() {
		parent::execute();

		// check permission
		WCF::getUser()->checkPermission($this->neededPermissions);

		$smallButton = new SmallButtonEditor($this->smallbuttonID);
		if (!$smallButton->smallbuttonID) {
			throw new IllegalLinkException();
		}
		$smallButton->delete();

		// clear Cache
		WCF::getCache()->clear(WBB_DIR.'cache/','cache.threadsmallbutton.php');

		$this->executed();

		// forward to list page
		HeaderUtil::redirect('index.php?page=SmallButtonList&smallbuttonID=1&pageNo='.$this->pageNo.'&packageID='.PACKAGE_ID.SID_ARG_2ND_NOT_ENCODED);
		exit();
	}
}
?>