<?php 
class {PluginName}CustomFieldsSchema extends CakeSchema {

	public $file = '{SnakeCasePluginName}_custom_fields.php';

	public $connection = 'plugin';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $sample_table_name = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'your_integer' => array('type' => 'integer', 'null' => true, 'default' => null),
		'your_string' => array('type' => 'string', 'null' => true, 'default' => null),
		'your_flag' => array('type' => 'integer', 'null' => true, 'default' => 0, 'length' => 1),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		)
	);

}
