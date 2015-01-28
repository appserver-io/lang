<?php

/**
 * \AppserverIo\Lang\FloatTest
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
 * This is the test for the Float class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class FloatTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a Float instance and clone it
        $floatOne = new Float(0.1);
        $clonedOne = clone $floatOne;
        // serialize/unserialize the Float instance
        $floatOne->unserialize($floatOne->serialize());
        // check that the two Float instances are equal
        $this->assertEquals($clonedOne, $floatOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        // check for the correct class name
        $this->assertEquals('AppserverIo\Lang\Float', Float::__getClass());
    }

    /**
     * This test checks the Floats equal method.
     *
     * @return void
     */
    public function testEquals()
    {
        // initialize a new Float instance
        $float = new Float(1.01);
        // check that the two Floats are equal
        $this->assertTrue($float->equals(new Float(1.01)));
    }

    /**
     * This test checks the Float's floatValue() method.
     *
     * @return void
     */
    public function testFloatValue()
    {
        // initialize a new Float instance
        $float = new Float(1.0005);
        // check that float value of the Float instance
        $this->assertEquals(1.0005, $float->floatValue());
    }

    /**
     * This test checks the Float's intValue() method.
     *
     * @return void
     */
    public function testIntValue()
    {
        // initialize a new Float instance
        $float = new Float(17.1);
        // check that float value of the Float instance
        $this->assertEquals(17, $float->intValue());
    }

    /**
     * This test checks the Float's doubleValue() method.
     *
     * @return void
     */
    public function testDoubleValue()
    {
        // initialize a new Float instance
        $float = new Float(17.05);
        // check that double value of the Float instance
        $this->assertEquals(17.05, $float->doubleValue());
    }

    /**
     * This test checks the Float's valueOf() method.
     *
     * @return void
     */
    public function testValueOf()
    {
        // initialize a new Float instance
        $float = Float::valueOf(
            new String('17.6')
        );
        // check that the two Float instances are equal
        $this->assertTrue($float->equals(new Float(17.6)));
    }

    /**
     * This test checks the Float's valueOf() method.
     *
     * @return void
     */
    public function testValueOfWithNumberFormatException()
    {
        // set the expected exception
        $this->setExpectedException('\AppserverIo\Lang\NumberFormatException');
        // initialize a new Float instance
        $int = Float::valueOf(
            new String('!17')
        );
    }

    /**
     * This test checks the Floats's parseFloat() method.
     *
     * @return void
     */
    public function testParseFloat()
    {
        // initialize a new Float instance
        $float = Float::parseFloat(
            new String('17')
        );
        // check that the two floats are equal
        $this->assertEquals(17, $float);
    }

    /**
     * This test checks the Float's parseFloat() method.
     *
     * @return void
     */
    public function testParseFloatWithNumberFormaException()
    {
        // set the expected exception
        $this->setExpectedException('\AppserverIo\Lang\NumberFormatException');
        // initialize a new Float instance
        $float = Float::parseFloat(new String('!17'));
    }

    /**
     * This test checks the Float's add() method.
     *
     * @return void
     */
    public function testAdd()
    {
        // initialize a new Float instance
        $float = new Float(10.005);
        $float->add(new Float(10.105));
        // check the value
        $this->assertEquals(20.11, $float->floatValue());
    }

    /**
     * This test checks the Float's subtract() method.
     *
     * @return void
     */
    public function testSubtract()
    {
        // initialize a new Float instance
        $float = new Float(10.6);
        $float->subtract(new Float(32.6));
        // check the value
        $this->assertEquals(-22, $float->intValue());
    }

    /**
     * This test checks the Float's multiply() method.
     *
     * @return void
     */
    public function testMultiply()
    {
        // initialize a new Float instance
        $int = new Float(10.00);
        $int->multiply(new Float(10.00));
        // check the value
        $this->assertEquals(100.00, $int->floatValue());
    }

    /**
     * This test checks the Float's divide() method.
     *
     * @return void
     */
    public function testDivide()
    {
        // initialize a new Float instance
        $int = new Float(10.00);
        $int->divide(new Float(10.00));
        // check the value
        $this->assertEquals(1.00, $int->floatValue());
    }

    /**
     * This test checks the Float's divide() method
     * with an odd result.
     *
     * @return void
     */
    public function testDivideToOddNumber()
    {
        // initialize a new Float instance
        $float = new Float(11.00);
        $float->divide(new Float(3.00));
        // check the value
        $this->assertEquals(11.00 / 3.00, $float->floatValue());
    }
}
