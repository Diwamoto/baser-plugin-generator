<?php

namespace BcPluginGenarator;

class BcPluginGeneratorShell
{

    private $requests = [];

    private $signature = '
    -----------------------------------------------------
    +     ____       ____  __            _              +
    *    / __ )_____/ __ \/ /_  ______ _(_)___          *
    +   / __  / ___/ /_/ / / / / / __ `/ / __ \         +
    *  / /_/ / /__/ ____/ / /_/ / /_/ / / / / /         *
    + /_____/\___/_/   /_/\__,_/\__, /_/_/ /_/          +
    *                          /____/                   *
    +    ______                           __            +
    *   / ____/__  ____  ___  _________ _/ /_____  _____*
    +  / / __/ _ \/ __ \/ _ \/ ___/ __ `/ __/ __ \/ ___/+
    * / /_/ /  __/ / / /  __/ /  / /_/ / /_/ /_/ / /    *
    + \____/\___/_/ /_/\___/_/   \__,_/\__/\____/_/     +
    -----------------------------------------------------

       BcPluginGenerator {VERSION} by {AUTHER}
       for baserCMS {BASER_VERSION} へようこそ


    baserCMS {BASER_VERSION} に使用できるプラグインを生成します。';

    public function __construct(){
        require CORE . '/../config.php';
        $this->signature = str_replace('{BASER_VERSION}', $config['baser_version'], str_replace('{AUTHER}', $config['auther'], str_replace('{VERSION}', $config['version'], $this->signature)));
        echo $this->signature . PHP_EOL;
    }

    public function execShell(){
        $this->ask('プラグインの名前を入力してください...', 'PluginName');
        $this->ask('プラグインの説明を入力してください...', 'PluginDescription');
        $this->ask('作者の名前を入力してください...', 'Auther');
        $this->ask('バージョンを入力して下さい...', 'PluginVersion');
        $this->confirm('ReadMeを作成しますか？(y or n)', 'makeReadme');
        $this->confirm('Webサイトはお持ちですか？(y or n)', 'haveWebSite');
        if($this->requests['haveWebSite'] === 'true'){
            $this->ask('お持ちのWebサイトurlを入力して下さい...', 'AutherUrl');
        }else{
            $this->requests['AutherUrl'] = '';
        }
        unset($this->requests['haveWebSite']);
        $this->display();
        $this->confirm('この内容で作成してよろしいですか？(y or n)', 'check_flg');
        $this->confirm('ログを表示しますか？(y or n)', 'debug');
        if($this->requests['check_flg'] === 'true'){
            $this->requests['debug'] = ($this->requests['debug'] === 'true') ? true : false;
            return $this;
        }else{
            $this->requests = [];
            return $this->execShell();
        }

    }

    public function getRequest(){
        return $this->requests;
    }

    private function ask($message, $key, $validater = []){
        echo $message . PHP_EOL . PHP_EOL;
        while(1){
            echo '--> ';
            $line = trim(fgets(STDIN));
            if($line){
                if($validater){
                    //TODO 独自条件ある場合の処理
                }
                $this->requests[$key] = $line;
                break;
            }else{
                echo '文字列で入力してください。' . PHP_EOL . PHP_EOL;
            }
        }
    }

    private function confirm($message, $key){
        echo $message . PHP_EOL . PHP_EOL;
        while(1){
            echo '--> ';
            $line = trim(fgets(STDIN));
            if($line == 'y' || $line == 'yes'){
                $this->requests[$key] = 'true';
                break;
            }else if($line == 'n' || $line == 'no'){
                $this->requests[$key] = 'false';
                break;
            }else{
                echo $message . PHP_EOL . PHP_EOL;
            }
        }
    }

    private function display(){
        echo '-----------------------------' . PHP_EOL;
        foreach($this->requests as $key => $req){
            echo '    ' . \Basic::translate($key) . '     => ' . \Basic::translate($req) . PHP_EOL;
        }
        echo '-----------------------------' . PHP_EOL;
    }

    public function complete($pluginName, $time){
        echo '-----------------------------' . PHP_EOL .
             '    ' . $pluginName . 'プラグインを生成しました。' . PHP_EOL .
             '    ご利用ありがとうございました。' . PHP_EOL .
             '    生成にかかった時間...' . $time . '秒' .PHP_EOL .
             '-----------------------------' . PHP_EOL;
    }

}