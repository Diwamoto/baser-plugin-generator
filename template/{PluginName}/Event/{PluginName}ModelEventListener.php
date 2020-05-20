<?php
class {PluginName}ModelEventListener extends BcModelEventListener {
	
/**
 * 登録イベント
 * 
 * @var array
 */
	public $events = array(
//		'Blog.BlogPost.beforeFind',
//		'Blog.BlogPost.beforeSave',
//		'Blog.BlogCategory.beforeFind',
//		'Blog.BlogTag.beforeFind',
//		'Page.beforeFind',
//		'User.beforeFind',
//		'User.beforeValidate',
//		'Blog.BlogPost.beforeValidate',
//		'beforeValidate'
	);
	
/**
 * コンストラクタ
 */
	public function __construct() {
		parent::__construct();
	}
	
/**
 * ブログデータ検索時イベント
 * 
 * 
 * @param Event $event
 * @return boolean
 */
	public function blogBlogPostBeforeFind(CakeEvent $event) {
		
		$query = $event->data[0];
		$event->data[0] = $query;
		
		return true;
		
	}
	
/**
 * ブログ記事バリデーション直前イベント
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function blogBlogPostBeforeValidate(CakeEvent $event) {
		$BlogPost = $event->subject();
	}
/**
 * ブログデータ保存前イベント
 * 
 * @param CakeEvent $event
 */
	public function blogBlogPostBeforeSave(CakeEvent $event) {
		
		$BlogPost = $event->subject();
		return true;
		
	}
	
/**
 * ブログカテゴリ検索結果時イベント
 * 
 * 加盟店の場合はカテゴリは表示しない
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function blogBlogCategoryBeforeFind(CakeEvent $event) {
		return true;
		
	}
/**
 * ブログタグ取得前イベント
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function blogBlogTagBeforeFind(CakeEvent $event) {
//		$event->data[0]['conditions'][] = array('BlogTag.name' => $projects);
		
	}
	
	public function pageBeforeFind(CakeEvent $event) {
	}
	
/**
 * ユーザー検索前イベント
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function userBeforeFind(CakeEvent $event) {
		
		$User = $event->subject();
//		$User->bindModel(array(
//			'belongsTo' => array(
//				'SampleClass'	=> array(
//					'className'	=> 'SampleClass.SampleClass',
//					'foreignKey'=> 'customer_id'
//				),
//			),
//			'hasOne' => array(
//				'SampleClass' => array(
//					'className'	=> 'SampleClass.SampleClass',
//					'foreignKey'=> 'user_id'
//				)					
//			)
//		));
//		
		// ユーザーモデルのキャッシュは利用しない
		//$User->Behaviors->disable('BcCache');
		
		return true;
		
	}
/**
 * ユーザーバリデーション前イベント
 * 
 * @param CakeEvent $event
 * @return boolean
 */
	public function userBeforeValidate(CakeEvent $event) {
		
		return true;
		
	}

	
/**
 * beforeValidate：MailForm
 * - テキスト入力に機種依存文字が含まれている場合ははバリデーション・エラーとする
 * 
 * @param CakeEvent $event
 */
	public function beforeValidate(CakeEvent $event) {
		$Model = $event->subject();
		if (!BcUtil::isAdminSystem()) {
			if ($Model->name == 'Message') {
				if ($Model->data['Message']['mode'] == 'Confirm' || $Model->data['Message']['mode'] == 'Send') {
					// false が返ってきたら機種依存文字なしでOK
					foreach ($Model->data['Message'] as $key => $value) {
						if (!is_array($value)) {
							$result = $this->checkDependentCharacters($value);
							if ($result) {
								$message = '入力テキストに機種依存文字が含まれています。';
								$Model->invalidate('dependent_characters', $message);
								return false;
							}
						}
					}
				}
			}
		}
	}
	
/**
 * 機種依存文字がチェック対象文字列に含まれているかどうかをチェックする
 * 
 * @param string $str
 * @return boolean
 */
	function checkDependentCharacters($str) {
		mb_regex_encoding('UTF-8');
		$result = false;
		// チェックする対象文字列を生成
		$str = strip_tags($str);
		$check_contents = str_replace(array("\r\n","\n","\r"), '', $str);
		
		// チェックする機種依存文字
		$dependents = '①②③④⑤⑥⑦⑧⑨⑩⑪⑫⑬⑭⑯⑰⑱⑲⑳ⅠⅡⅢⅣⅤⅥⅦⅧⅨⅩ㍉㌔㌢㍍㌘㌧㌃㌶㍑㍗㌍㌦㌣㌫㍊㌻㎜㎝㎞㎎㎏㏄㎡㍻〝〟№㏍℡㊤㊥㊦㊧㊨㈱㈲㈹㍾㍽㍼∮∟⊿纊褜鍈銈蓜炻昱棈鋹曻彅仡仼伀伹佖侒侊侚侔俍偀倢俿倞偆偰偂傔僴僘兊兤冝冾凬刕劜劦勀勛匀匇匤卲厓厲叝﨎咜咊咩哿喆坙坥垬埈埇﨏增墲夋奓奛奝奣妤孖寀甯寘尞岦岺峵崧嵓嵂嵭嶸嶹巐弡弴彧德忞恝悅悊惞惕愠惲愑愷愰憘抦揵摠撝擎敎昀昕昉昮昞昤晗晙晳暙暠暲暿曺朎杦枻桒柀栁桄棏﨓楨﨔榘槢樰橫橆橳橾櫢櫤毖氿汜沆汯涇浯涖涬淏淸淲淼渹湜渧渼溿澈澵濵瀅瀇瀨炅炫焏焄煜煆燾犱犾猤獷玽珣珒琇珵琦琪琩琮瑢璉璟甁畯皂皜皞皛皦睆劯砡硎硤礰禔禛竑竧靖竫箞絈綷綠緖繒罇羡茁荢荿菇菶葈蒴蕓蕙蕫﨟薰蠇裵訒訷詹誧誾諟諶譓譿賰賴贒赶﨣軏﨤遧鄕鄧釚釗釞釭釮釤釥鈆鈐鈊鈺鉀鈼鉎鉙鉑鈹鉧銧鉷鉸鋧鋗鋙鋐﨧鋕鋠鋓錥錡鋻﨨錞鋿錝錂鍰鍗鎤鏆鏞鏸鐱鑅鑈閒﨩隝隯霳霻靃靍靏靑靕顗顥餧馞驎髜魵魲鮏鮱鮻鰀鵰鵫鸙黑';
		// チェックする機種依存文字群
		$dependentArray = array();
		while ($i = mb_strlen($dependents, 'UTF-8')) {
			array_push ($dependentArray, mb_substr($dependents, 0, 1, 'UTF-8'));
			$dependents = mb_substr ($dependents, 1, $i, 'UTF-8');
		}
		// チェック対象依存文字列を正規表現で検索
		// ・ヒットした場合は対象結果を返す
		foreach ($dependentArray as $value) {
			if (preg_match('/('. $value .')/', $check_contents)) {
				$result = true;
				break;
			}
		}
		
		return $result;
	}
	
}
