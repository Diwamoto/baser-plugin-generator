<?php
mb_internal_encoding("UTF-8");

use BcPluginGanerator\BcPluginGenaratorCore;

require 'core/classloader.php';
$core = new BcPluginGenaratorCore();
$core->exec();