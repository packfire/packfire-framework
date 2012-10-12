<?php
namespace Packfire\OAuth;

use Packfire\Net\Http\Request as HttpRequest;

/**
 * Test class for Request.
 * Generated by PHPUnit on 2012-09-27 at 01:08:22.
 */
class RequestTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Request
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Request;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Request::preload
     */
    public function testPreload() {
        $request = new HttpRequest();
        $request->get()->add(OAuth::CONSUMER_KEY, 'consumer');
        $request->get()->add('test', 'alpha');
        $this->object->preload($request);
        $this->assertEquals('consumer', $this->object->oauth(OAuth::CONSUMER_KEY));
        $this->assertEquals('alpha', $this->object->get()->get('test'));
    }

    /**
     * @covers Request::oauth
     */
    public function testOauth() {
        $this->assertNull($this->object->oauth(OAuth::CALLBACK));
        $this->object->oauth(OAuth::TOKEN, 'token');
        $this->assertEquals('token', $this->object->oauth(OAuth::TOKEN));
    }

    /**
     * @covers Request::parse
     */
    public function testParse() {
        $http = "POST /api/test?oauth_token=token HTTP/1.1\nHost: example.com\n"
                . "Authorization: OAuth oauth_consumer_key=consumer\n\ntest=5";
        $this->object->parse($http);
        $this->assertEquals(5, $this->object->post()->get('test'));
        $this->assertEquals('token', $this->object->oauth(OAuth::TOKEN));
        $this->assertEquals('consumer', $this->object->oauth(OAuth::CONSUMER_KEY));
    }

    /**
     * @covers Request::signatureBase
     */
    public function testSignatureBase() {
        $this->object->oauth(OAuth::CONSUMER_KEY, 'consumer');
        $this->object->get()->add('test', 'alpha');
        $base = $this->object->signatureBase();
        $this->assertInternalType('string', $base);
        $this->assertEquals(1, substr_count($base, '%3Dconsumer'));
        $this->assertEquals(1, substr_count($base, 'oauth_consumer_key'));
        $this->assertEquals(1, substr_count($base, 'test'));
        $this->assertEquals(1, substr_count($base, '%3Dalpha'));
    }

    /**
     * @covers Request::method
     */
    public function testMethod() {
        $this->assertEquals('GET', $this->object->method('get'));
    }

    /**
     * @covers Request::buildAuthorizationHeader
     */
    public function testBuildAuthorizationHeader() {
        $this->object->oauth(OAuth::CONSUMER_KEY, 'consumer');
        $this->object->oauth(OAuth::TOKEN, 'token');
        $header = $this->object->buildAuthorizationHeader();
        $this->assertEquals('OAuth oauth_version="1.0", oauth_consumer_key'
                . '="consumer", oauth_token="token"', $header);

    }

    /**
     * @covers Request::sign
     */
    public function testSign() {
        $this->object->oauth(OAuth::NONCE, 'test');
        $this->object->oauth(OAuth::TOKEN, 'token');
        $this->object->sign('HMAC-SHA1', new Consumer('consumer', 'secret'));
        $this->assertNotNull($this->object->oauth(OAuth::SIGNATURE));
        $this->assertNotNull($this->object->oauth(OAuth::TIMESTAMP));
        $this->assertEquals('HMAC-SHA1', $this->object->oauth(OAuth::SIGNATURE_METHOD));
    }

    /**
     * @covers Request::sign
     * @expectedException Packfire\Exception\InvalidArgumentException
     */
    public function testSignFail(){
        $this->object->sign('WOAHFAKE', new Consumer('consumer', 'secret'));
    }

}