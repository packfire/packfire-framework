<?php
namespace Packfire\Collection;

/**
 * Test class for Deque.
 * Generated by PHPUnit on 2012-02-19 at 05:16:42.
 */
class DequeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Deque
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Deque;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Deque::enqueueFront
     */
    public function testEnqueueFront() {
        $this->assertCount(0, $this->object);
        $this->object->enqueueFront(5);
        $this->assertCount(1, $this->object);
        $this->assertEquals(5, $this->object->front());
        $this->object->enqueueFront(2);
        $this->assertCount(2, $this->object);
        $this->assertEquals(2, $this->object->front());
    }

    /**
     * @covers Deque::dequeueBack
     */
    public function testDequeueBack() {
        $this->object->enqueueFront(5);
        $this->assertCount(1, $this->object);
        $this->object->enqueueFront(2);
        $this->assertCount(2, $this->object);
        $this->assertEquals(5, $this->object->dequeueBack());
        $this->assertCount(1, $this->object);
        $this->assertEquals(2, $this->object->dequeueBack());
        $this->assertCount(0, $this->object);
    }

    /**
     * @covers Deque::back
     */
    public function testBack() {
        $this->object->enqueueFront(5);
        $this->assertEquals(5, $this->object->back());
        $this->object->enqueueFront(2);
        $this->assertEquals(5, $this->object->back());
        $this->object->enqueue(15);
        $this->assertEquals(15, $this->object->back());
    }

}