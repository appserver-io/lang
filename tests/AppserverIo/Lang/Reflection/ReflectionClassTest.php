<?php

/**
 * AppserverIo\Lang\Reflection\ReflectionClassTest
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
 * This is the test for the ReflectionClass class.
 *
 * @category   Library
 * @package    Lang
 * @subpackage Reflection
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/lang
 * @link       http://www.appserver.io
 *
 * @MockAnnotation(name=MockAnnotation, description="some description", value="a value")
 */
class ReflectionClassTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The reflection class intance we want to test.
     *
     * @var \AppserverIo\Lang\Reflection\ReflectionClass
     */
    protected $reflectionClass;

    /**
     * Initializes the instance before we run each test.
     *
     * @return void
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {
        $this->reflectionClass = new ReflectionClass(__CLASS__);
    }

    /**
     * Checks the serialize/unserialize methods implemented
     * from the \Serializable interface.
     *
     * @return void
     */
    public function testSerializeAndUnserialize()
    {
        // initialize a ReflectionClass instance and clone it
        $classOne = new ReflectionClass(__CLASS__);
        $clonedOne = clone $classOne;
        // serialize/unserialize the ReflectionClass
        $classOne->unserialize($classOne->serialize());
        // check that the two ReflectionClass instances are equal
        $this->assertEquals($clonedOne, $classOne);
    }

    /**
     * This test checks the resolved class name.
     *
     * @return void
     */
    public function testGetClass()
    {
        // check for the correct class name
        $this->assertEquals('AppserverIo\Lang\Reflection\ReflectionClass', ReflectionClass::__getClass());
    }

    /**
     * Test if the returned class name equals the one passed to the constructor.
     *
     * @return void
     */
    public function testGetClassName()
    {
        $this->assertSame(__CLASS__, $this->reflectionClass->getName());
    }

    /**
     * Test if this method is available in the reflection method list.
     *
     * @return void
     */
    public function testHasMethodWithExistingMethod()
    {
        $this->assertTrue($this->reflectionClass->hasMethod('testGetMethodWithExistingMethod'));
    }

    /**
     * Test if this method is available in the reflection method list.
     *
     * @return void
     */
    public function testGetMethodWithExistingMethod()
    {
        $reflectionMethod = $this->reflectionClass->getMethod($methodName = 'testGetMethodWithExistingMethod');
        $this->assertSame($reflectionMethod->getClassName(), __CLASS__);
        $this->assertSame($reflectionMethod->getMethodName(), $methodName);
    }

    /**
     * Test if this method is available in the reflection method list.
     *
     * @return void @expectedException AppserverIo\Lang\Reflection\ReflectionException
     */
    public function testGetMethodWithException()
    {
        $this->reflectionClass->getMethod('someUnknownMethod');
    }

    /**
     * Test if the class annotation is available.
     *
     * @return void
     */
    public function testHasAnnotationWithExistingAnnotation()
    {
        $this->assertTrue($this->reflectionClass->hasAnnotation('MockAnnotation'));
    }

    /**
     * Test if the class annotation is available and has the correct values set.
     *
     * @return void
     */
    public function testGetAnnotationWithExistingAnnotation()
    {
        $annotation = $this->reflectionClass->getAnnotation('MockAnnotation');
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
        $this->reflectionClass->getAnnotation('UnknownAnnotation');
    }

    /**
     * Checks if the initialization of a reflection class works as exepected.
     *
     * @return void
     */
    public function testFromPhpReflectionClass()
    {
        $reflectionClass = ReflectionClass::fromPhpReflectionClass(new \ReflectionClass($this));
        $this->assertSame(__CLASS__, $reflectionClass->getName());
    }

    /**
     * Checks if the hasMethod() method works as expected.
     *
     * @return void
     */
    public function testHasMethod()
    {
        $this->assertTrue($this->reflectionClass->hasMethod('testHasMethod'));
    }

    /**
     * Checks if the hasProperty() method works as expected.
     *
     * @return void
     */
    public function testHasProperty()
    {
        $this->assertTrue($this->reflectionClass->hasProperty('reflectionClass'));
    }
}
