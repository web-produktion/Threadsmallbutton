<?php
// wbb imports
require_once(WBB_DIR.'lib/data/smallbutton/SmallButton.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class SmallButtonEditor extends SmallButton {

	/**
	 * Create SmallButton
	 */
	public static function create($name = '', $description = '', $imgSrc = '', $linkTo = '' , $showOrder = 0, $isDisabled = 1) {
		
		// get show order
		if ($showOrder == 0) {
			// get next number in row
			$sql = "SELECT	MAX(showOrder) AS showOrder
				FROM	wbb".WBB_N."_smallbutton";
			$row = WCF::getDB()->getFirstRow($sql);
			if (!empty($row)) $showOrder = intval($row['showOrder']) + 1;
			else $showOrder = 1;
		}
		else {
			$sql = "UPDATE	wbb".WBB_N."_smallbutton
				SET 	showOrder = showOrder + 1
				WHERE 	showOrder >= ".$showOrder;
			WCF::getDB()->sendQuery($sql);
		}
		
		// save smallbutton
		$smallbuttonID = self::insert($name, $description, array(
			'imgSrc' => $imgSrc,
			'linkTo' => $linkTo,
			'isDisabled' => $isDisabled,
			'showOrder' => $showOrder
		));
		
		// create new object
		$smallbutton = new SmallButtonEditor($smallbuttonID);
		
		// return object
		return $smallbutton;
	}
	
	/**
	 * Creates the smallbutton row in database table.
	 *
	 * @param 	string 		$name
	 * @param 	string 		$description
	 * @param 	array		$additionalFields
	 * @return	integer		new smallbutton id
	 */
	public static function insert($name, $description, array $additionalFields = array()) {
		// build sql
		$keys = $values = '';
		foreach ($additionalFields as $key => $value) {
			$keys .= ', '.$key;
			$values .= ",'".escapeString($value)."'";
		}

		// create database entry
		$sql = "INSERT INTO	wbb".WBB_N."_smallbutton
					(name, description
					".$keys.")
			VALUES		('".escapeString($name)."', '".escapeString($description)."'
					".$values.")";
		WCF::getDB()->sendQuery($sql);

		return WCF::getDB()->getInsertID();
	}
	
	/**
	 * Update SmallButton
	 */
	public function update($name = '', $description = '', $image = '', $link = '' , $showOrder = 0) {
		// update show order
		if ($this->showOrder != $showOrder) {
			if ($showOrder < $this->showOrder) {
				$sql = "UPDATE	wbb".WBB_N."_smallbutton
					SET 	showOrder = showOrder + 1
					WHERE 	showOrder >= ".$showOrder."
						AND showOrder < ".$this->showOrder;
				WCF::getDB()->sendQuery($sql);
			}
			else if ($showOrder > $this->showOrder) {
				$sql = "UPDATE	wbb".WBB_N."_smallbutton
					SET	showOrder = showOrder - 1
					WHERE	showOrder <= ".$showOrder."
						AND showOrder > ".$this->showOrder;
				WCF::getDB()->sendQuery($sql);
			}
		}

		$sql = "UPDATE wbb".WBB_N."_smallbutton
				SET name = '".escapeString($name)."',
					description = '".escapeString($description)."',
					ImgSrc = '".escapeString($image)."',
					linkTo = '".escapeString($link)."',
					showOrder = ".$showOrder."
					WHERE smallbuttonID = ".$this->smallbuttonID;
		WCF::getDB()->sendQuery($sql);
	}

	/**
	 * Delete SmallButton
	 */
	public function delete() {
		// update show order
		$sql = "UPDATE	wbb".WBB_N."_smallbutton
				SET	showOrder = showOrder - 1
				WHERE	showOrder >= ".$this->showOrder."";
		WCF::getDB()->sendQuery($sql);

		// delete item
		$sql = "DELETE FROM	wbb".WBB_N."_smallbutton
				WHERE	smallbuttonID = ".$this->smallbuttonID;
		WCF::getDB()->sendQuery($sql);
	}

	/**
	 * Enable SmallButton
	 */
	public function enable($enable = 1) {
		$sql = "UPDATE	wbb".WBB_N."_smallbutton
				SET	isDisabled = ".intval(!$enable)."
				WHERE	smallbuttonID = ".$this->smallbuttonID;
		WCF::getDB()->sendQuery($sql);
	}
}
?>