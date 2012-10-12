<?php
namespace Packfire\IoC;

/**
 * Test class for BucketUser.
 * Generated by PHPUnit on 2012-06-13 at 09:57:00.
 */
class BucketUserTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BucketUser
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = $this->getMockForAbstractClass('Packfire\IoC\BucketUser');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers BucketUser::setBucket
     */
    public function testSetBucket() {
        $bucket = new ServiceBucket();
        $bucket->put('test', $this);
        $this->object->setBucket($bucket);
        $this->assertEquals($this, $this->object->service('test'));
    }

    /**
     * @covers BucketUser::copyBucket
     */
    public function testCopyBucket() {
        $bucket = new ServiceBucket();
        $bucket->put('test', $this);
        $this->object->setBucket($bucket);

        $user = $this->getMockForAbstractClass('Packfire\IoC\BucketUser');
        $user->copyBucket($this->object);
        $this->assertEquals($this, $user->service('test'));
    }

    /**
     * @covers pBucketUser::service
     */
    public function testService() {
        $this->assertNull($this->object->service('test'));
        $bucket = new ServiceBucket();
        $this->object->setBucket($bucket);
        $this->assertNull($this->object->service('test'));
        $bucket->put('test', $this);
        $this->assertEquals($this, $this->object->service('test'));
    }

}