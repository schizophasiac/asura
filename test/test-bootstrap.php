<?php
require '../src/asura/AutoLoader.php';

$testLoader = new asura\AutoLoader();
$testLoader->RegisterPath('./');
$testLoader->RegisterPath('../src/');
$testLoader->RegisterPath('../');
$testLoader->RegisterExcludePaths('PHPUnit');
$testLoader->RegisterExcludePaths('Composer');
$testLoader->RegisterLoader();
