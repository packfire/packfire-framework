<?php

pload('packfire.datetime.pTimeSpan');

/**
 * Test class for pTimeSpan.
 * Generated by PHPUnit on 2012-04-28 at 02:31:47.
 */
class pTimeSpanTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pTimeSpan
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pTimeSpan(3695);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pTimeSpan::hour
     */
    public function testHour() {
        $this->assertEquals(1, $this->object->hour());
        $this->object->hour(2);
        $this->assertEquals(2, $this->object->hour());
        $this->assertEquals(5, $this->object->hour(5));
    }

    /**
     * @covers pTimeSpan::day
     */
    public function testDay() {
        $this->assertEquals(0, $this->object->day());
        $this->object->day(5);
        $this->assertEquals(5, $this->object->day());
        $this->assertEquals(3, $this->object->day(3));
    }

    /**
     * @covers pTimeSpan::totalSeconds
     */
    public function testTotalSeconds() {
        $this->assertEquals(3695, $this->object->totalSeconds());
        $this->object->hour(2);
        $this->assertEquals(7295, $this->object->totalSeconds());
        $this->object->day(1);
        $this->assertEquals(93695, $this->object->totalSeconds());
    }

    /**
     * @covers pTimeSpan::totalMinutes
     */
    public function testTotalMinutes() {
        $this->assertEquals(3695 / 60, $this->object->totalMinutes());
        $this->object->hour(2);
        $this->assertEquals(7295 / 60, $this->object->totalMinutes());
        $this->object->day(1);
        $this->assertEquals(93695 / 60, $this->object->totalMinutes());
    }

    /**
     * @covers pTimeSpan::totalHours
     */
    public function testTotalHours() {
        $this->assertEquals(3695 / 3600, $this->object->totalHours());
        $this->object->hour(2);
        $this->assertEquals(7295 / 3600, $this->object->totalHours());
        $this->object->day(1);
        $this->assertEquals(93695 / 3600, $this->object->totalHours());
    }

    /**
     * @covers pTimeSpan::totalDays
     */
    public function testTotalDays() {
        $this->assertEquals(3695 / 86400, $this->object->totalDays());
        $this->object->hour(2);
        $this->assertEquals(7295 / 86400, $this->object->totalDays());
        $this->object->day(1);
        $this->assertEquals(93695 / 86400, $this->object->totalDays());
    }

    /**
     * @covers pTimeSpan::add
     */
    public function testAdd() {
        $ts = $this->object->add(new pTimeSpan(90015));
        $this->assertEquals(2, $ts->hour());
        $this->assertEquals(1, $ts->day());
        $this->assertEquals(50, $ts->second());
        $this->assertEquals(1, $ts->minute());
    }

    /**
     * @covers pTimeSpan::subtract
     */
    public function testSubtract() {
        $ts = $this->object->subtract(new pTimeSpan(1425));
        $this->assertEquals(0, $ts->hour());
        $this->assertEquals(0, $ts->day());
        $this->assertEquals(37, $ts->minute());
        $this->assertEquals(50, $ts->second());
    }

}