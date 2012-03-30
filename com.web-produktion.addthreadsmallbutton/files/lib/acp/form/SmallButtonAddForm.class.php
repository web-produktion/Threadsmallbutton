<?php
// wbb imports
require_once(WBB_DIR.'lib/data/smallbutton/SmallButtonEditor.class.php');

// wcf imports
require_once(WCF_DIR.'lib/acp/form/ACPForm.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButtonAddForm extends ACPForm {
	// system
	public $templateName = 'smallButtonAdd';
	public $activeMenuItem = 'wcf.acp.menu.link.smallbutton.add';
	public $neededPermissions = 'admin.smallbutton.canAdd';

	// properties
	public $name = '';
	public $description = '';
	public $linkTo = '';
	public $imgSrc = '';

	/**
	 * @see Form::readFormParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		// data
		if (isset($_POST['name'])) $this->name = StringUtil::trim($_POST['name']);
		if (isset($_POST['description'])) $this->description = $_POST['description'];
		if (isset($_POST['linkTo'])) $this->linkTo = StringUtil::trim($_POST['linkTo']);
		if (isset($_POST['imgSrc'])) $this->imgSrc = StringUtil::trim($_POST['imgSrc']);
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
		parent::save();

		$this->smallbutton = SmallButtonEditor::create($this->name, $this->description, $this->imgSrc, $this->linkTo);

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
				'name' => $this->name,
				'description' => $this->description,
				'linkTo' => $this->linkTo,
				'imgSrc' => $this->imgSrc,
				'action' => 'add'
		));
	}
	
	/**
	 * @see Page::show()
	 */
	public function show() {
		
		// enable menu item
		WCFACP::getMenu()->setActiveMenuItem($this->activeMenuItem);
		
		parent::show();
	}
}
?>