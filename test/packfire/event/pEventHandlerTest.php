<?php

pload('packfire.event.pEventHandler');

/**
 * Test class for pEventHandler.
 * Generated by PHPUnit on 2012-07-06 at 04:58:15.
 */
class pEventHandlerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pEventHandler
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pEventHandler($this);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pEventHandler::on
     * @covers pEventHandler::trigger
     */
    public function testCombined() {
        $this->object->on('click', function($obj, $arg){
            $obj->assertNull($arg);
            $obj->assertInstanceOf('PHPUnit_Framework_TestCase', $obj);
        });
        $this->object->trigger('click');
    }
}