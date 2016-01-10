<?php

/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2016/01/07
 * Time: 3:28
 */
include dirname(__FILE__) . '/../webd/includes/DbAction.php';
class DbActionTest extends PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }

    public function testDB(){
        $dba = new DbAction();
        # Checking that db config.php exist and contains options
        $dba->Check();
    }


}
