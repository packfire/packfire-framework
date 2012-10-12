<?php
namespace Packfire\Application;

/**
 * Test class for ServiceApplication.
 * Generated by PHPUnit on 2012-09-17 at 06:20:35.
 */
class ServiceApplicationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ServiceApplication
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = $this->getMockForAbstractClass('Packfire\Application\ServiceApplication');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testConstruct(){
        $this->assertInstanceOf('Packfire\IoC\BucketUser', $this->object);
        $property = new \ReflectionProperty(get_class($this->object), 'services');
        $property->setAccessible(true);
        $services = $property->getValue($this->object);
        $this->assertTrue($services->contains('config.app'));
        $this->assertFalse($services->contains('config.routing'));
        $this->assertNull($this->object->service('config.routing'));
    }

}