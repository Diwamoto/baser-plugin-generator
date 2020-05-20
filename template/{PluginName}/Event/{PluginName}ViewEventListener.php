<?php 
class {PluginName}ViewEventListener extends BcViewEventListener {
/**
 * 登録イベント
 * 
 * @var array
 */
	public $events = array(
//		'beforeLayout'
	);

/**
 * beforeLayout
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function beforeLayout(CakeEvent $event) {
		
		if(BcUtil::isAdminSystem()) {
			return true;
		}
		$View = $event->subject;

		
		return true;
		
	}
	
}