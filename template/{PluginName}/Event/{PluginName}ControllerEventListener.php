<?php
class {PluginName}ControllerEventListener extends BcControllerEventListener {
/**
 * 登録イベント
 * 
 * @var array
 */
	public $events = array(
//		'startup',
//		'Mail.Mail.startup',
//		'beforeRender', 
//		'Dashboard.beforeRender', 
//		'Feed.FeedDetails.beforeRender',
//		'Mail.Mail.beforeSendEmail',
//		'Mail.Mail.beforeRender',
//		'Blog.BlogPosts.beforeRender',
//		'Feed.FeedDetails.beforeRedirect',
//		'Users.initialize',
	);
	
/**
 * startup
 * 
 * @param CakeEvent $event
 */
	public function startup(CakeEvent $event) {
		$Controller = $event->subject();
	}
	
/**
 * Mail.Mail.startup
 * 
 * @param CakeEvent $event
 */
	public function mailMailStartup (CakeEvent $event) {
		$Controller = $event->subject();
		// セキュリティコンポーネントの無効化
//		$Controller->Security->validatePost = false;
//		$Controller->Security->csrfCheck = false;
	}
	
/**
 * 
 * @param CakeEvent $event
 */
	function usersInitialize (CakeEvent $event) {
		$Controller = $event->subject;
		
		// ログインをEmailアドレスでできるように調整
		if(isset($Controller->request->params['action']) && $Controller->request->params['action'] == 'admin_login') {
			if(!empty($Controller->request->data['User']['name'])) {
				$Controller->request->data['User']['email'] = $Controller->request->data['User']['name'];
			}
		}
	}
/**
 * 
 * 
 * @param type $event
 * @return boolean
 */
	public function beforeRender (CakeEvent $event) {
		$Controller = $event->subject;
		
		// ヘルパを自動読み込み追加
		$Controller->helpers[] = '{PluginName}.{PluginName}';
		return true;
		
	}
/**
 * ダッシュボード***
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function dashboardBeforeRender(CakeEvent $event) {
	}
	
/**
 * フィード詳細保存前イベント
 * 
 * @param CakeEvent $event
 */
	public function feedFeedDetailsBeforeRender(CakeEvent $event) {
	}
	
/**
 * メールフォームメール送信前イベント
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function mailMailBeforeSendEmail(CakeEvent $event) {
		
		// 特定ユーザー宛にメールを送信する
//		if ($event->subject->dbDatas['mailContent']['MailContent']['name'] == "contact") {
//		} else {
//			$User = ClassRegistry::init('User');
//			$email = 'targetemail@example.com';
//			if($email) {
//				$event->subject->dbDatas['mailContent']['MailContent']['sender_1'] .= $email . ',' . $event->subject->siteConfigs['email'];
//			}
//		}
		
		return true;
	}
	
/**
 * ブログ記事表示前イベント
 * 
 * @param CakeEvent $event
 */
	public function blogBlogPostsBeforeRender(CakeEvent $event) {
		$Controller = $event->subject;
	}
	
	
}
