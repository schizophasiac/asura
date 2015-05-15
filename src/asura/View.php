<?php
namespace asura;

use config\SiteConfig;
class View
{
    /**
     * @var String $viewFolder - Folder from the site root directoy that holds the view files
     */
    private $viewFolder = 'src/views';
    /**
     * @var String $view - Name of the view file sans .php
     */
    private $view = null;
    /**
     * @var String $rootPath - Path to the site root directory
     */
    private $rootPath;


    
    /**
     * __construct
     * Constructor class, Most commonly a view will be passed in for immediate loading.
     * @param String $view - Name of the view to be used
     */
    public function __construct($view = null)
    {
        $this->rootPath = SiteConfig::$rootDirectory;
        if($view) {
            $this->Load($view);
        }
        return $this;
    }

    public function Load($view)
    {
        $ds = DIRECTORY_SEPARATOR;
        $file = $this->rootPath . $ds . $this->viewFolder . $ds . $view;
        if(!is_file($file)) {
            throw new \Exception("File not found: " . $file);
        } else if (!is_readable($this->rootPath . $ds . $this->viewFolder . $ds . $view)) {
            throw new \Exception('Could not access the file: '.$view); 
        } else {
            $this->view = $view;
        }
    }

    public function Set($var, $content)
    {
        $this->$var = $content;
        return $this;
    }

    public function Parse() 
    {
        if(!$this->view) {
            throw new Exception('Cannot parse a template before it has been set!');
        } else {
            ob_start();
            require($this->rootPath.DIRECTORY_SEPARATOR.$this->viewFolder.DIRECTORY_SEPARATOR.$this->view);
            $content = ob_get_clean();
            return $content;
        }
    }
}
