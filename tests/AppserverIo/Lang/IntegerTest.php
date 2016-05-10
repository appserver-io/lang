<?php

/**
 * \AppserverIo\Lang\IntegerTest
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
 * This is the test for the Integer class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class IntegerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a Integer instance and clone it
        $integerOne = new Integer(17);
        $clonedOne = clone $integerOne;
        // serialize/unserialize the Integer instance
        $integerOne->unserialize($integerOne->serialize());
        // check that the two Integer instances are equal
        $this->assertEquals($clonedOne, $integerOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        // check for the correct class name
        $this->assertEquals('AppserverIo\Lang\Integer', Integer::__getClass());
    }

    /**
     * This test checks the Integer's equal method.
     *
     * @return void
     */
    public function testEquals()
    {
        // initialize a new Integer instance
        $int = new Integer(1);
        // check that the two Integers are equal
        $this->assertTrue($int->equals(new Integer(1)));
    }

    /**
     * This test checks the Integer's floatValue() method.
     *
     * @return void
     */
    public function testFloatValue()
    {
        // initialize a new Integer instance
        $int = new Integer(17);
        // check that float value of the Integer instance
        $this->assertEquals(17.0, $int->floatValue());
    }

    /**
     * This test checks the Integer's intValue() method.
     *
     * @return void
     */
    public function testIntValue()
    {
        // initialize a new Integer instance
        $int = new Integer(17);
        // check that integer value of the Integer instance
        $this->assertEquals(17, $int->intValue());
    }

    /**
     * This test checks the Integer's doubleValue() method.
     *
     * @return void
     */
    public function testDoubleValue()
    {
        // initialize a new Integer instance
        $int = new Integer(17);
        // check that double value of the Integer instance
        $this->assertEquals(17.0, $int->doubleValue());
    }

    /**
     * This test checks the Integer's valueOf() method.
     *
     * @return void
     */
    public function testValueOf()
    {
        // initialize a new Integer instance
        $int = Integer::valueOf(new Strng('17'));
        // check that the two Integer instances are equal
        $this->assertTrue($int->equals(new Integer(17)));
    }

    /**
     * This test checks the Integer's valueOf() method.
     *
     * @return void
     */
    public function testValueOfWithNumberFormatException()
    {
        // set the expected exception
        $this->setExpectedException('\AppserverIo\Lang\NumberFormatException');
        // initialize a new Integer instance
        $int = Integer::valueOf(new Strng('!17'));
    }

    /**
     * This test checks the Integer's parseInteger() method.
     *
     * @return void
     */
    public function testParseInteger()
    {
        // initialize a new Integer instance
        $int = Integer::parseInteger(new Strng('17'));
        // check that the two integers are equal
        $this->assertEquals(17, $int);
    }

    /**
     * This test checks the Integer's parseInteger() method.
     *
     * @return void
     */
    public function testParseIntegerWithNumberFormaException()
    {
        // set the expected exception
        $this->setExpectedException('\AppserverIo\Lang\NumberFormatException');
        // initialize a new Integer instance
        $int = Integer::parseInteger(new Strng('!17'));
    }

    /**
     * This test checks the Integer's add() method.
     *
     * @return void
     */
    public function testAdd()
    {
        // initialize a new Integer instance
        $int = new Integer(10);
        $int->add(new Integer(22));
        // check the value
        $this->assertEquals(32, $int->intValue());
    }

    /**
     * This test checks the Integer's subtract() method.
     *
     * @return void
     */
    public function testSubtract()
    {
        // initialize a new Integer instance
        $int = new Integer(10);
        $int->subtract(new Integer(32));
        // check the value
        $this->assertEquals(-22, $int->intValue());
    }

    /**
     * This test checks the Integer's multiply() method.
     *
     * @return void
     */
    public function testMultiply()
    {
        // initialize a new Integer instance
        $int = new Integer(10);
        $int->multiply(new Integer(10));
        // check the value
        $this->assertEquals(100, $int->intValue());
    }

    /**
     * This test checks the Integer's divide() method.
     *
     * @return void
     */
    public function testDivide()
    {
        // initialize a new Integer instance
        $int = new Integer(10);
        $int->divide(new Integer(10));
        // check the value
        $this->assertEquals(1, $int->intValue());
    }

    /**
     * This test checks the Integer's divide() method
     * with an odd result.
     *
     * @return void
     */
    public function testDivideToOddNumber()
    {
        // initialize a new Integer instance
        $int = new Integer(11);
        $int->divide(new Integer(3));
        // check the value
        $this->assertEquals(3, $int->intValue());
    }

    /**
     * This test checks the Integer's modulo() method.
     *
     * @return void
     */
    public function testModulo()
    {
        // initialize a new Integer instance
        $int = new Integer(11);
        $remeinder = $int->modulo(new Integer(3));
        // check the value
        $this->assertEquals(2, $remeinder->intValue());
    }

    /**
     * This test checks the Integer's greaterThan() method.
     *
     * @return void
     */
    public function testGreaterThan()
    {
        $int = new Integer(2);
        $this->assertFalse($int->greaterThan(new Integer(3)));
        $this->assertTrue($int->greaterThan(new Integer(1)));
    }

    /**
     * This test checks the Integer's greaterThanOrEqual() method.
     *
     * @return void
     */
    public function testGreaterThanOrEqual()
    {
        $int = new Integer(2);
        $this->assertFalse($int->greaterThanOrEqual(new Integer(3)));
        $this->assertTrue($int->greaterThanOrEqual(new Integer(2)));
        $this->assertTrue($int->greaterThanOrEqual(new Integer(1)));
    }

    /**
     * This test checks the Integer's lowerThan() method.
     *
     * @return void
     */
    public function testLowerThan()
    {
        $int = new Integer(2);
        $this->assertTrue($int->lowerThan(new Integer(3)));
        $this->assertFalse($int->lowerThan(new Integer(1)));
    }

    /**
     * This test checks the Integer's lowerThanOrEqual() method.
     *
     * @return void
     */
    public function testLowerThanOrEqual()
    {
        $int = new Integer(2);
        $this->assertTrue($int->lowerThanOrEqual(new Integer(3)));
        $this->assertTrue($int->lowerThanOrEqual(new Integer(2)));
        $this->assertFalse($int->lowerThanOrEqual(new Integer(1)));
    }
}
