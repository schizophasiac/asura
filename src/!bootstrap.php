<?php
require_once ('asura/AutoLoader.php');
$autoLoader = new asura\AutoLoader();
$autoLoader->RegisterPath('src/');
$autoLoader->RegisterPath('./');
$autoLoader->RegisterLoader();
