<?php

/**
 * \AppserverIo\Lang\StringTest
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Lang;

/**
 * This is the test for the String class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a String instance and clone it
        $stringOne = new String('aStringValue');
        $clonedOne = clone $stringOne;
        // serialize/unserialize the String instance
        $stringOne->unserialize($stringOne->serialize());
        // check that the two String instances are equal
        $this->assertEquals($clonedOne, $stringOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        $this->assertEquals('AppserverIo\Lang\String', String::__getClass());
    }

    /**
     * This test checks the String's equal method.
     *
     * @return void
     */
    public function testEquals()
    {
        // initialize a new String instance
        $string = new String('Mustermann');
        // check that the two Strings are equal
        $this->assertTrue($string->equals(new String('Mustermann')));
    }

    /**
     * This test checks the String's stringValue() method.
     *
     * @return void
     */
    public function testStringValue()
    {
        // initialize a new String instance
        $string = new String($test = 'Mustermann');
        // check that string value of the String instance
        $this->assertEquals($test, $string->stringValue());
    }

    /**
     * This test checks the String's trim() method.
     *
     * @return void
     */
    public function testTrim()
    {
        // initialize a new String instance
        $string = new String(' Mustermann ');
        // check that String was trimmed successfully
        $this->assertTrue($string->trim()->equals(new String('Mustermann')));
    }

    /**
     * This test checks the String's md5() method.
     *
     * @return void
     */
    public function testMd5()
    {
        // initialize a new String instance
        $string = new String('Mustermann');
        // check that String's md5 summs equals
        $this->assertTrue($string->md5()->equals(new String(md5('Mustermann'))));
    }

    /**
     * This test checks the String's toUpperCase() method.
     *
     * @return void
     */
    public function testToUpperCase()
    {
        // initialize a new String instance
        $string = new String('mustermann1');
        // check that String was successfully convered to upper case
        $this->assertTrue($string->toUpperCase()->equals(new String('MUSTERMANN1')));
    }

    /**
     * This test checks the String's toLowerCase() method.
     *
     * @return void
     */
    public function testToLowerCase()
    {
        // initialize a new String instance
        $string = new String('MUSTERMANN1');
        // check that String was successfully convered to upper case
        $this->assertTrue($string->toLowerCase()->equals(new String('mustermann1')));
    }

    /**
     * This test checks the String's concat method.
     *
     * @return void
     */
    public function testConcat()
    {
        // initialize a new String instance
        $string = new String('value to');
        // check that String was successfully concatenated
        $this->assertTrue($string->concat(new String(' search'))->equals(new String('value to search')));
    }

    /**
     * This test checks the String's valueOf method.
     *
     * @return void
     */
    public function testValueOf()
    {
        // initialize a new String instance
        $string = String::valueOf($value = 'value of');
        // check that String was successfully concatenated
        $this->assertTrue($string->equals(new String($string)));
    }
}
