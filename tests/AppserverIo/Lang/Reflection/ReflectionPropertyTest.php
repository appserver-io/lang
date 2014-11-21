<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionPropertyTest
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
class ReflectionPropertyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * A random name for a method.
     *
     * @var string
     */
    const PROPERTY_NAME = 'reflectionProperty';

    /**
     * The reflection property instance we want to test.
     *
     * @var \AppserverIo\Lang\Reflection\ReflectionProperty
     * @MockAnnotation(name=MockAnnotation, description="some description", value="a value")
     */
    protected $reflectionProperty;

    /**
     * Initializes the instance before we run each test.
     *
     * @return void
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->reflectionProperty = new ReflectionProperty(__CLASS__, ReflectionPropertyTest::PROPERTY_NAME);
    }

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a ReflectionProperty instance and clone it
        $propertyOne = new ReflectionProperty(__CLASS__, ReflectionPropertyTest::PROPERTY_NAME);
        $clonedOne = clone $propertyOne;
        // serialize/unserialize the ReflectionProperty
        $propertyOne->unserialize($propertyOne->serialize());
        // check that the two ReflectionProperty instances are equal
        $this->assertEquals($clonedOne, $propertyOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        // check for the correct class name
        $this->assertEquals('AppserverIo\Lang\Reflection\ReflectionProperty', ReflectionProperty::__getClass());
    }

    /**
     * Test if the class annotation is available and has the correct values set.
     *
     * @return void
     * @MockAnnotation(name=MockAnnotation, description="some description", value="a value")
     */
    public function testGetAnnotation()
    {
        $annotation = $this->reflectionProperty->getAnnotation('MockAnnotation');
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
        $this->reflectionProperty->getAnnotation('UnknownAnnotation');
    }
}
