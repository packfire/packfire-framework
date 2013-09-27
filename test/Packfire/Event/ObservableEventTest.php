<?php
namespace Packfire\Event;

use Packfire\Core\IObserver;

/**
 * Test class for ObservableEvent.
 * Generated by PHPUnit on 2012-09-17 at 07:44:11.
 */
class ObservableEventTest extends \PHPUnit_Framework_TestCase implements IObserver
{
    /**
     * @var \Packfire\Event\ObservableEvent
     */
    protected $object;

    /**
     * @var integer
     */
    protected $counter = 0;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers \Packfire\Event\ObservableEvent::__construct
     * @covers \Packfire\Event\ObservableEvent::attach
     */
    protected function setUp()
    {
        $this->object = new ObservableEvent($this);
        $this->object->attach(new EventObserver(array($this, 'observer')));
        $this->object->attach($this);
    }

    public function observer($observable, $arg = null)
    {
        if ($this === $observable) {
            $this->counter += $arg;
        }
    }

    public function updated($observable, $arg = null)
    {
        $this->observer($observable, $arg);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers \Packfire\Event\ObservableEvent::notify
     */
    public function testNotify()
    {
        $this->object->notify(5);
        $this->assertEquals(10, $this->counter);
    }
}
