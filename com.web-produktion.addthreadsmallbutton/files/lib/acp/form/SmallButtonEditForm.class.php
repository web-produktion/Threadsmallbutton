<?php
// wbb imports
require_once(WBB_DIR.'lib/acp/form/SmallButtonAddForm.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButtonEditForm extends SmallButtonAddForm {
	// system
	public $neededPermissions = 'admin.smallbutton.canEdit';

	// properties
	public $linkTo = '';
	public $imgSrc = '';
	public $name = '';
	public $smallbuttonID = 0;

	/**
	 * @see Form::readFormParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		// get smallbuttonID
		if (isset($_REQUEST['smallbuttonID'])) $this->smallbuttonID = intval($_REQUEST['smallbuttonID']);
		require_once(WBB_DIR.'lib/data/smallbutton/SmallButtonEditor.class.php');
		$this->smallButton = new SmallButtonEditor($this->smallbuttonID);
		if (!$this->smallButton->smallbuttonID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see Form::readFormParameters()
	 */
	public function readData() {
		parent::readData();

		if (!count($_POST)) {
			$this->smallbuttonID = $this->smallButton->smallbuttonID;
			$this->name = $this->smallButton->name;
			$this->description = $this->smallButton->description;
			$this->linkTo = $this->smallButton->linkTo;
			$this->imgSrc = $this->smallButton->imgSrc;
		}
	}

	/**
	 * @see Form::validate()
	 */
	public function validate() {
		parent::validate();

		if (empty($this->description)) {
			throw new UserInputException('description');
		}
		if (empty($this->linkTo)) {
			throw new UserInputException('linkTo');
		}
		if (empty($this->imgSrc)) {
			throw new UserInputException('imgSrc');
		}
	}

	/**
	 * @see Form::save()
	 */
	public function save() {

		$this->smallButton->update($this->name, $this->description, $this->imgSrc, $this->linkTo);

		// clear Cache
		WCF::getCache()->clear(WBB_DIR.'cache/','cache.threadsmallbutton.php');

		// show success message
		WCF::getTPL()->assign('success', true);
	}

	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
				'smallbuttonID' => $this->smallbuttonID,
				'action' => 'edit'
		));
	}
}
?>