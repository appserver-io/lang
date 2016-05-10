<?php

/**
 * \AppserverIo\Lang\StrngTest
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
 * This is the test for the Strng class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class StrngTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a Strng instance and clone it
        $stringOne = new Strng('aStringValue');
        $clonedOne = clone $stringOne;
        // serialize/unserialize the Strng instance
        $stringOne->unserialize($stringOne->serialize());
        // check that the two Strng instances are equal
        $this->assertEquals($clonedOne, $stringOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        $this->assertEquals('AppserverIo\Lang\Strng', Strng::__getClass());
    }

    /**
     * This test checks the Strng's equal method.
     *
     * @return void
     */
    public function testEquals()
    {
        // initialize a new Strng instance
        $string = new Strng('Mustermann');
        // check that the two Strng's are equal
        $this->assertTrue($string->equals(new Strng('Mustermann')));
    }

    /**
     * This test checks the Strng's stringValue() method.
     *
     * @return void
     */
    public function testStringValue()
    {
        // initialize a new Strng instance
        $string = new Strng($test = 'Mustermann');
        // check that string value of the Strng instance
        $this->assertEquals($test, $string->stringValue());
    }

    /**
     * This test checks the Strng's trim() method.
     *
     * @return void
     */
    public function testTrim()
    {
        // initialize a new Strng instance
        $string = new Strng(' Mustermann ');
        // check that Strng was trimmed successfully
        $this->assertTrue($string->trim()->equals(new Strng('Mustermann')));
    }

    /**
     * This test checks the Strng's md5() method.
     *
     * @return void
     */
    public function testMd5()
    {
        // initialize a new Strng instance
        $string = new Strng('Mustermann');
        // check that Strng's md5 summs equals
        $this->assertTrue($string->md5()->equals(new Strng(md5('Mustermann'))));
    }

    /**
     * This test checks the Strng's toUpperCase() method.
     *
     * @return void
     */
    public function testToUpperCase()
    {
        // initialize a new Strng instance
        $string = new Strng('mustermann1');
        // check that Strng was successfully convered to upper case
        $this->assertTrue($string->toUpperCase()->equals(new Strng('MUSTERMANN1')));
    }

    /**
     * This test checks the Strng's toLowerCase() method.
     *
     * @return void
     */
    public function testToLowerCase()
    {
        // initialize a new Strng instance
        $string = new Strng('MUSTERMANN1');
        // check that Strng was successfully convered to upper case
        $this->assertTrue($string->toLowerCase()->equals(new Strng('mustermann1')));
    }

    /**
     * This test checks the Strng's concat method.
     *
     * @return void
     */
    public function testConcat()
    {
        // initialize a new Strng instance
        $string = new Strng('value to');
        // check that Strng was successfully concatenated
        $this->assertTrue($string->concat(new Strng(' search'))->equals(new Strng('value to search')));
    }

    /**
     * This test checks the Strng's valueOf method.
     *
     * @return void
     */
    public function testValueOf()
    {
        // initialize a new Strng instance
        $string = Strng::valueOf($value = 'value of');
        // check that Strng was successfully concatenated
        $this->assertTrue($string->equals(new Strng($string)));
    }
}
