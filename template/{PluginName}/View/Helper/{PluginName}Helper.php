<?php
class {PluginName}Helper extends AppHelper {
	public $helpers = array('BcBaser');
/**
 * Default Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}
}
