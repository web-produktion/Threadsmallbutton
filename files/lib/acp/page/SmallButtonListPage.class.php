<?php
// wcf imports
require_once(WCF_DIR.'lib/page/SortablePage.class.php');
require_once(WCF_DIR.'lib/system/event/EventHandler.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButtonListPage extends SortablePage {
	// system
	public $templateName = 'smallButtonList';
	public $deletedsmallbuttonID = 0;
	public $smallbutton = array();
	public $smallbuttonCount;
	public $defaultSortField = 'showOrder';
	public $activeMenuItem = 'wcf.acp.menu.link.smallbutton.list';
	public $neededPermissions = 'admin.smallbutton.canUse';

	/**
	 * @see Page::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if(isset($_REQUEST["deletedsmallbuttonID"]) && $_REQUEST["deletedsmallbuttonID"] == 1) $this->deletedsmallbuttonID = 1;
	}

	/**
	 * @see SortablePage::validateSortField()
	 */
	public function validateSortField() {
		parent::validateSortField();

		switch ($this->sortField) {
			case 'smallbuttonID':
			case 'name':
			case 'imgSrc':
			case 'description':
			case 'linkTo':
			case 'showOrder': break;
			default: $this->sortField = $this->defaultSortField;
		}
	}

	/**
	 * @see MultipleLinkPage::countItems()
	 */
	public function countItems() {
		parent::countItems();

		$sql = "SELECT	COUNT(*) AS count
				FROM	wbb".WBB_N."_smallbutton";
		$row = WCF::getDB()->getFirstRow($sql);
		return $row['count'];
	}

	/**
	 * Gets all user groups and the number of their members.
	 */
	public function readData() {
		parent::readData();

		$sql = "SELECT	*
				FROM		wbb".WBB_N."_smallbutton
				ORDER BY	".$this->sortField." ".$this->sortOrder;
		$result = WCF::getDB()->sendQuery($sql, $this->itemsPerPage, ($this->pageNo - 1) * $this->itemsPerPage);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$this->smallbutton[] = $row;
		}

		$sql = "SELECT	COUNT(*) AS count
				FROM	wbb".WBB_N."_smallbutton";
		$row = WCF::getDB()->getFirstRow($sql);
		$this->smallbuttonCount = $row['count'];
	}

	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'smallbutton' => $this->smallbutton,
			'smallbuttonCount' => $this->smallbuttonCount,
			'deletedsmallbuttonID' => $this->deletedsmallbuttonID
		));
	}

	/**
	 * @see Page::show()
	 */
	public function show() {
		// check permission
		WCF::getUser()->checkPermission($this->neededPermissions);

		// enable menu item
		WCFACP::getMenu()->setActiveMenuItem($this->activeMenuItem);

		parent::show();
	}
}
?>