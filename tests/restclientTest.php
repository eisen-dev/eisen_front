<?php

/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 2:42
 */
include dirname(__FILE__) . '/../webd/includes/restclient.php';
class restclientTest extends PHPUnit_Framework_TestCase
{
    public function testTrueIsTrue()
    {
        $s = new restclient();
        $ans = $s->restconnect("127.0.0.1","5000","ansible","default");
        $this->assertEquals('online', $ans);

    }

    public function testEmpty()
    {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack)
    {
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);

        return $stack;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $stack)
    {
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }
}
