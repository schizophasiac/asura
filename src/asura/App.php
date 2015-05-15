<?php
namespace asura;

use config\SiteConfig;

class App 
{


    public function __construct()
    {

    }

    public function Run()
    {
        $master = new MasterPage(
            SiteConfig::$appTitle,
            SiteConfig::$appSubTitle,
            SiteConfig::$appDescription,
            SiteConfig::$appTitle,
            SiteConfig::$appInfo,
            SiteConfig::$rootUrl
        );

        print $master->PrintPage();
    }
}
