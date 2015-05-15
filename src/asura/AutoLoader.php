<?php
namespace asura;

class AutoLoader
{
    private $includePaths = array();
    private $excludedPaths = array();

    public function RegisterPath($includePath)
    {
        $this->includePaths[] = $includePath;
    }

    public function RegisterExcludePaths($excludePath)
    {
        $this->excludedPaths[] = $excludePath;
    }
    
    public function RegisterLoader()
    {
        spl_autoload_register(array($this, 'LoadClass'));
    }
    
    public function LoadClass($class)
    {
        $class = ltrim($class, '\\');
        $fileName = '';
        $namespace = '';
        if($lastNsPos = strpos($class, '\\')) {
            $namespace = substr($class, 0, $lastNsPos);
            $class = substr($class, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        // See if any of the paths should be excluded
        foreach($this->excludedPaths as $path) {
            if(strpos($namespace, $path) === 0) {
                return;
            }
        }

        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        if(!empty($this->includePaths)) {
            foreach($this->includePaths as $includePath) {
                if(file_exists($includePath . $fileName)) {
                    require($includePath.$fileName);
                    break;
                }
            }
        } else {
            require($fileName);
        }
    }
}

