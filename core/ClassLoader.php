<?php

require 'basics.php';

class ClassLoader
{
    //classファイルがあるディレクトリのリスト
    private static $dir = __DIR__ ;

    //クラス読み込む
    public static function loadClass($class)
    {
        $file_name = __DIR__ . '/' .  $class . ".php";
        // $dir = __DIR__;
        // if (is_file($file_name)) {
        //     require $file_name;

        //     return true;
        // }
    }

    public static function loadAllClass()
    {
        $dir = __DIR__ . '/classes/';
        if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
            while( ($file = readdir($handle)) !== false ) {
                if( filetype( $path = $dir . $file ) == "file" ) {
                    //self::loadClass($file);
                    require_once $path;
                  // $file: ファイル名
                  // $path: ファイルのパス
                }
            }
        }
    }
}
ClassLoader::loadAllClass();