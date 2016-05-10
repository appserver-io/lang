<?php

/**
 * \AppserverIo\Lang\BooleanTest
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
 * This is the test for the Boolean class.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/lang
 * @link      http://www.appserver.io
 */
class BooleanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a Boolean instance and clone it
        $booleanOne = new Boolean(true);
        $clonedOne = clone $booleanOne;
        // serialize/unserialize the Boolean value
        $booleanOne->unserialize($booleanOne->serialize());
        // check that the two Booleans are equal
        $this->assertEquals($clonedOne, $booleanOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        // check for the correct class name
        $this->assertEquals('AppserverIo\Lang\Boolean', Boolean::__getClass());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid boolean value TRUE.
     *
     * @return void
     */
    public function testToStringWithBooleanValueTrue()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean(true);
        // check that the two booleans are equal
        $this->assertEquals('true', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'true'.
     *
     * @return void
     */
    public function testToStringWithStringValueTrue()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('true');
        // check that the two booleans are equal
        $this->assertEquals('true', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'on'.
     *
     * @return void
     */
    public function testToStringWithStringValueOn()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('on');
        // check that the two booleans are equal
        $this->assertEquals('true', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'yes'.
     *
     * @return void
     */
    public function testToStringWithStringValueYes()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('yes');
        // check that the two booleans are equal
        $this->assertEquals('true', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'y'.
     *
     * @return void
     */
    public function testToStringWithStringValueY()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('y');
        // check that the two booleans are equal
        $this->assertEquals('true', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid boolean value FALSE.
     *
     * @return void
     */
    public function testToStringWithBooleanValueFalse()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean(false);
        // check that the two boolean are equal
        $this->assertEquals('false', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'false'.
     *
     * @return void
     */
    public function testToStringWithStringValueFalse()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('false');
        // check that the two boolean are equal
        $this->assertEquals('false', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'off'.
     *
     * @return void
     */
    public function testToStringWithStringValueOff()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('off');
        // check that the two boolean are equal
        $this->assertEquals('false', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'no'.
     *
     * @return void
     */
    public function testToStringWithStringValueNo()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('no');
        // check that the two boolean are equal
        $this->assertEquals('false', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * with a valid string value 'n'.
     *
     * @return void
     */
    public function testToStringWithStringValueN()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean('n');
        // check that the two boolean are equal
        $this->assertEquals('false', $boolean->__toString());
    }

    /**
     * This test checks the Boolean's toString() method
     * returns a valid String instance.
     *
     * @return void
     */
    public function testMethodToStringWithStringValueN()
    {
        // initialize a new Boolean instance
        $boolean = new Boolean(true);
        // check that the two boolean are equal
        $this->assertEquals(new Strng('true'), $boolean->toString());
    }

    /**
     * This test checks the Boolean's __constructor() method
     * by expecting an exception.
     *
     * @return void
     */
    public function testConstructorWithClassCastException()
    {
        // set the expected exception
        $this->setExpectedException('\AppserverIo\Lang\ClassCastException');
        // try to initialize a new Boolean instance
        $boolean = new Boolean('xxx');
    }
}
