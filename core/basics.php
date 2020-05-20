<?php
define('DS', DIRECTORY_SEPARATOR);
define('CORE', __DIR__);
define('ROOT', $_SERVER['PWD']);
define('TEMPLATE_DIR', ROOT . '/template');
define('RESULT_DIR', ROOT . '/result');

class Basic {

    private static $translation = [
        'PluginName'        => 'プラグイン名',
        'PluginDescription' => '説明',
        'Auther'            => '作者',
        'PluginVersion'     => 'バージョン',
        'AutherUrl'         => 'webサイト名',
        'makeReadme'        => 'README.mdを作成するかどうか',
        'makeHelper'        => 'ヘルパーを作成するかどうか',
        'makeLibrary'       => 'ライブラリを作成するかどうか',
        'true'              => 'はい',
        'false'             => 'いいえ'
    ];

    public static function translate($key)
    {
        if(array_key_exists($key, self::$translation)){
            return self::$translation[$key];
        }else{
            return $key;
        }
    }

}