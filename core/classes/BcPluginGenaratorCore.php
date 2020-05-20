<?php

namespace BcPluginGanerator;

use BcPluginGenarator\BcPluginGeneratorShell;
use BcPluginManager\FileManager;

class BcPluginGenaratorCore
{

    public function exec(){
        $shell = new BcPluginGeneratorShell();
        $request = $shell->execShell()->getRequest();
        $request['SnakeCasePluginName'] = strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($request['PluginName'])));
        $fileManager = new FileManager();
        $time_start = microtime(true);
        $fileManager->execute($request);
        $time_end = microtime(true);
        $shell->complete($request['PluginName'], round($time_end - $time_start, 3));
    }

}