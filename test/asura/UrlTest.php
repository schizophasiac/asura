<?php 
use asura\Url;
use config\SiteConfig;

class UrlTest extends PHPUnit_Framework_TestCase
{
    private $testUrl = '';

    public function setUp()
    {
        $this->testUrl = SiteConfig::$rootUrl . '/controller_test/action_test/id_test/apone/aptwo/apthree?var1=val1&var2=val2&var3=val3';
    }

    public function testCreateUrl()
    {
        $additionalParams = array('apone', 'aptwo', 'apthree');
        $namedParams = array('var1' => 'val1', 'var2' => 'val2', 'var3' => 'val3');
        $url = Url::CreateUrl('controller_test', 'action_test', 'id_test', $additionalParams, $namedParams);
        $this->assertEquals($this->testUrl, $url, 'The URL should equal ' . $this->testUrl . ' Actually equals ' . $url);
    }

    public function testParseUrl()
    {
        $urlData = Url::ParseUrl($this->testUrl);
        $this->assertEquals($urlData['base'], SiteConfig::$rootUrl, 'The base URL does not match');
    }


    public function testGetController()
    {
        $controller = Url::GetController($this->testUrl);
        $this->assertEquals($controller, 'controller_test', 'The controller name does not match');
    }

    public function testGetAction()
    {
        $action = Url::GetAction($this->testUrl);
        $this->assertEquals($action, 'action_test', 'The action name does not match');
    }


    public function testGetId()
    {
        $id = Url::GetId($this->testUrl);
        $this->assertEquals($id, 'id_test', 'The ID does not match');
    }


    public function testGetAdditionalParams()
    {
        $params = Url::GetAdditionalParams($this->testUrl);
        $this->assertEquals($params[0], 'apone', 'The first additional parameter doesn\'t match' );
        $this->assertEquals($params[1], 'aptwo', 'The second additional parameter doesn\'t match');
        $this->assertEquals($params[2], 'apthree', 'The third additional parameter does\'t match');
    }


    public function testGetNamedParams()
    {
        $params = Url::GetNamedParams($this->testUrl);
        $this->assertEquals($params['var1'], 'val1', 'The var1 named parameter doesn\'t match');
        $this->assertEquals($params['var2'], 'val2', 'The second named paremeter doesn\'t match');
        $this->assertEquals($params['var3'], 'val3', 'The third named parameter doesn\'t match');
    }
}
