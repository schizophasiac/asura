<?php
use asura\View;

class ViewTest extends PHPUnit_Framework_TestCase
{
    private $view;

    public function Setup() {
        $this->view = new View('testview.php', 'asura');                
    }


    public function testParse() {
        $assertString = 'This is a test test';
        $this->view->Set('myVar', 'test');
        $this->assertEquals($this->view->Parse(), $assertString, 'The view was not parsed correctly');
    }

    public function testParseException()
    {
        $view = new View();
        $this->setExpectedException('Exception', 'Cannot parse a template before it has been set!');
        $view->Parse();

    }

    public function testLoadFileNotFoundException()
    {
        $fileName = 'nonexistantfile.php';
        $this->setExpectedException('Exception', 'File not found: asura/src/views/'.$fileName);
        $this->view->Load($fileName); 
    }

    public function testViewUnreadableException()
    {
        $this->setExpectedException('Exception', 'Could not access the file: unreadableview.php');
        $this->view->Load('unreadableview.php', 'asura');
    }
    
    

}

