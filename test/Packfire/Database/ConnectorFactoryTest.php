<?php
namespace Packfire\Database;

/**
 * Test class for ConnectorFactory.
 * Generated by PHPUnit on 2012-09-03 at 07:14:23.
 */
class ConnectorFactoryTest extends \PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {

    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers ConnectorFactory::create
     */
    public function testCreate() {
        $driver = ConnectorFactory::create(array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'test',
            'user' => 'root',
            'password' => defined('__TEST_DB_PWD__') ? __TEST_DB_PWD__ : 'password'
        ));
        $this->assertInstanceOf('Packfire\Database\Drivers\MySql\Connector', $driver);
    }

}