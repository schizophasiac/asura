<?php

namespace asura;

use config\SiteConfig;
// use controllers\Controller;

class Router
{
    /** @var Controller $controller */
    private $controller;

    /** @var string - Folder the controller classes are in */
    private $controllerDir = 'controllers';

    /** @var String - Stores any content returned by the controller */
    private $content;

    /** @var String - Stores the type of content, currently supports 'json', 'html' and any other name for 'other' */
    private $contentType;

}
