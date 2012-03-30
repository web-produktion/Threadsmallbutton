<?php
// wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * @author 		Jean-Marc Licht
 * @copyright 	(c) 2009 - 2011 by Jean-Marc Licht
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @package		com.web-produktion.threadsmallbutton
 */
class ThreadAdditionalSmallButtonsListener implements EventListener {

	public $additionalSmallButtons;

	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		if(THREAD_SMALLBUTTON_ENABLE == 1 && WCF::getUser()->getPermission('user.smallbutton.canUse')) {

			// add cache resource
			WCF::getCache()->addResource('threadsmallbutton', WBB_DIR.'cache/cache.threadsmallbutton.php', WBB_DIR.'lib/system/cache/CacheBuilderThreadSmallButton.class.php');

			// get Smallbuttons
			$this->smallbutton = WCF::getCache()->get('threadsmallbutton');

			if($this->smallbutton > 0) {

				// Assign Varibales
				WCF::getTPL()->assign(array(
						'smallbutton' => $this->smallbutton
				));

				// Foreach buttons
				foreach($eventObj->postList->posts as $post) {
					$this->additionalSmallButtonsbuttons[$post->postID] = WCF::getTPL()->fetch('threadAdditionalSmallButtons');
				}
				WCF::getTPL()->append('additionalSmallButtons', $this->additionalSmallButtonsbuttons);
			}
		}
	}
}
?>