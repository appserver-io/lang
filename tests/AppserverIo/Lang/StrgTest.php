<?php

/**
 * \AppserverIo\Lang\StrgTest
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
 * This is the test for the Strg class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class StrgTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a Strg instance and clone it
        $stringOne = new Strg('aStringValue');
        $clonedOne = clone $stringOne;
        // serialize/unserialize the Strg instance
        $stringOne->unserialize($stringOne->serialize());
        // check that the two Strg instances are equal
        $this->assertEquals($clonedOne, $stringOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        $this->assertEquals('AppserverIo\Lang\Strg', Strg::__getClass());
    }

    /**
     * This test checks the Strg's equal method.
     *
     * @return void
     */
    public function testEquals()
    {
        // initialize a new Strg instance
        $string = new Strg('Mustermann');
        // check that the two Strg's are equal
        $this->assertTrue($string->equals(new Strg('Mustermann')));
    }

    /**
     * This test checks the Strg's stringValue() method.
     *
     * @return void
     */
    public function testStringValue()
    {
        // initialize a new Strg instance
        $string = new Strg($test = 'Mustermann');
        // check that string value of the Strg instance
        $this->assertEquals($test, $string->stringValue());
    }

    /**
     * This test checks the Strg's trim() method.
     *
     * @return void
     */
    public function testTrim()
    {
        // initialize a new Strg instance
        $string = new Strg(' Mustermann ');
        // check that Strg was trimmed successfully
        $this->assertTrue($string->trim()->equals(new Strg('Mustermann')));
    }

    /**
     * This test checks the Strg's md5() method.
     *
     * @return void
     */
    public function testMd5()
    {
        // initialize a new Strg instance
        $string = new Strg('Mustermann');
        // check that Strg's md5 summs equals
        $this->assertTrue($string->md5()->equals(new Strg(md5('Mustermann'))));
    }

    /**
     * This test checks the Strg's toUpperCase() method.
     *
     * @return void
     */
    public function testToUpperCase()
    {
        // initialize a new Strg instance
        $string = new Strg('mustermann1');
        // check that Strg was successfully convered to upper case
        $this->assertTrue($string->toUpperCase()->equals(new Strg('MUSTERMANN1')));
    }

    /**
     * This test checks the Strg's toLowerCase() method.
     *
     * @return void
     */
    public function testToLowerCase()
    {
        // initialize a new Strg instance
        $string = new Strg('MUSTERMANN1');
        // check that Strg was successfully convered to upper case
        $this->assertTrue($string->toLowerCase()->equals(new Strg('mustermann1')));
    }

    /**
     * This test checks the Strg's concat method.
     *
     * @return void
     */
    public function testConcat()
    {
        // initialize a new Strg instance
        $string = new Strg('value to');
        // check that Strg was successfully concatenated
        $this->assertTrue($string->concat(new Strg(' search'))->equals(new Strg('value to search')));
    }

    /**
     * This test checks the Strg's valueOf method.
     *
     * @return void
     */
    public function testValueOf()
    {
        // initialize a new Strg instance
        $string = Strg::valueOf($value = 'value of');
        // check that Strg was successfully concatenated
        $this->assertTrue($string->equals(new Strg($string)));
    }
}
