<?php
namespace asura;

/**
 * Class: MasterPage
 *
 * Provides the structure of the page, that is, the majority of the HTML surrounding the content.
 * This works for most web-apps that I build, the view file is where most of the customization
 * is done. 
 */
class MasterPage 
{
    /** title @var String - Title used in the <title> tag */
    private $title;

    /** pageTitle @var String - Title which is displayed (the one that's usually hidden!)*/   
    private $pageTitle;

    /** subtitle @var String - A Subtitle displayed along with the $pageTitle if applicable */ 
    private $subtitle;

    /** description @var String - Description of the page used in the META tags */ 
    private $description;

    /** siteInfo @var String - Displayed in the footer, usually contains copyright or contact info */
    private $siteInfo;

    /** siteUrl @var String - URL to the site root, used for linking the pageTitle/subTitle back to the index page */
    private $siteUrl;

    /** stylesheets @var Array - Array of stylesheets in array(array('sheet1', 'screen'), ('sheet2' => 'print')) format */
    private $stylesheets;

    /** javascripts @var Array - Array of JavaScript files to be included */ 
    private $javascripts;

    /** messages @var Array - Array of messages to be included on the page, this includes "Success" and "Error" messages in the
     * format array(array($msg, 'success'), array($msg, 'error')) */
    private $messages;

    /** content @var String - The main content displayed in the body of the page */
    private $content;

    /** mainmenu @var String - The menu, this is often generated by another view and may change if a person is logged in, etc. */
    private $mainMenu;


    public function __construct($title, $subtitle, $description, $pageTitle, $siteInfo, $siteUrl)
    { 
        $this->SetTitle($title);
        $this->SetSubTitle($subtitle);
        $this->SetDescription($description);
        $this->SetPageTitle($pageTitle);
        $this->SetSiteInfo($siteInfo);
        $this->SetSiteUrl($siteUrl);

    }

    
    /**
     * AddMessage
     * Messages are displayed (generally) at the top of the page to indicate a succsessful or failed operation
     *
     * @param string $message The message to be displayed
     * @param string $type 'success'|'error'
     */
    public function AddMessage($message, $type = 'success')
    {
        $this->messages[] = array($message, $type);
        return $this;
    }
    

    public function SetSiteUrl($url)
    {
        $this->siteUrl = $url;
        return $this;
    }
    

    public function SetTitle($title)
    {
        $this->title = $title;
        return $this;
    }


    public function SetPageTitle($title)
    {
        $this->pageTitle = $title;
        return $this;
    }

    public function SetSubTitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }


    public function SetDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function SetContent($content)
    {
        $this->content = $content;
        return $this;
    }


    public function SetMainMenu($menu)
    {
        $this->mainMenu = $menu;
        return $this;
    }

    public function SetSiteInfo($siteinfo)
    {
        $this->siteInfo = $siteinfo;
        return $this;
    }

    public function AddStyleSheet($stylesheet, $media = 'screen')
    {
        $this->stylesheets[] = array($stylesheet, $media);
        return $this;
    }

    public function AddJavascriptFile($filename)
    {
        $this->javascripts[] = $filename;
        return $this;
    }


    public function PrintPage($viewFile)
    {
        $view = new View($viewFile);
        return $view 
            -> Set('description', $this->description)
            -> Set('title',       $this->title)
            -> Set('subtitle',    $this->GetSubtitle())
            -> Set('stylesheets', $this->stylesheets)
            -> Set('javascripts', $this->javascripts)
            -> Set('siteUrl',     $this->siteUrl)
            -> Set('pageTitle',   $this->pageTitle)
            -> Set('messages',    $this->messages)
            -> Set('content',     $this->content)
            -> Set('siteInfo',    $this->siteInfo)
            -> Set('mainMenu',    $this->mainMenu)
            -> Parse();
    }

    // Getter methods 
    public function GetTitle()
    {
        return $this->title;
    }

    public function GetPageTitle()
    {
        return $this->pageTitle;
    }
    
    public function GetSubtitle()
    {
        return $this->subtitle;
    }
    
    public function GetDescription()
    {
        return $this->description;
    }

    public function GetSiteInfo()
    {
        return $this->siteInfo;
    }
    
    public function GetSiteUrl()
    {
        return $this->siteUrl;
    }

    public function GetStylesheets()
    {
        return $this->stylesheets;
    }

    public function GetJavascripts()
    {
        return $this->javascripts;
    }

    public function GetMessages()
    {
        return $this->messages;
    }

    public function GetContent()
    {
        return $this->content;
    }

    public function GetMainMenu()
    {
        return $this->mainMenu;
    } 
}

