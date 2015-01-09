<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionParameterTest
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Library
 * @package    Lang
 * @subpackage Reflection
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/lang
 * @link       http://www.appserver.io
 */

namespace AppserverIo\Lang\Reflection;

/**
 * This is the test for the ReflectionParameter class.
 *
 * @category   Library
 * @package    Lang
 * @subpackage Reflection
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/lang
 * @link       http://www.appserver.io
 */
class ReflectionParameterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a ReflectionParameter instance and clone it
        $parameterOne = new ReflectionParameter(__CLASS__, 'methodWithOneParameter', 'test');
        $clonedOne = clone $parameterOne;
        // serialize/unserialize the ReflectionParameter
        $parameterOne->unserialize($parameterOne->serialize());
        // check that the two ReflectionParameter instances are equal
        $this->assertEquals($clonedOne, $parameterOne);
    }

    /**
     * Checks if reflection for a a method with one parameter works.
     *
     * @return void
     */
    public function testMethodWithOneParameter()
    {
        $reflectionParameter = new ReflectionParameter(__CLASS__, 'methodWithOneParameter', 'test');
        $this->assertEquals(0, $reflectionParameter->getPosition());
    }

    /**
     * Checks if reflection for a a method with two parameters works.
     *
     * @return void
     */
    public function testMethodWithTwoParameters()
    {
        $reflectionParameter = new ReflectionParameter(__CLASS__, 'methodWithTwoParameters', 'test1');
        $this->assertEquals(1, $reflectionParameter->getPosition());
    }

    /**
     * A method with one parameter, used for testing purposes.
     *
     * @param string $test A test parameter
     *
     * @return void
     */
    public function methodWithOneParameter($test)
    {
        // we do nothing here
    }

    /**
     * A method with one parameter, used for testing purposes.
     *
     * @param string $test0 First test parameter
     * @param string $test1 Second test parameter
     *
     * @return void
     */
    public function methodWithTwoParameters($test0, $test1)
    {
        // we do nothing here
    }
}
