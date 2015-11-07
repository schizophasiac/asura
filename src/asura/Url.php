<?php

namespace asura;

use config\SiteConfig;

class Url 
{
    /**
     * Generates a URL string
     * @param $controller String|Null Controller being called
     * @param $action String|Null  Action within the controller being called
     * @param $id String|Null Most commonly an ID is passed
     * @param $additionalParams Array Additional parameters to be appended in /var1/var2/var3 format
     * @param $namedParams Array Associative array of key=>value pairs included a ?var1=val1&var2=val2&var3=val3 format
     * @return String Generated url
     */
    static function CreateUrl($controller = null, $action = null, $id = null, $additionalParams = array(), $namedParams = array())
    {
        $url = SiteConfig::$rootUrl;
        if(isset($controller)) {
            $url .= '/' . urlencode($controller);
            if(isset($action)) {
                $url .= '/'.urlencode($action);
                if(isset($id)) {
                    $url .= '/'.urlencode($id);
                }
            }
        }
        if(count($additionalParams)) {
            foreach($additionalParams as $param) {
                $url .= '/'.urlencode($param);
            }
        }
        if(count($namedParams)) {
            $url .= '?';
            $paramStrings = array();
            foreach($namedParams as $key => $value) {
               $paramStrings[] = urlencode($key).'='.urlencode($value); 
            }
            $url .= implode('&', $paramStrings);
        }
        return $url;
    }


    /**
     * Parses the URL into the various variables
     * @param $url String - Optional, should really only be used for testing
     * @return array containing keys 'base', 'controller', 'action', 'id', 'additionalParams' and 'namedParams'
     */
    static function ParseUrl($url = null)
    {
        $url = $url ? $url : $_SERVER['REQUEST_URI'];
        $urlData = array();
        // First seperate any possible named params
        $urlPart = explode('?', $url);
        if(isset($urlPart[1])) {
            $namedParamsStrings = explode('&', $urlPart[1]);
            $namedParams = array();
            foreach($namedParamsStrings as $param) {
                $paramPair = explode('=', $param);
                $namedParams[$paramPair[0]] = $paramPair[1];
            }
            $urlData['namedParams'] = $namedParams;
        }
        $urlParts = explode('/', $urlPart[0]);
        $urlData['base'] = $urlParts[0] . '//' . $urlParts[1] . $urlParts[2];
        $urlData['controller'] = isset($urlParts[3]) ? $urlParts[3] : '';
        $urlData['action'] = isset($urlParts[4]) ? $urlParts[4] : '';
        $urlData['id'] = isset($urlParts[5]) ? $urlParts[5] : '';
        if(isset($urlParts[6])) {
            $additionalParams = array();
            $urlParts = array_slice($urlParts, 6);
            foreach($urlParts as $part) {
                $additionalParams[] = $part;
            }
            $urlData['additionalParams'] = $additionalParams;
        }
        return $urlData;
    }

    
    /**
     * Finds and returns the Controller in the URL
     * @param $url String - Optional, only really used for testing
     * @return string|null The current controller
     */
    static function GetController($url = null)
    {
        $controller = null;
        $url = self::ParseUrl($url);
        if(isset($url['controller'])) {
            $controller = $url['controller'];
        }
        return $controller;
    }

    static function GetAction($url = null)
    {
        $action = null;
        $url = self::ParseUrl($url);
        if(isset($url['action'])) {
            $action = $url['action'];
        }
        return $action;
    }


    static function GetId($url = null)
    {
        $id = null;
        $url = self::ParseUrl($url);
        if(isset($url['id'])) {
            $id = $url['id'];
        }
        return $id;
    }


    static function GetAdditionalParams($url = null)
    {
        $params = array();
        $url = self::ParseUrl($url);
        if(isset($url['additionalParams'])) {
            $params = $url['additionalParams'];
        }
        return $params;
    }


    static function GetNamedParams($url = null)
    {
        $params = array();
        $url = self::ParseUrl($url);
        if(isset($url['namedParams'])) {
            $params = $url['namedParams'];
        }
        return $params;
    }
}


