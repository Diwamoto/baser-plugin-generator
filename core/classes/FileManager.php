<?php

namespace BcPluginManager;

class FileManager
{

    public function execute($request)
    {
        $this->copy(TEMPLATE_DIR, RESULT_DIR, $request['debug']);
        $this->replace($request, RESULT_DIR);
        if($request['makeReadme']){
            file_put_contents(RESULT_DIR . '/' . $request['PluginName'] . '/README.md',
            '# ' . $request['PluginName'] . PHP_EOL .
            'このREADME.mdはBcPluginGeneratorにて作成されました。' . PHP_EOL);
        }
    }

    private function copy($dir, $newDir, $debug = false)
    {
        if (!is_dir($newDir)) {
            mkdir($newDir);
        }

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    if (is_dir($dir . '/' . $file)) {
                        $this->copy($dir . '/' . $file, $newDir . '/' . $file);
                    }
                    else {
                        copy($dir . '/' . $file, $newDir . '/' . $file);
                        if($debug){
                            echo $dir . '/' . $file . 'を' . $newDir . '/' . $file . 'にコピーしました。' . PHP_EOL;
                        }
                    }
                }
                closedir($dh);
            }
        }
        return true;
    }

    private function replace($request, $dir)
    {
        $debug = $request['debug'];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }
                    if (is_dir($dir . '/' . $file)) {
                        $newDirName = str_replace('{PluginName}', $request['PluginName'], $dir . '/' . $file);
                        rename($dir . '/' . $file, $newDirName);
                        if($debug){
                            echo $dir . '/' . $file . 'を' . $newDirName . 'に変更しました。' . PHP_EOL;
                        }
                        $this->replace($request, $newDirName);
                    }
                    else {
                        $newFileName = str_replace('{PluginName}', $request['PluginName'], $dir . '/' . $file);
                        $fileContent = file_get_contents($dir . '/' . $file);
                        if(rename($dir . '/' . $file, $newFileName)){
                            if($debug){
                                echo $dir . '/' . $file . 'を' . $newFileName . 'に変更しました。' . PHP_EOL;
                            }
                            $fileContent = $this->parseRequest($request, $fileContent);
                            file_put_contents($newFileName, $fileContent);
                            if($debug){
                                echo $newFileName . 'に書き込みました。' . PHP_EOL;
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        return true;
    }

    private function parseRequest($request, $fileContent)
    {
        foreach($request as $key => $req){
            $fileContent = str_replace('{' . $key . '}', $req, $fileContent);
        }
        return $fileContent;
    }

}