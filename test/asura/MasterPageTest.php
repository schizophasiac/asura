<?php
use asura\MasterPage;

class MasterPageTest extends PHPUnit_Framework_TestCase
{
    private $testTitle = 'Test Title';
    private $testSubtitle = 'Test Subtitle';
    private $testDescription = 'A description';
    private $testPageTitle = 'Welcome to My Page';
    private $testSiteInfo = '(c)2015';
    private $testSiteUrl = 'http://www.waninghalo.com';
    private $masterPage;

    public function setUp()
    {
         $this->masterPage = new MasterPage($this->testTitle, $this->testSubtitle, 
            $this->testDescription, $this->testPageTitle, $this->testSiteInfo, 
            $this->testSiteUrl);
    } 

    public function testGetTitle()
    {
        $actualTitle = $this->masterPage->GetTitle();
        $this->assertEquals($this->testTitle, $actualTitle,
           'The title should equal '.$this->testTitle);
    }       

    public function testGetPageTitle()
    {
        $actualPageTitle = $this->masterPage->GetPageTitle();
        $this->assertEquals($this->testPageTitle, $actualPageTitle,
            'The page title should equal '.$this->testPageTitle);
    }

    public function testGetSubtitle()
    {
        $actualSubtitle = $this->masterPage->GetSubTitle();
        $this->assertEquals($this->testSubtitle, $actualSubtitle, 
            'The page subtitle should equal '.$this->testSubtitle);
    }

    public function testGetDescription()
    {
        $actualDescription = $this->masterPage->GetDescription();
        $this->assertEquals($this->testDescription, $actualDescription, 
            'The description should equal '.$this->testDescription);
    }

    public function testGetSiteInfo()
    {
        $actualInfo = $this->masterPage->GetSiteInfo();
        $this->assertEquals($this->testSiteInfo, $actualInfo,
            'The site info should equal '.$this->testSiteInfo);
    }

    public function testGetSiteUrl()
    {
        $url = $this->masterPage->GetSiteUrl();
        $this->assertEquals($this->testSiteUrl, $url, 
            'The site URL should equal '.$this->testSiteUrl);
    }

    public function testAddMessage()
    {
        $this->masterPage->AddMessage('Something went wrong', 'error');
        $messages = $this->masterPage->GetMessages();
        $this->assertEquals($messages[0][0], 'Something went wrong', 
            'The site message is incorrect');
        $this->assertEquals($messages[0][1], 'error', 
            'The site message is not reporting an error');
    }

    public function testSetContent()
    {
        $this->masterPage->SetContent('Test Content');
        $content = $this->masterPage->GetContent();
        $this->assertEquals($content, 'Test Content', 'The site content is incorrect.');
    }

    public function testSetMainMenu()
    {
        $mainMenu = '<ul><li>Home</li><li>About</li></ul>';
        $this->masterPage->SetMainMenu($mainMenu);
        $menu = $this->masterPage->GetMainMenu();
        $this->assertEquals($mainMenu, $menu, 'The menu should equal: '.$mainMenu);
    }

    public function testAddStyleSheet()
    {
        $stylesheet = 'style.css';
        $media = 'print';
        $this->masterPage->AddStyleSheet($stylesheet, $media);
        $styles = $this->masterPage->GetStylesheets();
        $this->assertEquals($styles[0][0], $stylesheet, 'The style sheet file should equal: '.$stylesheet);
        $this->assertEquals($styles[0][1], $media, 'The style media should equal: '.$media);
    }

    public function testAddJavascriptFile()
    {
        $jsfile = 'test.js';
        $this->masterPage->AddJavascriptFile($jsfile);
        $file = $this->masterPage->GetJavascripts();
        $this->assertEquals($file[0], $jsfile, 'The JavaScript file should equal: '.$jsfile);
    }

    //TODO: Implement testPrintPage();
}

