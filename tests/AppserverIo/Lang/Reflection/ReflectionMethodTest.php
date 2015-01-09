<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionMethodTest
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
 * This is the test for the ReflectionMethod class.
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
class ReflectionMethodTest extends \PHPUnit_Framework_TestCase
{

    /**
     * A random name for a method.
     *
     * @var string
     */
    const METHOD_NAME = 'testGetAnnotation';

    const METHOD_WITH_PARAMETERS = 'methodWithTwoParameters';

    /**
     * Initializes the instance before we run each test.
     *
     * @return void
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->reflectionMethod = new ReflectionMethod(__CLASS__, ReflectionMethodTest::METHOD_NAME);
    }

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a ReflectionMethod instance and clone it
        $methodOne = new ReflectionMethod(__CLASS__, ReflectionMethodTest::METHOD_NAME);
        $clonedOne = clone $methodOne;
        // serialize/unserialize the ReflectionMethod
        $methodOne->unserialize($methodOne->serialize());
        // check that the two ReflectionMethod instances are equal
        $this->assertEquals($clonedOne, $methodOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        // check for the correct class name
        $this->assertEquals('AppserverIo\Lang\Reflection\ReflectionMethod', ReflectionMethod::__getClass());
    }

    /**
     * Test if the class annotation is available and has the correct values set.
     *
     * @return void
     * @MockAnnotation(name=MockAnnotation, description="some description", value="a value")
     */
    public function testGetAnnotation()
    {
        $annotation = $this->reflectionMethod->getAnnotation('MockAnnotation');
        $this->assertSame($annotation->getValue('name'), 'MockAnnotation');
        $this->assertSame($annotation->getValue('description'), 'some description');
        $this->assertSame($annotation->getValue('value'), 'a value');
    }

    /**
     * Test if an execption is thrown if a requested annotation is not available.
     *
     * @return void
     * @expectedException AppserverIo\Lang\Reflection\ReflectionException
     */
    public function testGetAnnotationWithException()
    {
        $this->reflectionMethod->getAnnotation('UnknownAnnotation');
    }

    /**
     * Test if the invoke() method passes the args correctly to the method.
     *
     * @return void
     */
    public function testInvokeWithArgs()
    {

        // initialize the array with the values
        $values = array($key = 'test' => $value = 'aValue');

        // create a new MockAnnotation instance
        $reflectionClass = new ReflectionClass('AppserverIo\Lang\Reflection\MockAnnotation');
        $instance = $reflectionClass->newInstanceArgs(array($values));

        // create the reflection method and invoke it with arguments
        $reflectionMethod = $reflectionClass->getMethod('getValue');
        $this->assertSame($value, $reflectionMethod->invoke($instance, $key));
    }

    /**
     * Tests if the method parameters returns the correct number of parameters.
     *
     * @return void
     */
    public function testGetParametersCount()
    {
        $reflectionMethod = new ReflectionMethod(__CLASS__, ReflectionMethodTest::METHOD_WITH_PARAMETERS);
        $this->assertCount(2, $reflectionMethod->getParameters());
    }

    /**
     * Tests if the method parameters returns the correct number of parameters.
     *
     * @return void
     */
    public function testGetParametersName()
    {

        // load the reflection method
        $reflectionMethod = new ReflectionMethod(__CLASS__, ReflectionMethodTest::METHOD_WITH_PARAMETERS);

        // initialize the counter
        $counter = 0;

        // iterate over the parameters and check the parameter names
        foreach ($reflectionMethod->getParameters() as $reflectionParameter) {
            $this->assertSame('test' . $counter++, $reflectionParameter->getParameterName());
        }
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
